<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'bindings';
    $subtitle = 'Add item';
?>

<?php echo renderHeader ($table, $subtitle); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getCompetitors($DBH), 0, 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку'); ?>
            </div>

             <div class="col-md-6 mb-3" id="comp_goods">
                <?php echo renderDDL(getGCompet($DBH, 0), 0, 'g_comp_id', 'Назва товару конкурента', 'Треба обрати назву товару конкурента зі списку'); ?>
            </div>

           <div class="col-md-3 mb-3">
                <?php echo renderDDL(getDepartments($DBH), 0, 'dep_id', 'Департаменти', 'Треба обрати департамент зі списку'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderInput('g_inner_id', 'Артикул в обліковій системі', '', 'Треба ввести артикул товару в обліковій системі'); ?>
            </div>

            <div class="col-md-9 mb-3">
                <?php echo renderInput('g_inner_name', 'Назва товару в обліковій системі', '', 'Треба ввести назву товару в обліковій системі') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderChbx ('ident', 1, 'Статус ідентичності товару') ?>
            </div>

            <div class="col-md-3 mb-3">
                <?php echo renderChbx ('is_active', 1, 'Статус активності товару') ?>
            </div>
        </div>

    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save2db">Зберегти зв'язування</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooterSpec ($table, 'add'); ?>