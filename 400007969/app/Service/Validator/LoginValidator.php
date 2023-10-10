<?php
namespace App\Service\Validator;
use App\Libs\Validators\BaseValidator;
use App\Service\Database;

final class LoginValidator extends BaseValidator {
	private Database $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	protected function isValid(array $values): bool {
		return $this->isValidEmail($values['Email']) &&
			$this->isPasswordExists($values['Password']);
	}

	private function isPasswordExists($password): bool {
		$sql = 'SELECT * FROM users WHERE password = ?';
		$query = $this->database->getConnection()->prepare($sql);
		$query->execute([$password]);

		return $query->rowCount() === 0;
	}
}
