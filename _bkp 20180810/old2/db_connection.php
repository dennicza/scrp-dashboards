<?php
require_once 'password.php';

function dbConnection () {
	global $__HOST;
	global $__DBNAME;
	global $__USER;
	global $__PASSWORD;
	$encoding = 'utf8';
	
	$dsn = "mysql:host=$__HOST;dbname=$__DBNAME;charset=$encoding";
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);

	try {
		$DBH = new PDO($dsn, $__USER, $__PASSWORD, $options);
	}
	catch(PDOException $e) {
		echo 'Connection aborted: '.$e->getMessage();
	}
	
	return $DBH;
}

function getTable($DBH, $table) {
	switch ($table) {
		case 'departments':
			// $sql = "SELECT a.name, a.code, a.department_id, b.name department, b.article article
			$sql = "SELECT a.name, a.id, b.id branch 
					FROM departments a
					LEFT JOIN branches b ON a.branch_id = b.id
					WHERE a.is_deleted = 0";
			break;
		case 'competitors':
			$sql = "SELECT * FROM {$table} WHERE url != ''";
			break;
		case 'bindings':
			$sql = "SELECT a.id bind_id, b.name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							a.g_inner_id, a.g_inner_name,
							d.name g_comp_name, d.id g_comp_id,
							a.ident, a.is_active
					FROM bindings a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					LEFT JOIN all_goods d ON a.g_comp_id = d.id
					WHERE b.is_active = 1";
					// LEFT JOIN branches e ON c.branch_id = e.id";
			break;
		case 'monitoring':
			$sql = "SELECT a.id monit_id, b.name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							b.url url,
							a.week_day, a.wd, a.frequency,
							(SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(a.start_at)), a.dist)) DAY)) as start_next,
							a.is_active, (SELECT COUNT(bindings.id) FROM bindings WHERE bindings.comp_id = b.id AND bindings.dep_id = c.id AND bindings.is_active = 1) as active
					FROM monitoring a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					WHERE b.is_active = 1";
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

function isUAC ($DBH) {
	$cred = $_SESSION ['cred'];
	if (!empty($cred) && strlen($cred)==32) {
		$sql = "SELECT id, role FROM users WHERE sess = '{$cred}'";
		$STH = $DBH->query($sql);
		$user = $STH->fetchAll(PDO::FETCH_ASSOC);
		$STH = null;
		
		return $user[0]['id'];
	}
	return 0;
}

?>