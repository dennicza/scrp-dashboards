<?php
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';

function renderBranchesBody($arr) {
	$msg = '';
	$i = 1;
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$i++.'</th>'."\r\n";
		$msg .= '	<td>'.$row['department'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['article'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['code'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderBranches($arr) {
	$msg = '';
	$msg .= '<table class="table">'."\r\n";
	$msg .= '<thead class="thead-light">'."\r\n";
	$msg .= '  <tr>'."\r\n";
	$msg .= '	<th scope="col">#</th>'."\r\n";
	$msg .= '	<th scope="col">Назва департаменту</th>'."\r\n";
	$msg .= '	<th scope="col">ID департаменту</th>'."\r\n";
	$msg .= '	<th scope="col">Номер відділу</th>'."\r\n";
	$msg .= '  </tr>'."\r\n";
	$msg .= '</thead>'."\r\n";
	$msg .= '<tbody  id="render">'."\r\n";
	
	$msg .= renderBranchesBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}


?>