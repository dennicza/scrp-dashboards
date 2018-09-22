<?php
require_once '../functions.php';

function renderFilters ($DBH) {
    $mapFilter = array (
        'comp_name' => 'Назва конкуренту',
        'id' => 'ID конкуренту',
        'url' => 'Адреса сайту',
        'is_active' => 'Статус активності'
    );
	
	$fieldsType  = array (
		'comp_name' => 'select',
        'id' => 'input',
        'url' => 'input',
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
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['url'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_active'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dt'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderTable($arr, $page, $pp = 500) {
	$mapTable = array (
        'comp_name' => 'Назва конкуренту',
        'id' => 'ID конкуренту',
        'url' => 'Адреса сайту',
		'is_active' => 'Статус активності',
		'dt' => 'Оновлено'
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