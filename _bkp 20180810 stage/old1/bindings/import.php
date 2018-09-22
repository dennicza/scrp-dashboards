<?php
	require_once 'ajax_imp.php';
	$DBH = dbConnection ();

	if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'bindings';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <title><?php echo ucfirst($table); ?> | Import</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/upload.css">
</head>
<body data-table="<?php echo $table; ?>">

	<div class="container-fluid mt-3 mb-3">
		<div class="row">
			<div class="col-md-6">
				<label class="custom-file" id="customFile">
					<input type="file" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp" name="sortpic">
					<span class="custom-file-control form-control-file"></span>
				</label>
				<button type="button" class="btn btn-outline-info" id="upload">Завантажити файл 'bindings.xls'</button>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-outline-primary" id="import">Імпортувати з Excel</button>
			</div>
		</div>
	</div>

	<div class="container-fluid" id="res"></div>

<?php
	$DBH = null;
?>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
  	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

    <script src="js/import.js"></script>

</body>
</html>