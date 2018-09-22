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

function getRowsCount( $DBH, $table, $filters ) {
	switch ($table) {
		case 'departments':
			$sql = "SELECT COUNT(a.id) x
					FROM departments a
					LEFT JOIN branches b ON a.branch_id = b.id
					WHERE a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'competitors':
			$sql = "SELECT COUNT(id) x
					FROM competitors
					WHERE url != ''";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'bindings':
			$sql = "SELECT COUNT(a.id) x
					FROM bindings a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					LEFT JOIN all_goods d ON a.g_comp_id = d.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'monitoring':
			$sql = "SELECT COUNT(a.id) x
					FROM monitoring a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'results':
			$sql = "SELECT COUNT(a.id) x
					FROM results a
					LEFT JOIN bindings b ON a.binding_id = b.id
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON b.comp_id = d.id
					LEFT JOIN departments e ON b.dep_id = e.id
					LEFT JOIN all_goods f ON b.g_comp_id = f.id";
			if (count($filters)) {
				$sql .= " WHERE " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'stat':
			$sql = "SELECT COUNT(a.id) x
					FROM stat a
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON c.comp_id = d.id
					LEFT JOIN departments e ON c.dep_id = e.id";
			if (count($filters)) {
				$sql .= " WHERE " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		case 'aggregators':
			$sql = "SELECT COUNT(a.id) x
					FROM aggregators a
					LEFT JOIN competitors b ON a.aggr_id = b.id
					LEFT OUTER JOIN competitors c ON a.comp_id = c.id
					WHERE (c.is_active = 1 OR c.is_active IS NULL) AND a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			break;
		default:
			break;
	}
	
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows[0]['x'];
}

function convFltrs4Sql ($filters, $table) {
	switch ($table) {
		case 'departments':
			$map = array (
				'comp_name' => 'a.comp_name',
				'id' => 'a.id',
				'branch' => 'b.id'
			);
			break;
		case 'competitors':
			$map = array (
				'comp_name' => 'comp_name',
				'id' => 'id',
				'url' => 'url',
				'is_active' => 'is_active'
			);
			break;
		case 'bindings':
			$map  = array (
				'g_inner_id' => 'a.g_inner_id',
				'g_inner_name' => 'a.g_inner_name',
				'g_comp_name' => 'd.name',
				
				'comp_name' => 'b.comp_name',
				'dep_name' => 'c.name',
				'branch_id' => 'c.branch_id'
			);
			break;
		case 'monitoring':
			$map = array (
				'comp_name' => 'b.comp_name',
				'dep_name' => 'c.name',
				'branch_id' => 'c.branch_id',
				
				'frequency' => 'a.frequency',
				'wd' => 'a.week_day',
				'start_next' => '(SELECT IF (CURDATE() <= start_0, start_0, IF (CURDATE() <= start_at, start_at, (SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(start_at)), dist)) DAY)))))',
				
				'is_active' => 'a.is_active'
			);
			break;
		case 'results':
			$map = array (
				'g_inner_id' => 'b.g_inner_id',
				'g_inner_name' => 'b.g_inner_name',
				'g_comp_name' => 'f.g_merch_name',
		
				'monitoring_date' => 'DATE(a.dt)',
		
				'comp_name' => 'd.comp_name',
				'dep_name' => 'e.name',
				'branch_id' => 'e.branch_id'
			);
			break;
		case 'stat':
			$map = array (
				'monitoring_date' => 'DATE(a.dt)',
		
				'comp_name' => 'd.comp_name',
				'dep_name' => 'e.name',
				'branch_id' => 'e.branch_id'
			);
			break;
		case 'aggregators':
			$map = array (
				'aggr_id' => 'a.aggr_id',
				'aggr_name' => 'b.comp_name',
				'comp_id' => 'c.id',
				'comp_name' => 'c.comp_name'
				// 'aggr_comp_name' => 'a.aggr_comp_name'
			);
			break;
		default:
			$map = array ();
			break;
	}

	$res = "";
	foreach ($filters as $key => $value) {
		$res .= " AND " . $map[$key] . " LIKE '%" . $value . "%'";
	}
	return $res;
}

function getTableFiltered ($DBH, $table, $page, $filters) {
	$pp = 500;
	$from = ($page - 1) * $pp;
	$to = $page * $pp;
	// $sql .= " WHERE a.id >= {$from} AND a.id <= {$to}";

	switch ($table) {
		case 'departments':
			$sql = "SELECT a.name, a.id, b.id branch 
					FROM departments a
					LEFT JOIN branches b ON a.branch_id = b.id
					WHERE a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.name ASC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'competitors':
			$sql = "SELECT * FROM competitors WHERE url != ''";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY comp_name ASC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'bindings':
			$sql = "SELECT a.id bind_id, b.comp_name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							a.g_inner_id, a.g_inner_name,
							d.name g_comp_name, d.id g_comp_id,
							a.ident, a.is_active
					FROM bindings a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					LEFT JOIN all_goods d ON a.g_comp_id = d.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
					// LEFT JOIN branches e ON c.branch_id = e.id";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.dt DESC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'monitoring':
			$sql = "SELECT a.id monit_id, b.comp_name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							b.url url,
							a.week_day, a.wd, a.frequency,
							
							/*(SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(a.start_at)), a.dist)) DAY)) as start_next,*/

							(SELECT IF (CURDATE() <= start_0, start_0, IF (CURDATE() <= start_at, start_at, (SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(start_at)), dist)) DAY)))))  as start_next,

							a.is_active, (SELECT COUNT(bindings.id) FROM bindings WHERE bindings.comp_id = b.id AND bindings.dep_id = c.id AND bindings.is_active = 1) as active
					FROM monitoring a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.week_day ASC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'results':
			$sql = "SELECT DATE(a.dt) monitoring_date,
							d.comp_name comp_name, b.comp_id comp_id,
							e.name dep_name, e.id dep_id,
							e.branch_id branch_id,
							b.g_inner_id g_inner_id, b.g_inner_name g_inner_name,
							f.g_merch_name g_comp_name, a.competitor_price g_comp_price,
							a.is_available, a.identity, a.is_promo
					FROM results a
					LEFT JOIN bindings b ON a.binding_id = b.id
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON b.comp_id = d.id
					LEFT JOIN departments e ON b.dep_id = e.id
					LEFT JOIN all_goods f ON b.g_comp_id = f.id";
			if (count($filters)) {
				$sql .= " WHERE " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.dt DESC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'stat':
			$sql = "SELECT DATE(a.dt) monitoring_date,
							d.comp_name comp_name, d.id comp_id,
							e.name dep_name, e.id dep_id,
							e.branch_id branch_id,
							a.active_amount, a.result_amount, (a.result_amount / a.active_amount) result
					FROM stat a
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON c.comp_id = d.id
					LEFT JOIN departments e ON c.dep_id = e.id";
			if (count($filters)) {
				$sql .= " WHERE " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.dt DESC LIMIT {$pp} OFFSET {$from}";
			break;
		case 'aggregators':
			$sql = "SELECT a.id id, a.aggr_id aggr_id, b.comp_name aggr_name,
							c.id comp_id, c.comp_name comp_name,
							a.aggr_comp_name aggr_comp_name
					FROM aggregators a
					LEFT JOIN competitors b ON a.aggr_id = b.id
					LEFT JOIN competitors c ON a.comp_id = c.id
					WHERE (c.is_active = 1 OR c.is_active IS NULL) AND a.is_deleted = 0";
			if (count($filters)) {
				$sql .= " AND " . substr(convFltrs4Sql ($filters, $table), 4);
			}
			$sql .= " ORDER BY a.aggr_id ASC LIMIT {$pp} OFFSET {$from}";
			break;
		default:
			$sql = "SELECT * FROM {$table}";
			break;
	}

	// return $sql;
	
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows;
}


function getTable($DBH, $table, $page = null) {
	switch ($table) {
		case 'departments':
			// $sql = "SELECT a.name, a.code, a.department_id, b.name department, b.article article
			$sql = "SELECT a.name, a.id, b.id branch 
					FROM departments a
					LEFT JOIN branches b ON a.branch_id = b.id
					WHERE a.is_deleted = 0";
			break;
		case 'competitors':
			$sql = "SELECT * FROM competitors WHERE url != ''";
			break;
		case 'bindings':
			$sql = "SELECT a.id bind_id, b.comp_name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							a.g_inner_id, a.g_inner_name,
							d.name g_comp_name, d.id g_comp_id,
							a.ident, a.is_active
					FROM bindings a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					LEFT JOIN all_goods d ON a.g_comp_id = d.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
					// LEFT JOIN branches e ON c.branch_id = e.id";
			break;
		case 'monitoring':
			$sql = "SELECT a.id monit_id, b.comp_name comp_name, a.comp_id,
							c.name dep_name, a.dep_id, c.branch_id,
							b.url url,
							a.week_day, a.wd, a.frequency,
							
							/*(SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + a.week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(a.start_at)), a.dist)) DAY)) as start_next,*/

							(SELECT IF (CURDATE() <= start_0, start_0, IF (CURDATE() <= start_at, start_at, (SELECT DATE_ADD((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), INTERVAL (SELECT MOD(DATEDIFF((SELECT DATE_ADD(CURDATE(), INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(CURDATE()), 7))) DAY)), DATE(start_at)), dist)) DAY)))))  as start_next,

							a.is_active, (SELECT COUNT(bindings.id) FROM bindings WHERE bindings.comp_id = b.id AND bindings.dep_id = c.id AND bindings.is_active = 1) as active
					FROM monitoring a
					LEFT JOIN competitors b ON a.comp_id = b.id
					LEFT JOIN departments c ON a.dep_id = c.id
					WHERE b.is_active = 1 AND a.is_deleted = 0";
			break;
		case 'results':
			$sql = "SELECT DATE(a.dt) monitoring_date,
							d.comp_name comp_name, b.comp_id comp_id,
							e.name dep_name, e.id dep_id,
							e.branch_id branch_id,
							b.g_inner_id g_inner_id, b.g_inner_name g_inner_name,
							f.g_merch_name g_comp_name, a.competitor_price g_comp_price,
							a.is_available, a.identity, a.is_promo
					FROM results a
					LEFT JOIN bindings b ON a.binding_id = b.id
					-- LEFT JOIN monitoring c ON a.monitoring_id = b.id
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON b.comp_id = d.id
					LEFT JOIN departments e ON b.dep_id = e.id
					LEFT JOIN all_goods f ON b.g_comp_id = f.id";
			if ($page) {
				$pp = 500;
				$from = ($page - 1) * $pp;
				$to = $page * $pp;
				// $sql .= " WHERE a.id >= {$from} AND a.id <= {$to}";
				$sql .= " LIMIT {$pp} OFFSET {$from}";
			}
			break;
		case 'stat':
			$sql = "SELECT DATE(a.dt) monitoring_date,
							d.comp_name comp_name, d.id comp_id,
							e.name dep_name, e.id dep_id,
							e.branch_id branch_id,
							a.active_amount, a.result_amount, (a.result_amount / a.active_amount) result
					FROM stat a
					LEFT JOIN monitoring c ON a.monitoring_id = c.id
					LEFT JOIN competitors d ON c.comp_id = d.id
					LEFT JOIN departments e ON c.dep_id = e.id
					ORDER BY a.dt ASC";
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