<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\Traits\PermissionTrait;

class Permission extends Model
{
    use PermissionTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'description','main_menu','sub_menu','main_link','icon'
    ];

    /**
     * The attributes that can be used for sorting with query string filtering.
     *
     * @var array
     */
    public $sortable = [
        'name', 'created_at', 'updated_at'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'roles'
    ];

    /**
     * The roles associated with the permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
}
