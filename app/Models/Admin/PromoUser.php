<?php

namespace App\Models\Admin;

use App\Models\Admin\Promo;
use App\Models\Request\Request;
use Illuminate\Database\Eloquent\Model;

class PromoUser extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promo_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['promo_code_id','user_id','request_id'];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'promo','request'
    ];

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_code_id', 'id');
    }
    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }
}
