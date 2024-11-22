<?php

namespace App\Transformers\User;

use App\Models\User;
use App\Base\Constants\Auth\Role;
use App\Transformers\Transformer;
use App\Transformers\Access\RoleTransformer;
use App\Transformers\Requests\TripRequestTransformer;
use App\Models\Admin\Sos;
use App\Transformers\Common\SosTransformer;
use App\Transformers\User\FavouriteLocationsTransformer;
use App\Base\Constants\Setting\Settings;
use Carbon\Carbon;
use App\Models\Admin\UserDriverNotification;
use App\Transformers\Common\BannerImageTransformer;
use App\Models\Master\BannerImage;
use App\Transformers\Payment\WalletTransformer;
use App\Models\Chat;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Log;

class UserTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'roles','onTripRequest','metaRequest','favouriteLocations','laterMetaRequest',
    ];
    /**
     * Resources that can be included default.
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'sos','bannerImage','wallet'

    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {

        $country_dial_code =$user->countryDetail?$user->countryDetail->dial_code:'';

        $params = [
            'id' => $user->id,
            'name' => $user->name,
            'gender' => $user->gender,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'mobile' => $country_dial_code.$user->mobile,
            'profile_picture' => $user->profile_picture,
            'active' => $user->active,
            'email_confirmed' => $user->email_confirmed,
            'mobile_confirmed' => $user->mobile_confirmed,
            'last_known_ip' => $user->last_known_ip,
            'last_login_at' => $user->last_login_at,
            'rating' => round($user->rating, 2),
            'no_of_ratings' => $user->no_of_ratings,
            'refferal_code'=>$user->refferal_code,
            'currency_code'=>$user->countryDetail->currency_code,
            'currency_symbol'=>$user->countryDetail->currency_symbol,
            'country_code'=>$user->countryDetail->code,
            //'map_key'=>get_settings('google_map_key'),
            'show_rental_ride'=>true,
            'is_delivery_app'=>false,
            'show_ride_later_feature'=>true,
            'authorization_code'=>$user->authorization_code
            // 'created_at' => $user->converted_created_at->toDateTimeString(),
            // 'updated_at' => $user->converted_updated_at->toDateTimeString(),
        ];

        $params['enable_map_location_icon_drag_and_drop_feature'] =  get_settings('enable_map_location_icon_drag_and_drop_feature');



        $params['enable_modules_for_applications'] =  get_settings('enable_modules_for_applications');


        $params['contact_us_mobile1'] =  get_settings('contact_us_mobile1');
        $params['contact_us_mobile2'] =  get_settings('contact_us_mobile2');
        $params['contact_us_link'] =  get_settings('contact_us_link');
        $params['show_wallet_money_transfer_feature_on_mobile_app'] = get_settings('shoW_wallet_money_transfer_feature_on_mobile_app');
        $params['show_bank_info_feature_on_mobile_app'] =  get_settings('show_bank_info_feature_on_mobile_app');
        $params['show_wallet_feature_on_mobile_app'] =  get_settings('show_wallet_feature_on_mobile_app');

        $app_for = config('app.app_for');
        if($app_for == 'delivery'){
            $params['is_delivery_app']= true;
        }


        // $params['show_outstation_ride_feature'] = "0";


        $notifications_count= UserDriverNotification::where('user_id',$user->id)
            ->where('is_read',0)->count();
        $params['notifications_count']=$notifications_count;

        if(get_settings('show_rental_ride_feature')=='0'){
            $params['show_rental_ride'] = false;
        }

        if(get_settings('show_ride_later_feature')=='0'){
            $params['show_ride_later_feature'] = false;
        }

        $referral_comission = get_settings('referral_commision_for_user');
        $referral_comission_string = 'Refer a friend and earn'.$user->countryDetail->currency_symbol.''.$referral_comission;
        $params['referral_comission_string'] = $referral_comission_string;

        $params['user_can_make_a_ride_after_x_miniutes'] = get_settings(Settings::USER_CAN_MAKE_A_RIDE_AFTER_X_MINIUTES);

        $params['maximum_time_for_find_drivers_for_regular_ride'] = (get_settings(Settings::MAXIMUM_TIME_FOR_FIND_DRIVERS_FOR_REGULAR_RIDE) * 60);

        $params['maximum_time_for_find_drivers_for_bitting_ride'] = (get_settings(Settings::MAXIMUM_TIME_FOR_FIND_DRIVERS_FOR_BIDDING_RIDE));


       $params['enable_driver_preference_for_user'] = (get_settings(Settings::ENABLE_DRIVER_PREFERENCE_FOR_USER));
       $params['enable_pet_preference_for_user'] = (get_settings(Settings::ENABLE_PET_PREFERENCE_FOR_USER));
       $params['enable_luggage_preference_for_user'] = (get_settings(Settings::ENABLE_LUGGAGE_PREFERENCE_FOR_USER));

        $params['bidding_amount_increase_or_decrease'] = (get_settings(Settings::BIDDING_AMOUNT_INCREASE_OR_DECREASE));


        $params['show_ride_without_destination'] = (get_settings(Settings::SHOW_RIDE_WITHOUT_DESTINATION));

        $params['enable_country_restrict_on_map'] = (get_settings(Settings::ENABLE_COUNTRY_RESTRICT_ON_MAP));

        $params['chat_id'] = "";
        $get_chat_data = Chat::where('user_id',$user->id)->first();
        if($get_chat_data)
        {
            $params['chat_id'] = $get_chat_data->id;
        }

        if($user->is_deleted_at!=null)
        {
            $params['is_deleted_at'] = "Your Account Delete operation is Processing";
        }

        $params['map_type'] = (get_settings(Settings::MAP_TYPE));
        $ongoing_ride = $user->requestDetail()->where('is_cancelled', false)->where('user_rated', false)->where('is_driver_started',1)->exists();

        $params['has_ongoing_ride'] = $ongoing_ride;

        if($app_for == 'bidding'){
            $params['show_outstation_ride_feature'] =  get_settings('show_outstation_ride_feature');
        }

        if($app_for=='taxi' || $app_for=='delivery')
        {
           $params['enable_modules_for_applications'] =  $app_for;
        }


        return $params;
    }

    /**
     * Include the roles of the user.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeRoles(User $user)
    {
        $roles = $user->roles;

        return $roles
        ? $this->collection($roles, new RoleTransformer)
        : $this->null();
    }
    /**
     * Include the request of the user.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeOnTripRequest(User $user)
    {

        $request = null;

        if(request()->has('current_ride') && request()->current_ride){

            $request =$user->requestDetail()->where('is_cancelled',false)->where('id',request()->current_ride)->first();

        }


        return $request
        ? $this->item($request, new TripRequestTransformer)
        : $this->null();
    }
    /**
    * Include the request meta of the user.
    *
    * @param User $user
    * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
    */

public function includeMetaRequest(User $user)
{
   $request = $user->requestDetail()->where('is_completed', false)->where('is_cancelled', false)->where('user_rated', false)->where('driver_id', null)->where('is_later', 0)->first();

Log::info("meta");
Log::info($request);


    return $request
        ? $this->item($request, new TripRequestTransformer)
        : $this->null();
}

    /**
    * Include the request meta of the user.
    *
    * @param User $user
    * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
    */
    public function includeLaterMetaRequest(User $user)
    {
        $current_date = Carbon::now()->format('Y-m-d H:i:s');

        $findable_duration = get_settings('minimum_time_for_search_drivers_for_schedule_ride');
        if(!$findable_duration){
            $findable_duration = 45;
        }
        $add_45_min = Carbon::now()->addMinutes($findable_duration)->format('Y-m-d H:i:s');


        $request = $user->requestDetail()->where('is_completed', false)->where('is_cancelled', false)->where('user_rated', false)->where('driver_id', null)->where('is_later', 0)->where('trip_start_time', '<=', $add_45_min)
                    ->where('trip_start_time', '>', $current_date)->first();

        return $request
        ? $this->item($request, new TripRequestTransformer)
        : $this->null();
    }

     /**
    * Include the request meta of the user.
    *
    * @param User $user
    * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
    */
    public function includeSos(User $user)
    {
        // Log::info('test');
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
        }
        else{
             $user_id = Session::get('user_id');
        }
        $request = Sos::select('id', 'name', 'number', 'user_type', 'created_by')
        ->where('created_by', $user_id)
        ->orWhere('user_type', 'admin')
        ->orderBy('created_at', 'Desc')
        ->companyKey()->get();

        return $request
        ? $this->collection($request, new SosTransformer)
        : $this->null();
    }

    /**
     * Include the favourite location of the user.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeFavouriteLocations(User $user)
    {
        $fav_locations = $user->favouriteLocations;

        return $fav_locations
        ? $this->collection($fav_locations, new FavouriteLocationsTransformer)
        : $this->null();
    }

    /**
     * Include the Banner image of the user.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeBannerImage()
    {
        $banner_image = BannerImage::where('active', true)->get();

        return $banner_image
        ? $this->collection($banner_image, new BannerImageTransformer)
        : $this->null();
    }
    /**
     * Include the favourite location of the user.
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeWallet(User $user)
    {
        $user_wallet = $user->userWallet;

        return $user_wallet
        ? $this->item($user_wallet, new WalletTransformer)
        : $this->null();
    }


}
