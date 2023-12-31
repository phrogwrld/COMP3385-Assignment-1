<?php

namespace App\Libs\Validators;

use App\Libs\Validators\IValidator;

abstract class BaseValidator implements IValidator {
	protected array $errors = [];

	public function isEmpty(string $string): bool {
		return empty($string);
	}

	public function isValidEmail(string $email): bool {
		if ($this->isEmpty($email)) {
			$this->errors['email_empty'] = 'Email cannot be empty.';
			return false;
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->errors['email_invalid'] = 'Email is invalid.';
			return false;
		}

		return true;
	}

	public function isValidPassword(string $password): bool {
		if ($this->isEmpty($password)) {
			$this->errors['password_empty'] = 'Password cannot be empty.';
			return false;
		}

		if (strlen($password) < 10) {
			$this->errors['password_length'] = 'Password must be at least 10 characters long.';
			return false;
		}

		if (!preg_match('/[A-Z]/', $password) && !preg_match('/\d/', $password)) {
			$this->errors['password_uppercase_or_digit'] = 'Password must contain at least one uppercase letter or digit.';
			return false;
		}

		return true;

		// return !$this->isEmpty() && strlen($password) >= 10 && (ctype_upper($password) && ctype_digit($password));
	}

	public function isNaN(string $string): bool {
		return !is_numeric($string);
	}

	public function getErrors(): array {
		return $this->errors;
	}
}
