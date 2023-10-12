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
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (
			!$this->validate([
				'Email' => $email,
				'Password' => $password,
			])
		) {
			$this->redirect('/login');
			return;
		}

		$user = $this->userRepository->findByEmail($email);

		if (!password_verify($password, $user->getPassword())) {
			$this->redirect('/login');
			return;
		}

		$this->session->setValue('email', $email);
		$this->session->setValue('username', $user->getUsername());
		// $this->session->setValue('role', $user->getRole());

		$this->redirect('/dashboard');
	}

	public function logout() {
		$this->session->destroySession();
		$this->redirect('/login');
	}
}
