<?php
header("Content-Type: text/html; charset=windows-1251");
session_start ();
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';
// require_once ($_SERVER['DOCUMENT_ROOT'].'PHPExcel/PHPExcel.php');
require_once '../PHPExcel/PHPExcel.php';

function renderNav_local () {
	$msg = "<nav class=\"navbar navbar-toggleable-md navbar-light fixed-top\" style=\"background-color:#e3f2fd\">\r\n";
	// $msg .= "<a class=\"navbar-brand\" href=\"#\">Navbar</a>\r\n";
	$msg .= "<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\r\n";
	$msg .= "	<span class=\"navbar-toggler-icon\"></span>\r\n";
	$msg .= "</button>\r\n";
	$msg .= "<div class=\"collapse navbar-collapse\" id=\"navbarNav\">\r\n";

	$msg .= "<ul class=\"navbar-nav\">\r\n";

	$msg .= '	<li class="nav-item active">
			<a class="nav-link" href="/">Головна сторінка<span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="aggregators" href="/aggregators">Прайс-агрегатори</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="competitors" href="/competitors">Конкуренти</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="departments" href="/departments">Департаменти</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="monitoring" href="/monitoring">Розклад моніторингів</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="bindings" href="/bindings">Зв’язування артикулів</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="results" href="/results">Результати моніторингів</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="stat" href="/stat">Статус монітор</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" id="logout" style="color:red" href="/">Вийти</a>
		</li>';

	$msg .= "</ul>\r\n";

	$msg .= "</div>\r\n";
	$msg .= "</nav>\r\n";

	return $msg;
}

function getCompetitorsAssoc ($DBH) {
	$assoc  = array ();
	$sql = "SELECT id, comp_name FROM competitors WHERE is_active = 1 AND is_aggregator = 0 ORDER BY comp_name ASC";
	$STH = $DBH->query($sql);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $STH->fetch()) {
		$assoc[$row['comp_name']] = $row['id'];
	}
	$STH = null;
	return $assoc;
}

function getAggregatorsAssoc ($DBH) {
	$assoc  = array ();
	$sql = "SELECT id, comp_name FROM competitors WHERE is_active = 1 AND is_aggregator = 1 ORDER BY comp_name ASC";
	$STH = $DBH->query($sql);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $STH->fetch()) {
		$assoc[$row['comp_name']] = $row['id'];
	}
	$STH = null;
	return $assoc;
}

function importAggrLinks ($DBH, $filename) {	//	should be used on page with header("Content-Type: text/html; charset=windows-1251");
	$objReader = new PHPExcel_Reader_Excel5();
	$objPHPExcel = $objReader->load('uploads/'.$filename);	//	'aggregators.xls'
	$objWorksheet = $objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow();
	
	// echo "ROWS :  ".$highestRow."<br><br>";

	$comps = getCompetitorsAssoc ($DBH);
	$aggrs = getAggregatorsAssoc ($DBH);

	$mapping = array (
		'aggr_id' => "A",
		'comp_id' => "B",
		'aggr_comp_name' => "C"
	);

	$sql = "INSERT INTO aggregators (";
	$vals = "\r\n(:";
	$upd = "\r\nON DUPLICATE KEY UPDATE\r\n";
	foreach ($mapping as $key => $value) {
		$sql .= $key . ", ";
		$vals .= $key . ", :";
		$upd .= $key . " = :" . $key . ", ";
	}
	$sql .= "dt, is_deleted) VALUES ";
	$vals = substr($vals, 0, -1) . "NOW(), 0)";
	// $upd = substr($upd, 0, -2);
	$upd .= "dt = NOW(), is_deleted = 0";

	$sql = $sql . $vals . $upd;

	$num = 0;
	$STH = $DBH->prepare($sql);

	for ($row = 2; $row <= $highestRow; $row++) {
		$data = array();
		/*
		foreach ($mapping as $key => $value) {
			// $data[$key] = iconv("UTF-8", "CP1251", $objWorksheet->getCell($value.$row)->getValue());
			$data[$key] = $objWorksheet->getCell($value.$row)->getValue();
		}
		*/
		$data['aggr_id'] = $aggrs[$objWorksheet->getCell($mapping['aggr_id'].$row)->getValue()];
		$data['comp_id'] = $comps[$objWorksheet->getCell($mapping['comp_id'].$row)->getValue()];
		$data['aggr_comp_name'] = $objWorksheet->getCell($mapping['aggr_comp_name'].$row)->getValue();
		$STH->execute($data);
		$num += $STH->rowCount() > 0 ? 1 : 0;
		// echo "<pre>{$sql}</pre>";
	}
	
	$STH = null;

	// echo "<br><br>DONE";

	$objPHPExcel->disconnectWorksheets();
	unset($objPHPExcel);

	return $num.'/'.--$highestRow;
	// return $num.'/'.$sql;
}

if (isset($_POST['import'])) {
	$res = '';
	$DBH = dbConnection ();
	if (isUAC($DBH)) $res = importAggrLinks ($DBH, 'aggregators.xls');
    $DBH = null;

    print_r ($res);
}