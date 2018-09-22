<?php
header("Content-Type: text/html; charset=windows-1251");
date_default_timezone_set ('Europe/Kiev');
require_once '../db_connection.php';
// require_once ($_SERVER['DOCUMENT_ROOT'].'PHPExcel/PHPExcel.php');
require_once '../PHPExcel/PHPExcel.php';

function importBindings($DBH, $filename) {	//	should be used on page with header("Content-Type: text/html; charset=windows-1251");
	$objReader = new PHPExcel_Reader_Excel5();
	$objPHPExcel = $objReader->load('uploads/'.$filename);	//	'bindings.xls'
	$objWorksheet = $objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow();
	
	// echo "ROWS :  ".$highestRow."<br><br>";

	$mapping = array (
		'comp_id' => "A",
		'g_comp_id' => "B",
		'dep_id' => "C",
		'g_inner_id' => "D",
		'g_inner_name' => "E",
		'ident' => "F",
		'is_active' => "G"
	);

	$sql = "INSERT INTO bindings (";
	$vals = "\r\n(:";
	$upd = "\r\nON DUPLICATE KEY UPDATE\r\n";
	foreach ($mapping as $key => $value) {
		$sql .= $key . ", ";
		$vals .= $key . ", :";
		$upd .= $key . " = :" . $key . ", ";
	}
	$sql .= "dt) VALUES ";
	$vals = substr($vals, 0, -1) . "NOW())";
	$upd = substr($upd, 0, -2);

	$sql = $sql . $vals . $upd;

	$num = 0;
	$STH = $DBH->prepare($sql);

	for ($row = 2; $row <= $highestRow; $row++) {
		$data = array();
		foreach ($mapping as $key => $value) {
			// $data[$key] = iconv("UTF-8", "CP1251", $objWorksheet->getCell($value.$row)->getValue());
			$data[$key] = $objWorksheet->getCell($value.$row)->getValue();
		}
		$STH->execute($data);
		$num += $STH->rowCount() > 0 ? 1 : 0;
		// echo "<pre>{$sql}</pre>";
	}
	
	$STH = null;

	// echo "<br><br>DONE";

	$objPHPExcel->disconnectWorksheets();
	unset($objPHPExcel);

    return $num.'/'.--$highestRow;
}

if (isset($_POST['import'])) {
    $DBH = dbConnection ();
    $res = importBindings($DBH, 'bindings.xls');
    $DBH = null;

    print_r ($res);
}