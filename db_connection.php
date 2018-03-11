<?php

function dbConnection () {
	$host = 'ashost.mysql.tools';
	$dbname = 'ashost_camp';
	$user = 'ashost_camp';
	$pass = '_______';
	$encoding = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$dbname;charset=$encoding";
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);

	try {
		$DBH = new PDO($dsn, $user, $pass, $options);
	}
	catch(PDOException $e) {
		echo 'Connection aborted: '.$e->getMessage();
	}
	
	return $DBH;
}

function getTable($DBH, $table) {
	switch ($table) {
		case 'branches':
			// $sql = "SELECT a.name, a.code, a.department_id, b.name department, b.article article
			$sql = "SELECT b.name department, b.article article, a.code 
					FROM branches a
					LEFT JOIN departments b ON a.department_id = b.id
					WHERE a.is_deleted = 0";
			break;
		case 'competitors':
			$sql = "SELECT * FROM {$table} WHERE url != ''";
			break;
		default:
			$sql = "SELECT * FROM {$table}";
			break;
	}
	
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows;
}

?>