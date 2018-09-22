<?php
require_once 'functions.php';
$DBH = dbConnection ();

if (isUAC($DBH)) {

	if (isset($_POST['logout'])) {
		echo delUserFromSession ();
	}
}

$DBH = null;
?>