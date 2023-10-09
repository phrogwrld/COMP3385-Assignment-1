<?php

namespace App\Service;

/**
 * A service for managing session state.
 */
final class Session {
	/**
	 * Whether or not the session has been started.
	 *
	 * @private
	 */
	private static $started = false;

	/**
	 * Starts the session if it is not already started.
	 */
	public function __construct() {
		if (!self::$started) {
			session_start();
			self::$started = true;
		}
	}

	/**
	 * Gets the value of a session variable.
	 *
	 * @param string $key The name of the session variable.
	 * @return mixed The value of the session variable, or null if the variable does not exist.
	 */
	public function getValue($key) {
		return $_SESSION[$key];
	}

	/**
	 * Sets the value of a session variable.
	 *
	 * @param string $key The name of the session variable.
	 * @param mixed $value The value to set for the session variable.
	 */
	public function setValue($key, $value) {
		$_SESSION[$key] = $value;
	}

	/**
	 * Destroys the session.
	 */
	public function destroySession() {
		session_destroy();
	}
}
