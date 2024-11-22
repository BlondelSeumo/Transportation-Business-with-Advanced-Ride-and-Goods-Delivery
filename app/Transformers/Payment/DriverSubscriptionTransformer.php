<?php

namespace App\Transformers\Payment;

use App\Transformers\Transformer;
use App\Models\Payment\DriverSubscription;
use App\Base\Constants\Setting\Settings;

class DriverSubscriptionTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(DriverSubscription $driver_subscription)
    {
        $user_currency_code = get_settings('currency_code');

        $params = [
            'id' => $driver_subscription->id,
            'driver_id' => $driver_subscription->driver_id,
            'subscription_type' => $driver_subscription->subscription_type,
            'active' => $driver_subscription->active,
            'paid_amount' => $driver_subscription->paid_amount,
            'payable_monthly_subscription_amount'=>get_settings('driver_monthly_subscription_amount'),
            'payable_yearly_subscription_amount'=>get_settings('driver_yearly_subscription_amount'),
            'currency_code'=>$user_currency_code,
            'currency_symbol'=>get_settings('currency_symbol'),
            'expired_at' => $driver_subscription->converted_expired_at,
            'transaction_id'=>$driver_subscription->transaction_id
        ];

        return $params;
    }
}
