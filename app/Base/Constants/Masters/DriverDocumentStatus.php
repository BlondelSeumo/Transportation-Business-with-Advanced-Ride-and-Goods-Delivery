<?php

namespace App\Base\Constants\Masters;

class DriverDocumentStatus
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
            self::UPLOADED_AND_DECLINED=>DriverDocumentStatusString::UPLOADED_AND_DECLINED,
            self::UPLOADED_AND_APPROVED=>DriverDocumentStatusString::UPLOADED_AND_APPROVED,
            self::NOT_UPLOADED=>DriverDocumentStatusString::NOT_UPLOADED,
            self::UPLOADED_AND_WAITING_FOR_APPROVAL=>DriverDocumentStatusString::UPLOADED_AND_WAITING_FOR_APPROVAL,
            self::REUPLOADED_AND_WAITING_FOR_APPROVAL=>DriverDocumentStatusString::REUPLOADED_AND_WAITING_FOR_APPROVAL,
            self::REUPLOADED_AND_DECLINED=>DriverDocumentStatusString::REUPLOADED_AND_DECLINED,
            self::EXPIRED_AND_DECLINED=>DriverDocumentStatusString::EXPIRED_AND_DECLINED,
        ];
    }
}
