<?php
require_once '../functions.php';

function chkUser ($DBH, $email, $pass) {
	$password = pass4db ($email, $pass);
	$sql = "SELECT id FROM users WHERE email = '{$email}' AND pass = '{$password}'";
	$STH = $DBH->query($sql);
	$user = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	$err = count($user) - 1;

	if (!$err) return $user[0]['id'];
	if ($err > 0) return -1;
	return 0;
}

function putUserToSession ($DBH, $id, $email) {
	if ($id > 0) {
		$cred = genCode ($email);
		$sql = "UPDATE users SET sess = '{$cred}' WHERE id = '{$id}'";
		$STH = $DBH->prepare($sql);
		$STH->execute();
		$affected = $STH->rowCount();
		$STH = null;

		$_SESSION ['cred'] = $cred;
		return $affected;
	}
}

?>