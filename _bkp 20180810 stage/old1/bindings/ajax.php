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
		echo renderBindingsBody($_POST['render']);
	} else 

	if (isset($_POST['comp2goods'])) {
		$rend_goods = renderDDL(getGCompet($DBH, $_POST['comp2goods']), 0, 'g_comp_id', 'Назва товару конкурента', 'Треба обрати назву товару конкурента зі списку');
		
		echo $rend_goods;
	} else 

	if (isset($_POST['save2db'])) {
		unset($_POST['save2db']);
		$id = saveBinding($DBH, $_POST);

		echo $id;
	} else 

	if (isset($_POST['upd2db'])) {
		$bid = $_POST['upd2db'];
		unset($_POST['upd2db']);
		$num = updBinding ($DBH, $bid, $_POST);

		echo $num;
	} else 

	if (isset($_POST['delete']) && $_POST['delete'] > 0) {
		echo delItemInTable ($DBH, $_POST['table'], $_POST['delete']);
	}
}

$DBH = null;

?>