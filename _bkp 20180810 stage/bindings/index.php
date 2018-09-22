<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'bindings';
?>

<?php echo renderHeader ($table); ?>

<?php echo renderNav(); ?>

    <div class="container-fluid under_nav">
        <?php echo renderFilters (); ?>
    </div>

    <div class="container-fluid">
        <?php print_r ( renderBindings( getTable( $DBH, $table ) ) ); ?>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-info" id="go2add">Додати рядок</button>
        <button type="button" class="btn btn-outline-warning" id="go2edit">Редагувати рядок</button>
        <button type="button" class="btn btn-outline-danger" id="delete">Видалити рядок</button>

        <button type="button" class="btn btn-outline-success" id="import">Завантажити з Excel</button>
        <button type="button" class="btn btn-outline-dark" id="template">Отримати шаблон для завантаження</button>
        <button type="button" class="btn btn-outline-primary" id="download">Вивантажити в Excel</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table, true); ?>