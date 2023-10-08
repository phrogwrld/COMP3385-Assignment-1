<?php

namespace App\Models\Entity;

/**
 * A model for a user.
 */
final class User {
	/**
	 * The user's ID.
	 *
	 * @var int
	 */
	private int $id;

	/**
	 * The user's username.
	 *
	 * @var string
	 */
	private string $username;

	/**
	 * The user's email address.
	 *
	 * @var string
	 */
	private string $email;

	/**
	 * The user's password.
	 *
	 * @var string
	 */
	private string $password;

	/**
	 * Constructs a new user object.
	 *
	 * @param int $id The user's ID.
	 * @param string $username The user's username.
	 * @param string $email The user's email address.
	 * @param string $password The user's password.
	 */
	public function __construct(?int $id, string $username, string $email, string $password) {
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Gets the user's ID.
	 *
	 * @return int The user's ID.
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * Gets the user's username.
	 *
	 * @return string The user's username.
	 */
	public function getUsername(): string {
		return $this->username;
	}

	/**
	 * Sets the user's username.
	 *
	 * @param string $username The user's username.
	 *
	 * @return void
	 */
	public function setUsername(string $username): void {
		$this->username = $username;
	}

	/**
	 * Gets the user's email address.
	 *
	 * @return string The user's email address.
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * Sets the user's email address.
	 *
	 * @param string $email The user's email address.
	 *
	 * @return void
	 */
	public function setEmail(string $email): void {
		$this->email = $email;
	}

	/**
	 * Gets the user's password.
	 *
	 * @return string The user's password.
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * Sets the user's password.
	 *
	 * @param string $password The user's password.
	 *
	 * @return void
	 */
	public function setPassword(string $password): void {
		$this->password = $password;
	}

	/**
	 * Converts the user object to an array.
	 *
	 * @return array An array containing the user's data.
	 */
	public function toArray(): array {
		return [
			'id' => $this->id,
			'username' => $this->username,
			'email' => $this->email,
			'password' => $this->password,
		];
	}

	/**
	 * Creates a new user object from an array.
	 *
	 * @param array $data An array containing the user's data.
	 *
	 * @return User A new user object.
	 */
	public static function fromArray(array $data): User {
		return new User($data['id'], $data['username'], $data['email'], $data['password']);
	}
}
