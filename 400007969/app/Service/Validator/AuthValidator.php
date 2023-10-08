<?php
namespace App\Service\Validator;
use App\Libs\Validators\BaseValidator;
use App\Service\Database;

final class AuthValidator extends BaseValidator {

  private Database $database;

  public function __construct(Database $database) {
    $this->database = $database;
  }

  protected function isValid(array $values): bool
  {
    return $this->isValidEmail($values['Email']) 
        && $this->isValidPassword($values['Password']) 
        && $this->isUniqueUsername($values['Username']);
  }

  private function isUniqueUsername($username): bool
  {
    $sql = "SELECT * FROM users WHERE username = ?";
    $query = $this->database->getConnection()->prepare($sql);
    $query->execute([$username]);

    $this->errors['Username'] = 'This username is already taken.';

    return $query->rowCount() === 0;
  }
  
}