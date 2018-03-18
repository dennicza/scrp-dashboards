<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'bindings';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <title><?php echo ucfirst($table); ?> | Edit item</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body data-table="<?php echo $table; ?>">
<?php
    if (isset($_GET['bind_id']) && isset($_GET['comp_id']) && isset($_GET['dep_id']) && isset($_GET['g_comp_id'])) {

        $inner = getBindingByID ($DBH, $_GET['bind_id']);
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getCompetitors($DBH), $_GET['comp_id'], 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку'); ?>
            </div>

             <div class="col-md-6 mb-3" id="comp_goods">
                <?php echo renderDDL(getGCompet($DBH, $_GET['comp_id']), $_GET['g_comp_id'], 'g_comp_id', 'Назва товару конкурента', 'Треба обрати назву товару конкурента зі списку'); ?>
            </div>

           <div class="col-md-3 mb-3">
                <?php echo renderDDL(getDepartments($DBH), $_GET['dep_id'], 'dep_id', 'Департаменти', 'Треба обрати департамент зі списку'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderInput('g_inner_id', 'Артикул в обліковій системі', $inner['g_inner_id'], 'Треба ввести артикул товару в обліковій системі'); ?>
            </div>

            <div class="col-md-9 mb-3">
                <?php echo renderInput('g_inner_name', 'Назва товару в обліковій системі', $inner['g_inner_name'], 'Треба ввести назву товару в обліковій системі') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderChbx ('ident', $inner['ident'], 'Статус ідентичності товару') ?>
            </div>

            <div class="col-md-3 mb-3">
                <?php echo renderChbx ('is_active', $inner['is_active'], 'Статус активності товару') ?>
            </div>
        </div>

    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" data-binding="<?php echo $_GET['bind_id']; ?>" id="upd2db">Зберегти зміни</button>
    </nav>

    <?php
        $DBH = null;
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- <script src="../js/bootstrap.js"></script>
    <script src="../js/filters.js"></script>
    <script src="../js/date.js"></script>
    <script src="../js/xls.js"></script> -->

    <script src="js/edit.js"></script>
    
<?php } ?>
</body>
</html>