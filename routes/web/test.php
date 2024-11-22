<?php

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| All the codes below are test codes which would be constantly updated.
| These codes will be deleted before pushing live.
|
 */

/*
 * Temporary dummy route for testing SPA.
 */
Route::get('passport', function () {
    //auth('web')->loginUsingId(1);
    return view('spa');
});

