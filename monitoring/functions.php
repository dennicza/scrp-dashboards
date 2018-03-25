<?php
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';

function renderFilters () {
    $mapFilter = array (
		'comp_name' => 'Конкурент',
		
		'branch_id' => 'Відділ',
		'dep_name' => 'Департамент',
		
		'frequency' => 'Частота моніторингу',
		'wd' => 'День тижня моніторингу',
		'start_next' => 'Дата наступного моніторингу',
		
        'is_active' => 'Статус активності моніторингу'
    );
    
    $msg = "";
    foreach ($mapFilter as $key => $value) {
        $msg .= "<div class=\"input-group input-group-sm mb-1\">\r\n";
        $msg .= "    <div class=\"input-group-prepend\">\r\n";
        $msg .= "        <span class=\"input-group-text\">{$value}</span>\r\n";
        $msg .= "    </div>\r\n";
        $msg .= "    <input type=\"text\" class=\"form-control filter\" id=\"{$key}\" aria-describedby=\"basic-addon3\">\r\n";
        $msg .= "    <div class=\"input-group-append\">\r\n";
        $msg .= "       <button class=\"btn btn-outline-secondary clear\" data-clear=\"{$key}\" type=\"button\">Очистити</button>\r\n";
        $msg .= "   </div>\r\n";
        $msg .= "</div>\r\n";
    }

    return $msg;
}

function renderMonitoringsBody($arr) {
	$msg = '';
	$i = 1;
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row" class="edit">'.$i++;
		$msg .= '<a href="/monitoring/edit.php?';
		$msg .= 'monit_id='.$row['monit_id'].'&dep_id='.$row['dep_id'];
		$msg .= '&comp_id='.$row['comp_id'];
		$msg .= '" class="pencil"><i class="fa fa-pencil fa-lg"></i></a></th>'."\r\n";

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

function renderMonitorings($arr) {
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
	
	$msg .= renderMonitoringsBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

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
	$sql = "SELECT id, name FROM departments WHERE 	is_deleted = 0";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_NUM);
	$STH = null;

	return $rows;
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