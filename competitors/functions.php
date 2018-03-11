<?php
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';

function renderCompetitorsBody($arr) {
	$msg = '';
	foreach ($arr as $row) {
		$msg .= '  <tr>'."\r\n";
		$msg .= '	<th scope="row">'.$row['id'].'</th>'."\r\n";
		$msg .= '	<td>'.$row['name'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['article'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['url'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['is_active'].'</td>'."\r\n";
		$msg .= '	<td>'.$row['dt'].'</td>'."\r\n";
		$msg .= '  </tr>'."\r\n";
	}
	return $msg . '<tr style="height:49px"><th></th><td></td><td></td><td></td><td></td><td></td></tr>' . "\r\n";
}

function renderCompetitors($arr) {
	$msg = '';
	$msg .= '<table class="table">'."\r\n";
	$msg .= '<thead class="thead-light">'."\r\n";
	$msg .= '  <tr>'."\r\n";
	$msg .= '	<th scope="col">#</th>'."\r\n";
	$msg .= '	<th scope="col">Назва конкуренту</th>'."\r\n";
	$msg .= '	<th scope="col">ID конкуренту</th>'."\r\n";
	$msg .= '	<th scope="col">Адреса сайту</th>'."\r\n";
	$msg .= '	<th scope="col">Статус активності</th>'."\r\n";
	$msg .= '	<th scope="col">Оновлено</th>'."\r\n";
	$msg .= '  </tr>'."\r\n";
	$msg .= '</thead>'."\r\n";
	$msg .= '<tbody  id="render">'."\r\n";
	
	$msg .= renderCompetitorsBody($arr);

	$msg .= '</tbody>'."\r\n";
	$msg .= '</table>'."\r\n";

  return $msg;
}


?>