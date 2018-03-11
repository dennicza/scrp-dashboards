<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'competitors';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo ucfirst($table); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body data-table="<?php echo $table; ?>">

<div class="container-fluid">

    <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">Назва конкуренту</span>
        </div>
        <input type="text" class="form-control filter" id="name" aria-describedby="basic-addon3">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary clear" data-clear="name" type="button">Clear</button>
        </div>
    </div>

    <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">ID конкуренту</span>
        </div>
        <input type="text" class="form-control filter" id="article" aria-describedby="basic-addon3">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary clear" data-clear="article" type="button">Clear</button>
        </div>
    </div>

    <div class="input-group input-group-sm mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">Адреса сайту</span>
        </div>
        <input type="text" class="form-control filter" id="url" aria-describedby="basic-addon3">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary clear" data-clear="url" type="button">Clear</button>
        </div>
    </div>

    <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Статус активності</span>
        </div>
        <input type="text" class="form-control filter" id="is_active" aria-describedby="basic-addon3">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary clear" data-clear="is_active" type="button">Clear</button>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php
        print_r ( renderCompetitors( getTable( $DBH, $table ) ) );
    ?>
</div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="download">Download</button>
    </nav>

<?php
    $DBH = null;
?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="../js/bootstrap.js"></script>
    <script src="../js/filters.js"></script>
    <script src="../js/date.js"></script>
    <script src="../js/xls.js"></script>

    <script src="js/index.js"></script>
</body>
</html>