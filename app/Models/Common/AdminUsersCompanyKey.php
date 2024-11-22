<?php

namespace App\Models\Common;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminUsersCompanyKey extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_users_company_keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id', 'company_key', 'expiry_date','active'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'user'
    ];
    /**
     * The driver that the user_id belongs to.
     * @tested
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_user_id', 'id');
    }
}
