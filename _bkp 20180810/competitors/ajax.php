<?php
require_once 'functions.php';
$DBH = dbConnection ();

if (isUAC($DBH)) {

	if (isset($_POST['bootstrap'])) {
		$arr = getTable($DBH, $_POST['bootstrap']);
		header('Content-Type: application/json');
		
		echo json_encode($arr);
	} else 

	if (isset($_POST['render'])) {
		echo renderBody($_POST['render'], 1);
	}
}

$DBH = null;
?>