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
		echo renderBindingsBody($_POST['render']);
	} else 

	if (isset($_POST['comp2goods'])) {
		$DBH = dbConnection ();
		$rend_goods = renderDDL(getGCompet($DBH, $_POST['comp2goods']), 0, 'g_comp_id', 'Назва товару конкурента', 'Треба обрати назву товару конкурента зі списку');
		$DBH = null;

		echo $rend_goods;
	} else 

	if (isset($_POST['save2db'])) {
		unset($_POST['save2db']);
		$DBH = dbConnection ();
		$id = saveBinding($DBH, $_POST);
		$DBH = null;

		echo $id;
	} else 

	if (isset($_POST['upd2db'])) {
		$bid = $_POST['upd2db'];
		unset($_POST['upd2db']);
		$DBH = dbConnection ();
		$num = updBinding ($DBH, $bid, $_POST);
		$DBH = null;

		echo $num;
	}

?>