<?php
use App\Controllers\DashboardController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

require './app/autoload.php';

// $dashboardController = new DashboardController();
// $dashboardController->render();

$requestUri = $_SERVER['REQUEST_URI'];
$uriParts = explode('/', trim($requestUri, '/'));

$route = isset($uriParts[1]) ? $uriParts[1] : '';

switch ($route) {
	case 'dashboard':
		$dashboardController = new DashboardController();
		$dashboardController->render();
		break;
	case 'login':
		$loginController = new LoginController();
		$loginController->render();
		break;
	case 'register':
		$registerController = new RegisterController();
		$registerController->render();
		break;
	default:
		echo '404';
}
