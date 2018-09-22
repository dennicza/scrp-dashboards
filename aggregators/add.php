<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'aggregators';
    $subtitle = 'Add linking';
?>

<?php echo renderHeader ($table, $subtitle); ?>

<?php echo renderNav(); ?>

    <div class="container-fluid under_nav">
            <div class="col-md-3 mb-3" id="comp_goods">
                <?php echo renderDDL(getAggregators($DBH), 0, 'aggr_id', 'Агрегатор', 'Треба обрати агрегатор зі списку'); ?>
            </div>
            
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getCompetitors($DBH), 0, 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку'); ?>
            </div>

            <div class="col-md-6 mb-3">
                <?php echo renderInput('aggr_comp_name', 'Назва конкуренту в агрегатора', '', 'Треба ввести назву конкуренту в агрегатора') ?>
            </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save2db">Зберегти запис</button>
        <button type="button" class="btn btn-outline-warning" id="cancel">Скасувати</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooterSpec ($table, 'add'); ?>