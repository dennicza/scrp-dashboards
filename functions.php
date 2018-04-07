<?php
session_start ();
date_default_timezone_set ('Europe/Kiev');
require_once 'db_connection.php';


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
	$msg .= "	<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/main.css\">\r\n";
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

function renderFooterSpec ($table, $spec) {
	$msg = "";

	$msg .= "	<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\r\n";

    $msg .= "	<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>\r\n";
    $msg .= "	<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>\r\n";

	$msg .= "	<script src=\"js/{$spec}.js\"></script>\r\n";
	$msg .= "</body>\r\n";
	$msg .= "</html>\r\n";

	return $msg;
}


function renderDDL($arr, $selected, $id, $name, $error) {
	$msg = "<label for=\"{$id}\">{$name}</label>\r\n";
	$msg .= "<select class=\"custom-select d-block w-100\" id=\"{$id}\" required=\"\">\r\n";
	if ($selected > 0) {
		foreach ($arr as $row) {
			if ($selected == $row[0]) {
				$msg .= "<option value=\"{$row[0]}\" selected=\"\">{$row[1]}</option>\r\n";
			} else {
				$msg .= "<option value=\"{$row[0]}\">{$row[1]}</option>\r\n";
			}
		}
	} else {
		foreach ($arr as $row) {
			$msg .= "<option value=\"{$row[0]}\">{$row[1]}</option>\r\n";
		}
	}
	
	$msg .= "</select>\r\n";
	$msg .= "<div class=\"invalid-feedback\">{$error}</div>\r\n";
	
	return $msg;
}

function renderInput ($id, $name, $value, $error) {
	$msg = "<label for=\"{$id}\">{$name}</label>\r\n";
	$msg .= "<input type=\"text\" class=\"form-control\" id=\"{$id}\" value=\"{$value}\" placeholder=\"\" required=\"\">\r\n";
	$msg .= "<div class=\"invalid-feedback\">{$error}</div>\r\n";

	return $msg;
}

function renderChbx ($id, $status, $label) {
	$checked = '';
	if ($status) $checked = 'checked=""';

	$msg = "<div class=\"custom-control custom-checkbox\">\r\n";
	$msg .= "	<input type=\"checkbox\" class=\"custom-control-input\" id=\"{$id}\" {$checked}>\r\n";
	$msg .= "	<label class=\"custom-control-label\" for=\"{$id}\">{$label}</label>\r\n";
	$msg .= "</div>\r\n";

	return $msg;
}


function getCompetitors($DBH) {
	$sql = "SELECT id, name FROM competitors WHERE is_active = 1";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_NUM);
	$STH = null;

	return $rows;
}

function getDepartments($DBH) {
	$sql = "SELECT id, name FROM departments WHERE is_deleted = 0";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_NUM);
	$STH = null;

	return $rows;
}

function getBranches($DBH) {
	$sql = "SELECT id, name FROM branches WHERE is_deleted = 0";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_NUM);
	$STH = null;

	return $rows;
}

function getGCompet($DBH, $comp_id) {
	if (!$comp_id) {
		$sql = "SELECT id FROM competitors WHERE is_active = 1";
		$STH = $DBH->query($sql);
		$res = $STH->fetchAll(PDO::FETCH_ASSOC);
		$comp_id = $res[0]['id'];
	}
	$sql = "SELECT id, name FROM all_goods WHERE comp_id = '{$comp_id}'";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_NUM);
	$STH = null;

	return $rows;
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
	$affected = $STH->rowCount();
	$STH = null;

	return $affected;
}

function genCode ($email, $salt = null) {
	$arr = explode ("@", $email);
	if (empty($salt)) $salt = getCurrentTime ();
	$code = md5 (md5 ($arr[0] . $salt . $arr[1]));
	return $code;
}

function getCurrentTime () {
	return round (microtime(true) * 1000);
}

function pass4db ($email, $pass) {
	return genCode ($email, $pass);
}


function delUserFromSession () {
	unset ($_SESSION ['cred']);
	return 1;
}


function delItemInTable ($DBH, $table, $item) {
	$sql = "UPDATE {$table} SET is_deleted = 1 WHERE id = '{$item}'";
	$STH = $DBH->prepare($sql);
	$STH->execute();
	$affected = $STH->rowCount();
	$STH = null;

	return $affected;
}

?>