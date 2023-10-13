<?php
use App\Controllers\RegisterController;
require './app/autoload.php';

$controller = new RegisterController();
$controller->register();
?>
