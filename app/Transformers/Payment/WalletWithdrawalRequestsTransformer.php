<?php

namespace App\Transformers\Payment;

use App\Transformers\Transformer;
use App\Models\Payment\WalletWithdrawalRequest;
use App\Base\Constants\Masters\WithdrawalRequestStatus;

class WalletWithdrawalRequestsTransformer extends Transformer
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
    public function transform(WalletWithdrawalRequest $wallet_history)
    {
        $params = [
            'id' => $wallet_history->id,
            'requested_amount' => $wallet_history->requested_amount,
            'requested_currency'=>$wallet_history->requested_currency,
            'created_at' => $wallet_history->converted_created_at,
            'updated_at' => $wallet_history->converted_updated_at,
        ];

        if($wallet_history->status==WithdrawalRequestStatus::REQUESTED){
            $params['status'] = 'Requested';
        }

        if($wallet_history->status==WithdrawalRequestStatus::APPROVED){
            $params['status'] = 'Approved';
        }

        if($wallet_history->status==WithdrawalRequestStatus::DECLINED){
            $params['status'] = 'Declined';
        }

        return $params;
    }
}
