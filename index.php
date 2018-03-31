<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'bindings';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <title><?php echo ucfirst($table); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/edit.css">
</head>
<body data-table="<?php echo $table; ?>">
<input type="text" id="email">
<button id="save">Save email</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	
	$("#save").click(function() {
		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: { email: $("#email").val() }
		})
		.done(function( msg ) {
			if (msg > 0) {
				alert( msg );
			} else {
				alert ('Something went wrong\n\nPlease try again');
			}
		});
	});

</script>
