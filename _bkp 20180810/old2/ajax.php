<?php
	require_once 'functions.php';

	if (isset($_POST['logout'])) {
		echo delUserFromSession ();
	}

?>