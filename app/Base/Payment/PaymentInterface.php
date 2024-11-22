<?php

namespace App\Base\Payment;

use Illuminate\Http\Request;
use App\Models\Payment\CardInfo;

interface PaymentInterface
{

    /**
     * Add card
     */
    public function addCard($request);

    public function listCards();

    public function makeDefaultCard(Request $request);

    public function deleteCard(CardInfo $card);

    /**
     * Add wallet
     */
    public function addMoneyToWallet(Request $request);

    // /**
    //  * Get Client Token
    //  */
    // public function getClientToken($request);

    // /**
    //  * add or withdrawewl amount from card
    //  */
    // public function transfer($converted_amount, $card);
}
