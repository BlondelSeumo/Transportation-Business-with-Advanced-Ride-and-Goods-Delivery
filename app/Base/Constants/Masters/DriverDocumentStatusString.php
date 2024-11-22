<?php

namespace App\Base\Constants\Masters;

class DriverDocumentStatusString
{
    const UPLOADED_AND_DECLINED = 'Uploaded And Declined';
    const UPLOADED_AND_APPROVED = 'Uploaded And Approved';
    const NOT_UPLOADED = 'Not Uploaded';
    const UPLOADED_AND_WAITING_FOR_APPROVAL = 'Waiting For Approval';
    const REUPLOADED_AND_WAITING_FOR_APPROVAL = 'Reuploaded And Waiting For Approval';
    const REUPLOADED_AND_DECLINED = 'Reuploaded And Declined';
    const EXPIRED_AND_DECLINED = 'Expired And Declined';
}
