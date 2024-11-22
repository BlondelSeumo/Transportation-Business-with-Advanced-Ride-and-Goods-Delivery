<?php

namespace App\Models;

use App\Models\Traits\HasActive;
use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model {
	use HasActive;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'linked_social_accounts';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'provider_name', 'provider_id','user_id'
	];


	/**
	 * The relationships that can be loaded with query string filtering includes.
	 *
	 * @var array
	 */
	public $includes = [
		'user',
	];


	public function user()
	{
    	return $this->belongsTo('App\Models\User');
	}

}
