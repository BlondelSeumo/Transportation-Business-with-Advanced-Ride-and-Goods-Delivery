<?php

namespace App\Base\Constants\Taxi;

class EtaConstants
{
    const EARTH_RADIUS_IN_METERS = 6371000;
    const ENGLISH_UNITS = ['miles', 'km'];

    // TODO: These will become settings in the future
    const LOCATION_CACHE_TIME_IN_MINUTES = 30;
    const DRIVER_ACTIVE_DURATION_IN_MINUTES = 25;

    const NEAREST_DRIVER_SEARCH_RADIUS_IN_METERS = 10000;
    const PICKUP_RADIUS_IN_METERS = 30;
    const DRIVER_RADIUS_IN_METERS = 100;
    const DROPOFF_RADIUS_IN_METERS = 100;
}
