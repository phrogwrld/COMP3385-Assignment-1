<?php
namespace App\Service\Validator;
use App\Libs\Validators\BaseValidator;
use App\Service\Database;

final class RegisterValidator extends BaseValidator {
	private Database $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	public function isValid(array $values): bool {
		return $this->isValidEmail($values['Email']) &&
			$this->isValidPassword($values['Password']) &&
			$this->isUniqueUsername($values['Username']);
	}

	private function isUniqueUsername($username): bool {
		if ($this->isEmpty($username)) {
			$this->errors['Username'] = 'Username cannot be empty.';
			return false;
		}
		$sql = 'SELECT * FROM users WHERE username = ?';
		$query = $this->database->getConnection()->prepare($sql);
		$query->execute([$username]);

		$this->errors['Username'] = 'This username is already taken.';

		return $query->rowCount() === 0;
	}
}
