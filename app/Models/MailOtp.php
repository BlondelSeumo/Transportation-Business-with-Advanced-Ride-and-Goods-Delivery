<?php

namespace App\Models;

use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;

class MailOtp extends Model {
	use UuidModel;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'mail_otp_verifications';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email', 'otp', 'verified',
	];

	/**
	 * The user who owns the mobile number.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class, 'email', 'email');
	}

	/**
	 * Check if the OTP for the mobile number has been verified.
	 *
	 * @return bool
	 */
	public function isVerified() {
		return (bool) $this->verified;
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

}
