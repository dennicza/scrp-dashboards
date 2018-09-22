<?php
	require_once 'functions.php';

	if (isset($_POST['login'])) {
		unset($_POST['login']);
		$DBH = dbConnection ();
		$id = chkUser ($DBH, $_POST['email'], $_POST['pass']);
		$affected = putUserToSession ($DBH, $id, $_POST['email']);
		$DBH = null;
		if ($affected == 1) {
			echo $id;
		} else {
			echo -10;
		}
	}
?>