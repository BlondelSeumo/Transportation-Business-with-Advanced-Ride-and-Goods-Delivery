<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Access\Role;
use App\Models\Admin\Staff;
use App\Models\Admin\Driver;
use App\Models\Admin\Owner;
use App\Models\Request\Request;
use App\Models\Master\Developer;
use App\Models\Master\PocClient;
use App\Models\Traits\HasActive;
use App\Models\Admin\AdminDetail;
use App\Models\Admin\UserDetails;
use App\Models\Payment\UserWallet;
use Laravel\Passport\HasApiTokens;
use App\Models\LinkedSocialAccount;
use App\Models\Payment\DriverWallet;
use App\Base\Services\OTP\CanSendOTP;
use App\Models\Traits\DeleteOldFiles;
use App\Models\Traits\UserAccessTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Models\Payment\UserWalletHistory;
use App\Models\Traits\HasActiveCompanyKey;
use App\Models\Traits\UserAccessScopeTrait;
use App\Base\Services\OTP\CanSendOTPContract;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Request\FavouriteLocation;
use App\Models\Payment\UserBankInfo;
use App\Models\Payment\WalletWithdrawalRequest;

class User extends Authenticatable implements CanSendOTPContract
{
    use CanSendOTP,
    DeleteOldFiles,
    HasActive,
    HasApiTokens,
    Notifiable,
    UserAccessScopeTrait,
    UserAccessTrait,
    SearchableTrait,
    HasActiveCompanyKey;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'mobile', 'country', 'profile_picture', 'email_confirmed', 'mobile_confirmed', 'email_confirmation_token', 'active','fcm_token','login_by','apn_token','timezone','rating','rating_total','no_of_ratings','refferal_code','referred_by','social_nickname','social_id','social_token','social_token_secret','social_refresh_token','social_expires_in','social_avatar','social_avatar_original','social_provider','company_key','lang','is_bid_app','authorization_code','is_deleted_at','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_confirmation_token',
    ];

    /**
     * The attributes that have files that should be auto deleted on updating or deleting.
     *
     * @var array
     */
    public $deletableFiles = [
        'profile_picture',
    ];

    /**
     * The attributes that can be used for sorting with query string filtering.
     *
     * @var array
     */
    public $sortable = [
        'id', 'name', 'username', 'email', 'mobile', 'profile_picture', 'last_login_at', 'created_at', 'updated_at',
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'roles', 'otp','requestDetail'
    ];

    /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
    protected $appends = [

    ];

    /**
    * Get the Profile image full file path.
    *
    * @param string $value
    * @return string
    */
    public function getProfilePictureAttribute($value)
    {
        if (!$value) {
            $default_image_path = config('base.default.user.profile_picture');
            return url('/').$default_image_path;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url(file_path($this->uploadPath(), $value));
    }
    /**
     * Override the "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Model event handlers
    }

    /**
     * Set the password using bcrypt hash if stored as plaintext.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (password_get_info($value)['algo'] === 0) ? bcrypt($value) : $value;
    }

    /**
     * The roles associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * The OTP associated with the user's mobile number.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function otp()
    {
        return $this->hasOne(MobileOtp::class, 'mobile', 'mobile');
    }

    /**
     * Get the user model for the given username.
     *
     * @param string $username
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function findForPassport($username)
    {
        return $this->where($this->usernameField($username), $username)->first();
    }

    /**
     * Get the username attribute based on the input value.
     * Result is either 'email' or 'mobile'.
     *
     * @param string $username
     * @return string
     */
    public function usernameField($username)
    {
        return is_valid_email($username) ? 'email' : 'mobile';
    }

    /**
     * The default file upload path.
     *
     * @return string|null
     */
    public function uploadPath()
    {
        return config('base.user.upload.profile-picture.path');
    }

    /**
     * The Staff associated with the user's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function admin()
    {
        return $this->hasOne(AdminDetail::class, 'user_id', 'id');
    }

    /**
     * The Bank info associated with the user's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function bankInfo()
    {
        return $this->hasOne(UserBankInfo::class, 'user_id', 'id');
    }

    /**
     * The Staff associated with the user's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function developer()
    {
        return $this->hasOne(Developer::class, 'user_id', 'id');
    }

    /**
    * The user wallet history associated with the user's id.
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function userWalletHistory()
    {
        return $this->hasMany(UserWalletHistory::class, 'user_id', 'id');
    }

    /**
    * The favouriteLocations associated with the user's id.
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function favouriteLocations()
    {
        return $this->hasMany(FavouriteLocation::class, 'user_id', 'id');
    }

    public function userWallet()
    {
        return $this->hasOne(UserWallet::class, 'user_id', 'id');
    }
    public function driverWallet()
    {
        return $this->hasOne(DriverWallet::class, 'user_id', 'id');
    }

    public function withdrawalRequestsHistory()
    {
        return $this->hasMany(WalletWithdrawalRequest::class, 'user_id', 'id');
    }
    /**
     * The Driver associated with the user's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function driver()
    {
        return $this->hasOne(Driver::class, 'user_id', 'id');
    }

    public function accounts()
    {
        return $this->hasMany(LinkedSocialAccount::class, 'user_id', 'id');
    }
    public function requestDetail()
    {
        return $this->hasMany(Request::class, 'user_id', 'id');
    }

    /**
     * The Driver associated with the user's id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'id');
    }

    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedCreatedAtAttribute()
    {
        if ($this->created_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->created_at)->setTimezone($timezone)->format('jS M h:i A');
    }
    /**
    * Get formated and converted timezone of user's created at.
    *
    * @param string $value
    * @return string
    */
    public function getConvertedUpdatedAtAttribute()
    {
        if ($this->updated_at==null||!auth()->user()->exists()) {
            return null;
        }
        $timezone = auth()->user()->timezone?:env('SYSTEM_DEFAULT_TIMEZONE');
        return Carbon::parse($this->updated_at)->setTimezone($timezone)->format('jS M h:i A');
    }

    /**
    * Specifies the user's FCM token
    *
    * @return string
    */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
    public function routeNotificationForApn()
    {
        return $this->apn_token;
    }

    

    protected $searchable = [
        'columns' => [
            'users.name' => 20,
            'users.email'=> 20,
            'users.mobile'=> 20
        ],
    ];

    /**
    * The driver that the country belongs to.
    * @tested
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function owner()
    {
        return $this->hasOne(Owner::class, 'user_id', 'id');
    }


}
