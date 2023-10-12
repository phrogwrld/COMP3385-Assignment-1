<?php

namespace App\Service;

use App\Helpers\Role;
use App\Service\Session;

/**
 * A class to manage access to specific user based on their roles.
 */
final class AccessControl {
	/**
	 * Session.
	 *
	 * @var Session
	 */
	private Session $session;

	/**
	 * Constructs a AccessControl Instance.
	 *
	 * @param Session $session
	 */
	public function __construct(Session $session) {
		$this->session = $session;
	}

	/**
	 * Checks if the user has the specified role.
	 *
	 * @param Role $role The role to check.
	 * @return bool True if the user has the specified role, false otherwise.
	 */
	public function hasRole(Role $role): bool {
		return $this->getRole() === $role;
	}

	/**
	 * Gets the user's role.
	 *
	 * @return Role The user's role, or null if the user does not have a role.
	 * @throws \Exception If the user does not have a role.
	 */
	public function getRole(): Role {
		$role = $this->session->getValue('role');
		$role = Role::from($role);

		if ($role === null) {
			throw new \Exception('User does not have a role');
		}

		return $role;
	}

	/**
	 * Requires that the user has the specified role.
	 *
	 * @param Role $role The role to require.
	 * @throws \Exception If the user does not have the specified role.
	 */
	public function requireRole(Role $role): void {
		if (!$this->hasRole($role)) {
			throw new \Exception('User does not have the required role');
		}
	}

	/**
	 * Requires that the user has one of the specified roles.
	 *
	 * @param Role[] $roles The roles to require.
	 * @throws \Exception If the user does not have one of the specified roles.
	 */
	public function requireRoles(array $roles): void {
		foreach ($roles as $role) {
			if ($this->hasRole($role)) {
				return;
			}
		}

		throw new \Exception('User does not have one of the required roles');
	}
}
