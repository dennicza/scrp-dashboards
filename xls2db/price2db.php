<?php
	ini_set('memory_limit', '-1');
	require_once ($_SERVER['DOCUMENT_ROOT'].'/AShop/PHPExcel/PHPExcel.php');
	
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

	function c2id($c_name){
		$host = 'localhost';
		$dbname = 'ashop_db';
		$user = 'u_ashop_db';
		$pass = 'M8KlXNXF';
		try {
			$DBH_AS = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		}
		catch(PDOException $e) {
			echo 'Connection aborted: '.$e->getMessage();
		}

		$qwer = "SELECT term_id FROM as_terms WHERE name='".$c_name."'";
		$STH_AS = $DBH_AS->query($qwer);
		$STH_AS->setFetchMode(PDO::FETCH_ASSOC);
		$scat = $STH_AS->fetchAll();
		$STH_AS = null;

		if ($scat[0]['term_id']) {
			$qwer = "SELECT parent FROM as_term_taxonomy WHERE taxonomy='category' AND parent != '0' AND term_id='".$scat[0]['term_id']."'";
			$STH_AS = $DBH_AS->query($qwer);
			$STH_AS->setFetchMode(PDO::FETCH_ASSOC);
			$cat = $STH_AS->fetchAll();
			$STH_AS = null;

			if ($cat[0]['parent']) {
				return $cat[0]['parent']."_".$scat[0]['term_id'];
			}

			$qwer = "SELECT term_id FROM as_term_taxonomy WHERE taxonomy='category' AND parent='".$scat[0]['term_id']."'";
			$STH_AS = $DBH_AS->query($qwer);
			$STH_AS->setFetchMode(PDO::FETCH_ASSOC);
			$cat = $STH_AS->fetchAll();
			$STH_AS = null;

			if ($cat[0]['term_id']) {
				return '0';
			}

			return $scat[0]['term_id']."_0";
		}

		$DBH_AS = null;
		return "CHECK FOR THE CATEGORY NAME IN DB";
	}

	$objReader = new PHPExcel_Reader_Excel5();
	$objPHPExcel = $objReader->load('price2db.xls');
	$objWorksheet = $objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow();

	echo "ROWS :  ".$highestRow."<br /><br />";

	$p_title = "A";
	$articul = "B";
	$pack = "C";
	$price_cur = "D";
	$img = "B";

	$euro = chr(136);
	$dollar = chr(36);
	$uah = iconv("UTF-8", "CP1251", "грн");
	$rur = iconv("UTF-8", "CP1251", "р");

	$g_cats = "0_0";

	$host = 'localhost';
	$dbname = 'ashop_db';
	$user = 'u_ashop_db';
	$pass = 'M8KlXNXF';
	try {
		$DBH_AS = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	}
	catch(PDOException $e) {
		echo 'Connection aborted: '.$e->getMessage();
	}

	$qwer = "TRUNCATE TABLE as_warehouse";
	$STH_AS = $DBH_AS->prepare($qwer);
	$STH_AS->execute();
	$STH_AS = null;

	$qwer = "TRUNCATE TABLE as_term_relationships";
	$STH_AS = $DBH_AS->prepare($qwer);
	$STH_AS->execute();
	$STH_AS = null;
	$DBH_AS = null;

	for ($row = 1; $row <= $highestRow; $row++) {

		$good = $objWorksheet->getCell($p_title.$row)->getValue();
		$good = iconv("UTF-8", "CP1251", $good);

		$g_articul = $objWorksheet->getCell($articul.$row)->getValue();
		$g_articul = iconv("UTF-8", "CP1251", $g_articul);

		$g_pack = $objWorksheet->getCell($pack.$row)->getValue();
		$g_pack = iconv("UTF-8", "CP1251", $g_pack);

		$g_cur = $objWorksheet->getStyleByColumnAndRow(3, $row)->getNumberFormat()->getFormatCode();
		$g_price_cur = $objWorksheet->getCell($price_cur.$row)->getValue();
		$g_price_cur = iconv("UTF-8", "CP1251", $g_price_cur);

		$g_img = $objWorksheet->getCell($img.$row)->getValue();
		$g_img = strtolower(trim($g_img));
		$g_img = GetInTranslit($g_img);
		$g_img = str_replace(array("/", "\\", " "), "_", $g_img);
		// $g_img = iconv("UTF-8", "CP1251", $g_img);

		if ($good !== '' && $g_articul === '' && $g_pack === '' && $g_price_cur === '' && $g_img === ''){
			if (c2id(iconv("CP1251", "UTF-8", $good))) {
				// echo "CIDs :  ".c2id(iconv("CP1251", "UTF-8", $good))." => ".$good."<br /><br />";
				$g_cats = c2id(iconv("CP1251", "UTF-8", $good));
			}
			
		} else {
			$g_cur = iconv("UTF-8", "CP1251", $g_cur);
			$g_cur = preg_replace("/[0-9_\-\#,.\"' '\\\\[\]]/", "", $g_cur);
			$g_cur = preg_replace("/[$]{2}/", "USD", $g_cur);
			$g_cur = preg_replace("/[$]/", "", $g_cur);
			
			switch($g_cur) {
				case $euro: $g_cur = "EURO"; $g_cur_id = '1'; break;
				case $rur: $g_cur = "RUR"; $g_cur_id = '3'; break;
				case "USD": $g_cur_id = '2'; break;
				default: $g_cur = "UAH"; $g_cur_id = '0'; break;
			}

			$cats = array();
			$cats = explode("_", $g_cats);
			if (!($cats[0] + $cats[1])) {
				echo "ERROR WITH CATEGORY DETECTION";
				return false;
			}

			// $full_lenth = strlen($g_price_cur);
			// $int_pos = strpos($g_price_cur, ".") + 3;
			// if ($full_lenth > $int_pos) {
			// 	$g_price = substr($g_price_cur, 0, $int_pos);
			// 	$dec = substr($g_price_cur, $int_pos, 1);
			// 	if ($dec > 4){
			// 		$g_price = $g_price." + 0.01";
			// 	}
			// } else {
			// 	$g_price = $g_price_cur;
			// }
			$g_price = $g_price_cur * 100.0;

			$host = 'localhost';
			$dbname = 'ashop_db';
			$user = 'u_ashop_db';
			$pass = 'M8KlXNXF';
			try {
				$DBH_AS = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			}
			catch(PDOException $e) {
				echo 'Connection aborted: '.$e->getMessage();
			}

			if ($g_img) {
				$data = array('p_title' => iconv("CP1251", "UTF-8", $good), 'articul' => iconv("CP1251", "UTF-8", $g_articul), 'pack' => iconv("CP1251", "UTF-8", $g_pack), 'opt_price' => $g_price, 'currency' => $g_cur_id, 'img' => iconv("CP1251", "UTF-8", $g_img).".jpg");
				$qwer = "INSERT INTO as_warehouse (p_title, articul, pack, opt_price, currency, img) values (:p_title, :articul, :pack, :opt_price, :currency, :img)";
			} else {
				$data = array('p_title' => iconv("CP1251", "UTF-8", $good), 'articul' => iconv("CP1251", "UTF-8", $g_articul), 'pack' => iconv("CP1251", "UTF-8", $g_pack), 'opt_price' => $g_price, 'currency' => $g_cur_id);
				$qwer = "INSERT INTO as_warehouse (p_title, articul, pack, opt_price, currency) values (:p_title, :articul, :pack, :opt_price, :currency)";
			}
			$STH_AS = $DBH_AS->prepare($qwer);
			$STH_AS->execute($data);
			$pid = $DBH_AS->lastInsertId();
			$STH_AS = null;

			$data = array('object_id' => $pid, 'term_taxonomy_id' => $cats[0]);
			$qwer = "INSERT INTO as_term_relationships (object_id, term_taxonomy_id) values (:object_id, :term_taxonomy_id)";
			$STH_AS = $DBH_AS->prepare($qwer);
			$STH_AS->execute($data);
			$STH_AS = null;

			if ($cats[1]) {
				$data = array('object_id' => $pid, 'term_taxonomy_id' => $cats[1]);
				$qwer = "INSERT INTO as_term_relationships (object_id, term_taxonomy_id) values (:object_id, :term_taxonomy_id)";
				$STH_AS = $DBH_AS->prepare($qwer);
				$STH_AS->execute($data);
				$STH_AS = null;
			}

			$DBH_AS = null;

			echo "PRODUCT :<br />".$good."<br />";
			echo "CATEGORY: ".$cats[0]."<br />";
			// echo "SUB_CAT : ".$cats[1]."<br />";
			echo "ARTICUL : ".$g_articul."<br />";
			// echo "PACKING : ".$g_pack."<br />";
			// echo "G_PRICE : ".$g_price."<br />";
			// echo "CURRENCY: ".$g_cur."<br />";
			// echo "PICTURE : ".$g_img.".jpg<br /><br />";
		}
	}
	echo "<br />DONE";

	$objPHPExcel->disconnectWorksheets(); //Закрываем файл прайслиста
	unset($objPHPExcel); //Уничтожаем объект класса.
?>