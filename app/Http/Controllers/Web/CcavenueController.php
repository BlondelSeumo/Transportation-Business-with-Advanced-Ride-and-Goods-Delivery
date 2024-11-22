<?php
  
namespace App\Http\Controllers\Web;  
use Illuminate\Http\Request as ValidatorRequest;
use App\Http\Controllers\Controller;
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
use App\Models\Request\Request as RequestModel;
use App\Models\User;
use Log;
use Kreait\Firebase\Contract\Database;

include 'Crypto.php';
use Kishnio\CCAvenue\Payment as CCAvenueClient;

class CcavenueController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
    }    
    
    public function index(ValidatorRequest $request)
    {
        // Retrieve URL parameters
        $amount = $request->input('amount');
        $user_id = $request->input('user_id');
        $currency = $request->input('currency');
        $payment_for = $request->input('payment_for');
        $request_id = $request->input('request_id');
        $user = User::find($user_id);
        $orderId = 12345; // Example order ID

        $merchantId = 2895904;
        $accessCode = 'AVZK23KJ86BP39KZPB';
        $workingKey = '0F70073739ED5AAE1C7D0D4D7B16C06B';
        $response_url = "{{route(ccavenue.checkout)}}";
        // Construct the merchant data
        $merchant_data = [
            'merchant_id' => $merchantId,
            'order_id' => $orderId,
            'redirect_url' => $response_url,
            'amount' => $amount,
            'currency' => 'INR',
            'billing_email' => "bala@gmail.com",
            'billing_name' => "bala",
            'billing_tel' => "9879879879",
            // Add other required parameters
        ];

        $encrypted_data = encryptCC(implode('&', $merchant_data), $workingKey);
// dd($encrypted_data);

        return view('ccavenue.ccavenue', compact('amount', 'user', 'payment_for', 'currency', 'user_id', 'request_id', 'merchantId', 'accessCode', 'orderId'));
    }

    public function ccavenueCheckout(ValidatorRequest $request)
    {
        $amount = $request->input('amount');
        $user_id = $request->input('user_id');
        $currency = $request->input('currency');
        $user_id = $request->input('user_id');
        $payment_for = $request->input('payment_for');
        $request_id = $request->input('request_id');


//Handle the sucess payment  Here
           if ($payment_for=="wallet") {

             $user = User::find($user_id);
                
            if ($user->hasRole('user')) {
                $wallet_model = new UserWallet();
                $wallet_add_history_model = new UserWalletHistory();
                $user_id = $user->id;
            } elseif($user->hasRole('driver')) {
                        $wallet_model = new DriverWallet();
                        $wallet_add_history_model = new DriverWalletHistory();
                        $user_id = $user->driver->id;
            }else {
                        $wallet_model = new OwnerWallet();
                        $wallet_add_history_model = new OwnerWalletHistory();
                        $user_id = $user->owner->id;
            }

            $user_wallet = $wallet_model::firstOrCreate([
                'user_id'=>$user_id]);
            $user_wallet->amount_added += $amount;
            $user_wallet->amount_balance += $amount;
            $user_wallet->save();
            $user_wallet->fresh();

            $wallet_add_history_model::create([
                'user_id'=>$user_id,
                'amount'=>$amount,
                'transaction_id'=>$request->PayerID,
                'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET,
                'is_credit'=>true]);


                $title = trans('push_notifications.amount_credited_to_your_wallet_title',[],$user->lang);
                $body = trans('push_notifications.amount_credited_to_your_wallet_body',[],$user->lang);                      

                    dispatch(new SendPushNotification($user,$title,$body));

                    if ($user->hasRole(Role::USER)) {
                    $result =  fractal($user_wallet, new WalletTransformer);
                    } elseif($user->hasRole(Role::DRIVER)) {
                        $result =  fractal($user_wallet, new DriverWalletTransformer);
                    }else{
                        $result =  fractal($user_wallet, new OwnerWalletTransformer);

                   }


            }else{

                $request_id = $request_id;
                // Log::info($request_id);

                 $request_detail = RequestModel::where('id', $request_id)->first();

                $request_detail->update(['is_paid' => true]);     
                 
                 $this->database->getReference('requests/'.$request_detail->id)->update(['is_paid'=>1]);   


            }




        return view('success',['success']);
    }


    public function paystackCheckoutSuccess(ValidatorRequest $request)
    {


    }

    public function paystackCheckoutError(ValidatorRequest $request)
    {
        return view('failure',['failure']);

    }
}
  