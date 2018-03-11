<?php
	require_once 'functions.php';

	if (isset($_POST['bootstrap'])) {
		$DBH = dbConnection ();
		$arr = getTable($DBH, $_POST['bootstrap']);
		$DBH = null;

		header('Content-Type: application/json');
		echo json_encode($arr);
	} else 

	if (isset($_POST['render'])) {
		echo renderBranchesBody($_POST['render']);
	}
?>