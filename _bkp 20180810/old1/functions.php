<?php

date_default_timezone_set('Europe/Kiev');

function dbConnection () {
	$host = 'ashost.mysql.ukraine.com.ua';
	$dbname = 'ashost_poligon';
	$user = 'ashost_poligon';
	$pass = '3dsh3l78';
	$encoding = 'utf8';

	$dsn = "mysql:host=$host;dbname=$dbname;charset=$encoding";
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);

	try {
		$DBH = new PDO($dsn, $user, $pass, $options);
	}
	catch(PDOException $e) {
		echo 'Connection aborted: '.$e->getMessage();
	}
	return $DBH;
}

function date2id () {
	return date ("Y-m-d H:i:s");
}

function conv4send ($string) {	//	converts STRING for SITE-showing
	return iconv("UTF-8", "CP1251", $string);
}

function getLetter ($post) {
	$msg = "<div>\r\n";
	$msg .= "<p>Name : <b>{$post[name]}</b></p>\r\n";
	$msg .= "<p>E-mail : <b>{$post[email]}</b></p>\r\n";
	$msg .= "<p>Phone : <b>{$post[phone]}</b></p>\r\n";
	$msg .= "<p>Spec : <b>{$post[spec]}</b></p>\r\n";
	$msg .= "</div>\r\n";
	return $msg;
}

function user2db ($post) {
	$DBH = dbConnection ();
	$sql = "INSERT INTO landing16 (name, phone, email, spec, dt) values (:name, :phone, :email, :spec, SYSDATE())";
	$STH = $DBH->prepare($sql);
	$data = array('name' => $post['name'], 'phone' => $post['phone'], 'email' => $post['email'], 'spec' => $post['spec']);
	$STH->execute($data);
	$user = $DBH->lastInsertId();
	$STH = null;
	$DBH = null;
	return $user;
}

function sndMail ($post) {
	$to  = "ADMIN <dennicza@gmail.com>\r\n";
	$to .= ", MANAGER <tetiana.k.ua@gmail.com>\r\n";
	
	$subject = conv4send("BU Summer Camp - Request")."\r\n";
	
	$message = getLetter ($post);
	$message = wordwrap($message,70);
	$message .= "\r\n";
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: BU Summer Camp <noreply@promo.net.ua>\r\n";
	mail($to, $subject, $message, $headers);
}


function admin2db ($user) {
	$DBH = dbConnection ();
	$sql = "SELECT id FROM admin WHERE email = '".$user['email']."'";
	$STH = $DBH->query($sql);
	$row = $STH->fetchAll(PDO::FETCH_ASSOC);
	if (count ($row)) {
		return 0;
		$STH = null;
		$DBH = null;
	}

	// CRYPT_SHA512 = 1;
	// $user['password'] = crypt($user['password'], $user['email']);
	$user['password'] = hash('sha512', $user['password']);

	$sql = "INSERT INTO admin (email, password, name, dt) values (:email, :password, :name, SYSDATE())";
	$STH = $DBH->prepare($sql);
	$data = array('email' => $user['email'], 'password' => $user['password'], 'name' => $user['name']);
	$STH->execute($data);
	$id = $DBH->lastInsertId();
	$STH = null;
	$DBH = null;
	return $id;
}

function getAdmin ($hash) {
	$DBH = dbConnection ();
	$sql = "SELECT id FROM admin WHERE email = '".$user['email']."'";
	$STH = $DBH->query($sql);
	$row = $STH->fetchAll(PDO::FETCH_ASSOC);
	$STH = null;
	$DBH = null;
	if (!count($row)) return [];
	return $row[0];
}

function getApplicats ($spec = null) {
	$DBH = dbConnection ();
	$msg = "<h2>".getSpec ($spec)."</h2>\r\n";
	$msg .= "<table>\r\n";
	$msg .= visAplicantTtl($spec);
	if (!empty ($spec)) {
		$sql = "SELECT * FROM landing16 WHERE spec = '{$spec}'";
	} else {
		$sql = "SELECT * FROM landing16";
	}
	$STH = $DBH->query($sql);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$i = 1;
	while ($row = $STH->fetch()) {
		$msg .= visAplicant($row, $i++, $spec);
	}
	$STH = null;
	$DBH = null;
	$msg .= "</table>\r\n";
	return $msg;
}

function getSpec ($spec = null) {
	switch ($spec) {
		case 'dev':
			return "Front-End";
			break;
		case 'qba':
			return "QA / BA";
			break;
		case 'dnk':
			return "Ya Ulidka";
			break;
		default:
			return "All Applicants";
			break;
	}
}

function lstSpec ($arr, $get = null) {
	$msg = "<select onchange='getApplicants(this.value);'>\r\n";
	if (!empty ($get)) {
		$msg .= "<option value=''>All Applicants</option>\r\n";
		foreach ($arr as $spec) {
			if ($spec === $get) {
				$msg .= "<option value='{$spec}' selected>".getSpec ($spec)."</option>\r\n";
			} else {
				$msg .= "<option value='{$spec}'>".getSpec ($spec)."</option>\r\n";
			}
		}
	} else {
		$msg .= "<option value='' selected>All Applicants</option>\r\n";
		foreach ($arr as $spec) {
			$msg .= "<option value='{$spec}'>".getSpec ($spec)."</option>\r\n";
		}
	}
	$msg .= "</select>\r\n";
	return $msg;
}

function visAplicant($aplicant, $i, $spec = null) {
	$msg = "<tr>\r\n";
	$msg .= "<td>{$i}</td>\r\n";
	$msg .= "<td>{$aplicant[name]}</td>\r\n";
	$msg .= "<td>{$aplicant[phone]}</td>\r\n";
	$msg .= "<td>{$aplicant[email]}</td>\r\n";
	
	if (empty ($spec)) $msg .= "<td>{$aplicant[spec]}</td>\r\n";

	$msg .= "</tr>\r\n";
	
	return $msg;
}

function visAplicantTtl($spec = null) {
	$msg = "<th>\r\n";
	$msg .= "<td>#</td>\r\n";
	$msg .= "<td>Name</td>\r\n";
	$msg .= "<td>Phone</td>\r\n";
	$msg .= "<td>Email</td>\r\n";

	if (empty ($spec)) $msg .= "<td>Spec</td>\r\n";
		
	$msg .= "</th>\r\n";

	return $msg;
}

?>