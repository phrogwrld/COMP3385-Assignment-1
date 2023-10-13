<?php
namespace App\Service\Validator;
use App\Libs\Validators\BaseValidator;
use App\Service\Database;

final class LoginValidator extends BaseValidator {
	private Database $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	public function isValid(array $values): bool {
		return $this->isValidEmail($values['Email']) && $this->isPasswordExists($values['Email'], $values['Password']);
	}

	private function isPasswordExists($email, $password): bool {
		if ($this->isEmpty($password)) {
			$this->errors['Password'] = 'Password cannot be empty.';
			return false;
		}
		$sql = 'SELECT password FROM users WHERE email = ?';
		$query = $this->database->getConnection()->prepare($sql);
		$query->execute([$email]);

		$hash = $query->fetchColumn();

		if (password_verify($password, $hash)) {
			return true;
		} else {
			$this->errors['Password'] = 'Password is incorrect.';
			return false;
		}
	}
}
