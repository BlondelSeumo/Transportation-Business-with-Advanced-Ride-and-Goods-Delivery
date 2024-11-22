<?php

namespace App\Http\Controllers\Web\Dispatcher;

use App\Base\Filters\Admin\RequestFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Controllers\Web\BaseController;
use App\Models\Request\Request as RequestRequest;
use Illuminate\Http\Request;
use App\Models\Master\PackageType;
use App\Transformers\Requests\PackagesTransformer;
use App\Models\User;
use App\Models\Admin\VehicleType;
use App\Base\Constants\Masters\UserType;
use App\Base\Libraries\Access\Access;
use Illuminate\Support\Facades\Hash;
use App\Models\Request\RequestCycles;
use App\Models\Admin\ServiceLocation;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;
use Kreait\Firebase\Contract\Database;
use App\Models\Request\RequestMeta;
use App\Models\Admin\Driver;
use App\Jobs\Notifications\SendPushNotification;
use Config;
use Log;

class DispatcherController extends BaseController
{
    use FetchDriversFromFirebaseHelpers;
    public function __construct(User $user,Database $database,RequestRequest $request_details)
    {
        $this->database = $database;
        $this->user = $user;
        $this->request_details = $request_details;
    }
    public function index()
    {
        $main_menu = 'dispatch_request';

        $sub_menu = null;

        $page = 'Dispatch Requests';

        return view('admin.dispatcher.requests', compact(['main_menu','sub_menu','page']));
    }

    public function dispatchView(){
        $main_menu = 'dispatch_request';

        $sub_menu = null;

        $page = 'Dispatch Requests';

        $default_lat = env('DEFAULT_LAT');
        $default_lng = env('DEFAULT_LNG');
        return view('admin.dispatcher.dispatch', compact(['main_menu','sub_menu','page', 'default_lat', 'default_lng']));
    }

    public function bookNow()
    {
         $main_menu = 'dispatch_request';

        $sub_menu = null;
         $default_lat = env('DEFAULT_LAT');
        $default_lng = env('DEFAULT_LNG');

        // $page = 'Dispatch Requests';
        return view('dispatch.new-ui.book-now')->with(compact('main_menu','sub_menu','default_lat', 'default_lng'));
    }

    /**
    *
    * create new request
    */
    public function createRequest(Request $request)
    {
        dd($request->all());
    }

    public function loginView(){
        return view('admin.dispatch-login');
    }
    public function detail_view(){
        $request = "W3sic3RhdHVzIjoxLCJwcm9jZXNzX3R5cGUiOiJjcmVhdGVfcmVxdWVzdCIsImlmX2Rpc3BhdGNoZXIiOnRydWUsInVzZXJfaW1hZ2UiOiJodHRwczpcL1wvdGFneGktc2VydmVyLm9uZGVtYW5kYXBwei5jb21cL2Fzc2V0c1wvaW1hZ2VzXC9kZWZhdWx0LXByb2ZpbGUtcGljdHVyZS5wbmciLCJvcmRlcmJ5X3N0YXR1cyI6MSwiZHJpY3Zlcl9kZXRhaWxzIjpudWxsLCJjcmVhdGVkX2F0IjoiMjAyNC0wNi0wNiAwNjo1OTowMCJ9LHsicmF0aW5nIjoiMC4wMCIsInN0YXR1cyI6MSwiaXNfYWNjZXB0IjoyLCJkcmljdmVyX2RldGFpbHMiOnsibmFtZSI6Ik5ha3VsIFNyaSBLdWJlciIsIm1vYmlsZSI6IjYzODIzNTEyODEiLCJpbWFnZSI6Imh0dHBzOlwvXC90YWd4aS1zZXJ2ZXIub25kZW1hbmRhcHB6LmNvbVwvYXNzZXRzXC9pbWFnZXNcL2RlZmF1bHQtcHJvZmlsZS1waWN0dXJlLnBuZyJ9LCJjcmVhdGVkX2F0IjoiMjAyNC0wNi0wNiAwNjo1OTozNCIsIm9yZGVyYnlfc3RhdHVzIjoyLCJwcm9jZXNzX3R5cGUiOiJhY2NlcHQifSx7InJhdGluZyI6IjAuMDAiLCJzdGF0dXMiOjIsImlzX2FjY2VwdCI6MywiZHJpY3Zlcl9kZXRhaWxzIjp7Im5hbWUiOiJOYWt1bCBTcmkgS3ViZXIiLCJtb2JpbGUiOiI2MzgyMzUxMjgxIiwiaW1hZ2UiOiJodHRwczpcL1wvdGFneGktc2VydmVyLm9uZGVtYW5kYXBwei5jb21cL2Fzc2V0c1wvaW1hZ2VzXC9kZWZhdWx0LXByb2ZpbGUtcGljdHVyZS5wbmcifSwiY3JlYXRlZF9hdCI6IjIwMjQtMDYtMDYgMDY6NTk6MzQiLCJvcmRlcmJ5X3N0YXR1cyI6MywicHJvY2Vzc190eXBlIjoiZGVjbGluZSJ9LHsicmF0aW5nIjoiMC4wMCIsInN0YXR1cyI6NCwicHJvY2Vzc190eXBlIjoidHJpcF9hcnJpdmVkIiwib3JkZXJieV9zdGF0dXMiOjQsImRyaWN2ZXJfZGV0YWlscyI6eyJuYW1lIjoiTmFrdWwgU3JpIEt1YmVyIiwibW9iaWxlIjoiNjM4MjM1MTI4MSIsImltYWdlIjoiaHR0cHM6XC9cL3RhZ3hpLXNlcnZlci5vbmRlbWFuZGFwcHouY29tXC9hc3NldHNcL2ltYWdlc1wvZGVmYXVsdC1wcm9maWxlLXBpY3R1cmUucG5nIn0sImNyZWF0ZWRfYXQiOiIyMDI0LTA2LTA2IDA3OjAwOjAwIn0seyJzdGF0dXMiOjcsInByb2Nlc3NfdHlwZSI6InVzZXJfY2FuY2VsbGVkIiwiY3JlYXRlZF9hdCI6IjIwMjQtMDYtMDYgMDc6MDI6NTciLCJkcml2ZXJfZGV0YWlscyI6eyJuYW1lIjoiTmFrdWwiLCJtb2JpbGUiOiI2MzgyMzUxMjgxIiwiaW1hZ2UiOiJodHRwczpcL1wvdGFneGktc2VydmVyLm9uZGVtYW5kYXBwei5jb21cL2Fzc2V0c1wvaW1hZ2VzXC9kZWZhdWx0LXByb2ZpbGUtcGljdHVyZS5wbmcifSwicmF0aW5nIjoiMC4wMCIsIm5hbWUiOiJOYWt1bCBTcmkgS3ViZXIiLCJtb2JpbGUiOiI2MzgyMzUxMjgxIiwiaW1hZ2UiOiJodHRwczpcL1wvdGFneGktc2VydmVyLm9uZGVtYW5kYXBwei5jb21cL2Fzc2V0c1wvaW1hZ2VzXC9kZWZhdWx0LXByb2ZpbGUtcGljdHVyZS5wbmcifV0=";
        $data = json_decode(base64_decode($request));
        // print_r($data);
        // $double_data = [];
        // foreach($data as $k=> $v){
        //     if(isset($v->dricver_details)){
        //         $double_data[] =$v;
        //     }else{
        //         if(isset($v->driver_details)){
        //         $v->dricver_details = $v->driver_details;
        //         unset($v->driver_details);
        //         $double_data[] = $v;
        //         }
        //     }
        // }
        // $double_request = base64_encode(json_encode($double_data));
        // print_r($double_data);
        // print_r("\n".$double_request);
        // exit;
        $timezone = "Asia/Kolkata";
        return view('dispatch-new.detailed-view',compact('data','timezone'));
    }
    public function dashboard(){

        return view('dispatch.home');
    }

    public function dashboardOpen(){

        return view('dispatch.homeopen');
    }

    public function fetchBookingScreen($modal){
        return view("dispatch.$modal");
    }

    public function fetchRequestLists(QueryFilterContract $queryFilter){
        // $query = RequestRequest::where('if_dispatch', true)->where('dispatcher_id',auth()->user()->admin->id);
        $query = RequestRequest::query();

        $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->paginate();

        return view('dispatch.request-list', compact('results'));
    }

    public function profile(){
        return view('dispatch.profile');
    }
    public function authenticate(Request $request){
        $dispatcher = User::where('email',$request->email)->first();
        if($dispatcher->hasRole('dispatcher')){
            if (Hash::check($request->password, $dispatcher->password)) {
                return $this->respondSuccess();
            } else {
                dd('no');
            }
        }
    }
    public function dashboard1(){
        $vehicle_types = VehicleType::where('active', 1)->get();
        $demo = env('APP_FOR') == 'demo' ? 'demo' : 'nil';
        return view('dispatch-new.home',compact('vehicle_types','demo'));
    }
    public function requestView(Request $request){
        $type = 'all';
        $is_completed_count = RequestRequest::where('is_completed',1)->count();
        $user_cancelled_count = RequestRequest::where('is_cancelled',1)->where('cancel_method','1')->count();
        $driver_cancelled_count = RequestRequest::where('is_cancelled',1)->where('cancel_method','2')->count();
        $upcoming_count = RequestRequest::where('is_completed',0)->Where('is_cancelled',0)->where('is_driver_started',0)->where('is_later',1)->count();

        return view('dispatch-new.requests-list',compact('type','is_completed_count','user_cancelled_count','driver_cancelled_count','upcoming_count'));
    }
    public function fetch(Request $request){
        $type = $request->type;
        switch ($type) {
            case 'completed':
                $query = RequestRequest::where('is_completed',1);
                break;
            case 'cancelled':
                $query = RequestRequest::where('is_cancelled',1);
                break;
            case 'upcoming':
                $query = RequestRequest::where('is_completed',0)->Where('is_cancelled',0)->where('is_driver_started',0)->where('is_later',1);
                break;
            default:
                $query = RequestRequest::where('is_completed',1)->orWhere('is_cancelled',1)->orWhere(function($query){
                    $query->where('is_completed',0)->Where('is_cancelled',0)->where('is_driver_started',0)->where('is_later',1);
                });
                break;
        }
        $results = $query->orderBy('created_at','DESC')->paginate();
        return view('dispatch-new._requests',compact('results'));
    }

    public function requestDetailedView(RequestRequest $requestmodel){
        $item = $requestmodel;

        return view('dispatch.request_detail',compact('item'));
    }

    public function ongoingTrip(){
        // $service_location = auth()->user()->admin->service_location_id;
        return view('dispatch-new.ongoing-trip');
    }

    public function detailView(RequestRequest $requestmodel){
        $item = $requestmodel;
        foreach ($item->requestRating as $key => $requestrating) {
            if($requestrating->user_rating){
                $item->user_rating = (int) $requestrating->rating;
            }
            if($requestrating->driver_rating){
                $item->driver_rating = (int) $requestrating->rating;
            }
        }
        // dd($item->driverDetail);
        $item->make = "-------";
        $item->model = "-------";
        if($item->driverDetail)
        {
            $item->make = $item->driverDetail->car_make_name ?? $item->driverDetail->custom_make;
            $item->model = $item->driverDetail->car_make_name ?? $item->driverDetail->custom_model;
        }
        $request_cycles_data = RequestCycles::where('request_id', $item->id)->first();
        $data = [];
        $service_location = ServiceLocation::find($item->service_location_id);
        $timezone = $service_location->timezone;
        if($request_cycles_data)
        {
            $data = json_decode(base64_decode($request_cycles_data->request_data));
        }
        $demo = env('APP_FOR');
        // print_r($data);
        // exit;


        return view('dispatch-new.detailed-view',compact('item','data','timezone','demo'));
    }
    public function book_ride(Request $request){
        $request =(object) $request->all();
        // $type = PackageType::where('transport_type','taxi')->orWhere('transport_type', 'both')->active()->get();

        $app_for = config('app.app_for');
        return view('dispatch-new.book-ride',compact('request','app_for'));
    }
      /**
    * List Packages
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    *
    */
    public function listPackages(Request $request){

        $request->validate([
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
        ]);

        // echo "sdfsdf";
        // exit;
        $app_for = config('app.app_for');
        if($app_for == 'taxi' || $app_for == "delivery"){
            $type = PackageType::active();
        }
        if($request->transport_type == "both")
        {
            $type1 = PackageType::Where('transport_type', 'both')->orWhere('transport_type', 'delivery')->orWhere('transport_type', 'taxi')->active();
        }
        else{
            $type1 = PackageType::where('transport_type',$request->transport_type)->orWhere('transport_type', 'both')->active();
        }
        if(isset($request->data_val))
        {
            $type = $type1->where('id',$request->data_val)->get();
        }
        else{
            $type = $type1->get();
        }

        $result = fractal($type, new PackagesTransformer);
        return $this->respondSuccess($result);

    }
    public function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "KM") {
                return ($miles * 1.609344);
            } elseif ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
    public function assigndriver(RequestRequest $request_model)
    {
        $item = $request_model;

        $place = $item->requestPlace;
        $unit = $item->unit == 1 ? 'km' : 'm';
        $distance = number_format($this->calculate_distance($place->pick_lat,$place->pick_lng,$place->drop_lat,$place->drop_lng,$unit),2);

        $item->distance = $distance * 1.3." ".$unit;
        $demo = env('APP_FOR');
        return view('dispatch-new.assign-driver',compact('item','demo'));
    }
    public function assigmanual(RequestRequest $request_model,Request $request)
    {
        $request->validate([
            'driver_id'  => 'required'
        ]);
        $request_detail = $this->request_details->where('id',$request_model->id)->first();
            $selected_drivers["user_id"] = $request_detail->user_id;
            $selected_drivers["driver_id"] = $request->driver_id;
            $selected_drivers["active"] = 1;
            $selected_drivers["assign_method"] = 1;
            $selected_drivers["created_at"] = date('Y-m-d H:i:s');
            $selected_drivers["updated_at"] = date('Y-m-d H:i:s');
            $request_meta = new RequestMeta();
            $request_meta->request_id = $request_detail->id;
            $request_meta->user_id = $request_detail->user_id;
            $request_meta->driver_id = $request->driver_id;
            $request_meta->assign_method = 1;
            // $request_meta->save();
            $driver = Driver::find((int)($request->driver_id));
            $request_detail->requestMeta()->create($selected_drivers);
            $this->database->getReference('request-meta/'.$request_detail->id)->set(['driver_id'=>$driver->id,'request_id'=>$request_detail->id,'user_id'=>$request_detail->user_id,'active'=>1,'transport_type'=>"taxi",'updated_at'=> Database::SERVER_TIMESTAMP]);


        $notifable_driver = $driver->user;

        $title = trans('push_notifications.new_request_title',[],$notifable_driver->lang);
        $body = trans('push_notifications.new_request_body',[],$notifable_driver->lang);
        $push_data = ['title' => $title,'message' => $body,'push_type'=>'meta-request'];

        dispatch(new SendPushNotification($notifable_driver,$title,$body,$push_data));
        return response()->json(['status'=>true,'message'=>'Assigned Successfully']);
    }
    public function checkuserexist(Request $request)
    {
        $user_exist = $this->user->belongsToRole('user')
        ->where('mobile', $request->mobile)
        ->first();
        Log::info('------------------user_check------------------');
        Log::info($user_exist);
        if($user_exist)
        {
            return response()->json(['status'=>true,'message'=>'user exist','data'=>$user_exist]);
        }
        else{
            return response()->json(['status'=>false]);
        }
    }
    public function viewDispatchLogin()
    {    
        $recaptcha_enabled = get_settings('enable_recaptcha') ?? false; 
        
        return view('dispatch-new.login',compact('recaptcha_enabled'));
    }
    
     public function requestcancelRide($requestmodel)
     {

        $requestsmodel = RequestRequest::find($requestmodel);
        if($requestsmodel){
            $requestsmodel->update(['is_cancelled'=>true, 'cancelled_at'=>date('Y-m-d H:i:s'), 'cancel_method'=>UserType::DISPATCHER]);
    
            $requestsmodel->fresh();
    
            if($requestsmodel->driver_id){
                Driver::find($requestsmodel->driver_id)->update(['available'=>true, 'updated_at'=>Database::SERVER_TIMESTAMP]);
            }
    
            $requestsmodel->requestMeta()->delete();
    

            // $push_data = ['title' => $title,'message' => $body,'push_type'=>'general'];
    
            if($requestsmodel->driverDetail)
            {
                $notifiable_driver = $requestsmodel->driverDetail->user;
        
            $title = trans('push_notifications.trip_cancelled_by_user_title',[],$notifiable_driver->lang);
            $body = trans('push_notifications.trip_cancelled_by_user_body',[],$notifiable_driver->lang);

                dispatch(new SendPushNotification($notifiable_driver,$title,$body));
            }
        }

            $this->database->getReference('request-meta/'.$requestmodel)->remove();
    
            // Update Request
            $this->database->getReference('requests/'.$requestmodel)->update(['is_cancelled'=>true,'updated_at'=> Database::SERVER_TIMESTAMP, 'cancelled_by_user'=>true]);
        return $this->respondSuccess(null, 'Trip Cancelled successfully.');
    }
}
