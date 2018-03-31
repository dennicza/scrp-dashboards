<?php
date_default_timezone_set ('Europe/Kiev');
require_once 'db_connectio.php';

function getEmails () {
	$DBH = dbConnection ();
	$sql = "SELECT * FROM emails";
	$STH = $DBH->query($sql);
	$user = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;
	$DBH = null;
	
	return $user;
}

function saveEmails ($email) {
	$DBH = dbConnection ();
	$dt = date("Y-m-d H:i:s");
	$sql = "INSERT INTO emails (email, dt) VALUES (:email, :dt)";
	$STH = $DBH->prepare($sql);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':dt', $dt);
	$STH->execute();
	$res = $DBH->lastInsertId();
	$STH = null;
	$DBH = null;
	
	return $res;
}




?>