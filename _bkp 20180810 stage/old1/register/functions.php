<?php
require_once '../functions.php';

function chkEmail ($DBH, $email) {
	$sql = "SELECT id FROM users WHERE email = '{$email}'";
	$STH = $DBH->query($sql);
	$user = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return count($user);
}

?>