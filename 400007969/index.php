<?php
use App\Controllers\DashboardController;
// use App\Controllers\LoginController;
// use App\Controllers\RegisterController;

require './app/autoload.php';

$dashboardController = new DashboardController();
$dashboardController->render();

// function debug_to_console($data) {
// 	$output = $data;
// 	if (is_array($output))
// 			$output = implode(',', $output);

// 	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }

// $requestUri = $_SERVER['REQUEST_URI'];
// $uriParts = explode('/', trim($requestUri, '/'));

// $route = isset($uriParts[1]) ? $uriParts[1] : '';

// switch ($route) {
// 	case 'dashboard':
// 		$dashboardController = new DashboardController();
// 		$dashboardController->render();
// 		break;
// 	case 'login':
// 		$loginController = new LoginController();
// 		$loginController->render();
// 		break;
// 	case 'register':
// 		$registerController = new RegisterController();
// 		$registerController->render();
// 		break;
// 	case 'registers':
// 		echo $_SERVER['REQUEST_METHOD'];
// 		$registerController = new RegisterController();
// 		$registerController->register();
// 		break;
// 	case 'logout':
// 		$loginController = new LoginController();
// 		$loginController->logout();
// 		break;
// 	default:
// 		echo '404';
// }
