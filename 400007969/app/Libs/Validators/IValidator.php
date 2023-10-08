<?php

namespace App\Libs\Validators;

interface IValidator {
	public function isValid(array $values): bool;
	public function isEmpty(string $string): bool;
	public function isValidEmail(string $email): bool;
	public function isValidPassword(string $password): bool;
	public function isNaN(string $string): bool;
	public function getErrors(): array;
}
