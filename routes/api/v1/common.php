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

/**
 * These routes are prefixed with 'api/v1/masters'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Master'.
 * These routes use the middleware group 'auth'.
 */

use App\Base\Constants\Auth\Role;


Route::namespace('Common')->group(function () {

    // Masters Crud
    Route::prefix('common')->group(function () {

        // Get owner driverModule
        Route::get('modules', 'CarMakeAndModelController@getAppModule');     
        
        // Test Api
        Route::get('test-api','CarMakeAndModelController@testApi');
        // Get car makes
        Route::get('car/makes', 'CarMakeAndModelController@getCarMakes');
        // Get Car models
        Route::get('car/models/{make_id}', 'CarMakeAndModelController@getCarModels');
        Route::get('goods-types', 'GoodsTypesController@index');
   
    Route::get('admin-notify', 'CarMakeAndModelController@adminNotify');

        Route::middleware('auth')->group(function () {
            // List Cancallation Reasons
            Route::get('cancallation/reasons', 'CancellationReasonsController@index');
            // List Faq
            Route::get('faq/list/{lat}/{lng}', 'FaqController@index');
            // List Sos
            Route::get('sos/list/{lat}/{lng}', 'SosController@index');
            // Store Sos by users
            Route::post('sos/store', 'SosController@store');
            // Delete Sos by User
            Route::post('sos/delete/{sos}', 'SosController@delete');
            // List Complaint titles
            Route::get('complaint-titles', 'ComplaintsController@index');
            // Make a complaint
            Route::post('make-complaint', 'ComplaintsController@makeComplaint');
        });
    });
    // Validate Company key api
    // Route::post('validate-company-key', 'CompanyKeyController@validateCompanyKey');
});

Route::namespace('VehicleType')->prefix('types')->group(function () {
    // get types depends service location
    Route::get('/{service_location}', 'VehicleTypeController@getVehicleTypesByServiceLocation');
    Route::post('/report', 'VehicleTypeController@report');
});

Route::namespace('Notification')->prefix('notifications')->middleware('auth')->group(function (){
    //get notifications depends on the role
    Route::middleware(role_middleware(Role::mobileAppRoles()))->group(function () {
        Route::get('get-notification', 'ShowNotificationController@getNotifications');
        Route::any('delete-notification/{notification}', 'ShowNotificationController@deleteNotification');

    });
});