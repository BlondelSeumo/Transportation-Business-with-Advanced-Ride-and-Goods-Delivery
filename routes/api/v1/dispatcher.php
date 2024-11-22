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
 * These routes are prefixed with 'api/v1/admin'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Admin'.
 * These routes use the middleware group 'auth'.
 */

Route::prefix('dispatcher')->namespace('Dispatcher')->middleware('auth')->group(function () {
    Route::middleware(role_middleware(Role::adminRoles()))->group(function () {
        Route::prefix('request')->group(function () {
            Route::post('create', 'DispatcherCreateRequestController@createRequest');
            Route::post('find-user-data','DispatcherCreateRequestController@findUserData');
            Route::get('request-detail/{request}','DispatcherCreateRequestController@requestDetail');
            Route::post('cancel-ride','DispatcherRequestStateController@cancelRide');
        });
    });
});

Route::namespace('Request')->prefix('dispatcher')->group(function () {
    Route::post('request/eta', 'EtaController@eta');
});

Route::prefix('adhoc-request')->namespace('Request')->group(function () {
    Route::get('history/{id}', 'RequestHistoryController@getRequestByIdForDispatcher');
});
