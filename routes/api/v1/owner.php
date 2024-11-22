<?php

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */
use App\Base\Constants\Auth\Role;

/**
 * These routes are prefixed with 'api/v1'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Driver'.
 * These routes use the middleware group 'auth'.
 */


Route::prefix('owner')->namespace('Owner')->middleware('auth')->group(function () {
    Route::middleware(role_middleware(Role::OWNER))->group(function () {
        Route::get('list-fleets','FleetController@index');
        Route::get('fleet/documents/needed','FleetController@neededDocuments');
        Route::get('list-drivers','FleetController@listDrivers');
        Route::post('assign-driver/{fleet}','FleetController@assignDriver');
        Route::post('add-fleet','FleetController@storeFleet');
        Route::post('add-drivers','FleetDriversController@addDriver');
        Route::get('delete-driver/{driver}','FleetDriversController@deleteDriver');
    });
});
