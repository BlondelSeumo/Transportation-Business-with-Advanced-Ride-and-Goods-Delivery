<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Constants\Masters\FleetDocumentStatus;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
// use App\Http\Requests\Taxi\Driver\FleetDocumentUploadRequest;
use App\Models\Admin\Fleet;
use App\Models\Admin\FleetDocument;
use App\Models\Admin\FleetNeededDocument;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\Notifications\SendPushNotification;

class FleetDocumentController extends BaseController
{
    
    /**
     * The
     *
     * @var App\Base\Services\ImageUploader\ImageUploaderContract
     */
    protected $imageUploader;

    /**
     * DriverController constructor.
     *
     * @param \App\Models\Admin\Driver $driver
     */
    public function __construct(ImageUploaderContract $imageUploader)
    {
        $this->imageUploader = $imageUploader;

    }

    public function index(Fleet $fleet)
    {
        $neededDocument = FleetNeededDocument::whereActive(true)->get();
        $fleetDoc = FleetDocument::whereFleetId($fleet->id)->get();
// dd($fleetDoc);
        $page = trans('pages_names.fleet_document');
        $main_menu = 'manage_fleet';
        $sub_menu = null;

        return view('admin.fleets.documents.index', compact('page', 'main_menu', 'sub_menu', 'fleet', 'neededDocument', 'fleetDoc'));
    }

    public function documentUploadView(Fleet $fleet, FleetNeededDocument $needed_document)
    {
        $fleetDoc = null;
        if ($needed_document->fleetDocument) {
            $fleetDoc = $needed_document->fleetDocument->where('fleet_id', $fleet->id)->whereDocumentId($needed_document->id)->first();
        }

        $page = trans('pages_names.owner_document');
        $main_menu = 'manage_fleets';
        $sub_menu = null;

        return view('admin.fleets.documents.upload', compact('page', 'main_menu', 'sub_menu', 'fleet', 'needed_document', 'fleetDoc'));
    }


    public function uploadDocument(Request $request, Fleet $fleet, FleetNeededDocument $needed_document)
    {
        $expiry_date = $request->expiry_date;
        $this->uploadFleetDoc('document',$expiry_date,$request,$fleet,$needed_document);
     
        $message = trans('succes_messages.fleet_document_uploaded_successfully');

        return redirect("fleets/document/view/$fleet->id")->with('success', $message);
    }


    public function approveFleetDocument(Request $request)
    {
        $status = true;

        $fleet = Fleet::find($request->fleet_id);
        foreach ($request->document_id as $key => $document) {
            if ($document != '') {
                $fleetDoc = FleetDocument::whereId($document)->first();

                $fleetDoc->document_status = $request->document_status[$key];
                $fleetDoc->comment = $request->comment[$key];
                $fleetDoc->save();

                if ($fleetDoc->document_status != 1) {
                    $status = false;
                }
            } else {
                $status = false;
            }
        }

        // if(!$fleet->user->email_confirmed){
        //     $status = false;
        // }

        $status = $status == true ? 1 : 0;
        $fleet->update([
            'approve' => $status
        ]);

        return 'success';
    }

    public function uploadFleetDoc($name,$expiry_date = null,Request $request,Fleet $fleet, FleetNeededDocument $needed_document){
        // dd($needed_document->id);
        $created_params['expiry_date'] = $expiry_date;

        $created_params['fleet_id'] = $fleet->id;
        $created_params['document_id'] = $needed_document->id;

        if ($uploadedFile = $this->getValidatedUpload($name, $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetDocument($fleet->id);
        }

        // Check if document exists
        $fleet_documents = FleetDocument::where('fleet_id', $fleet->id)->where('document_id', $needed_document->id)->first();

        if ($fleet_documents) {
            $created_params['document_status'] = fleetDocumentStatus::REUPLOADED_AND_WAITING_FOR_APPROVAL;
            FleetDocument::where('fleet_id', $fleet->id)->where('document_id', $needed_document->id)->update($created_params);
        } else {
            $created_params['document_status'] = FleetDocumentStatus::UPLOADED_AND_WAITING_FOR_APPROVAL;
            FleetDocument::create($created_params);
        }
    }
  
    public function toggleApprove(Fleet $fleet, $status)
    {
        $status = $status == true ? 1 : 0;

        $this->database->getReference('fleets/'.$fleet->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);


        $fleet->update([
            'approve' => $status
        ]);

        $user = User::find($fleet->user_id);
        if ($status) {
            $title = trans('push_notifications.fleet_approved_title',[],$user->lang);
            $body = trans('push_notifications.fleet_approved_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::FLEET_ACCOUNT_APPROVED];
            $socket_success_message = PushEnums::FLEET_ACCOUNT_APPROVED;
        } else {
            $title = trans('push_notifications.fleet_declined_title',[],$user->lang);
            $body = trans('push_notifications.fleet_declined_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::FLEET_ACCOUNT_DECLINED];
            $socket_success_message = PushEnums::FLEET_ACCOUNT_DECLINED;
        }

        $fleet_details = $user->fleet;
        $fleet_result = fractal($fleet_details, new FleetTransformer);
        $formated_driver = $this->formatResponseData($fleet_result);

        $socket_params = $formated_fleet['data'];
        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = $socket_success_message;
        $socket_data->data  = $socket_params;

        
        // dispatch(new NotifyViaMqtt('approval_status_'.$driver_details->id, json_encode($socket_data), $driver_details->id));

        dispatch(new SendPushNotification($user,$title,$body));
    }
}
