<?php
use App\Controllers\DashboardController;

require 'autoload.php';

$dashboardController = new DashboardController();
$dashboardController->render();
