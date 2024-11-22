<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;
use App\Helpers\Exception\ExceptionHelpers;
use App\Models\Common\AdminUsersCompanyKey;
use Illuminate\Support\Facades\Auth;

trait HasActiveCompanyKey
{
    use ExceptionHelpers;
    /**
     * Scope a query to add the active condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompanyKey($query)
    {
        if (env('APP_FOR')=='demo') {
            if (auth()->user()) {
                $user_company_key = auth()->user()->company_key;
                $today = Carbon::today()->toDateString();

                if (!$user_company_key) {
                    return;
                }
                $company_key = AdminUsersCompanyKey::where('company_key', $user_company_key)->first();
                if (!$company_key) {
                    if (Auth::guard('web')->check()) {
                        auth('web')->logout();
                        request()->session()->invalidate();
                    } else {
                        auth()->user()->token()->revoke();
                    }
                }
                $ExpiryDate = Carbon::parse($company_key->expiry_date)->toDateString();
                if ($ExpiryDate < $today) {
                    if (Auth::guard('web')->check()) {
                        auth('web')->logout();
                        request()->session()->invalidate();
                    } else {
                        auth()->user()->token()->revoke();
                    }
                }
                return $query->where('company_key', $user_company_key);
            } else {
                $user_company_key = request()->company_key;
                if (!$user_company_key) {
                    return;
                }
                $today = Carbon::today()->toDateString();

                $company_key = AdminUsersCompanyKey::where('company_key', $user_company_key)->first();
                if (!$company_key) {
                    // auth()->user()->token()->revoke();
                    $this->throwAuthorizationException();
                }
                $ExpiryDate = Carbon::parse($company_key->expiry_date)->toDateString();
                if ($ExpiryDate < $today) {
                    // auth()->user()->token()->revoke();
                    $this->throwAuthorizationException();
                }
                return $query->where('company_key', $user_company_key);
            }
        }
    }
}
