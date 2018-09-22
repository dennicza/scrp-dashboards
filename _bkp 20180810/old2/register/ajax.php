<?php
	require_once 'functions.php';

	if (isset($_POST['saveuser'])) {
		unset($_POST['saveuser']);
		$DBH = dbConnection ();
		$flag = chkEmail ($DBH, $_POST['email']);
		if (!$flag) {
			$_POST['verif_link'] = genCode ($_POST['email']);
			$_POST['pass'] = pass4db ($_POST['email'], $_POST['pass']);
			$id = saveDataToDB ($DBH, 'users', $_POST);
			$DBH = null;

			echo $id;
		} else {
			echo '-100';
		}
	}

?>