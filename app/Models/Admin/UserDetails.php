<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class UserDetails extends Model
{
    use HasActive, UuidModel,SoftDeletes,SearchableTrait;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_details';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id','name','mobile','email','address','state','city','country','gender','active','currency','profile','token','token_expiry'
	];
	public function user(){
		return $this->belongsTo(User::class,'user_id','id');
	}

    protected $searchable = [
        'columns' => [
            'user_details.name' => 20,
            'user_details.mobile'=> 20,
            'user_details.email'=> 20
        ]
    ];
}
