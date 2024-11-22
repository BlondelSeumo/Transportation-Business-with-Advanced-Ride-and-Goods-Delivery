<?php

namespace App\Transformers\Access;

use App\Models\Access\Permission;
use App\Transformers\Transformer;

class PermissionTransformer extends Transformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected array $availableIncludes = [
        'roles'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'id'           => $permission->id,
            'slug'         => $permission->slug,
            'name'         => $permission->name,
            'description'  => $permission->description,
        ];
    }

    /**
     * Include the roles associated with the permission.
     *
     * @param Permission $permission
     * @return \League\Fractal\Resource\Collection|\League\Fractal\Resource\NullResource
     */
    public function includeRoles(Permission $permission)
    {
        $roles = $permission->roles;

        return $roles
            ? $this->collection($roles, new RoleTransformer)
            : $this->null();
    }
}
