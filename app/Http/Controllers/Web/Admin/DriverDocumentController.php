<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;
use App\Jobs\NotifyViaSocket;
use App\Http\Controllers\Controller;
use App\Models\Admin\DriverDocument;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Admin\DriverNeededDocument;
use App\Http\Controllers\Web\BaseController;
use App\Transformers\Driver\DriverTransformer;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Requests\Admin\Driver\DriverDocumentUploadRequest;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;

class DriverDocumentController extends BaseController
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
    public function __construct(ImageUploaderContract $imageUploader,Database $database)
    {
        $this->imageUploader = $imageUploader;
        $this->database = $database;
    }

    public function index(Driver $driver)
    {
        if($driver->owner_id){
            $neededDocument = DriverNeededDocument::where(function($query) {
                $query->where('account_type', 'fleet_driver')
                      ->orWhere('account_type', 'both');
            })->where('active', true)->get();
        }else{
            $neededDocument = DriverNeededDocument::where(function($query) {
                $query->where('account_type', 'individual')
                      ->orWhere('account_type', 'both');
            })->where('active', true)->get();
        }
        $driverDoc = DriverDocument::whereDriverId($driver->id)->get();

        $page = trans('pages_names.driver_document');
        $main_menu = 'drivers';
        $sub_menu = 'driver_details';

        return view('admin.drivers.documents.index', compact('page', 'main_menu', 'sub_menu', 'driver', 'neededDocument', 'driverDoc'));
    }

    public function documentUploadView(Driver $driver, DriverNeededDocument $needed_document)
    {
        $driverDoc = null;
        if ($needed_document->driverDocument) {
            $driverDoc = $needed_document->driverDocument->where('driver_id', $driver->id)->whereDocumentId($needed_document->id)->first();
        }

        $page = trans('pages_names.driver_document');
        $main_menu = 'drivers';
        $sub_menu = 'driver_details';

        return view('admin.drivers.documents.upload', compact('page', 'main_menu', 'sub_menu', 'driver', 'needed_document', 'driverDoc'));
    }

    public function uploadDocument(DriverDocumentUploadRequest $request, Driver $driver, DriverNeededDocument $needed_document)
    {
        $created_params = $request->only(['identify_number','expiry_date']);

        $created_params['driver_id'] = $driver->id;
        $created_params['document_id'] = $needed_document->id;

        if ($uploadedFile = $this->getValidatedUpload('document', $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveDriverDocument($driver->id);
        }

        // Check if document exists
        $driver_documents = DriverDocument::where('driver_id', $driver->id)->where('document_id', $needed_document->id)->first();

        if ($driver_documents) {
            $created_params['document_status'] = DriverDocumentStatus::REUPLOADED_AND_WAITING_FOR_APPROVAL;
            DriverDocument::where('driver_id', $driver->id)->where('document_id', $needed_document->id)->update($created_params);
        } else {
            $created_params['document_status'] = DriverDocumentStatus::UPLOADED_AND_WAITING_FOR_APPROVAL;
            DriverDocument::create($created_params);
        }

        return redirect("drivers/document/view/$driver->id");
    }


    public function approveDriverDocument(Request $request)
    {
        $status = true;

        $driver = Driver::find($request->driver_id);
        foreach ($request->document_id as $key => $document) {
            if ($document != '') {
                $driverDoc = DriverDocument::whereId($document)->first();

                $driverDoc->document_status = $request->document_status[$key];
                $driverDoc->comment = $request->comment[$key];
                $driverDoc->save();

                if ($driverDoc->document_status != 1) {
                    $status = false;
                }
            } else {
                $status = false;
            }
        }

        $this->toggleApprove($driver, $status);

        return 'success';
    }


    public function toggleApprove(Driver $driver, $status)
    {
        $status = $status == true ? 1 : 0;

        $this->database->getReference('drivers/driver_'.$driver->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);


        $driver->update([
            'approve' => $status
        ]);

        $user = User::find($driver->user_id);
        if ($status) {    
        $title = trans('push_notifications.driver_approved',[],$user->lang);
        $body = trans('push_notifications.driver_approved_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::DRIVER_ACCOUNT_APPROVED];
            $socket_success_message = PushEnums::DRIVER_ACCOUNT_APPROVED;
        } else {
        $title = trans('push_notifications.driver_declined_title',[],$user->lang);
        $body = trans('push_notifications.driver_declined_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::DRIVER_ACCOUNT_DECLINED];
            $socket_success_message = PushEnums::DRIVER_ACCOUNT_DECLINED;
        }

        $driver_details = $user->driver;
        $driver_result = fractal($driver_details, new DriverTransformer);
        $formated_driver = $this->formatResponseData($driver_result);

        $socket_params = $formated_driver['data'];
        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = $socket_success_message;
        $socket_data->data  = $socket_params;

        
        // dispatch(new NotifyViaMqtt('approval_status_'.$driver_details->id, json_encode($socket_data), $driver_details->id));

        dispatch(new SendPushNotification($user,$title,$body));
    }
}
