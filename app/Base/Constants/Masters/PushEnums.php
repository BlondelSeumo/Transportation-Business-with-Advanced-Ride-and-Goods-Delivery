<?php

namespace App\Base\Constants\Masters;

class PushEnums
{

    // for driver
    const REQUEST_CREATED ='request_created';
    const REQUEST_CANCELLED_BY_USER ='request_cancelled_by_user';
    const GENERAL_NOTIFICATION ='general_notification';
    const DRIVER_ACCOUNT_APPROVED = 'driver_account_approved';
    const DRIVER_ACCOUNT_DECLINED = 'driver_account_declined';
    // For User
    const TRIP_ACCEPTED_BY_DRIVER = 'trip_accepted';
    const DRIVER_ARRIVED = 'driver_arrived';
    const DRIVER_STARTED_TO_PICKUP = 'driver_started_to_pickup';
    const DRIVER_STARTED_THE_TRIP = 'driver_started_the_trip';
    const DRIVER_END_THE_TRIP = 'driver_end_the_trip';
    const REQUEST_CANCELLED_BY_DRIVER ='request_cancelled_by_driver';
    const NO_DRIVER_FOUND ='no_driver_found';

    const COMPLAINT_TAKEN = 'complaint_taken';
    const COMPLAINT_SOLVED = 'complaint_solved';
    const NEW_MESSAGE = 'new_message';
    const DROP_CHANGED = 'drop_changed';

    const AMOUNT_CREDITED = 'amount_credited';
    const CARD_TO_WALLET_TRANSACTION_FAILED = 'card_to_wallet_transaction_failed';
  

}
