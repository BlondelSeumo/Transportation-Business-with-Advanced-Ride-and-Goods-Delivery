<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Base\Uuid\UuidModel;
use App\Models\User;

class Developer extends Model
{	use  UuidModel;
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name','user_id', 'address', 'country','state','city','pincode','email','mobile','team',
	];
	public function user(){
		return $this->belongsTo(User::class,'user_id','id');
	}
}
