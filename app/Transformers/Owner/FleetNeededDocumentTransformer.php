<?php

namespace App\Transformers\Owner;

use App\Models\Admin\FleetDocument;
use App\Models\Admin\FleetNeededDocument;
use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Transformers\Owner\FleetDocumentTransformer;
use App\Base\Constants\Masters\DriverDocumentStatusString;
use App\Transformers\Transformer;

class FleetNeededDocumentTransformer extends Transformer
{
    /**
    * Resources that can be included if requested.
    *
    * @var array
    */
    protected array $availableIncludes = [
        'fleet_document',
    ];
    /**
     * Resources that can be included default.
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'fleet_document',
    ];
    /**
     * A Fractal transformer.
     *
     * @param FleetNeededDocument $fleetneededdocument
     * @return array
     */
    public function transform(FleetNeededDocument $fleetneededdocument)
    {
        $params =  [
            'id'=>$fleetneededdocument->id,
            'name' => $fleetneededdocument->name,
            'doc_type' => $fleetneededdocument->doc_type,
            'has_identify_number' => (bool)$fleetneededdocument->has_identify_number,
            'has_expiry_date' => (bool) $fleetneededdocument->has_expiry_date,
            'active' => $fleetneededdocument->active,
            'identify_number_locale_key'=>$fleetneededdocument->identify_number_locale_key,
            'is_uploaded'=>false,
            'document_status'=>2,
            'document_status_string'=>DriverDocumentStatusString::NOT_UPLOADED
        ];

        $fleet_document = FleetDocument::where('document_id', $fleetneededdocument->id)->where('fleet_id', request()->fleet_id)->first();

        if ($fleet_document) {
            $params['is_uploaded'] = true;
            $params['document_status']= $fleet_document->document_status;

            foreach (DriverDocumentStatus::DocumentStatus() as $key=> $document_string) {
                if ($fleet_document->document_status==$key) {
                    $params['document_status_string'] = $document_string;
                }
            }
        }

        return $params;
    }

    /**
     * Include the owner document of the owner needed document.
     *
     * @param FleetNeededDocument $fleetneededdocument
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeFleetDocument(FleetNeededDocument $fleetneededdocument)
    {
        $document = $fleetneededdocument->fleetDocument()->where('fleet_id', request()->fleet_id)->first();

        return $document
        ? $this->item($document, new FleetDocumentTransformer)
        : $this->null();
    }
}
