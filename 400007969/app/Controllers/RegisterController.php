<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Entity\User;
use App\Models\Repository\UserRepository;
use App\Service\Validator\RegisterValidator;
use App\Service\Database;

final class RegisterController extends BaseController {
	private UserRepository $userRepository;

	private Database $database;

	public function __construct() {
		parent::__construct();
		$this->setValidator(new RegisterValidator($this->getDatabase()));
		$this->userRepository = new UserRepository($this->getDatabase());
	}

	public function register() {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (
			!$this->validate([
				'Username' => $username,
				'Email' => $email,
				'Password' => $password,
			])
		) {
			$this->redirect('/register');
			return;
		}

		$pass = password_hash($password, PASSWORD_BCRYPT);

		$user = new User(null, $username, $email, $pass);

		$this->userRepository->create($user);

		$this->session->setValue('username', $username);
		$this->session->setValue('email', $email);

		$this->redirect('/login');
	}
}
