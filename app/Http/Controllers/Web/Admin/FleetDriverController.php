<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use Illuminate\Http\Request;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\Company;
use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Base\Constants\Auth\Role;
use App\Models\Admin\VehicleType;
use App\Models\Admin\ServiceLocation;
use App\Http\Controllers\ApiController;
use App\Base\Filters\Admin\DriverFilter;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Admin\DriverNeededDocument;
use App\Http\Controllers\Web\BaseController;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Transformers\Driver\DriverTransformer;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Http\Requests\Admin\FleetDriver\CreateFleetDriverRequest;
use App\Http\Requests\Admin\FleetDriver\UpdateFleetDriverRequest;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Models\Request\Request as RequestRequest;
use App\Models\Request\RequestRating;
use App\Base\Filters\Admin\RequestFilter;
use App\Models\Payment\DriverWalletHistory;
use App\Models\Payment\DriverWallet;
use App\Http\Requests\Admin\Driver\AddDriverMoneyToWalletRequest;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use App\Base\Constants\Masters\WalletRemarks;
use Illuminate\Support\Str;
use App\Models\Payment\WalletWithdrawalRequest;
use App\Base\Constants\Setting\Settings;
use Kreait\Firebase\Contract\Database;
use App\Models\Admin\Owner;
use App\Jobs\Notifications\SendPushNotification;
use Config;
use App\Models\Admin\DriverVehicleType;

/**
 * @resource Driver
 *
 * vechicle types Apis
 */
class FleetDriverController extends BaseController
{
    /**
     * The Driver model instance.
     *
     * @var \App\Models\Admin\Driver
     */
    protected $driver;

    /**
     * The User model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The
     *
     * @var App\Base\Services\ImageUploader\ImageUploaderContract
     */
    protected $imageUploader;

    protected $gateway;

    protected $country;

    // protected $callable_gateway_class;

    /**
     * DriverController constructor.
     *
     * @param \App\Models\Admin\Driver $driver
     */
    public function __construct(Driver $driver, ImageUploaderContract $imageUploader, User $user,Country $country,Database $database)
    {
        $this->driver = $driver;
        $this->imageUploader = $imageUploader;
        $this->user = $user;
        $this->country = $country;
        $this->database = $database;

        $this->gateway = env('PAYMENT_GATEWAY');
        // $this->callable_gateway_class = app(config('base.payment_gateway.'.$this->gateway.'.class'));
    }

    /**
    * Get all drivers
    * @return \Illuminate\Http\JsonResponse
    */
    public function index()
    {
        $page = trans('pages_names.fleet-driversF');
        $main_menu = 'fleet-drivers';
        $sub_menu = 'driver_details';
        $services = ServiceLocation::whereActive(true)->companyKey()->get();
        $approved = Driver::whereNotNull('owner_id')->where('approve', true)->get();
        // dd($approved);
        return view('admin.fleet-drivers.index', compact('page', 'main_menu', 'sub_menu','services', 'approved'));
    }

    /**
    * Fetch approved fleet-drivers
    */
    public function getApprovedFleetDrivers(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');
        if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
                $query = Driver::whereNotNull('owner_id')->where('approve', true)->orderBy('created_at', 'desc');
                if (env('APP_FOR')=='demo') {
                    $query = Driver::whereNotNull('owner_id')->where('approve', true)->whereHas('user', function ($query) {
                        $query->whereCompanyKey(auth()->user()->company_key);
                    })->orderBy('created_at', 'desc');
                }
            } else {
                $this->validateAdmin();
                $query = $this->driver->whereNotNull('owner_id')->where('approve', true)->where('service_location_id', auth()->user()->admin->service_location_id)->orderBy('created_at', 'desc');
                // $query = Driver::orderBy('created_at', 'desc');
            }
            $results = $queryFilter->builder($query)->customFilter(new DriverFilter)->paginate();

            return view('admin.fleet-drivers._drivers', compact('results','app_for'))->render();

    }
    public function approvalPending()
    {
        $page = trans('pages_names.fleet-drivers');
        $main_menu = 'fleet-drivers';
        $sub_menu = 'driver_approval_pending';
        $services = ServiceLocation::whereActive(true)->companyKey()->get();
        return view('admin.fleet-drivers.pending-for-approval', compact('page', 'main_menu', 'sub_menu','services'));
    }
    public function getApprovalPendingFleetDrivers(QueryFilterContract $queryFilter)
    {
        $app_for = config('app.app_for');

         if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
                $query = Driver::where('approve', false)->whereNotNull('owner_id')->orderBy('created_at', 'desc');

                if (env('APP_FOR')=='demo') {
                    $query = Driver::where('approve', false)->whereNotNull('owner_id')->whereHas('user', function ($query) {
                        $query->whereCompanyKey(auth()->user()->company_key);
                    })->orderBy('created_at', 'desc');
                }
            } else {
                $this->validateAdmin();
                $query = $this->driver->where('approve', false)->whereNotNull('owner_id')->where('service_location_id', auth()->user()->admin->service_location_id)->orderBy('created_at', 'desc');
                // $query = Driver::orderBy('created_at', 'desc');
            }
            $results = $queryFilter->builder($query)->customFilter(new DriverFilter)->paginate();

            return view('admin.fleet-drivers._drivers', compact('results','app_for'))->render();

    }

    /**
    * Create Driver View
    *
    */
    public function create()
    {
        $page = trans('pages_names.add_driver');

        // $admins = User::doesNotBelongToRole(RoleSlug::SUPER_ADMIN)->get();
        $services = ServiceLocation::companyKey()->whereActive(true)->get();
        $types = VehicleType::whereActive(true)->get();
        $countries = Country::all();
        $carmake = CarMake::active()->get();

        $companies = Company::active()->get();

        $owner = Owner::whereApprove(true)->get();
        $app_for = config('app.app_for');

// dd($owner);

        $main_menu = 'fleet-drivers';
        $sub_menu = 'driver_details';

        return view('admin.fleet-drivers.create', compact('services', 'types', 'page', 'countries', 'main_menu', 'sub_menu', 'companies', 'carmake','owner', 'app_for'));
    }

    /**
     * Create Driver.
     *
     * @param \App\Http\Requests\Admin\Driver\CreateDriverRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
  public function store(CreateFleetDriverRequest $request)
    {

        $created_params = $request->only(['service_location_id', 'name','mobile','email','gender', 'owner_id','transport_type']);
        $service_location = ServiceLocation::where('id',$request->service_location_id)->first();


        $validate_exists_email = $this->user->belongsTorole(Role::DRIVER)->where('email', $request->email)->exists();

        $validate_exists_mobile = $this->user->belongsTorole(Role::DRIVER)->where('mobile', $request->mobile)->exists();

        if ($validate_exists_email) {
            return redirect()->back()->withErrors(['email'=>'Provided email has already been taken'])->withInput();
        }
        if ($validate_exists_mobile) {
            return redirect()->back()->withErrors(['mobile'=>'Provided mobile has already been taken'])->withInput();
        }

        $created_params['uuid'] = driver_uuid();


        $user = $this->user->create(['name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'mobile_confirmed'=>true,
            'password' => bcrypt($request->input('password')),
            'company_key'=>auth()->user()->company_key,
            'refferal_code'=> str_random(6),
            'country'=>$service_location->country,
        ]);


        if ($uploadedFile = $this->getValidatedUpload('profile_pic', $request)) {
            $created_params['profile_pic'] = $this->imageUploader->file($uploadedFile)
                ->saveDriverProfilePicture();
        }

        $user->attachRole(RoleSlug::DRIVER);


        $created_params['active'] = false;
        $created_params['country'] = $service_location->country;

        $driver = $user->driver()->create($created_params);

        $driver_detail_data = $request->only(['is_company_driver','company']);

        $driver_detail = $driver->driverDetail()->create($driver_detail_data);

        // Create Empty Wallet to the driver
        $driver_wallet = $driver->driverWallet()->create(['amount_added'=>0]);

        $message = trans('succes_messages.fleet_driver_added_succesfully');

        cache()->tags('fleet_drivers_list')->flush();

        return redirect('fleet-drivers')->with('success', $message);
    }

    public function getById(Driver $driver)
    {
        $page = trans('pages_names.edit_driver');

        $services = ServiceLocation::whereActive(true)->get();
        $countries = Country::all();
        $companies = Company::active()->get();
        $item = $driver;
        $owner = Owner::whereApprove(true)->get();
        $main_menu = 'fleet-drivers';
        $sub_menu = 'driver_details';
        $app_for = config('app.app_for');
        $owner = Owner::whereApprove(true)->get();


        return view('admin.fleet-drivers.update', compact('item', 'services', 'page', 'countries', 'main_menu', 'sub_menu', 'companies','owner','app_for'));
    }


      public function update(Driver $driver, UpdateFleetDriverRequest $request)
    {
        // dd($driver);
        $updatedParams = $request->only(['service_location_id', 'name','mobile','email','gender', 'owner_id','transport_type']);

        $user = $driver->user;
        $validate_exists_email = $this->user->belongsTorole(Role::DRIVER)->where('email', $request->email)->where('id', '!=', $user->id)->exists();

        $validate_exists_mobile = $this->user->belongsTorole(Role::DRIVER)->where('mobile', $request->mobile)->where('id', '!=', $user->id)->exists();

        if ($validate_exists_email) {
            return redirect()->back()->withErrors(['email'=>'Provided email hs already been taken'])->withInput();
        }
        if ($validate_exists_mobile) {
            return redirect()->back()->withErrors(['mobile'=>'Provided mobile hs already been taken'])->withInput();
        }
        $service_location = ServiceLocation::where('id',$request->service_location_id)->first();


        $user_param = $request->only(['profile']);

        $user_param['profile']=null;
        
        if ($uploadedFile = $this->getValidatedUpload('profile_picture', $request)) {
            $user_param['profile'] = $this->imageUploader->file($uploadedFile)
                ->saveProfilePicture();
        }
        
        $driver->update(['name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'transport_type'=>$request->input('transport_type'),
            'country'=>$service_location->country,
            'owner_id'=>$request->input('owner_id'),
            'service_location_id'=>$request->service_location_id

        ]);
        $driver->user->update(['name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'country'=>$service_location->country,
            'mobile'=>$request->input('mobile'),
            'profile_picture'=>$user_param['profile']
        ]);
        $message = trans('succes_messages.fleet_driver_updated_succesfully');
        cache()->tags('fleet_drivers_list')->flush();
        return redirect('fleet-drivers')->with('success', $message);
    }

    public function toggleStatus(Driver $driver)
    {
        $status = $driver->active == 1 ? 0 : 1;
        $driver->update([
            'active' => $status
        ]);

        $message = trans('succes_messages.fleet_driver_status_changed_succesfully');
        return redirect('fleet-drivers')->with('success', $message);
    }
    public function toggleApprove(Driver $driver, $approval_status)
    {

        $status = (boolean)$approval_status;

        if ($status) {
            $err = false;
            $neededDoc = DriverNeededDocument::count();

            $uploadedDoc = count($driver->driverDocument);

            if ($neededDoc != $uploadedDoc) {
                // $message = trans('succes_messages.driver_document_not_uploaded');
                return redirect('fleet-drivers/document/view/'.$driver->id);
            }

            foreach ($driver->driverDocument as $driverDoc) {
                if ($driverDoc->document_status != 1) {
                    $err = true;
                }
            }

            if ($err) {
                $message = trans('succes_messages.driver_document_not_approved');
                // return redirect('drivers')->with('warning', $message);
                return redirect('fleet-drivers/document/view/'.$driver->id);
            }
            $driver->update([
            'reason' => null
        ]);
        }

        $this->database->getReference('fleet-drivers/'.$driver->id)->update(['approve'=>(int)$status,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $driver->update([
            'approve' => $status
        ]);

        $message = trans('succes_messages.fleet_driver_approve_status_changed_succesfully');
        $user = User::find($driver->user_id);
        if ($status) {
            $title = trans('push_notifications.fleet_approved_title',[],$user->lang);
            $body = trans('push_notifications.fleet_approved_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::DRIVER_ACCOUNT_APPROVED];
            $socket_success_message = PushEnums::DRIVER_ACCOUNT_APPROVED;
        } else {
            $title = trans('push_notifications.fleet_declined_title',[],$user->lang);
            $body = trans('push_notifications.fleet_declined_body',[],$user->lang);
            $push_data = ['notification_enum'=>PushEnums::DRIVER_ACCOUNT_DECLINED];
            $socket_success_message = PushEnums::DRIVER_ACCOUNT_DECLINED;
        }

        $driver_details = $user->driver;
        $driver_result = fractal($driver_details, new DriverTransformer);
        $formated_driver = $this->formatResponseData($driver_result);
        // dd($formated_driver);
        $socket_params = $formated_driver['data'];
        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = $socket_success_message;
        $socket_data->data  = $socket_params;


        // dispatch(new NotifyViaMqtt('approval_status_'.$driver_details->id, json_encode($socket_data), $driver_details->id));

        dispatch(new SendPushNotification($user,$title,$body));

        return redirect('fleet-drivers')->with('success', $message);
    }
    public function toggleAvailable(Driver $driver)
    {
        $status = $driver->available == 1 ? 0 : 1;
        $driver->update([
            'available' => $status
        ]);

        $message = trans('succes_messages.fleet_driver_available_status_changed_succesfully');
        return redirect('fleet-drivers')->with('success', $message);
    }

    public function delete(Driver $driver)
    {
        if(env('APP_FOR')=='demo'){

        return $message = 'you cannot delete the driver. this is demo version';


        }
        $driver->user()->delete();

        $message = trans('succes_messages.fleet_driver_deleted_succesfully');

        return redirect('fleet-drivers')->with('success', $message);
    }

    public function getCarModel()
    {
        $carModel = request()->car_make;

        // return CarModel::where('make_id',$carModel)->where('active','1')->get();
        return CarModel::active()->whereMakeId($carModel)->get();
    }

    public function UpdateFleetDriverDeclineReason(Request $request)
    {
        $driver = Driver::whereId($request->id)->update([
            'reason' => $request->reason
        ]);

        return 'success';
    }

   public function DriverTripRequestIndex(Driver $driver)
    {

        $completedTrips = RequestRequest::where('driver_id',$driver->id)->companyKey()->whereIsCompleted(true)->count();
        $cancelledTrips = RequestRequest::where('driver_id',$driver->id)->companyKey()->whereIsCancelled(true)->count();

        $card = [];
        $card['completed_trip'] = ['name' => 'trips_completed', 'display_name' => 'Completed Rides', 'count' => $completedTrips, 'icon' => 'fa fa-flag-checkered text-green'];
        $card['cancelled_trip'] = ['name' => 'trips_cancelled', 'display_name' => 'Cancelled Rides', 'count' => $cancelledTrips, 'icon' => 'fa fa-ban text-red'];

        $main_menu = 'fleet-drivers';
        $sub_menu = 'driver_details';
        $items = $driver->id;

        return view('admin.fleet-drivers.driver-request-list', compact('card','main_menu','sub_menu','items'));
    }
     public function DriverTripRequest(QueryFilterContract $queryFilter, Driver $driver)
        {
            $items = $driver->id;

             $query = RequestRequest::where('driver_id',$driver->id);
            $results = $queryFilter->builder($query)->customFilter(new RequestFilter)->defaultSort('-created_at')->paginate();

            return view('admin.fleet-drivers.driver-request-list-view', compact('results','items'));
        }

    public function FleetDriverPaymentHistory(Driver $driver)
    {
        $main_menu = 'fleet-drivers';
        $sub_menu = 'fleet_drivers_details';
        $item = $driver;
        // dd($item);

        $amount = DriverWallet::where('user_id',$driver->id)->first();
        
        if ($amount == null) {

         $card = [];
         $card['total_amount'] = ['name' => 'total_amount', 'display_name' => 'Total Amount ', 'count' => "0", 'icon' => 'fa fa-flag-checkered text-green'];
        $card['amount_spent'] = ['name' => 'amount_spent', 'display_name' => 'Spend Amount ', 'count' => "0", 'icon' => 'fa fa-ban text-red'];
        $card['balance_amount'] = ['name' => 'balance_amount', 'display_name' => 'Balance Amount', 'count' => "0", 'icon' => 'fa fa-ban text-red'];

         $history = UserWalletHistory::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        }
        else{
         $card = [];
        $card['total_amount'] = ['name' => 'total_amount', 'display_name' => 'Total Amount ', 'count' => $amount->amount_added, 'icon' => 'fa fa-flag-checkered text-green'];
        $card['amount_spent'] = ['name' => 'amount_spent', 'display_name' => 'Spend Amount ', 'count' => $amount->amount_spent, 'icon' => 'fa fa-ban text-red'];
        $card['balance_amount'] = ['name' => 'balance_amount', 'display_name' => 'Balance Amount', 'count' => $amount->amount_balance, 'icon' => 'fa fa-ban text-red'];


         $history = DriverWalletHistory::where('user_id',$driver->id)->orderBy('created_at','desc')->paginate(10);

          }

        return view('admin.fleet-drivers.driver-payment-wallet', compact('card','main_menu','sub_menu','item','history'));
    }

    public function StoreDriverPaymentHistory(AddDriverMoneyToWalletRequest $request,Driver $driver)
    {

        $currency = get_settings(Settings::CURRENCY);

        // $converted_amount_array =  convert_currency_to_usd($user_currency_code, $request->input('amount'));

        // $converted_amount = $converted_amount_array['converted_amount'];
        // $converted_type = $converted_amount_array['converted_type'];
        // $conversion = $converted_type.':'.$request->amount.'-'.$converted_amount;
        $transaction_id = Str::random(6);


            $wallet_model = new DriverWallet();
            $wallet_add_history_model = new DriverWalletHistory();
            $user_id = $driver->id;


        $user_wallet = $wallet_model::firstOrCreate([
            'user_id'=>$user_id]);
        $user_wallet->amount_added += $request->amount;
        $user_wallet->amount_balance += $request->amount;
        $user_wallet->save();

        $wallet_add_history_model::create([
            'user_id'=>$user_id,
            'card_id'=>null,
            'amount'=>$request->amount,
            'transaction_id'=>$transaction_id,
            'merchant'=>null,
            'remarks'=>WalletRemarks::MONEY_DEPOSITED_TO_E_WALLET_FROM_ADMIN,
            'is_credit'=>true]);


         $message = "money_added_successfully";
        return redirect()->back()->with('success', $message);


    }

    // public function driverRatings()
    // {
    //     $page = trans('pages_names.drivers');
    //     $main_menu = 'fleet-drivers';
    //     $sub_menu = 'driver_ratings';
       
    //     return view('admin.fleet-drivers.driver-ratings', compact('page', 'main_menu', 'sub_menu'));

    // }

    // public function fetchDriverRatings(QueryFilterContract $queryFilter){

    //     $query = Driver::query();

    //     $results = $queryFilter->builder($query)->customFilter(new DriverFilter)->paginate();


    //     return view('admin.fleet-drivers._driver-ratings', compact('results'))->render();

    // }

    // public function driverRatingView(Driver $driver)
    // {
    //     $page = trans('pages_names.fleet-drivers');
    //     $main_menu = 'fleet-drivers';
    //     $sub_menu = 'driver_ratings';
    //     $trips = RequestRating::where('driver_id',$driver->id)->whereNotNull('user_id')->whereUserRating(true)->paginate(10);
    //     $item = $driver;
    //     // dd($trips);
    //      return view('admin.fleet-drivers.driver-rating-view', compact('page', 'main_menu', 'sub_menu','item','trips'));
    // }

    // /**
    //  * Withdrawal Requests List
    //  *
    //  * */
    // public function withdrawalRequestsList()
    // {
    //     $page = trans('pages_names.withdrawal_requests');
    //     $main_menu = 'fleet-drivers';
    //     $sub_menu = 'withdrawal_requests';

    //         if (access()->hasRole(RoleSlug::SUPER_ADMIN)) {
    //             $history = WalletWithdrawalRequest::whereHas('driverDetail.user',function($query){
    //             $query->companyKey();
    //             })->orderBy('created_at','desc')->paginate(20);

    //         }else{
    //             $admin_data =auth()->user()->admin;

    //            $history = WalletWithdrawalRequest::whereHas('driverDetail.user',function($query){
    //             $query->companyKey();
    //             })->whereHas('driverDetail',function($query)use($admin_data){
    //             $query->where('service_location_id', $admin_data->service_location_id);
    //             })->orderBy('created_at','desc')->paginate(20);
    //         }


    //     return view('admin.fleet-drivers.driver-wallet-withdrawal-requests-list', compact('page', 'main_menu', 'sub_menu','history'));
    // }

    // /**
    //  * Wallet withdrawal Requests Detail
    //  *
    //  *
    //  * */
    // public function withdrawalRequestDetail(Driver $driver){

    //     $page = trans('pages_names.withdrawal_requests');
    //     $main_menu = 'fleet-drivers';
    //     $sub_menu = 'withdrawal_requests';

    //     $bankInfo = $driver->user->bankInfo;

    //     $history = WalletWithdrawalRequest::whereHas('driverDetail.user',function($query){
    //         $query->companyKey();
    //     })->where('driver_id',$driver->id)->orderBy('created_at','desc')->paginate(20);

    //     $bankInfo = $driver->user->bankInfo;

    //     $amount = DriverWallet::where('user_id',$driver->id)->first();

    //      $card = [];

    //     $card['balance_amount'] = ['name' => 'balance_amount', 'display_name' => 'Balance Amount', 'count' => $amount->amount_balance, 'icon' => 'fa fa-ban text-red'];

    //     return view('admin.fleet-drivers.DriverWalletWithdrawalRequestDetail', compact('page', 'main_menu', 'sub_menu','history','card', 'bankInfo'));

    // }

    // /**
    //  * Approve Withdrawal Request
    //  *
    //  *
    //  * */
    // public function approveWithdrawalRequest(WalletWithdrawalRequest $wallet_withdrawal_request){

    //     $driver_wallet = DriverWallet::firstOrCreate([
    //         'user_id'=>$wallet_withdrawal_request->driver_id]);
    //     $driver_wallet->amount_spent += $wallet_withdrawal_request->requested_amount;
    //     $driver_wallet->amount_balance -= $wallet_withdrawal_request->requested_amount;
    //     $driver_wallet->save();

    //      $driver_wallet_history = $wallet_withdrawal_request->driverDetail->driverWalletHistory()->create([
    //             'amount'=>$wallet_withdrawal_request->requested_amount,
    //             'transaction_id'=>str_random(6),
    //             'remarks'=>WalletRemarks::WITHDRAWN_FROM_WALLET,
    //             'is_credit'=>false
    //         ]);

    //      $wallet_withdrawal_request->status = 1;
    //      $wallet_withdrawal_request->save();

    //     $message = "Withdrawal request approved successfully";

    //     return redirect()->back()->with('success', $message);

    // }

    // /**
    //  * Decline Withdrawal Request
    //  *
    //  *
    //  * */
    // public function declineWithdrawalRequest(WalletWithdrawalRequest $wallet_withdrawal_request)
    // {

    //     $wallet_withdrawal_request->status = 2;
    //     $wallet_withdrawal_request->save();

    //     $message = "Withdrawal request declined successfully";

    //     return redirect()->back()->with('success', $message);
    // }

}


