<?php

namespace App\Models;

use App\Base\Uuid\UuidModel;
use Illuminate\Database\Eloquent\Model;

class MobileOtp extends Model {
	use UuidModel;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'mobile_otp_verifications';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'mobile', 'otp', 'verified',
	];

	/**
	 * The user who owns the mobile number.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class, 'mobile', 'mobile');
	}

	/**
	 * Check if the OTP for the mobile number has been verified.
	 *
	 * @return bool
	 */
	public function isVerified() {
		return (bool) $this->verified;
	}
}
