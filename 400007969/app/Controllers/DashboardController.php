<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Service\AccessControl;

final class DashboardController extends BaseController {
	public AccessControl $accessControl;

	public function __construct() {
		parent::__construct();

		// $this->accessControl = new AccessControl($this->session);

		// if (!$this->session->hasValue('email') || !$this->session->hasValue('username')) {
		// 	header('Location: Views/Login.php');
		// 	exit();
		// }
	}
}
