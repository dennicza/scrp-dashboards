<?php
require_once '../functions.php';

function renderFilters () {
    $mapFilter = array (
        'name' => 'Назва конкуренту',
        'id' => 'ID конкуренту',
        'url' => 'Адреса сайту',
        'is_active' => 'Статус активності'
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

function renderCompetitorsBody($arr) {
	$msg = '';
	$i = 1;
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['url'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_active'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dt'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderCompetitors($arr) {
	$mapTable = array (
        'name' => 'Назва конкуренту',
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
	
	$msg .= renderCompetitorsBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}

?>