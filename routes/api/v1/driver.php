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


Route::prefix('driver')->namespace('Driver')->middleware('auth')->group(function () {
    Route::middleware(role_middleware([Role::DRIVER,Role::OWNER]))->group(function () {
        // get DriverDocument
        Route::get('documents/needed', 'DriverDocumentController@index');
        // Upload Driver document
        Route::post('upload/documents', 'DriverDocumentController@uploadDocuments');
        // List All Uploaded Documents
        // Route::get('uploaded/documents', 'DriverDocumentController@listUploadedDocuments');
        // Online-offline
        Route::post('online-offline', 'OnlineOfflineController@toggle');
        Route::get('today-earnings', 'EarningsController@index');
        Route::get('weekly-earnings', 'EarningsController@weeklyEarnings');
        Route::get('earnings-report/{from_date}/{to_date}', 'EarningsController@earningsReport');
        Route::post('add-my-route-address','OnlineOfflineController@addMyRouteAddress');
        Route::post('enable-my-route-booking','OnlineOfflineController@enableMyRouteBooking');

        Route::get('all-earnings', 'EarningsController@allEarnings');
        // Route::get('earnings-report/{from_date}/{to_date}', 'EarningsController@earningsReport');

        Route::get('leader-board/trips','EarningsController@leaderBoardTrips');
        Route::get('leader-board/earnings','EarningsController@leaderBoardEarnings');        
    });
});
