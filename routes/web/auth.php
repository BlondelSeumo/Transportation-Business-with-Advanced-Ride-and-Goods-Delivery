<?php

/*
|--------------------------------------------------------------------------
| SPA Auth Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with '/'.
| These routes use the root namespace 'App\Http\Controllers\Web'.
|
 */

/*
 * These routes are used for web authentication.
 *
 * Route prefix 'api/spa'.
 * Root namespace 'App\Http\Controllers\Web\Auth'.
 */

/**
 * Temporary dummy route for testing SPA.
 */
Route::get('admin-panel', function () {
    //auth('web')->loginUsingId(1);
    return view('admin.admin');
});

Route::prefix('api/spa')->namespace('Auth')->group(function () {
    // Login Admin user from the web (SPA) application
    Route::post('login', 'LoginController@loginWebUsers');
    Route::post('dispatch/login', 'LoginController@loginDispatchUsers');
    Route::post('dispatch-delivery/login', 'LoginController@loginDispatchDeliveryUsers');

});

Route::prefix('api/spa')->namespace('Auth')->group(function () {

    // Login normal user from the web (SPA) application.
    Route::post('user/login', 'LoginController@loginSpaUser');

    Route::namespace('Registration')->group(function () {
        // Register Admin user
        // Route::post('admin/register', 'AdminRegistrationController@register');
    });
});

// Logout user from the web (SPA) application.
Route::any('api/spa/logout', 'Auth\LoginController@logoutSPA')->middleware('auth:web');
