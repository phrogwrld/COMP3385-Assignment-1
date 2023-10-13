<?php

namespace App\Controllers;

use App\Config\Config;
use App\Controllers\BaseController;
use App\Models\Entity\User;
use App\Models\Repository\UserRepository;
use App\Service\AccessControl;
use App\Helpers\Role;
use App\Service\Validator\CreateResearcherValidator;

final class CreateResearcherController extends BaseController {
	public AccessControl $accessControl;

	private UserRepository $userRepository;

	public function __construct() {
		parent::__construct();
		$this->setValidator(new CreateResearcherValidator($this->getDatabase()));
		$this->userRepository = new UserRepository($this->getDatabase());

		$this->accessControl = new AccessControl($this->session);

		if (
			!$this->session->hasValue('email') ||
			!$this->session->hasValue('username') ||
			!$this->session->hasValue('role')
		) {
			header('Location: login.php');
			exit();
		}

		$role = $this->accessControl->getRole();

		if ($role !== Role::ResearchGroupManager) {
			header('Location: index.php');
			exit();
		}
	}

	public function render() {
		if (
			!$this->session->hasValue('email') ||
			!$this->session->hasValue('username') ||
			!$this->session->hasValue('role')
		) {
			header('Location: login.php');
			exit();
		}

		$role = $this->accessControl->getRole();
		$email = $this->session->getValue('email');
		$username = $this->session->getValue('username');

		// options array that passes all the roles in the enun
		$options = [
			Role::Researcher->value,
			Role::ResearchStudyManager->value,
			// Role::ResearchGroupManager->value,
		];

		require_once Config::getViewPath() . DIRECTORY_SEPARATOR . 'CreateResearcher.php';
	}

	public function createResearcher() {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->render();
			return;
		}

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = Role::fromString($_POST['role']);

		if (
			!$this->validate([
				'Username' => $username,
				'Email' => $email,
				'Password' => $password,
			])
		) {
			$this->redirect('createResearcher.php', ['errors' => $this->validator->getErrors()]);
			return;
		}

		$pass = password_hash($password, PASSWORD_DEFAULT);

		$user = new User(null, $username, $email, $pass, $role);

		$this->userRepository->create($user);

		$this->redirect('createResearcher.php', ['success' => 'Researcher created successfully!']);
	}

	public function getAccessControl(): AccessControl {
		return $this->accessControl;
	}
}
