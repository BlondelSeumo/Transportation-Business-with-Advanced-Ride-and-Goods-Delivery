<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Constants\Auth\Role as RoleSlug;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Admin\Fleet\FleetStoreRequest;
use App\Models\Admin\AreaType;
use App\Models\Admin\Driver;
use App\Models\Admin\Owner;
use App\Models\Admin\Fleet;
use App\Models\Admin\VehicleType;
use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Admin\FleetNeededDocument;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\Notifications\SendPushNotification;


class FleetController extends BaseController
{
    
    /**
     * The Fleet model instance.
     *
     * @var \App\Models\Admin\Fleet
     */
    protected $fleet;

    /**
     * FleetController constructor.
     *
     * @param \App\Models\Admin\Fleet $fleet
     */
    public function __construct(Fleet $fleet, ImageUploaderContract $imageUploader)
    {
        $this->fleet = $fleet;
        $this->imageUploader = $imageUploader;
    }

    public function index()
    {
        $page = trans('pages_names.fleets');
        $main_menu = 'manage_fleet';
        $sub_menu = '';

        return view('admin.fleets.index', compact('page', 'main_menu', 'sub_menu'))->render();
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = Fleet::query();
        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        return view('admin.fleets._fleets', compact('results'))->render();
    }

    public function create()
    {
        $page = trans('pages_names.add_fleet');

        $main_menu = 'manage_fleet';
        $sub_menu = '';
        $me = Owner::where('user_id',1010)->first();
        $my_fleet = $this->fleet->whereOwnerId($me->user_id)->count();
       
        $types = VehicleType::active()->get();
        $owner = Owner::where('approve',true)
                    ->whereRaw('(SELECT COUNT(*) FROM fleets WHERE fleets.owner_id = owners.user_id) < owners.no_of_vehicles')
                    ->get();

        return view('admin.fleets.create', compact('page', 'main_menu', 'sub_menu','types','owner'));
    }

    public function store(FleetStoreRequest $request)
    {
        $owner = Owner::where('user_id',$request->owner_id)->first();

        $created_params = $request->only(['custom_make','custom_model','license_number','permission_number']);
        $created_params['vehicle_type'] = $request->type;
        $created_params['owner_id'] = $owner->user->id;

        $fleet = $this->fleet->create($created_params);

        if ($uploadedFile = $this->getValidatedUpload('registration_certificate', $request)) {
            $fleet_document['registration_certificate'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetRegistrationCertificateImage();
        }

        if ($uploadedFile = $this->getValidatedUpload('vehicle_back_side', $request)) {
            $fleet_document['vehicle_back_side'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetBackSideImage();
        }

        if($uploadedFile){
            foreach($fleet_document as $key => $image){
                $fleet->fleetDocument()->create(['name' => $key,'image' => $image]);
            }
        }

        $message = trans('succes_messages.fleet_added_succesfully');

        return redirect('fleets')->with('success', $message);
    }

    public function getById(Fleet $fleet)
    {
        $page = trans('pages_names.edit_fleet');
        $item = $fleet;

        $main_menu = 'manage_fleet';
        $sub_menu = '';

        
        $types = VehicleType::active()->get();

        return view('admin.fleets.update', compact('page', 'item', 'main_menu', 'sub_menu','types'));
    }


    public function update(FleetStoreRequest $request,Fleet $fleet)
    {
        $updated_params = $request->only(['custom_make','custom_model','license_number','permission_number']);
        $updated_params['vehicle_type'] = $request->type;

        
        $fleet->update($updated_params);
   
        if ($uploadedFile = $this->getValidatedUpload('registration_certificate', $request)) {
            $fleet_document['registration_certificate'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetRegistrationCertificateImage();
        }

        if ($uploadedFile = $this->getValidatedUpload('vehicle_back_side', $request)) {
            $fleet_document['vehicle_back_side'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetBackSideImage();
        }

        if($uploadedFile){
            foreach($fleet_document as $key => $image){
                $fleet->fleetDocument()->update(['name' => $key,'image' => $image]);
            }
        }

        $message = trans('succes_messages.fleet_updated_succesfully');

        return redirect('fleets')->with('success', $message);
    }


    public function toggleStatus(Fleet $fleet)
    {
        $status = $fleet->active == 1 ? 0 : 1;

        $fleet->update([
            'active' => $status
        ]);

        $message = trans('succes_messages.fleet_status_changed_succesfully');

        return redirect('fleets')->with('success', $message);
    }

    public function toggleApprove(Fleet $fleet)
    {
        $status = $fleet->approve == 1 ? 0 : 1;


        if ($status) {
            $err = false;
            $neededDoc = FleetNeededDocument::count();

            $uploadedDoc = count($fleet->fleetDocument);

            if ($neededDoc != $uploadedDoc) {
                return redirect('fleets/document/view/'.$fleet->id);
            }

            foreach ($fleet->fleetDocument as $fleetDoc) {
                if ($fleetDoc->document_status != 1) {
                    $err = true;
                }
            }

            if ($err) {
                $message = trans('succes_messages.driver_document_not_approved');
                return redirect('fleets/document/view/'.$fleet->id);
            }

        }

        $fleet->update([
            'approve' => $status
        ]);

        $fleet->fresh();

        $user = $fleet->user;

        $title = trans('push_notifications.fleet_declined_title',[],$user->lang);
        $body = trans('push_notifications.fleet_declined_body',[],$user->lang);


        if($status){
            $title = trans('push_notifications.fleet_approved_title',[],$user->lang);
            $body = trans('push_notifications.fleet_approved_body',[],$user->lang);
        }
        
        dispatch(new SendPushNotification($user,$title,$body));

        $message = trans('succes_messages.fleet_approval_status_changed_succesfully');
        return redirect('fleets')->with('success', $message);
    }

    public function updateFleetDeclineReason(Request $request){
        Fleet::whereId($request->id)->update([
            'reason' => $request->reason
        ]);

        return 'success';
    }

    public function delete(Fleet $fleet)
    {
        $fleet->delete();

        $message = trans('succes_messages.fleet_deleted_succesfully');

        return redirect('fleets')->with('success', $message);
    }

    public function generateQRCode($fleet){
        do {
            $code = str_random(30);
        } while ($this->fleet->whereFleetId($code)->exists());

        $qr_code_image_name = 'qrcode-'.$fleet->id.'.svg';

        $qr_code = QrCode::size(500)
            // ->format('svg')
            ->generate($code, storage_path('app/public/uploads/qr-codes/'.$qr_code_image_name));

        return ['code'=>$code,'qrcode'=>$qr_code_image_name];
    }

    public function assignDriverView(Fleet $fleet)
    {
        $page = trans('pages_names.fleets');
        $main_menu = 'manage_fleet';
        $sub_menu = '';

        $drivers = Driver::whereOwnerId(auth()->user()->owner->id)->whereNull('fleet_id')->get();

        return view('admin.fleets.assign_driver', compact('page', 'main_menu', 'sub_menu','drivers','fleet'));
    }

    public function assignDriver(Request $request,Fleet $fleet)
    {
        $driver = Driver::whereId($request->driver)->first();
        $isVehicleAlreadyAssigned = Driver::whereFleetId($fleet->id)->whereApprove(true)->whereActive(true)->whereAvailable(false)->exists();

        if ($isVehicleAlreadyAssigned) {
            return back()->withErrors('Fleet already assigned with another driver')->withInput($request->all());
        }

        if ($driver->fleet_id != null) {
            return back()->withErrors('Selected driver is already assigned with another vehicle')->withInput($request->all());
        }

        $driver->update([
            'fleet_id' => $fleet->id,
            'vehicle_type' => $fleet->vehicle_type
        ]);
        $driver->update([
            'custom_make'=> $fleet->custom_make,
            'custom_model'=> $fleet->custom_model
        ]);
        $message = trans('succes_messages.driver_assigned_succesfully');

        return redirect('fleets')->with('success', $message);
    }
}
