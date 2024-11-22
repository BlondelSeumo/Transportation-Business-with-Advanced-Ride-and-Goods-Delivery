<?php

namespace App\Base\Constants\Taxi;

class TripStatus
{
    const REQUESTED = 'REQUESTED';
    const DRIVING_TO_PICKUP = 'DRIVING_TO_PICKUP';
    const ARRIVED_AT_PICKUP = 'ARRIVED_AT_PICKUP';
    const CANCELLED = 'CANCELLED';
    const CANCELLED_BY_DRIVER = 'CANCELLED_BY_DRIVER';
    const CAR_NOT_AVAILABLE = 'CAR_NOT_AVAILABLE';
    const COMPLETED = 'COMPLETED';
}
