<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'departments';
    $subtitle = 'Add item';
?>

<?php echo renderHeader ($table, $subtitle); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getBranches($DBH), 0, 'branch_id', 'Відділи', 'Треба обрати відділ зі списку'); ?>
            </div>
            <div class="col-md-3 mb-3">
                <?php echo renderInput('id', 'ID департаменту в обліковій системі', '', 'Треба ввести ID департаменту в обліковій системі') ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php echo renderInput('name', 'Назва департаменту', '', 'Треба ввести назву департаменту в обліковій системі'); ?>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save2db">Зберегти запис</button>
        <button type="button" class="btn btn-outline-warning" id="cancel">Відміна</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooterSpec ($table, 'add'); ?>