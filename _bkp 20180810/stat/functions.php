<?php
require_once '../functions.php';

function renderFilters ($DBH) {
    $mapFilter = array (
		'monitoring_date' => 'Дата моніторингу',

		'comp_name' => 'Конкурент',
        'dep_name' => 'Департамент',
		'branch_id' => 'Відділ'
	);
	
	$fieldsType  = array (
		'monitoring_date' => 'datepicker',

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
		if ($row['result'] == 1) {
			$class = 'class="table-success"';
			$result = 'Повний';
		} else 
		if ($row['result'] > 0) {
			$class = 'class="table-warning"';
			$result = 'Частковий';
		} else {
			$class = 'class="table-danger"';
			$result = 'Немає';
		}

		$msg .= '  <tr ' . $class . '>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['monitoring_date'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch_id'].'</td>'."\r\n";
		
		$msg .= '	<td>'.$row['active_amount'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['result_amount'].'</td>'."\r\n";
		$msg .= '	<td>'.$result.'</td>'."\r\n";
		
		$msg .= '  </tr>'."\r\n";
	}
	$msg .= '<tr style="height:49px"><th></th><td></td><td></td><td></td><td></td>' . "\r\n";
	return $msg . '<td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
        'monitoring_date' => 'Дата моніторингу',
		'comp_name' => 'Конкурент',
        'comp_id' => 'ID конкуренту',
        'dep_name' => 'Департамент',
		'dep_id' => 'ID департаменту',
		'branch_id' => 'Відділ',

		'active_amount' => 'Кількість активних артикулів',
		'result_amount' => 'Кількість артикулів з результатом',
		'result' => 'Результат'
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

?>