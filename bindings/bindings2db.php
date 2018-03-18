<?php
    date_default_timezone_set ('Europe/Kiev');
    // require_once ($_SERVER['DOCUMENT_ROOT'].'bindings/PHPExcel/PHPExcel.php');
    require_once '../PHPExcel/PHPExcel.php';
    require_once 'functions.php';
    $DBH = dbConnection ();
	
	header("Content-Type: text/html; charset=windows-1251");

	function GetInTranslit($string) {
		$replace = array(
			"-"=>"_"," "=>"_",
			"'"=>"","`"=>"",","=>".",
			"а"=>"a","А"=>"a",
			"б"=>"b","Б"=>"b",
			"в"=>"v","В"=>"v",
			"г"=>"g","Г"=>"g",
			"д"=>"d","Д"=>"d",
			"е"=>"e","Е"=>"e",
			"ж"=>"zh","Ж"=>"zh",
			"з"=>"z","З"=>"z",
			"и"=>"i","И"=>"i",
			"й"=>"y","Й"=>"y",
			"к"=>"k","К"=>"k",
			"л"=>"l","Л"=>"l",
			"м"=>"m","М"=>"m",
			"н"=>"n","Н"=>"n",
			"о"=>"o","О"=>"o",
			"п"=>"p","П"=>"p",
			"р"=>"r","Р"=>"r",
			"с"=>"s","С"=>"s",
			"т"=>"t","Т"=>"t",
			"у"=>"u","У"=>"u",
			"ф"=>"f","Ф"=>"f",
			"х"=>"h","Х"=>"h",
			"ц"=>"c","Ц"=>"c",
			"ч"=>"ch","Ч"=>"ch",
			"ш"=>"sh","Ш"=>"sh",
			"щ"=>"sch","Щ"=>"sch",
			"ъ"=>"","Ъ"=>"",
			"ы"=>"y","Ы"=>"y",
			"ь"=>"","Ь"=>"",
			"э"=>"e","Э"=>"e",
			"ю"=>"yu","Ю"=>"yu",
			"я"=>"ya","Я"=>"ya",
			"і"=>"i","І"=>"i",
			"ї"=>"yi","Ї"=>"yi",
			"є"=>"e","Є"=>"e"
		);
		return $str = iconv("UTF-8", "UTF-8//IGNORE", strtr($string, $replace));
		// return $str = strtr($string, $replace);
    }

    function conv4send ($string) {	//	converts STRING for SITE-showing
        return iconv("UTF-8", "CP1251", $string);
    }
    
    $objReader = new PHPExcel_Reader_Excel5();
	$objPHPExcel = $objReader->load('bindings.xls');
	$objWorksheet = $objPHPExcel->getActiveSheet();
    $highestRow = $objWorksheet->getHighestRow();
    
    echo "ROWS :  ".$highestRow."<br><br>";

    $mapping = array (
        'comp_id' => "A",
        'dep_id' => "B",
        'g_inner_id' => "C",
        'g_inner_name' => "D",
        'g_comp_id' => "E",
        'ident' => "F",
        'is_active' => "G"
    );

    $sql = "INSERT INTO bindings (";
    $vals = "\r\n(:";
    foreach ($mapping as $key => $value) {
        $sql .= $key . ", ";
        $vals .= $key . ", :";
    }
    $sql = substr($sql, 0, -2) . ") VALUES";
    $vals = substr($vals, 0, -3) . ")";
    $sql = $sql . $vals;

    $STH = $DBH->prepare($sql);

    for ($row = 2; $row <= $highestRow; $row++) {
        $data = array();
        foreach ($mapping as $key => $value) {
            // $data[$key] = iconv("UTF-8", "CP1251", $objWorksheet->getCell($value.$row)->getValue());
            $data[$key] = $objWorksheet->getCell($value.$row)->getValue();
        }
        $STH->execute($data);
    }
    
    $STH = null;

    echo "<br><br>DONE";

	$objPHPExcel->disconnectWorksheets();
    unset($objPHPExcel);
    
    $DBH = null;
?>