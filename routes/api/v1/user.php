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
 * These routes are prefixed with 'api/v1/user'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\User'.
 * These routes use the middleware group 'auth'.
 */
Route::prefix('user')->namespace('User')->middleware('auth')->group(function () {
    // Get the logged in user.
    Route::get('/', 'AccountController@me');
    /**
     * These routes use the middleware group 'role'.
     * These routes are accessible only by a user with the 'user' role.
     */
    Route::middleware('auth')->group(function () {

        // Update user password.
        Route::post('password', 'ProfileController@updatePassword');
        // Update user profile.
        Route::post('profile', 'ProfileController@updateProfile');
        Route::post('driver-profile', 'ProfileController@updateDriverProfile');
        Route::post('update-my-lang', 'ProfileController@updateMyLanguage');
        Route::post('update-bank-info','ProfileController@updateBankinfo');
        Route::get('get-bank-info','ProfileController@getBankInfo');
        // Add Favourite location
        Route::get('list-favourite-location','ProfileController@FavouriteLocationList');
        Route::post('add-favourite-location','ProfileController@addFavouriteLocation');
        Route::get('delete-favourite-location/{favourite_location}','ProfileController@deleteFavouriteLocation');
        // Delete user Account.
        Route::post('delete-user-account','ProfileController@userDeleteAccount');

    });
});

Route::get('test-socket', function () {
    return 'yess its works';
});

Route::namespace('VehicleType')->middleware('auth')->prefix('types')->group(function () {
    // get types depends on the location
    Route::get('/{lat}/{lng}', 'VehicleTypeController@getTypesByLocationOld');
    Route::get('/by-location/{lat}/{lng}', 'VehicleTypeController@getTypesByLocationAlongPrice');

    // Route::post('/{vehicle_type}','VehicleTypeController@update');
});
