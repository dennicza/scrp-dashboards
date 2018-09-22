<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
    
    $table = 'monitoring';
?>

<?php echo renderHeader ($table); ?>

    <div class="container-fluid">
        <?php echo renderFilters (); ?>
    </div>

    <div class="container-fluid">
        <?php print_r ( renderMonitorings( getTable( $DBH, $table ) ) ); ?>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-info" id="go2add">Додати рядок</button>
        <button type="button" class="btn btn-outline-warning" id="go2edit">Редагувати рядок</button>
        <button type="button" class="btn btn-outline-danger" id="delete">Видалити рядок</button>

        <button type="button" class="btn btn-outline-primary" id="download">Вивантажити в Excel</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table, true); ?>