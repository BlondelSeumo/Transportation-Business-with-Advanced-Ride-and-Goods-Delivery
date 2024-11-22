<?php

namespace App\Http\Controllers\Api\V1\Request;

use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\DriverUploadDeliveryProofRequest;
use App\Transformers\Requests\RequestProofsTransformer;
use App\Transformers\Requests\TripRequestTransformer;
use Illuminate\Support\Facades\Log;

/**
 * @group Driver-trips-apis
 *
 * APIs for Driver-trips apis
 */
class DriverDeliveryProofController extends BaseController
{
    /**
    * Driver Upload Delivery Proof
    * @bodyParam request_id uuid required id request
    * @bodyParam after_load boolean required status of trip request
    * @bodyParam after_unload boolean required status of trip request
    * @bodyParam proof_image string required proof image of trip request
    * @response
    * {
    *"success": true,
    *"message": "successfully_uploaded_delivery_proof"
    *}
    */
    protected $imageUploader;

    public function __construct(ImageUploaderContract $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }

    public function uploadDocument(DriverUploadDeliveryProofRequest $request)
    {
        // Log::info('Upload delivery proof. Input params : ' . json_encode($request->all()));

        // Get Request Detail
        $driver = auth()->user()->driver;

        $request_detail = $driver->requestDetail()->where('id', $request->request_id)->first();

        if (!$request_detail) {
            $this->throwAuthorizationException();
        }


        $data = $request->only(['after_load', 'after_unload', 'proof_image']);
        
        if ($uploadedFile = $this->getValidatedUpload('proof_image', $request)) {
            $data['proof_image'] = $this->imageUploader->file($uploadedFile)
                ->saveRequestDeliveryProof();
        }
        
        // Store Request document
        $request_detail->requestProofs()->create($data);
        
        $request_result = fractal($request_detail, new TripRequestTransformer)->parseIncludes(['requestProofs']);
        
        return $this->respondSuccess($request_result,'successfully_uploaded_delivery_proof');
    }
}
