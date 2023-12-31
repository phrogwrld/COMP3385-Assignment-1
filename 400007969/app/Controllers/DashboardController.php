<?php

namespace App\Controllers;

use App\Config\Config;
use App\Controllers\BaseController;
use App\Service\AccessControl;
use App\Helpers\Role;

final class DashboardController extends BaseController {
	public AccessControl $accessControl;

	public function __construct() {
		parent::__construct();

		$this->accessControl = new AccessControl($this->session);

		if (
			!$this->session->hasValue('email') ||
			!$this->session->hasValue('username') ||
			!$this->session->hasValue('role')
		) {
			header('Location: login.php');
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

		$options = [
			Role::Researcher->value => ['View All Studies' => '/viewAllStudies.php'],
			Role::ResearchStudyManager->value => [
				'View All Studies' => '/viewAllStudies.php',
				'Create New Study' => '/createStudy.php',
				'Delete Previous Study' => '/deleteStudy.php',
			],
			Role::ResearchGroupManager->value => [
				'View All Studies' => '/viewAllStudies.php',
				'Create New Study' => '/createStudy.php',
				'Delete Previous Study' => '/deleteStudy.php',
				'Create New Researchers' => '/createResearcher.php',
			],
		];

		require_once Config::getViewPath() . DIRECTORY_SEPARATOR . 'Dashboard.php';
	}

	public function getAccessControl(): AccessControl {
		return $this->accessControl;
	}
}
