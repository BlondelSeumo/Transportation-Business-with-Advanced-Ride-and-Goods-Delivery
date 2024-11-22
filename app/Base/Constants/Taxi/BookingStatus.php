<?php

namespace App\Base\Constants\Taxi;

class BookingStatus
{
    const REQUESTED = 'requested';
    const IS_COMPLETED = 'completed';
    const IS_CANCELLED = 'cancelled';
    const DRIVING_TO_PICKUP = 'driving-to-pickup';
    const ARRIVED_AT_PICKUP = 'arrived-at-pickup';
    const CANCELLED_BY_DRIVER = 'cancelled-by-driver';
    const CAR_NOT_AVAILABLE = 'car-not-available';
    const ON_GOING = 'on-going';
    const COMPELTE_AND_CANCEL = 'complete-and-cancel';
    const COMPLETE_AND_ONGOING = 'complete-and-ongoing';
    const CANCEL_AND_ONGOING = 'cancel-and-ongoing';
    const COMPLETE_AND_ONGOING_CANCEL = 'complete-and-cancel-and-ongoing';
}
