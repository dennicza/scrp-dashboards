<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'competitors';
?>

<?php echo renderHeader ($table); ?>

<?php echo renderNav(); ?>

    <div class="container-fluid under_nav">
        <?php echo renderFilters (); ?>
    </div>

    <div class="container-fluid">
        <?php print_r ( renderCompetitors( getTable( $DBH, $table ) ) ); ?>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="download">Вивантажити в Excel</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table, true); ?>