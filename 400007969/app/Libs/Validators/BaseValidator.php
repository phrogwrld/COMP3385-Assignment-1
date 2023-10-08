<?php

namespace App\Libs\Validators;

use App\Libs\Validators\IValidator;

abstract class BaseValidator implements IValidator
{

  protected array $errors = [];

  protected function isEmpty(): bool
  {
    return empty($string);
  }

  protected function isValidEmail(string $email): bool
  {
    if ($this->isEmpty()) {
      $this->errors['email_empty'] = 'Email cannot be empty.';
      return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->errors['email_invalid'] = 'Email is invalid.';
      return false;
    }

    return true;
  }

  protected function isValidPassword(string $password): bool
  {
    if ($this->isEmpty()) {
      $this->errors['password_empty'] = 'Password cannot be empty.';
      return false;
    }

    if (strlen($password) < 10) {
      $this->errors['password_length'] = 'Password must be at least 10 characters long.';
      return false;
    }

    if (!ctype_upper($password) && !ctype_digit($password)) {
      $this->errors['password_uppercase_or_digit'] = 'Password must contain at least one uppercase letter or digit.';
      return false;
    }

    return true;

    // return !$this->isEmpty() && strlen($password) >= 10 && (ctype_upper($password) && ctype_digit($password));
  }

  protected function isNaN(string $string): bool
  {
    return !is_numeric($string);
  }

  protected function getErrors(): array
  {
    return $this->errors;
  }

}