<?php

namespace App\Http\Controllers\Api\V1\Driver;

use Illuminate\Http\Request;
use App\Models\Admin\DriverDocument;
use App\Models\Admin\DriverNeededDocument;
use App\Models\Admin\OwnerNeededDocument;
use App\Http\Controllers\Api\V1\BaseController;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Transformers\DriverNeededDocumentTransformer;
use App\Transformers\Driver\DriverDocumentTransformer;
use App\Http\Requests\Driver\DriverDocumentUploadRequest;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Transformers\Owner\OwnerNeededDocumentTransformer;
use App\Base\Constants\Auth\Role;
use App\Models\Admin\OwnerDocument;
use App\Models\Admin\FleetDocument;
use App\Models\Admin\Fleet;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\User;
use App\Base\Constants\Masters\PushEnums;
/**
 * @group Driver Document Management
 *
 * APIs for DriverNeededDocument's
 */
class DriverDocumentController extends BaseController
{
    /**
    * ImageUploader instance.
    *
    * @var ImageUploaderContract
    */
    protected $imageUploader;

    /**
     * DriverDocumentController constructor.
     *
     * @param ImageUploaderContract $imageUploader
     */
    public function __construct(ImageUploaderContract $imageUploader,Database $database)
    {
        $this->imageUploader = $imageUploader;
        $this->database = $database;

    }
    /**
    * Get All documents needed to be uploaded
    * @responseFile responses/driver/ListAllDocumentNeededWithUploadedDocuments.json
    */
    public function index()
    {   

        if (auth()->user()->hasRole(Role::DRIVER)) {

        $driver_id = auth()->user()->driver->id;

        if(auth()->user()->driver->owner_id){
            $driverneededdocumentQuery  = DriverNeededDocument::active()->where(function($query){
                $query->where('account_type','fleet_driver')->orWhere('account_type','both');
            })->get();
        }else{

        $driverneededdocumentQuery  = DriverNeededDocument::active()->where(function($query){
                $query->where('account_type','individual')->orWhere('account_type','both');
            })->get();
            
        }

        $neededdocument =  fractal($driverneededdocumentQuery, new DriverNeededDocumentTransformer);

        $driver_needed_docs = DriverNeededDocument::whereActive(true)->get();

        foreach ($driver_needed_docs as $key => $needed_document) {

            if (auth()->user()->driver->driverDocument()->exists()) {
                $uploaded_document = true;
            } else {
                $uploaded_document = false;
            }
        }

        }else{

            $owner_id = auth()->user()->owner->id;

            $ownerneededdocumentQuery  = OwnerNeededDocument::active()->get();

            $neededdocument =  fractal($ownerneededdocumentQuery, new OwnerNeededDocumentTransformer);

            foreach (OwnerNeededDocument::active()->get() as $key => $needed_document) {
            if (OwnerDocument::where('owner_id', $owner_id)->where('document_id', $needed_document->id)->exists()) {
                $uploaded_document = true;
            } else {
                $uploaded_document = false;
            }
        }

        }
        

        $formated_document = $this->formatResponseData($neededdocument);

        return response()->json(['success'=>true,"message"=>'success','enable_submit_button'=>$uploaded_document,'data'=>$formated_document['data']]);
    }

    /**
    * Upload Driver's Document
    * @bodyParam document_id integer required id of the documents needed uploaded
    * @bodyParam identify_number string optional identify number of the document, required sometimes depends on the document
    * @bodyParam expiry_date date required expiry date of the document, the date should be in the format "date_format:Y-m-d H:i:s", eg:2020-08-13 00:00:00
    * @bodyParam document image required document file provided by user
    * @response {
    "success": true,
    "message": "success"
    }
    */
    public function uploadDocuments(DriverDocumentUploadRequest $request)
    {
        $created_params = $request->only(['document_id','identify_number','expiry_date']);

        if (auth()->user()->hasRole(Role::DRIVER)) {

        $created_params['document_status'] =DriverDocumentStatus::UPLOADED_AND_WAITING_FOR_APPROVAL;

        $document_exists = auth()->user()->driver->driverDocument()->where('document_id', $request->document_id)->exists();

        if ($document_exists) {
            $created_params['document_status'] =DriverDocumentStatus::REUPLOADED_AND_WAITING_FOR_APPROVAL;
        }
        $driver_id = auth()->user()->driver->id;

        $created_params['driver_id'] = $driver_id;

        if ($uploadedFile = $this->getValidatedUpload('document', $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveDriverDocument($driver_id);
        }
        // Check if document exists
        $driver_documents = DriverDocument::where('driver_id', $driver_id)->where('document_id', $request->input('document_id'))->first();

        if ($driver_documents) {
            DriverDocument::where('driver_id', $driver_id)->where('document_id', $request->input('document_id'))->update($created_params);
        } else {
            DriverDocument::create($created_params);
        }

        $driver_documents = DriverDocument::where('driver_id', $driver_id)->get();

        if(env('APP_FOR')=='demo'){

            $status = true;
             
            auth()->user()->driver->update(['approve' == true]);

            $this->database->getReference('drivers/'.'driver_'.auth()->user()->driver->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);                

        }
        
    }else{

        if($request->has('fleet_id') && $request->fleet_id){

        $created_params['document_status'] =DriverDocumentStatus::UPLOADED_AND_WAITING_FOR_APPROVAL;

        $fleet = Fleet::where('id',$request->fleet_id)->first();

        $document_exists = $fleet->fleetDocument()->where('document_id', $request->document_id)->exists();

        if ($document_exists) {
            $created_params['document_status'] =DriverDocumentStatus::REUPLOADED_AND_WAITING_FOR_APPROVAL;
        }

        $created_params['fleet_id'] = $fleet->id;

        if ($uploadedFile = $this->getValidatedUpload('document', $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveFleetDocument($fleet->id);
        }
        // Check if document exists
        $fleet_documents = FleetDocument::where('fleet_id', $fleet->id)->where('document_id', $request->input('document_id'))->first();

        if ($fleet_documents) {
            FleetDocument::where('fleet_id', $fleet->id)->where('document_id', $request->input('document_id'))->update($created_params);
        } else {
            FleetDocument::create($created_params);
        }

        }else{


        $created_params['document_status'] =DriverDocumentStatus::UPLOADED_AND_WAITING_FOR_APPROVAL;

        $document_exists = auth()->user()->owner->ownerDocument()->where('document_id', $request->document_id)->exists();

        if ($document_exists) {
            $created_params['document_status'] =DriverDocumentStatus::REUPLOADED_AND_WAITING_FOR_APPROVAL;
        }
        $owner_id = auth()->user()->owner->id;

        $created_params['owner_id'] = $owner_id;

        if ($uploadedFile = $this->getValidatedUpload('document', $request)) {
            $created_params['image'] = $this->imageUploader->file($uploadedFile)
                ->saveOwnerDocument($owner_id);
        }
        // Check if document exists
        $owner_documents = OwnerDocument::where('owner_id', $owner_id)->where('document_id', $request->input('document_id'))->first();

        if ($owner_documents) {
            OwnerDocument::where('owner_id', $owner_id)->where('document_id', $request->input('document_id'))->update($created_params);
        } else {
            OwnerDocument::create($created_params);
        }


        }
        

    }
        // $result = fractal($driver_documents, new DriverDocumentTransformer);


        
        if(env('APP_FOR')=='demo'){

            $status = true;

        if (auth()->user()->hasRole(Role::DRIVER)) 
        {

            auth()->user()->driver->update(['approve'=>true]);

            $this->database->getReference('drivers/driver_'.auth()->user()->driver->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);   

       $user = auth()->user();
 
            $title = trans('push_notifications.driver_approved',[],$user->lang);
            $body = trans('push_notifications.driver_approved_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::DRIVER_ACCOUNT_APPROVED];
            $socket_success_message = PushEnums::DRIVER_ACCOUNT_APPROVED;
        


        dispatch(new SendPushNotification($user,$title,$body));

                         
          }
        }
        
        return $this->respondSuccess();
    }

    /**
    * List All Uploaded Documents
    * @responseFile responses/driver/listAllUploadedDocuments.json
    */
    public function listUploadedDocuments()
    {
        $driver_documents = DriverDocument::where('driver_id', auth()->user()->driver->id)->get();

        $result = fractal($driver_documents, new DriverDocumentTransformer);

        return $this->respondSuccess($result);
    }
}
