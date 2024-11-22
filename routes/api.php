<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/*
 * These routes are prefixed with 'api' by default.
 * These routes use the root namespace 'App\Http\Controllers\Api'.
 */
Route::namespace ('Api')->group(function () {

	/**
	 * These routes are prefixed with 'api/v1'.
	 * These routes use the root namespace 'App\Http\Controllers\Api\V1'.
	 */
	Route::prefix('v1')->namespace('V1')->group(function () {
		include_route_files('api/v1');
    	Route::get('/razorpay', 'RazorPayController@razorpay');		
    	Route::get('/payment-success', 'RazorPayController@razorpay_success')->name('payment.success');
		
	});

});
