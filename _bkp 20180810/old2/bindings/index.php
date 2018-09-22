<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'bindings';
?>

<?php echo renderHeader ($table); ?>

    <div class="container-fluid">
        <?php echo renderFilters (); ?>
    </div>

    <div class="container-fluid">
        <?php print_r ( renderBindings( getTable( $DBH, $table ) ) ); ?>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="download">Експортувати в Excel</button>
        <button type="button" class="btn btn-outline-info" id="go2add">Додати зв'язування</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table, true); ?>