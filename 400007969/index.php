<?php
use App\Controllers\DashboardController;

require './app/autoload.php';

$dashboardController = new DashboardController();
$dashboardController->render();
