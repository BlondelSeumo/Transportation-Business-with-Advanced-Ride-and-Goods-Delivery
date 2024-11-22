<?php

namespace App\Models\Traits;

use DB;
use Cache;
use Exception;
use App\Models\Access\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

trait UserAccessTrait
{
    /**
     * Override the "boot" method of the model.
     * The trait's "boot" method is called in the Model's "boot" method automatically.
     *
     * @return void
     */
    public static function bootUserAccessTrait()
    {
        /*
         * Detach all the roles associated with the user when it's being deleted.
         */
        static::deleting(function ($user) {
            if (!method_exists($user, 'bootSoftDeletes')) {
                $user->roles()->detach();

                flush_model_cache($user);
            }
        });

        /*
         * Clear the roles cache when a model is saved.
         */
        static::saved(function ($user) {
            flush_model_cache($user);
        });
    }

    /**
     * Get the roles associated with the user from the cache.
     * Cache the result only if the Cache Store supports tagging.
     * If the cache is not available/expired then cache the result and return the value.
     *
     * @return Collection
     */
    public function cachedRoles()
    {
        if (is_cache_taggable()) {
            return Cache::tags(model_cache_tag($this, config('access.cache.tag')))
                ->remember(model_cache_key($this), config('access.cache.ttl.roles'), function () {
                    return $this->roles()->get();
                });
        }

        return $this->roles()->get();
    }

    /**
     * Clear the all roles cache.
     */
    public function clearCache()
    {
        flush_model_cache($this);
    }

    /**
     * Check if the user has role.
     * When multiple roles are provided it will check if any one is present.
     * When $requireAll is set to "true" then all the roles should be present.
     *
     * @param string|array $slug
     * @param bool $requireAll
     * @return bool
     */
    public function hasRole($slug, $requireAll = false)
    {
        if (is_array($slug)) {
            foreach ($slug as $roleSlug) {
                $hasRole = $this->hasRole($roleSlug);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found
            // Return the value of $requireAll
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($slug == $role->slug) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if the user has permission.
     * When multiple permissions are provided it will check if any one is present.
     * When $requireAll is set to "true" then all the permissions should be present.
     *
     * Will return true without any check if the "all" field is set to true for any of the role.
     *
     * @param string|array $slug
     * @param bool $requireAll
     * @return bool
     */
    public function hasPermission($slug, $requireAll = false)
    {
        static $isAdmin = false;

        if (is_array($slug)) {
            foreach ($slug as $permSlug) {
                $hasPerm = $this->hasPermission($permSlug);

                if ($isAdmin) {
                    return true;
                } elseif ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found
            // Return the value of $requireAll
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($role->all) {
                    return $isAdmin = true;
                }

                foreach ($role->cachedPermissions() as $permission) {
                    if (str_is($slug, $permission->slug)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check if the user has permission.
     * Alias for "hasPermission" method.
     *
     * @param string $permission
     * @param bool $requireAll
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        return $this->hasPermission($permission, $requireAll);
    }

    /**
     * Sync the provided roles to the user.
     *
     * @param array|Collection|BaseCollection $roles
     * @throws Exception
     */
    public function syncRoles($roles)
    {
        if (!(is_array($roles) || $roles instanceof Collection || $roles instanceof BaseCollection)) {
            throw new Exception('Invalid roles provided to sync.');
        }

        $this->roles()->sync($roles);

        $this->clearCache();
    }

    /**
     * Sync the provided roles to the user using their slugs.
     * Input can be a string value or an array of strings.
     *
     * @param string|array $roleSlugs
     * @throws Exception
     */
    public function syncRolesUsingSlug($roleSlugs)
    {
        $roleSlugs = array_wrap($roleSlugs);

        $roles = Role::whereIn('slug', $roleSlugs)->pluck('id');

        if ($roles->count() !== count($roleSlugs)) {
            throw new Exception('Invalid role slug.');
        }

        $this->syncRoles($roles);
    }

    /**
     * Attach a role from the user.
     *
     * @param integer|string|Model $role
     * @throws Exception
     */
    public function attachRole($role)
    {   
      
        $roleId = $this->getRoleId($role);

        $this->roles()->syncWithoutDetaching($roleId);

        $this->clearCache();
    }

    /**
     * Attach roles to the user.
     *
     * @param array|Collection $roles
     * @throws Exception
     */
    public function attachRoles($roles)
    {
        if (!(is_array($roles) || $roles instanceof Collection)) {
            throw new Exception('Invalid roles provided to attach.');
        }

        DB::transaction(function () use ($roles) {
            foreach ($roles as $role) {
                $this->attachRole($role);
            }
        });
    }

    /**
     * Detach a role from the user.
     *
     * @param integer|string|Model $role
     * @throws Exception
     */
    public function detachRole($role)
    {
        $roleId = $this->getRoleId($role);

        $this->roles()->detach($roleId);

        $this->clearCache();
    }

    /**
     * Detach roles from the user.
     *
     * @param array|Collection $roles
     * @throws Exception
     */
    public function detachRoles($roles)
    {
        if (!(is_array($roles) || $roles instanceof Collection)) {
            throw new Exception('Invalid roles provided to detach.');
        }

        DB::transaction(function () use ($roles) {
            foreach ($roles as $role) {
                $this->detachRole($role);
            }
        });
    }

    /**
     * Detach all roles from the user.
     */
    public function detachAllRoles()
    {
        $this->roles()->detach();

        $this->clearCache();
    }

    /**
     * Resolve the "id" of the role given its id/name/Model.
     *
     * @param integer|string|Model $role
     * @return integer
     * @throws Exception
     */
    protected function getRoleId($role)
    {
        if (!$role) {
            throw new Exception('No role provided.');
        }

        if (is_string($role) && !($role = Role::whereSlug($role)->first())) {
            throw new Exception('Invalid role slug.');
        }

        if ($role instanceof Model) {
            $role = $role->getKey();
        }

        if (!is_numeric($role)) {
            throw new Exception('Invalid role id.');
        }

        return $role;
    }
}