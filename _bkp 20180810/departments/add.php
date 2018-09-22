<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'departments';
    $subtitle = 'Add item';
?>

<?php echo renderHeader ($table, $subtitle); ?>

<?php echo renderNav(); ?>

<?php
    $qr = '';
    foreach ($_GET as $key => $value) {
        $qr .= '&' . $key . '=' . $value;
    }
?>

    <div class="container-fluid under_nav">
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
        <button type="button" class="btn btn-outline-primary" id="save2db" data-query="<?php echo substr($qr, 1); ?>">Зберегти запис</button>
        <button type="button" class="btn btn-outline-warning" id="cancel" data-query="<?php echo substr($qr, 1); ?>">Скасувати</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooterSpec ($table, 'add'); ?>