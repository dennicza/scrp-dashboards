<?php
require_once '../functions.php';

function renderFilters ($DBH) {
    $mapFilter = array (
		'comp_name' => 'Конкурент',
		'branch_id' => 'Відділ',
		'dep_name' => 'Департамент',
		
		'frequency' => 'Частота моніторингу',
		'wd' => 'День тижня моніторингу',
		'start_next' => 'Дата наступного моніторингу',
		
        'is_active' => 'Статус активності моніторингу'
	);
	
	$fieldsType  = array (
		'comp_name' => 'select',
		'branch_id' => 'select',
		'dep_name' => 'select',
		
		'frequency' => 'input',
		'wd' => 'select2',
		'start_next' => 'datepicker',
		
		'is_active' => 'select2'
	);
    
    $msg = "";
    foreach ($mapFilter as $key => $value) {
		$msg .= typeFilter ($DBH, $fieldsType[$key], $key, $value);
    }

    return $msg;
}

function renderBody($arr, $page, $pp = 500) {
	if (!$page) $page = 1;
	$from = 1 + ($page - 1) * $pp;

	$msg = '';
	$i = $from;
	foreach ($arr as $row) {
		$msg .= '  <tr id="r'.$row['monit_id'].'" data-edit="';
		$msg .= 'monit_id='.$row['monit_id'].'&dep_id='.$row['dep_id'];
		$msg .= '&comp_id='.$row['comp_id'];
		$msg .= '">'."\r\n";

		$msg .= '	<th scope="row" class="edit">'.$i++.'</th>'."\r\n";

		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['url'].'</td>'."\r\n";

		$msg .= '	<td>'.$row['frequency'].' / 4 тижні</td>'."\r\n";
		$msg .= '	<td>'.$row['wd'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['start_next'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_active'].'</td>'."\r\n";

		$msg .= '	<td>'.$row['active'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px">
					<th></th><td></td><td></td><td></td><td></td>
					<td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
		'comp_name' => 'Конкурент',
		'branch_id' => 'Відділ',
		'dep_name' => 'Департамент',
		'url' => 'Адреса сайту конкурента',
		
		'frequency' => 'Частота моніторингу',
		'wd' => 'День тижня моніторингу',
		'start_next' => 'Дата наступного моніторингу',
        'is_active' => 'Статус активності моніторингу',

		'active' => 'Кількість активних артикулів'
	);

	$msg = '';
	$msg .= '<table class="table mt-2">'."\r\n";
	$msg .= '<thead class="thead-light">'."\r\n";
	$msg .= '  <tr>'."\r\n";
	$msg .= '	<th scope="col">#</th>'."\r\n";

	foreach ($mapTable as $value) {
		$msg .= "	<th scope=\"col\">{$value}</th>\r\n";
	}

	$msg .= '  </tr>'."\r\n";
	$msg .= '</thead>'."\r\n";
	$msg .= '<tbody  id="render">'."\r\n";
	
	$msg .= renderBody($arr, $page, $pp);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}

function saveMonitoring ($DBH, $arr) {
	$res = 0;
	$msg1 = "(start_at, ";
	$msg2 = "((SELECT DATE_ADD('" . $arr['start_0'] . "', INTERVAL (SELECT (MOD(7 + " . ($arr['week_day'] * 1) . " - WEEKDAY('" . $arr['start_0'] . "'), 7))) DAY)), " ;

	$data = [];

	foreach ($arr as $field => $value) {
		$msg1 .= $field . ', ';
		$msg2 .= ':' . $field . ', ';
		$data[$field] = $value;
	}

	$msg1 = substr($msg1, 0, -2) . ")";
	$msg2 = substr($msg2, 0, -2) . ")";

	$sql = "INSERT INTO monitoring " . $msg1 . " VALUES " . $msg2;
// return $sql;
	$STH = $DBH->prepare($sql);
	$STH->execute($data);
	$res = $DBH->lastInsertId();
	$STH = null;
	
	return $res;
}

function updMonitoring ($DBH, $mid, $data) {
	$count = 0;

	if (count ($data)) {
		$msg = "";
		foreach ($data as $field => $value) {
			$msg .= $field . " = '" . $value . "', ";
		}
		// $msg = substr($msg, 0, -2);
		$msg .= "start_at = (SELECT DATE_ADD('" . $data['start_0'] . "', INTERVAL (SELECT (MOD(7 + " . ($data['week_day'] * 1) . " - WEEKDAY('" . $data['start_0'] . "'), 7))) DAY))";

		$sql = "UPDATE monitoring SET {$msg} WHERE id = '{$mid}'";
// return $sql;
		$STH = $DBH->prepare($sql);
		$STH->execute();
		$count = $STH->rowCount();
		$STH = null;
	}

	return $count;
}

function getMonitoringByID ($DBH, $mid) {
	$sql = "SELECT * FROM monitoring WHERE id = '{$mid}'";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows[0];
}

?>