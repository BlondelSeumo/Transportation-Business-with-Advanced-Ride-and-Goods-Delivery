<?php

namespace App\Http\Controllers\Api\V1\Request;

use Carbon\Carbon;
use App\Models\Request\Chat;
use App\Models\User; 
use App\Models\ChatMessage; 
use App\Models\Chat as AdminChat;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Request\Request as RequestModel;
use App\Base\Constants\Masters\PushEnums;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\NotifyViaMqtt;
use Illuminate\Http\Request;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Support\Facades\Validator; 
use Kreait\Firebase\Contract\Database;
use App\Models\Admin\ServiceLocation;
use Illuminate\Support\Facades\Log;

/**
 * @group Request-Chat
 *
 * APIs for In app chat b/w user/driver
 */
class ChatController extends BaseController
{

    protected $chat;

    function __construct(Chat $chat,Database $database)
    {
        $this->chat = $chat;
        $this->database = $database;
    }


    /**
     * Chat history for both user & driver
     *
     */
    public function history(RequestModel $request)
    {


        $chats = $request->requestChat()->orderBy('created_at', 'asc')->get();

        if (access()->hasRole(Role::USER)) {
            $from_type = 1;
        } else {
            $from_type = 2;
        }
        foreach ($chats as $key => $chat) {
            if ($chat->from_type == $from_type) {

                $chats[$key]['message_status'] = 'send';
            } else {
                $chats[$key]['message_status'] = 'receive';
            }
        }

        return $this->respondSuccess($chats, 'chats_listed');
    }

    /**
     * Update Seen
     * 
     * 
     * */
    public function updateSeen(Request $request){

        if (access()->hasRole(Role::USER)) {
            $seen_from_type = 2;
        } else {
            $seen_from_type = 1;
        }

        $request_detail = RequestModel::find($request->request_id);

        // $request_detail->requestChat()->where('from_type',$seen_from_type)->update(['seen'=>true]);

        if($request_detail && $request_detail->requestChat()) // Ensure $request_detail is not null and requestChat() is not null
        {
            $request_detail->requestChat()->where('from_type', $seen_from_type)->update(['seen' => true]);
        } 
        // else {
        //     return $this->respondError('Request or chat not found', 404);
        // }


        return $this->respondSuccess(null, 'message_seen_successfully');


    }

    /**
     * Send Chat Message
     * @bodyParam request_id uuid required request id of the trip
     * @bodyParam message string required message of chat
     */
    public function send(Request $request)
    {
        if (access()->hasRole(Role::USER)) {
            $from_type = 1;
        } else {
            $from_type = 2;
        }

        $request_detail = RequestModel::find($request->request_id);

        $request_detail->requestChat()->create([
            'message' => $request->message,
            'from_type' => $from_type,
            'user_id' => auth()->user()->id
        ]);

        $chats = $request_detail->requestChat()->orderBy('created_at', 'asc')->get();


        if (access()->hasRole(Role::USER)) {
            $from_type = 1;
            $user_type = 'user';
            $driver = $request_detail->driverDetail;
            $notifable_driver = $driver->user;
        } else {
            $from_type = 2;
            $user_type = 'driver';
            $driver = $request_detail->userDetail;
            $notifable_driver = $driver;
        }
        foreach ($chats as $key => $chat) {
            if ($chat->from_type == $from_type) {

                $chats[$key]['message_status'] = 'receive';
            } else {
                $chats[$key]['message_status'] = 'send';


            }
        }


        // $socket_data = new \stdClass();
        // $socket_data->success = true;
        // $socket_data->success_message  = PushEnums::NEW_MESSAGE;
        // $socket_data->data = $chats;

        // dispatch(new NotifyViaMqtt('new_message_' . $driver->id, json_encode($socket_data), $driver->id));


        $title = 'New Message From ' . auth()->user()->name;
        $body = $request->message;

        dispatch(new SendPushNotification($notifable_driver,$title,$body));

        return $this->respondSuccess(null, 'message_sent_successfully');
    }

     /**
     * Chat initiate and get chat messages
     *
     */
    public function chat_initiate(Request $request)
    {   
        $user_id = auth()->user()->id;   
        $country = auth()->user()->country;
        $timezone = ServiceLocation::where('country',$country)->pluck('timezone')->first()?:'UTC'; 
        $check_data_exists = AdminChat::where('user_id',$user_id)->first(); 
        if($check_data_exists)
        { 
            ChatMessage::where('chat_id',$check_data_exists->id)->where('to_id',$user_id)->update(['unseen_count'=>1]);
            $chat_messages = ChatMessage::where('chat_id',$check_data_exists->id)->get();
            foreach($chat_messages as $k=>$v)
            {
                $v->user_timezone = Carbon::parse($v->created_at)->setTimezone($timezone)->format('jS M h:i A'); 
            }
            $data['chats'] = $chat_messages;
            $data['new_chat'] = 0;
            $data['chat_id'] = $check_data_exists->id; 
            $data['count'] = 0;  
            $response_array = array("success"=>true,'data'=>$data);
        }
        else{ 
            $data['chats'] = [];
            $data['new_chat'] = 1;  
            $response_array = array("success"=>true,'data'=>$data);
        }
        return response()->json($response_array);  
    }
        /**
     * send message to admin
     *
     */
    public function send_message(Request $request)
    {
        $validate_array = [
            'new_chat' => 'required', 
            'message' => 'required',
           ];
        $validator = Validator::make($request->all(),$validate_array );
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response_array = array("success"=>false,"message"=>$errors->all());
            return response()->json($response_array); 
        }   
        if($request->new_chat == 1)
        {
            $chat = new AdminChat(); 
            $chat->user_id = auth()->user()->id;
            $chat->save();  
            $chat_id = $chat->id;
        } 
        else{
            $chat_id = $request->chat_id;
        }
        $chat_messages = new ChatMessage();
        $chat_messages->chat_id = $chat_id;
        $chat_messages->from_id = auth()->user()->id;
        $chat_messages->to_id = 1;
        $chat_messages->message = $request->message;
        $chat_messages->save();  
        $data = [
            'message' => $request->message, 
            'chat_id' => $chat_id, 
            'from_id' => auth()->user()->id, 
            'to_id' => 1, 
            'count' => 0, 
            'new_chat'=> $request->new_chat,
            'created_at'=> Database::SERVER_TIMESTAMP
        ]; 
        $chatRef = $this->database->getReference('chats/'.$chat_id);
        $NewchatRef = $chatRef->set($data);
        $chat_id = $NewchatRef->getKey(); 
        $data['message_success'] = "Data inserted successfully"; 
        $country = auth()->user()->country;
        $timezone = ServiceLocation::where('country',$country)->pluck('timezone')->first()?:'UTC'; 
        $data['user_timezone'] = Carbon::parse($chat_messages->created_at)->setTimezone($timezone)->format('jS M h:i A'); 
        return response()->json(["success"=>true,'data' => $data]); 
    }  
    public function update_notication_count(Request $request)
    {  
      ChatMessage::where('chat_id',$request->chat_id)->update(['unseen_count'=>1]);
      return response()->json(array("success"=>true,"message"=>"Updated successfully"));
    }
}
  