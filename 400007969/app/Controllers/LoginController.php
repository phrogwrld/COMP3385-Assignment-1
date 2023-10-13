<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Repository\UserRepository;
use App\Service\Validator\LoginValidator;

final class LoginController extends BaseController {
	private UserRepository $userRepository;

	public function __construct() {
		parent::__construct();
		$this->setValidator(new LoginValidator($this->getDatabase()));
		$this->userRepository = new UserRepository($this->getDatabase());
	}

	public function login() {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->render();
			return;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];

		if (
			!$this->validate([
				'Email' => $email,
				'Password' => $password,
			])
		) {
			$this->redirect('login.php', ['errors' => $this->validator->getErrors()]);
			return;
		}

		$user = $this->userRepository->findByEmail($email);

		$this->session->setValue('email', $email);
		$this->session->setValue('username', $user->getUsername());
		// After successful login, users should be redirected to their respective dashboards based on their roles. Done here:
		$this->session->setValue('role', $user->getRole()->value);

		$this->redirect('index.php');
	}

	public function logout() {
		$this->session->destroySession();
		$this->redirect('index.php');
		exit();
	}
}
