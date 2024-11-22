<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Request\Request as RequestModel;
use Log;
use Kreait\Firebase\Contract\Database;
use Illuminate\Validation\ValidationException;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Jobs\Notifications\SendPushNotification;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Transformers\Payment\WalletTransformer;
use App\Transformers\Payment\DriverWalletTransformer;
use App\Http\Requests\Payment\AddMoneyToWalletRequest;
use App\Transformers\Payment\UserWalletHistoryTransformer;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Base\Constants\Masters\WalletRemarks;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;
use Str;
use Ixudra\Curl\Facades\Curl;


class ThawaniPayController extends Controller
{

     public function checkout()
     {

$amount = 1000;
$publishable_key = "HGvTMLDssJghr9tlN9gr4DVYt0qyB";
$secrect_key = "rRQ26GcsZzoEhbrP2HZvLYDbn9C9et";

$data = [
    'client_reference_id' => rand(11111, 99999),
    'mode' => 'payment',
    'products' => [
        [
            'name' => 'Taxi',
            'quantity' => 1,
            'unit_amount' => $amount,
        ],
    ],
    'success_url' => route('thawani-pay-success'),
    'cancel_url' => route('thawani-pay-cancel'),
    'metadata' => [
        'Customer name' => "Bala",
        'order id' => Str::upper(Str::random(6)),
    ],
];

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://uatcheckout.thawani.om/api/v1/checkout/session",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'client_reference_id' => '123412',
    'mode' => 'payment',
    'products' => [
        [
                'name' => 'product 1',
                'quantity' => 1,
                'unit_amount' => 100
        ]
    ],
    'success_url' => 'https://thw.om/success',
    'cancel_url' => 'https://thw.om/cancel',
    'metadata' => [
        'Customer name' => 'somename',
        'order id' => 0
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "thawani-api-key: rRQ26GcsZzoEhbrP2HZvLYDbn9C9et"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

$r_data = json_decode($response);
// dd($r_data);
// Create the checkout URL
$checkout_url = 'https://uatcheckout.thawani.om/pay/' . $r_data->data->session_id . '?key=' . $publishable_key;

// dd($checkout_url);
        return redirect()->to($checkout_url);

    }


}
