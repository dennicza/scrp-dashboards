<?php
require_once '../functions.php';

function renderFilters () {
    $mapFilter = array (
        'name' => 'Назва департаменту',
		'id' => 'ID департаменту',
		'branch' => 'Номер відділу'
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

function renderBranchesBody($arr) {
	$msg = '';
	$i = 1;
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['id'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['branch'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderBranches($arr) {
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
	
	$msg .= renderBranchesBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}

?>