<?php
use App\Controllers\LoginController;

require './app/autoload.php';

$loginController = new LoginController();
$loginController->logout();
