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
	} else 

	if (isset($_POST['save2db'])) {
		unset($_POST['save2db']);
		$id = saveDataToDB ($DBH, 'departments', $_POST);

		echo $id;
	} else 

	if (isset($_POST['upd2db'])) {
		$id = $_POST['upd2db'];
		unset($_POST['upd2db']);
		$num = updDepartment ($DBH, $id, $_POST);

		echo $num;
	} else 

	if (isset($_POST['delete']) && $_POST['delete'] > 0) {
		echo delItemInTable ($DBH, $_POST['table'], $_POST['delete']);
	}
}

$DBH = null;
?>