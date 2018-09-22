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
		echo renderBranchesBody($_POST['render']);
	}
}

$DBH = null;
?>