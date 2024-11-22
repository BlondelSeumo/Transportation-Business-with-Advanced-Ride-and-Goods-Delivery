<?php

namespace App\Transformers\User;

use App\Models\User;
use App\Base\Constants\Auth\Role;
use App\Transformers\Transformer;
use App\Transformers\Access\RoleTransformer;
use App\Transformers\Requests\TripRequestTransformer;

class ReferralTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [

    ];
    /**
     * Resources that can be included default.
     *
     * @var array
     */
    protected array $defaultIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        $params = [
            'id' => $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'profile_picture' => $user->profile_picture,
            'active' => $user->active,
            'refferal_code'=>$user->refferal_code,
            'currency_code'=>$user->countryDetail->currency_code,
            'currency_symbol'=>$user->countryDetail->currency_symbol,
        ];

        if(auth()->user()->hasRole('user')){
            $referral_comission = get_settings('referral_commision_for_user');

        }else{
            $referral_comission = get_settings('referral_commision_for_driver');
        }
        $referral_comission_string = trans('push_notifications.refer_a_friend',['symbol'=>$user->countryDetail->currency_symbol,'amount'=>$referral_comission],$user->lang);

        $params['referral_comission_string'] = $referral_comission_string;
        return $params;
    }
}
