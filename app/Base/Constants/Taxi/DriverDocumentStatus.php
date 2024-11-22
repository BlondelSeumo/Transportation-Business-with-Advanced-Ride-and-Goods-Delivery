<?php

namespace App\Base\Constants\Taxi;

class DriverDocumentStatus 
{
	const UPLOADED_AND_APPROVED = 1;
	const NOT_UPLOADED = 2;
	const UPLOADED_AND_WAITING_FOR_APPROVAL = 3;
	const REUPLOADED_AND_WAITING_FOR_APPROVAL = 4;
	const DECLINED = 5;
    const EXPIRED = 6;
}