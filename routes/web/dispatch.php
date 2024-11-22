<?php

use App\Base\Constants\Auth\Role;

Route::middleware('auth:web')->group(function () {
    Route::middleware(role_middleware(Role::DISPATCHER))->group(function () {
    });

    Route::namespace('Dispatcher')->group(function () {
        Route::get('dispatch/dashboard', 'DispatcherController@dashboard');



        Route::get('dispatch/dashboard/open', 'DispatcherController@dashboardopen');


        Route::get('dispatch/dashboard/open', 'DispatcherController@dashboardOpen');


        Route::get('fetch/booking-screen/{modal}', 'DispatcherController@fetchBookingScreen');

        Route::post('request/create', 'DispatcherCreateRequestController@createRequest');

        Route::get('fetch/request_lists', 'DispatcherController@fetchRequestLists');

        Route::get('request/detail_view/{requestmodel}','DispatcherController@requestDetailedView')->name('dispatcherRequestDetailView');
        Route::get('request/cancelRide/{requestmodel}','DispatcherController@requescancelRide')->name('dispatcherRequestCancelRide');

        Route::get('dispatch/profile', 'DispatcherController@profile')->name('dispatcherProfile');
        Route::get('dispatch/book-now', 'DispatcherController@bookNow');
        // Route::get('dispatch/book-now-delivery', 'DispatcherController@bookNowDelivery');

    });

});
