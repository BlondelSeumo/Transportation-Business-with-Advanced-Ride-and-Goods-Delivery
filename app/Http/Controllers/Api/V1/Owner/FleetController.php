<?php

namespace App\Http\Controllers\Api\V1\Owner;

use App\Models\Admin\Driver;
use Illuminate\Support\Carbon;
use App\Transformers\Driver\DriverProfileTransformer;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Admin\Fleet;
use Illuminate\Http\Request;
use App\Transformers\Driver\DriverTransformer;
use App\Transformers\Owner\FleetTransformer;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Admin\FleetNeededDocument;
use App\Transformers\Owner\FleetNeededDocumentTransformer;
use App\Models\Admin\FleetDocument;
use App\Jobs\Notifications\AndroidPushNotification;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;


class FleetController extends BaseController
{
    protected $driver;
    protected $fleet;


    public function __construct(Driver $driver,Fleet $fleet,ImageUploaderContract $imageUploader,Database $database)
    {
        $this->driver = $driver;

        $this->fleet = $fleet;

        $this->imageUploader = $imageUploader;

        $this->database = $database;

    }

    /**
    * List Fleets
    * @group Fleet-Owner-apis
    * @return \Illuminate\Http\JsonResponse
    * @responseFile responses/driver/Online-OfflineResponse.json
    * @responseFile responses/driver/DriverOfflineResponse.json
    */
    public function index()
    {
        $fleets = Fleet::where('owner_id',auth()->user()->id)->get();

        $result = fractal($fleets, new FleetTransformer);

        return $this->respondSuccess($result,'fleet_listed');
    }


    /**
     * Store Fleets
     * 
     * 
     * */
    public function storeFleet(Request $request){

        $created_params = $request->only(['vehicle_type','car_color']);

        $created_params['brand'] = $request->car_make;
        $created_params['model'] = $request->car_model;
        $created_params['custom_make']=$request->custom_make;
        $created_params['custom_model']=$request->custom_model;
        $created_params['license_number'] = $request->car_number;
        $created_params['owner_id'] = auth()->user()->id;

        $fleet = $this->fleet->create($created_params);

        return $this->respondSuccess();
    }



    /**
     * List Drivers For Assign Drivers
     * 
     * 
     * */
    public function listDrivers()
    {
        $owner_id = auth()->user()->owner->id;


        $drivers = Driver::where('owner_id','=',$owner_id)->get();

        if(request()->has('fleet_id') && request()->fleet_id){

        $drivers = Driver::where('owner_id','=',$owner_id)->where('approve',true)->where(function($query) use ($owner_id){
            $query->where('fleet_id','!=',request()->fleet_id)->orWhere('fleet_id',null);
        })->get();

        }

        $result = fractal($drivers, new DriverTransformer);

        return $this->respondOk($result);

    }

    /**
     * Assign Drivers
     * 
     * 
     * */
    public function assignDriver(Request $request,Fleet $fleet)
    {
        $driver = Driver::whereId($request->driver_id)->first();
        
        $request->validate([
        'driver_id' => 'required',
        ]);

        if($fleet->driver_id==$request->driver_id){
            
            return $this->respondSuccess();

        }
        if($fleet->driverDetail){

            $fleet_driver = $fleet->driverDetail;

            // $title = trans('push_notifications.fleet_removed_from_your_account_title');
            // $body = trans('push_notifications.fleet_removed_from_your_account_body');
           
            $title = trans('push_notifications.fleet_removed_from_your_account_title',[],$fleet_driver->user->lang);
            $body = trans('push_notifications.fleet_removed_from_your_account_body',[],$fleet_driver->user->lang);

            $this->database->getReference('drivers/'.'driver_'.$fleet_driver->id)->update(['fleet_changed'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

            $notifable_driver = $fleet_driver->user;
            dispatch(new SendPushNotification($notifable_driver,$title,$body));

            $fleet->driverDetail()->update(['fleet_id'=>null,'vehicle_type'=>null,
            'car_make' => null,
            'car_model' => null,
            'car_color' => null,
            'custom_make'=>null,
            'custom_model'=>null  ,         
        ]);


        }

        $fleet->fresh();

        if($driver->fleetDetail){

            $driver->fleetDetail()->update(['driver_id'=>null]);

        }

        $driver->fresh();

        $fleet->update(['driver_id'=>$request->driver_id]);


        $driver->drivervehicleTypeDetail()->delete();
        $driver->drivervehicleTypeDetail()->create(['vehicle_type'=>$fleet->vehicle_type]);
        $driver->update([
            'fleet_id' => $fleet->id,
            'vehicle_type' => $fleet->vehicle_type,
            'car_make' => $fleet->brand,
            'car_model' => $fleet->model,
            'custom_make' => $fleet->custom_make,
            'custom_model' => $fleet->custom_model,
            'car_color' => $fleet->car_color,

        ]);

        $driver->fresh();

        // $title = trans('push_notifications.new_fleet_assigned_title');
        // $body = trans('push_notifications.new_fleet_assigned_body');

        $notifable_driver = $driver->user;
        $title = trans('push_notifications.new_fleet_assigned_title',[],$notifable_driver->lang);
        $body = trans('push_notifications.new_fleet_assigned_body',[],$notifable_driver->lang);

        dispatch(new SendPushNotification($notifable_driver,$title,$body));

        $this->database->getReference('drivers/driver_'.$driver->id)->update(['fleet_changed'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        return $this->respondSuccess();
        
    }

    /**
     * List of Fleet Needed Documents
     * 
     * */
    public function neededDocuments(){

        $ownerneededdocumentQuery  = FleetNeededDocument::active()->get();

        $neededdocument =  fractal($ownerneededdocumentQuery, new FleetNeededDocumentTransformer);

            foreach (FleetNeededDocument::active()->get() as $key => $needed_document) {
            if (FleetDocument::where('fleet_id', request()->fleet_id)->where('document_id', $needed_document->id)->exists()) {
                $uploaded_document = true;
            } else {
                $uploaded_document = false;
            }
        }


        $formated_document = $this->formatResponseData($neededdocument);

        return response()->json(['success'=>true,"message"=>'success','enable_submit_button'=>$uploaded_document,'data'=>$formated_document['data']]);

    }


}
