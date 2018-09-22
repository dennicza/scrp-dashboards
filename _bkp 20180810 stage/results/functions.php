<?php
require_once '../functions.php';

function renderFilters () {
    $mapFilter = array (
		'g_inner_id' => 'Артикул в обліковій системі',
		'g_inner_name' => 'Назва товару в обліковій системі',
		'g_comp_name' => 'Назва товару конкурента',

		'monitoring_date' => 'Дата моніторингу',

		'comp_name' => 'Конкурент',
        'dep_name' => 'Департамент',
		'branch_id' => 'Відділ'
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

function renderResultsBody($arr) {
	$msg = '';
	$i = 1;
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['monitoring_date'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['comp_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dep_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['g_inner_id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['g_inner_name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['g_comp_name'].'</td>'."\r\n";
		$msg .= '	<td>'. number_format($row['g_comp_price'] / 100, 2, '.', '') .'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_available'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['identity'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_promo'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	$msg .= '<tr style="height:49px"><th></th><td></td><td></td><td></td><td></td><td></td><td></td>' . "\r\n";
	return $msg . '<td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderResults($arr) {
	$mapTable = array (
        'monitoring_date' => 'Дата моніторингу',
		'comp_name' => 'Конкурент',
        'comp_id' => 'ID конкуренту',
        'dep_name' => 'Департамент',
		'dep_id' => 'ID департаменту',
		'branch_id' => 'Відділ',
		'g_inner_id' => 'Артикул в обліковій системі',
		'g_inner_name' => 'Назва товару в обліковій системі',
		'g_comp_name' => 'Назва товару конкурента',
		'g_comp_price' => 'Ціна конкурента з ПДВ',
		'is_available' => 'Статус наявності',
		'identity' => 'Статус ідентичності',
		'is_promo' => 'Статус дії акції'
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
	
	$msg .= renderResultsBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}

?>