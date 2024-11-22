<?php

namespace App\Base\Constants\Masters;

class FleetDocumentStatus
{
    const UPLOADED_AND_DECLINED = 0;
    const UPLOADED_AND_APPROVED = 1;
    const NOT_UPLOADED = 2;
    const UPLOADED_AND_WAITING_FOR_APPROVAL = 3;
    const REUPLOADED_AND_WAITING_FOR_APPROVAL = 4;
    const REUPLOADED_AND_DECLINED = 5;
    const EXPIRED_AND_DECLINED = 6;

    /**
    * Get all the admin roles.
    *
    * @return array
    */
    public static function DocumentStatus()
    {
        return [
            self::UPLOADED_AND_DECLINED=>FleetDocumentStatusString::UPLOADED_AND_DECLINED,
            self::UPLOADED_AND_APPROVED=>FleetDocumentStatusString::UPLOADED_AND_APPROVED,
            self::NOT_UPLOADED=>FleetDocumentStatusString::NOT_UPLOADED,
            self::UPLOADED_AND_WAITING_FOR_APPROVAL=>FleetDocumentStatusString::UPLOADED_AND_WAITING_FOR_APPROVAL,
            self::REUPLOADED_AND_WAITING_FOR_APPROVAL=>FleetDocumentStatusString::REUPLOADED_AND_WAITING_FOR_APPROVAL,
            self::REUPLOADED_AND_DECLINED=>FleetDocumentStatusString::REUPLOADED_AND_DECLINED,
            self::EXPIRED_AND_DECLINED=>FleetDocumentStatusString::EXPIRED_AND_DECLINED,
        ];
    }
}
