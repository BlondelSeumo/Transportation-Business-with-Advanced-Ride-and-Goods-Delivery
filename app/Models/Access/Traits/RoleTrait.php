<?php

namespace App\Models\Access\Traits;

use DB;
use Cache;
use Exception;
use App\Models\Access\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

trait RoleTrait
{
    /**
     * Override the "boot" method of the model.
     * The trait's "boot" method is called in the Model's "boot" method automatically.
     *
     * @return void
     */
    public static function bootRoleTrait()
    {
        /*
         * Detach all the users and permissions associated with
         * the role when it's being deleted.
         * Clear all the role cache associated with the user.
         */
        static::deleting(function ($role) {
            foreach ($role->users as $user) {
                $user->clearCache();
            }

            $role->users()->detach();
            $role->permissions()->detach();

            flush_model_cache($role);
        });

        /*
         * Clear the permissions cache when a model is saved.
         */
        static::saved(function ($role) {
            flush_model_cache($role);
        });
    }

    /**
     * Get the permissions associated with the role from the cache.
     * Cache the result only if the Cache Store supports tagging.
     * If the cache is not available/expired then cache the result and return the value.
     *
     * @return Collection
     */
    public function cachedPermissions()
    {
        if (is_cache_taggable()) {
            return Cache::tags(model_cache_tag($this, config('access.cache.tag')))
                ->remember(model_cache_key($this), config('access.cache.ttl.permissions'), function () {
                    return $this->permissions()->get();
                });
        }

        return $this->permissions()->get();
    }

    /**
     * Clear the all permissions cache.
     */
    public function clearCache()
    {
        flush_model_cache($this);
    }

    /**
     * Check if the role has permission.
     * When multiple permissions are provided it will check if any one is present.
     * When $requireAll is set to "true" then all the permissions should be present.
     *
     * Will return true without any check if the "all" field is set to true for the role.
     *
     * @param string|array $slug
     * @param bool $requireAll
     * @return bool
     */
    public function hasPermission($slug, $requireAll = false)
    {
        if ($this->all) {
            return true;
        }

        if (is_array($slug)) {
            foreach ($slug as $permissionSlug) {
                $hasPermission = $this->hasPermission($permissionSlug);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found
            // Return the value of $requireAll
            return $requireAll;
        } else {
            foreach ($this->cachedPermissions() as $permission) {
                if ($slug == $permission->slug) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Sync the provided permissions to the role.
     *
     * @param array|Collection|BaseCollection $permissions
     * @throws Exception
     */
    public function syncPermissions($permissions)
    {
        if (!(is_array($permissions) || $permissions instanceof Collection || $permissions instanceof BaseCollection)) {
            throw new Exception('Invalid permissions provided to sync.');
        }

        $this->permissions()->sync($permissions);

        $this->clearCache();
    }

    /**
     * Sync the provided permissions to the user using their slugs.
     * Input can be a string value or an array of strings.
     *
     * @param string|array $permissionSlugs
     * @throws Exception
     */
    public function syncPermissionsUsingSlug($permissionSlugs)
    {
        $permissionSlugs = array_wrap($permissionSlugs);

        $permissions = Permission::whereIn('slug', $permissionSlugs)->pluck('id');

        if ($permissions->count() !== count($permissionSlugs)) {
            throw new Exception('Invalid permission slug.');
        }

        $this->syncPermissions($permissions);
    }

    /**
     * Attach a permission to the role.
     *
     * @param integer|string|Model $permission
     * @throws Exception
     */
    public function attachPermission($permission)
    {
        $permissionId = $this->getPermissionId($permission);

        $this->permissions()->syncWithoutDetaching($permissionId);

        $this->clearCache();
    }

    /**
     * Attach permissions to the role.
     *
     * @param array|Collection $permissions
     * @throws Exception
     */
    public function attachPermissions($permissions)
    {
        if (!(is_array($permissions) || $permissions instanceof Collection)) {
            throw new Exception('Invalid permissions provided to attach.');
        }

        DB::transaction(function () use ($permissions) {
            foreach ($permissions as $permission) {
                $this->attachPermission($permission);
            }
        });
    }

    /**
     * Detach a permission from the role.
     *
     * @param integer|string|Model $permission
     * @throws Exception
     */
    public function detachPermission($permission)
    {
        $permissionId = $this->getPermissionId($permission);

        $this->permissions()->detach($permissionId);

        $this->clearCache();
    }

    /**
     * Detach permissions from the role.
     *
     * @param array|Collection $permissions
     * @throws Exception
     */
    public function detachPermissions($permissions)
    {
        if (!(is_array($permissions) || $permissions instanceof Collection)) {
            throw new Exception('Invalid permissions provided to attach.');
        }

        DB::transaction(function () use ($permissions) {
            foreach ($permissions as $permission) {
                $this->detachPermission($permission);
            }
        });
    }

    /**
     * Detach all permissions from the role.
     */
    public function detachAllPermissions()
    {
        $this->permissions()->detach();

        $this->clearCache();
    }

    /**
     * Resolve the "id" of the permission given its id/name/Model.
     *
     * @param integer|string|Model $permission
     * @return integer
     * @throws Exception
     */
    protected function getPermissionId($permission)
    {
        if (!$permission) {
            throw new Exception('No permission provided.');
        }

        if (is_string($permission) && !($permission = Permission::whereSlug($permission)->first())) {
            throw new Exception('Invalid permission slug.');
        }

        if ($permission instanceof Model) {
            $permission = $permission->getKey();
        }

        if (!is_numeric($permission)) {
            throw new Exception('Invalid permission id.');
        }

        return $permission;
    }
}
