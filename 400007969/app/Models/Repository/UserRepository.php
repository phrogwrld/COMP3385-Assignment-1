<?php

namespace App\Models\Repository;

use App\Models\Entity\User;
use App\Service\Database;
use IRepository;
use PDO;

final class UserRepository implements IRepository {
	private Database $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	/**
	 * Creates a new user in the database.
	 *
	 * @param User $user The user to create.
	 *
	 * @return bool True if the user was created successfully, false otherwise.
	 */
	public function create(User $user): bool {
		$sql = 'INSERT INTO users(username, password, email) VALUES (?, ?, ?) ';
		$stmt = $this->database->getConnection()->prepare($sql);

		$username = $user->getUsername();
		$email = $user->getEmail();
		$password = $user->getPassword();

		$stmt->execute([$username, $password, $email]);

		return $stmt->rowCount() > 0;
	}

	/**
	 * Finds a user by their ID.
	 *
	 * @param int $id The ID of the user to find.
	 *
	 * @return User|null The user, or null if the user was not found.
	 */
	public function find(int $id): ?User {
		$sql = 'SELECT * FROM users WHERE id = ?';
		$stmt = $this->database->getConnection()->prepare($sql);

		$stmt->execute([$id]);

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$user) {
			return null;
		}

		return new User($user['id'] ,$user['username'],  $user['email'], $user['password']);
	}

	/**
	 * Finds a user by their email.
	 *
	 * @param string $email The email of the user to find.
	 *
	 * @return User|null The user, or null if the user was not found.
	 */
	public function findByEmail(string $email): ?User {
		$sql = 'SELECT * FROM users WHERE email = ?';
		$stmt = $this->database->getConnection()->prepare($sql);

		$stmt->execute([$email]);

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$user) {
			return null;
		}

		return new User($user['id'] ,$user['username'],  $user['email'], $user['password']);
	}

	/**
	 * Finds all users.
	 *
	 * @return User[] An array of users.
	 */
	public function findAll(): array {
		$sql = 'SELECT * FROM users';
		$stmt = $this->database->getConnection()->prepare($sql);

		$stmt->execute();

		$users = [];

		foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
			$users[] = new User($user['id'] ,$user['username'],  $user['email'], $user['password']);
		}

		return $users;
	}

	/**
	 * Updates a user.
	 *
	 * @param User $user The user to update.
	 *
	 * @return bool True if the user was updated successfully, false otherwise.
	 */
	public function update(User $user): bool {
		$sql = 'UPDATE users SET username = ?, password = ?, email = ? WHERE id = ?';
		$stmt = $this->database->getConnection()->prepare($sql);

		$username = $user->getUsername();
		$email = $user->getEmail();
		$password = $user->getPassword();
		$id = $user->getId();

		$stmt->execute([$username, $password, $email, $id]);

		return $stmt->rowCount() > 0;
	}

	/**
	 * Deletes a user.
	 *
	 * @param User $user The user to delete.
	 *
	 * @return bool True if the user was deleted successfully, false otherwise.
	 */
	public function delete(User $user): bool {
		$sql = 'DELETE FROM users WHERE id = ?';
		$stmt = $this->database->getConnection()->prepare($sql);

		$id = $user->getId();

		$stmt->execute([$id]);

		return $stmt->rowCount() > 0;
	}
}
