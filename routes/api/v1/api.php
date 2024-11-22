<?php

/*
|--------------------------------------------------------------------------
| Common API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */

/*
         * Root namespace 'App\Http\Controllers\Api\V1\Common'.
    */
Route::namespace('Common')->group(function () {

    // List all the cities.
    Route::get('cities', 'CityController@index');

    // Get Cities by State
    Route::get('cities/by/state/{state_id}', 'CityController@byState');

    // Get the city by its id.
    Route::get('cities/{city}', 'CityController@show');

    // List all the states.
    Route::get('states', 'StateController@index');

    // Get the state by its id.
    Route::get('states/{state}', 'StateController@show');

    // Get all the countries.
    Route::get('countries', 'CountryController@index');
    Route::get('countries-new', 'CountryController@indexNew');

//onboarding
    Route::get('onboarding-module', 'CountryController@onboarding');


    // Get Language translation for mobile
    Route::get('translation/get', 'TranslationController@index');
    Route::get('translation-flutter/get', 'TranslationController@flutterTrnaslation');

    // Get all the ServiceLocation.
    Route::get('servicelocation', 'ServiceLocationController@index');
    Route::get('onboarding-user', 'OnboardingController@indexUser');
    Route::get('onboarding-driver', 'OnboardingController@indexDriver');

    Route::get('dummy','CountryController@dummy');



});
