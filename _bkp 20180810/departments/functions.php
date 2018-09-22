<?php
require_once '../functions.php';

function renderFilters ($DBH) {
    $mapFilter = array (
        'name' => 'Назва департаменту',
		'id' => 'ID департаменту',
		'branch' => 'Номер відділу'
    );
	
	$fieldsType  = array (
		'name' => 'select',
		'id' => 'input',
		'branch' => 'select'
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
		$msg .= 'id='.$row['id'];
		$msg .= '">'."\r\n";

		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
        'name' => 'Назва департаменту',
		'id' => 'ID департаменту',
		'branch' => 'Номер відділу'
    );
	
	$msg = '';
	$msg .= '<table class="table">'."\r\n";
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


function updDepartment ($DBH, $id, $data) {
	$count = 0;

	if (count ($data)) {
		$msg = "";
		foreach ($data as $field => $value) {
			$msg .= $field . " = '" . $value . "', ";
		}
		$msg = substr($msg, 0, -2);

		$sql = "UPDATE departments SET {$msg} WHERE id = '{$id}'";
		$STH = $DBH->prepare($sql);
		$STH->execute();
		$count = $STH->rowCount();
		$STH = null;
	}

	return $count;
}

function getDepartmentByID ($DBH, $id) {
	$sql = "SELECT id, name, branch_id FROM departments WHERE id = '{$id}'";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows[0];
}
?>