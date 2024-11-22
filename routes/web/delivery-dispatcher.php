<?php

use App\Base\Constants\Auth\Role;

Route::middleware('auth:web')->group(function () {
    Route::middleware(role_middleware(Role::DELIVERY_DISPATCHER))->group(function () {
    });

    Route::namespace('DeliveryDispatcher')->group(function () {
        Route::get('dispatch-delivery/dashboard', 'DeliveryDispatcherController@dashboard');
        Route::get('fetch/booking-screen/{modal}', 'DeliveryDispatcherController@fetchBookingScreen');

        Route::post('dispatch-delivery/request/create', 'DispatcherCreateRequestController@createRequest');

        Route::get('fetch/dispatch-delivery-request_lists', 'DeliveryDispatcherController@fetchRequestLists');

        Route::get('request/detail_view/{requestmodel}','DeliveryDispatcherController@requestDetailedView')->name('dispatcherRequestDetailView');


        Route::get('dispatch/profile', 'DeliveryDispatcherController@profile')->name('dispatcherProfile');
        Route::get('dispatch/book-now', 'DeliveryDispatcherController@bookNow');
        Route::get('dispatch/book-now-delivery', 'DeliveryDispatcherController@bookNowDelivery');

    });
});
