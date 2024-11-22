<?php

namespace App\Base\Libraries\Access;

use Exception;

class Access {
	/**
	 * Default authentication guard.
	 *
	 * @var string
	 */
	protected $guard = null;

	/**
	 * Get the current authenticated user object.
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function user() {
		return auth($this->guard)->user();
	}

	/**
	 * Set the default authentication guard.
	 *
	 * @param string|null $guard
	 * @return $this
	 */
	public function guard($guard = null) {
		$this->guard = $guard;

		return $this;
	}

	/**
	 * Check if the authenticated user has role.
	 *
	 * @param string $role
	 * @return bool
	 * @throws Exception
	 */
	public function hasRole($role) {
		if (!is_string($role)) {
			throw new Exception('Invalid role slug.');
		}

		if ($user = $this->user()) {
			return $user->hasRole($role);
		}

		return false;
	}

	/**
	 * Check if the authenticated user has roles.
	 * Will return true when user has any one of the input roles,
	 * unless $requireAll is set to "true" then user needs to have all the roles.
	 *
	 * @param array $roles
	 * @param bool $requireAll
	 * @return bool
	 * @throws Exception
	 */
	public function hasRoles(array $roles, $requireAll = false) {
		if ($user = $this->user()) {
			return $user->hasRole($roles, $requireAll);
		}

		return false;
	}

	/**
	 * Check if the authenticated user has all the input roles.
	 *
	 * @param array $roles
	 * @return bool
	 * @throws Exception
	 */
	public function hasAllRoles(array $roles) {
		return $this->hasRoles($roles, true);
	}

	/**
	 * Check if the authenticated user has permission.
	 *
	 * @param string $permission
	 * @return bool
	 * @throws Exception
	 */
	public function hasPermission($permission) {
		if (!is_string($permission)) {
			throw new Exception('Invalid permission slug.');
		}

		if ($user = $this->user()) {
			return $user->hasPermission($permission);
		}

		return false;
	}

	/**
	 * Check if the authenticated user has permission.
	 * Alias for "hasPermission" method.
	 *
	 * @param $permission
	 * @return bool
	 * @throws Exception
	 */
	public function can($permission) {
		return $this->hasPermission($permission);
	}

	/**
	 * Check if the authenticated user has permissions.
	 * Will return true when user has any one of the input permissions,
	 * unless $requireAll is set to "true" then user needs to have all the permissions.
	 *
	 * @param array $permissions
	 * @param bool $requireAll
	 * @return bool
	 * @throws Exception
	 */
	public function hasPermissions(array $permissions, $requireAll = false) {
		if ($user = $this->user()) {
			return $user->hasPermission($permissions, $requireAll);
		}

		return false;
	}

	/**
	 * Check if the authenticated user has all the input permissions.
	 *
	 * @param array $permissions
	 * @return bool
	 * @throws Exception
	 */
	public function hasAllPermissions(array $permissions) {
		return $this->hasPermissions($permissions, true);
	}
}
