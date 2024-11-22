<?php

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */
use App\Base\Constants\Auth\Role;

/*
 * These routes are prefixed with 'api/v1/request'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Request'.
 * These routes use the middleware group 'auth'.
 */
Route::prefix('request')->namespace('Request')->middleware('auth')->group(function () {

//outstation rides
        Route::get('outstation_rides', 'CreateNewRequestController@outstationRides');
    /**
     * These routes use the middleware group 'role'.
     * These routes are accessible only by a user with the 'user' role.
     */
    Route::middleware(role_middleware([Role::USER,Role::DISPATCHER]))->group(function () {
        // List Packages
        Route::post('list-packages', 'EtaController@listPackages');

        Route::get('promocode-list', 'PromoCodeController@index');
        // Create Request
        Route::post('create', 'CreateNewRequestController@createRequest');
        Route::post('delivery/create', 'DeliveryCreateRequestController@createRequest');
        // Change Drop Location
        Route::post('change-drop-location', 'EtaController@changeDropLocation');
        // Cancel Request
        Route::post('cancel', 'UserCancelRequestController@cancelRequest');
        // Accept/Decline Bidd Request
        Route::post('respond-for-bid','CreateNewRequestController@respondForBid');
        //payment methodd
        Route::post('user/payment-method', 'UserCancelRequestController@paymentMethod');

        Route::post('user/payment-confirm', 'UserCancelRequestController@userPaymentConfirm');

        // Route::post('ready-to-pickup','DriverTripStartedController@readyToPickup');


    });

    // Eta
    Route::post('eta', 'EtaController@eta');
    Route::get('get-directions', 'EtaController@getDirections');

    /**
     * These routes use the middleware group 'role'.
     * These routes are accessible only by a driver with the 'driver' role.
     */
    Route::middleware(role_middleware(Role::DRIVER))->group(function () {
        // Create Instant Ride
        Route::post('create-instant-ride','InstantRideController@createRequest');
        Route::post('create-delivery-instant-ride','InstantRideController@createDeliveryRequest');

        // Accet/Reject Request
        Route::post('respond', 'RequestAcceptRejectController@respondRequest');
        // Arrived
        Route::post('arrived', 'DriverArrivedController@arrivedRequest');
        // Trip started
        Route::post('started', 'DriverTripStartedController@tripStart');
        // Cancel Request
        Route::post('cancel/by-driver', 'DriverCancelRequestController@cancelRequest');
        // End Request
        Route::post('end', 'DriverEndRequestController@endRequest');
        // Upload Delivery Proof
        Route::post('upload-proof','DriverDeliveryProofController@uploadDocument');
        // payment Conmfirm Request
        Route::post('payment-confirm', 'DriverEndRequestController@paymentConfirm');

        Route::post('payment-method', 'DriverEndRequestController@paymentMethod');
        
        Route::post('ready-to-pickup','DriverTripStartedController@readyToPickup');

        Route::post('stop-complete', 'DriverEndRequestController@tripEndBystop');

        
    });

    // History
    Route::get('history', 'RequestHistoryController@index');
    Route::get('history/outstation', 'RequestHistoryController@outStationHistory');
    Route::get('history/{id}', 'RequestHistoryController@getById');
    // Rate the Request
    Route::post('rating', 'RatingsController@rateRequest');
    // Chat 
    Route::get('chat-history/{request}','ChatController@history');
    //Send Sms
    Route::post('send','ChatController@send');
    // Update Seen
    Route::post('seen','ChatController@updateSeen');


    // Chat 
    Route::get('admin-chat-history','ChatController@chat_initiate');
    //Send Sms
    Route::post('send-message','ChatController@send_message'); 
    Route::post('seen-message-update','ChatController@updateSeenmessage');

    Route::get('update-notification-count','ChatController@update_notication_count'); 
    
});
 
 