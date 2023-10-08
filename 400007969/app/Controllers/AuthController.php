<?php
use App\Models\Entity\User;
use App\Models\Repository\UserRepository;
use App\Service\Validator\AuthValidator;

final class AuthController extends BaseController {

  private UserRepository $userRepository;

  public function __construct() {
    parent::__construct(new AuthValidator($this->getDatabase()));
    $this->userRepository = new UserRepository($this->getDatabase());
  }

  public function register() {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!$this->validate([
      'Username' => $username,
      'Email' => $email,
      'Password' => $password
    ])) {
      $this->redirect('/register');
      return;
    }

    $pass = password_hash($password, PASSWORD_BCRYPT);

    $user = new User(null, $username, $email, $pass);

    $this->userRepository->create($user);

    $this->redirect('/login');
  }
}