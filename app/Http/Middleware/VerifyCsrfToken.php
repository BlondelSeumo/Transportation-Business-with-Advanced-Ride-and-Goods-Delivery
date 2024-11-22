<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        /*
         * Temporarily allow post request without csrf token for testing.
         * Remove these before production release.
         */
        'broadcasting/auth',
        'api/spa/*',
        'upload',
        'test',
        'save-pdf',
        'api/html',
        'api/html/*',
    ];
}
