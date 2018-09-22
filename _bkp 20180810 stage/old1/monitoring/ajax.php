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
		echo renderMonitoringsBody($_POST['render']);
	} else 

	if (isset($_POST['save2db'])) {
		unset($_POST['save2db']);
		$id = saveMonitoring($DBH, $_POST);

		echo $id;
	} else 

	if (isset($_POST['upd2db'])) {
		$mid = $_POST['upd2db'];
		unset($_POST['upd2db']);
		$num = updMonitoring ($DBH, $mid, $_POST);

		echo $num;
	}
}

$DBH = null;
?>