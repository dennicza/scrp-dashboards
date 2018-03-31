<?php
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';

function renderHeader ($table, $subtitle = null) {
	$msg = "";
	$msg .= "<!DOCTYPE html>\r\n";
	$msg .= "<html lang=\"uk\">\r\n";
	$msg .= "<head>\r\n";

	$title = ucfirst($table);
	if (!empty($subtitle) && strlen($subtitle)) $title .= " | " . ucfirst($subtitle);
	$msg .= "	<title>" . $title . "</title>\r\n";

	$msg .= "	<meta charset=\"UTF-8\">\r\n";
	$msg .= "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\n";
	$msg .= "	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">\r\n";
	$msg .= "	<link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css\" rel=\"stylesheet\">\r\n";
	$msg .= "	<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/edit.css\">\r\n";
	$msg .= "</head>\r\n";
	$msg .= "<body data-table=\"" . $table . "\">\r\n";

	return $msg;
}

function renderFooter ($table, $has_filter = null) {
	$msg = "";

	$msg .= "	<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\r\n";

    $msg .= "	<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>\r\n";
    $msg .= "	<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>\r\n";
	
	if (!empty($has_filter) && $has_filter) {
		$msg .= "	<script src=\"../js/bootstrap.js\"></script>\r\n";
		$msg .= "	<script src=\"../js/filters.js\"></script>\r\n";
		$msg .= "	<script src=\"../js/date.js\"></script>\r\n";
		$msg .= "	<script src=\"../js/xls.js\"></script>\r\n";
	}

    $msg .= "	<script src=\"js/index.js\"></script>\r\n";
	$msg .= "</body>\r\n";
	$msg .= "</html>\r\n";

	return $msg;
}

function saveDataToDB ($DBH, $table, $arr) {
	$res = 0;
	$msg1 = "(";
	$msg2 = "(";
	$data = [];

	foreach ($arr as $field => $value) {
		$msg1 .= $field . ', ';
		$msg2 .= ':' . $field . ', ';
		$data[$field] = $value;
	}

	$msg1 = substr($msg1, 0, -2) . ")";
	$msg2 = substr($msg2, 0, -2) . ")";

	$sql = "INSERT INTO " . $table . " " . $msg1 . " VALUES " . $msg2;
	$STH = $DBH->prepare($sql);
	$STH->execute($data);
	$res = $DBH->lastInsertId();
	$STH = null;
	
	return $res;
}

function genCode ($mail, $solt = null) {
	$arr = explode ("@", $mail);
	if (empty($solt) || $solt < 1) $solt = getCurrentTime ();
	$code = md5 (md5 ($arr[0] . $time . $arr[1]));
	return $code;
}

function getCurrentTime () {
	return round (microtime(true) * 1000);
}

function chkEmail ($DBH, $email) {
	$sql = "SELECT id FROM users WHERE email = '{$email}'";
	$STH = $DBH->query($sql);
	$user = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return count($user);
}

?>