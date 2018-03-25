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
		echo renderMonitoringsBody($_POST['render']);
	} else 

	if (isset($_POST['save2db'])) {
		unset($_POST['save2db']);
		$DBH = dbConnection ();
		$id = saveMonitoring($DBH, $_POST);
		$DBH = null;

		echo $id;
	} else 

	if (isset($_POST['upd2db'])) {
		$mid = $_POST['upd2db'];
		unset($_POST['upd2db']);
		$DBH = dbConnection ();
		$num = updMonitoring ($DBH, $mid, $_POST);
		$DBH = null;

		echo $num;
	}

?>