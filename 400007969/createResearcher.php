<?php
use App\Controllers\CreateResearcherController;

require './app/autoload.php';

$createResearcherController = new CreateResearcherController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$createResearcherController->createResearcher();
	exit();
}
$createResearcherController->render();
?>
