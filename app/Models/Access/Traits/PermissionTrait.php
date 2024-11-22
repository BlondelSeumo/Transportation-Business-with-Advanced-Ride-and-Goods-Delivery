<?php

namespace App\Models\Access\Traits;

trait PermissionTrait
{
    /**
     * Override the "boot" method of the model.
     * The trait's "boot" method is called in the Model's "boot" method automatically.
     *
     * @return void
     */
    public static function bootPermissionTrait()
    {
        /*
         * Detach all the roles associated with the permission when it's being deleted.
         * Clear all the permissions cache associated with the role.
         */
        static::deleting(function ($permission) {
            foreach ($permission->roles as $role) {
                $role->clearCache();
            }

            $permission->roles()->detach();
        });
    }
}
