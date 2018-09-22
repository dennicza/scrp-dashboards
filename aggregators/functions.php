<?php
require_once '../functions.php';

function renderFilters ($DBH) {
	$mapFilter = array (
		'aggr_id' => 'ID агрегатору',
		'aggr_name' => 'Агрегатор',
		'comp_id' => 'ID конкуренту',
		'comp_name' => 'Конкурент'
		// 'aggr_comp_name' => 'Конкурент в агрегатора'
	);
	
	$fieldsType = array (
		'aggr_id' => 'input',
		'aggr_name' => 'select',
		'comp_id' => 'input',
		'comp_name' => 'select'
		// 'aggr_comp_name' => 'select'
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
		$msg .= '  <tr id="r'.$row['id'].'" data-edit="';
		$msg .= 'lnk='.$row['id'];
		$msg .= '">'."\r\n";

		$msg .= '	<th scope="row" class="edit">'.$i++.'</th>'."\r\n";

		$msg .= '	<td>'.$row['aggr_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['aggr_name'].'</td>'."\r\n";

		$msg .= '	<td>'.$row['comp_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['aggr_comp_name'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px">
					<th></th><td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
		'aggr_id' => 'ID агрегатору',
		'aggr_name' => 'Агрегатор',
		'comp_id' => 'ID конкуренту',
		'comp_name' => 'Конкурент',
		'aggr_comp_name' => 'Конкурент в агрегатора'
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

function saveAggrLnk ($DBH, $arr) {
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

	$sql = "INSERT INTO aggregators " . $msg1 . " VALUES " . $msg2;
	$STH = $DBH->prepare($sql);
	$STH->execute($data);
	$res = $DBH->lastInsertId();
	$STH = null;
	
	return $res;
}

function updTable ($DBH, $table, $id, $data) {
	$count = 0;

	if (count ($data)) {
		$msg = "";
		foreach ($data as $field => $value) {
			if ($value == 'NULL') {
				$msg .= $field . " = NULL, ";
			} else {
				$msg .= $field . " = '" . $value . "', ";
			}
			
		}
		$msg = substr($msg, 0, -2);

		$sql = "UPDATE {$table} SET {$msg} WHERE id = '{$id}'";
		$STH = $DBH->prepare($sql);
		$STH->execute();
		$count = $STH->rowCount();
		$STH = null;
	}

	return $count;
}

function getAggrRow ($DBH, $id) {
	$sql = "SELECT *
			FROM aggregators
			WHERE id = {$id}";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows[0];
}

?>