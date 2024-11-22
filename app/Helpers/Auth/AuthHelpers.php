<?php

namespace App\Helpers\Auth;

use App\Base\Constants\Auth\Role;

trait AuthHelpers {
	/**
	 * Get the roles that are allowed to login with OTP.
	 *
	 * @return array
	 */
	protected function otpLoginRoles() {
		return [
			Role::USER,
			Role::DRIVER,
			Role::OWNER,
		];
	}

	/**
	 * Get all the roles which uses username instead of email.
	 *
	 * @return array
	 */
	protected function rolesUsingUsername() {
		return Role::adminRoles();
	}

	/**
	 * Check if the given role(s) can login with username.
	 *
	 * @param string|array $role
	 * @return bool
	 */
	protected function roleAllowedUsernameLogin($role) {
		return $this->roleAllowed($role, $this->rolesUsingUsername());
	}

	/**
	 * Check if the given role(s) can login with OTP.
	 *
	 * @param string|array $role
	 * @return bool
	 */
	protected function roleAllowedOTPLogin($role) {
		return $this->roleAllowed($role, $this->otpLoginRoles());
	}

	/**
	 * Check if the given role(s) are in the allowed list.
	 *
	 * @param string|array $role
	 * @param array $allowedList
	 * @return bool
	 */
	protected function roleAllowed($role, array $allowedList) {
		$role = is_string($role) ? [$role] : $role;

		return array_has_all($role, $allowedList);
	}
}
