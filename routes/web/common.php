<?php

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| These Routes are common routes
|
 */

/*
 * Temporary dummy route for testing SPA.
 */

Route::namespace ('Common')->group(function () {

	// Get admin-login form
	Route::get('unauthorized', 'ExceptionViewController@unauthorized');
	// Create Password For users
	Route::get('create/password', 'WebPasswordController@createPassword');
	// Update Password
	Route::post('password/update/{token}/{email}', 'WebPasswordController@updatePassword');

	Route::prefix('api/spa/common')->group(function(){
		Route::get('countries', 'CountryController@index');
		Route::get('timezones', 'CountryController@timezones');

});


});
