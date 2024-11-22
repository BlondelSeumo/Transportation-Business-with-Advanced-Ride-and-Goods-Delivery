<?php

namespace App\Models\Admin;

use App\Models\Admin\Promo;
use App\Models\Request\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class PromoCodeUser extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promo_code_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['promo_code_id','user_id','service_location_id'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'promo'
    ];

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_code_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
