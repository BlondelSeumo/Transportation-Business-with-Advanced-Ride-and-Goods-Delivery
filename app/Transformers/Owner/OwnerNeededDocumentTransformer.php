<?php

namespace App\Transformers\Owner;

use App\Models\Admin\OwnerDocument;
use App\Models\Admin\OwnerNeededDocument;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Transformers\Owner\OwnerDocumentTransformer;
use App\Base\Constants\Masters\DriverDocumentStatusString;
use App\Transformers\Transformer;

class OwnerNeededDocumentTransformer extends Transformer
{
    /**
    * Resources that can be included if requested.
    *
    * @var array
    */
    protected array $availableIncludes = [
        'driver_document',
    ];
    /**
     * Resources that can be included default.
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'driver_document',
    ];
    /**
     * A Fractal transformer.
     *
     * @param OwnerNeededDocument $ownerneededdocument
     * @return array
     */
    public function transform(OwnerNeededDocument $ownerneededdocument)
    {
        $params =  [
            'id'=>$ownerneededdocument->id,
            'name' => $ownerneededdocument->name,
            'doc_type' => $ownerneededdocument->doc_type,
            'has_identify_number' => (bool)$ownerneededdocument->has_identify_number,
            'has_expiry_date' => (bool) $ownerneededdocument->has_expiry_date,
            'active' => $ownerneededdocument->active,
            'identify_number_locale_key'=>$ownerneededdocument->identify_number_locale_key,
            'is_uploaded'=>false,
            'document_status'=>2,
            'document_status_string'=>DriverDocumentStatusString::NOT_UPLOADED
        ];

        $driver_document = OwnerDocument::where('document_id', $ownerneededdocument->id)->where('owner_id', auth()->user()->owner->id)->first();

        if ($driver_document) {
            $params['is_uploaded'] = true;
            $params['document_status']= $driver_document->document_status;

            foreach (DriverDocumentStatus::DocumentStatus() as $key=> $document_string) {
                if ($driver_document->document_status==$key) {
                    $params['document_status_string'] = $document_string;
                }
            }
        }

        return $params;
    }

    /**
     * Include the owner document of the owner needed document.
     *
     * @param OwnerNeededDocument $ownerneededdocument
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeDriverDocument(OwnerNeededDocument $ownerneededdocument)
    {
        $document = $ownerneededdocument->ownerDocument()->where('owner_id', auth()->user()->owner->id)->first();

        return $document
        ? $this->item($document, new OwnerDocumentTransformer)
        : $this->null();
    }
}
