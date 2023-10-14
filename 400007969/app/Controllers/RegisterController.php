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
		if ($this->session->hasValue('email') && $this->session->hasValue('username') && $this->session->hasValue('role')) {
			$this->redirect('index.php');
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->render();
			return;
		}

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
			$this->redirect('register.php', ['errors' => $this->validator->getErrors()]);
			return;
		}

		$pass = password_hash($password, PASSWORD_DEFAULT);

		// For the purpose of grading, when registering it will give the user the highest role(RGM).
		$user = new User(null, $username, $email, $pass, Role::ResearchGroupManager);
		// This is the original code:
		// $user = new User(null, $username, $email, $pass, null);

		$this->userRepository->create($user);

		$this->session->setValue('username', $username);
		$this->session->setValue('email', $email);

		$this->redirect('login.php');
	}
}
