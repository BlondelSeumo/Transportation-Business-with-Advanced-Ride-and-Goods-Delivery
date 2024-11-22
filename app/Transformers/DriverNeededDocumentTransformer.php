<?php

namespace App\Transformers;

use App\Models\Admin\DriverDocument;
use App\Models\Admin\DriverNeededDocument;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Transformers\Driver\DriverDocumentTransformer;
use App\Base\Constants\Masters\DriverDocumentStatusString;
use App\Transformers\Transformer;

class DriverNeededDocumentTransformer extends Transformer
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
     * @param DriverNeededDocument $driverneededdocument
     * @return array
     */
    public function transform(DriverNeededDocument $driverneededdocument)
    {
        $params =  [
            'id'=>$driverneededdocument->id,
            'name' => $driverneededdocument->name,
            'doc_type' => $driverneededdocument->doc_type,
            'has_identify_number' => (bool)$driverneededdocument->has_identify_number,
            'has_expiry_date' => (bool) $driverneededdocument->has_expiry_date,
            'active' => $driverneededdocument->active,
            'identify_number_locale_key'=>$driverneededdocument->identify_number_locale_key,
            'is_uploaded'=>false,
            'document_status'=>2,
            'document_status_string'=>DriverDocumentStatusString::NOT_UPLOADED
        ];

        $driver_document = DriverDocument::where('document_id', $driverneededdocument->id)->where('driver_id', auth()->user()->driver->id)->first();

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
     * Include the driver document of the driver needed document.
     *
     * @param DriverNeededDocument $driverneededdocument
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeDriverDocument(DriverNeededDocument $driverneededdocument)
    {
        $roles = $driverneededdocument->driverDocument()->where('driver_id', auth()->user()->driver->id)->first();

        return $roles
        ? $this->item($roles, new DriverDocumentTransformer)
        : $this->null();
    }
}
