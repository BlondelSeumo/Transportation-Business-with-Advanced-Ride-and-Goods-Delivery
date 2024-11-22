<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $config = config('auth');

        $this->registerPolicies();

        Passport::cookie($config['token_cookie']);

        Passport::tokensExpireIn(now()->addDays($config['token_expiry']));

        Passport::refreshTokensExpireIn(now()->addDays($config['refresh_token_expiry']));

        
    }
}
