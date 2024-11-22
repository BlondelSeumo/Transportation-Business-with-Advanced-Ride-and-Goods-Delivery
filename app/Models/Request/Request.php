<?php

namespace App\Models\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Base\Uuid\UuidModel;
use App\Models\Admin\Driver;
use App\Models\Admin\ServiceLocation;
use App\Models\Admin\ZoneType;
use App\Models\Admin\UserDetails;
use App\Models\Request\AdHocUser;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasActiveCompanyKey;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\Admin\CancellationReason;
use App\Models\Master\PackageType;
use App\Models\Admin\Owner;
use App\Models\Master\GoodsType;


class Request extends Model
{
    use UuidModel,SearchableTrait,HasActiveCompanyKey;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['request_number','is_later','assign_method','user_id','driver_id','trip_start_time','arrived_at','accepted_at','completed_at','cancelled_at','is_driver_started','is_driver_arrived','is_trip_start','is_completed','is_cancelled','reason','cancel_method','total_distance','total_time','payment_opt','is_paid','user_rated','driver_rated','promo_id','timezone','unit','if_dispatch','zone_type_id','requested_currency_code','custom_reason','attempt_for_schedule','service_location_id','company_key','dispatcher_id','book_for_other_contact','book_for_other','ride_otp','is_rental','rental_package_id','is_out_station','request_eta_amount','is_surge_applied','owner_id','fleet_id','goods_type_id','goods_type_quantity','requested_currency_symbol','offerred_ride_fare','accepted_ride_fare','is_bid_ride','instant_ride','return_time','is_round_trip','discounted_total','web_booking','on_search','poly_line','is_pet_available','is_luggage_available','transport_type'];


    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [
        'vehicle_type_name','pick_lat','pick_lng','drop_lat','drop_lng','pick_address','drop_address','converted_trip_start_time','converted_arrived_at','converted_accepted_at','converted_completed_at','converted_cancelled_at','converted_created_at','converted_updated_at','vehicle_type_image','vehicle_type_id','converted_return_time'
    ];
    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'driverDetail','userDetail','requestBill'
    ];

    public $sortable = ['trip_start_time', 'created_at', 'updated_at'];

    /**
     * The Request place associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestPlace()
    {
        return $this->hasOne(RequestPlace::class, 'request_id', 'id');
    }

    public function requestRating()
    {
        return $this->hasMany(RequestRating::class, 'request_id','id');
    }

    /**
     * The Request Adhoc user associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function adHocuserDetail()
    {
        return $this->hasOne(AdHocUser::class, 'request_id', 'id');
    }
    /**
     * The Request Bill associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestBill()
    {
        return $this->hasOne(RequestBill::class, 'request_id', 'id');
    }
    /**
     * The Request Bill associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestBillDetail()
    {
        return $this->hasOne(RequestBill::class, 'request_id', 'id');
    }
    /**
     * The Request meta associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestMeta()
    {
        return $this->hasMany(RequestMeta::class, 'request_id', 'id');
    }

    public function rentalPackage()
    {
        return $this->belongsTo(PackageType::class, 'rental_package_id', 'id');
    }

    public function driverDetail()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    public function ownerDetail()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function zoneType()
    {
        return $this->belongsTo(ZoneType::class, 'zone_type_id', 'id')->withTrashed();
    }

    /**
     * The Request place associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestCancellationFee()
    {
        return $this->hasOne(RequestCancellationFee::class, 'request_id', 'id');
    }

    public function zoneTypePackage()
    {
        return $this->belongsTo(ZoneTypePackage::class, 'zone_type_id', 'id');
    }
    /**
    * Get request's pickup latitude.
    *
    * @return string
    */
    public function getPickLatAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->pick_lat;
    }
    /**
    * Get request's pickup longitude.
    *
    * @return string
    */
    public function getPickLngAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->pick_lng;
    }
    /**
    * Get request's drop latitude.
    *
    * @return string
    */
    public function getDropLatAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->drop_lat;
    }
    /**
    * Get request's drop longitude.
    *
    * @return string
    */
    public function getDropLngAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->drop_lng;
    }
    /**
    * Get request's pickup address.
    *
    * @return string
    */
    public function getPickAddressAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->pick_address;
    }
    /**
    * Get request's drop address.
    *
    * @return string
    */
    public function getDropAddressAttribute()
    {
        if (!$this->requestPlace()->exists()) {
            return null;
        }
        return $this->requestPlace->drop_address;
    }
    /**
    * Get vehicle type's name.
    *
    * @return string
    */
    public function getVehicleTypeNameAttribute()
    {
        if ($this->zoneType == null) {
            return null;
        }
        if (!$this->zoneType->vehicleType()->exists()) {
            return null;
        }
        return $this->zoneType->vehicleType->name;
    }
     /**a
    * Get vehicle type's name.
    *
    * @return string
    */
    public function getVehicleTypeImageAttribute()
    {
        if ($this->zoneType == null) {
            return null;
        }
        if (!$this->zoneType->vehicleType()->exists()) {
            return null;
        }
        return $this->zoneType->vehicleType->icon;
    }
    /**
    * Get vehicle type's name.
    *
    * @return string
    */
    public function getVehicleTypeIdAttribute()
    {
        if ($this->zoneType == null) {
            return null;
        }
        if (!$this->zoneType->vehicleType()->exists()) {
            return null;
        }
        return $this->zoneType->vehicleType->id;
    }
    /**
    * Get formated and converted timezone of user's Trip start time.
    * @return string
    */
    public function getConvertedTripStartTimeAttribute()
    {
        if ($this->trip_start_time==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->trip_start_time)->setTimezone($timezone)->format('jS M h:i A');
    }

    /**
    * Get formated and converted timezone of user's Trip start time.
    * @return string
    */
    public function getConvertedReturnTimeAttribute()
    {
        if ($this->return_time==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->return_time)->setTimezone($timezone)->format('jS M h:i A');
    }

    /**
    * Get formated and converted timezone of user's arrived at.
    * @return string
    */
    public function getConvertedArrivedAtAttribute()
    {
        if ($this->arrived_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->arrived_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's accepted at.
    * @return string
    */
    public function getConvertedAcceptedAtAttribute()
    {
        if ($this->accepted_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->accepted_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's completed_at at.
    * @return string
    */
    public function getConvertedCompletedAtAttribute()
    {
        if ($this->completed_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->completed_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's cancelled at.
    * @return string
    */
    public function getConvertedCancelledAtAttribute()
    {
        if ($this->cancelled_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->cancelled_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's created at.
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }

        /**
         * Get formatted and converted timezone of user's Trip start time in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedTripStartTimeDateAttribute()
        {
            if ($this->trip_start_time == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->trip_start_time)->setTimezone($timezone)->format('d/m/Y');
        }

        /**
         * Get formatted and converted timezone of user's arrived at in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedArrivedAtDateAttribute()
        {
            if ($this->arrived_at == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->arrived_at)->setTimezone($timezone)->format('d/m/Y');
        }

        /**
         * Get formatted and converted timezone of user's accepted at in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedAcceptedAtDateAttribute()
        {
            if ($this->accepted_at == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->accepted_at)->setTimezone($timezone)->format('d/m/Y');
        }

        /**
         * Get formatted and converted timezone of user's completed_at at in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedCompletedAtDateAttribute()
        {
            if ($this->completed_at == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->completed_at)->setTimezone($timezone)->format('d/m/Y');
        }

        /**
         * Get formatted and converted timezone of user's cancelled at in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedCancelledAtDateAttribute()
        {
            if ($this->cancelled_at == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->cancelled_at)->setTimezone($timezone)->format('d/m/Y');
        }

        /**
         * Get formatted and converted timezone of user's created at in "dd/mm/yyyy" format.
         * @return string
         */
        public function getConvertedCreatedAtDateAttribute()
        {
            if ($this->created_at == null) {
                return null;
            }
            $timezone = $this->serviceLocationDetail->timezone ?: env('SYSTEM_DEFAULT_TIMEZONE');
            return Carbon::parse($this->created_at)->setTimezone($timezone)->format('d/m/Y');
        }


    /**
    * Get formated and converted timezone of user's created at.
    * @return string
    */
    public function getConvertedUpdatedAtAttribute()
    {
        if ($this->updated_at==null) {
            return null;
        }
        $timezone = $this->serviceLocationDetail->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->updated_at)->setTimezone($timezone)->format('jS M h:i A');
    }

    public function getRequestUnitAttribute()
    {
        if ($this->unit == '1') {
            return 'Km';
        } else {
            return 'Miles';
        }
    }

    public function getCurrencyAttribute()
    {
        if ($this->zoneType->zone->serviceLocation->exists()) {
            return $this->zoneType->zone->serviceLocation->currency_symbol;
        }
        return get_settings('currency_symbol');
    }

    protected $searchable = [
        'columns' => [
            'requests.request_number' => 20,
            'users.name' => 20,
            'drivers.name' => 20,
        ],
        'joins' => [
            'users' => ['requests.user_id','users.id'],
            'drivers' => ['requests.driver_id','drivers.id'],
        ],
    ];

     /**
    * The Request Chat associated with the request's id.
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function requestChat()
    {
        return $this->hasMany(Chat::class, 'request_id', 'id');
    }

    public function serviceLocationDetail(){
        return $this->belongsTo(ServiceLocation::class,'service_location_id','id');
    }

    public function cancelReason()
    {
         return $this->hasOne(CancellationReason::class, 'id', 'reason');

    }
    public function goodsTypeDetail(){
        return $this->belongsTo(GoodsType::class,'goods_type_id','id');
    }

    /**
     * The Request Stops associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestStops()
    {
        return $this->hasMany(RequestStop::class, 'request_id', 'id');
    }

    /**
     * The Request proof associated with the request's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function requestProofs()
    {
        return $this->hasMany(RequestDeliveryProof::class, 'request_id', 'id');
    }

}
