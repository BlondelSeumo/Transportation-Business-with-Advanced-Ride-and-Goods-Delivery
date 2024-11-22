<?php

namespace App\Transformers\Payment;

use App\Transformers\Transformer;
use App\Models\Payment\DriverWallet;
use App\Base\Constants\Setting\Settings;

class DriverWalletTransformer extends Transformer
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
    public function transform(DriverWallet $wallet_history)
    {

        $params = [
            'id' => $wallet_history->id,
            'user_id' => $wallet_history->user_id,
            'amount_added' => $wallet_history->amount_added,
            'amount_balance' => $wallet_history->amount_balance,
            'amount_spent' => $wallet_history->amount_spent,
            'currency_code'=>$wallet_history->driver->user->countryDetail->currency_code,
            'currency_symbol'=>$wallet_history->driver->user->countryDetail->currency_symbol,
            'created_at' => $wallet_history->converted_created_at,
            'updated_at' => $wallet_history->converted_updated_at,
        ];

        return $params;
    }
}
