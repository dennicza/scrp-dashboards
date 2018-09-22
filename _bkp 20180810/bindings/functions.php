<?php
require_once '../functions.php';

function renderFilters ($DBH) {
    $mapFilter = array (
        'g_inner_id' => 'Артикул',
        'g_inner_name' => 'Назва товару',
        'g_comp_name' => 'Товар у конкурента',
        
        'comp_name' => 'Конкурент',
        'dep_name' => 'Департамент',
        'branch_id' => 'ID відділу'
    );
	
	$fieldsType  = array (
		'g_inner_id' => 'input',
        'g_inner_name' => 'input',
        'g_comp_name' => 'input',
        
        'comp_name' => 'select',
        'dep_name' => 'select',
		'branch_id' => 'select'
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
		$msg .= '  <tr id="r'.$row['bind_id'].'" data-edit="';
		$msg .= 'bind_id='.$row['bind_id'].'&dep_id='.$row['dep_id'];
		$msg .= '&comp_id='.$row['comp_id'].'&g_comp_id='.$row['g_comp_id'];
		$msg .= '">'."\r\n";

		$msg .= '	<th scope="row" class="edit">'.$i++.'</th>'."\r\n";

		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_id'].'</td>'."\r\n";

		$msg .= '	<td>'.$row['dep_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch_id'].'</td>'."\r\n";

		$msg .= '	<td>'.$row['g_inner_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['g_inner_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['g_comp_name'].'</td>'."\r\n";
		
		$msg .= '	<td>'.$row['ident'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_active'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px">
					<th></th><td></td><td></td><td></td><td></td><td></td>
					<td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
		'comp_name' => 'Конкурент',
		'comp_id' => 'ID конкуренту',
	
		'dep_name' => 'Департамент',
		'dep_id' => 'ID департаменту',
		'branch_id' => 'ID відділу',
	
		'g_inner_id' => 'Артикул',
		'g_inner_name' => 'Назва товару',
		'g_comp_name' => 'Товар у конкурента',
	
		'ident' => 'Статус активності',
		'is_active' => 'Статус ідентичності'
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

function saveBinding ($DBH, $arr) {
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

	$sql = "INSERT INTO bindings " . $msg1 . " VALUES " . $msg2;
	$STH = $DBH->prepare($sql);
	$STH->execute($data);
	$res = $DBH->lastInsertId();
	$STH = null;
	
	return $res;
}

function updBinding ($DBH, $bid, $data) {
	$count = 0;

	if (count ($data)) {
		$msg = "";
		foreach ($data as $field => $value) {
			$msg .= $field . " = '" . $value . "', ";
		}
		$msg = substr($msg, 0, -2);

		$sql = "UPDATE bindings SET {$msg} WHERE id = '{$bid}'";
		$STH = $DBH->prepare($sql);
		$STH->execute();
		$count = $STH->rowCount();
		$STH = null;
	}

	return $count;
}

function getBindingByID ($DBH, $bid) {
	$sql = "SELECT g_inner_id, g_inner_name, ident, is_active FROM bindings WHERE id = '{$bid}'";
	$STH = $DBH->query($sql);
	$rows = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;

	return $rows[0];
}

?>