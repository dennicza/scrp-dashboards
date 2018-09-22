<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
    
    $table = 'monitoring';
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
            <div class="col-md-6 mt-3">
                <?php echo renderDDL(getCompetitors($DBH), 0, 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку'); ?>
            </div>

            <div class="col-md-6 mt-3">
                <?php echo renderDDL(getDepartments($DBH), 0, 'dep_id', 'Департаменти', 'Треба обрати департамент зі списку'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mt-5">
                <?php echo renderDDL(array([1, '1 раз на 4 тижні'], [2, '2 рази на 4 тижні'], [4, '4 рази на 4 тижні']), 0, 'frequency', 'Частота моніторингів', 'Треба обрати частоту зі списку'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderDDL(array([0, 'Понеділок'], [1, 'Вівторок'], [2, 'Середа'], [3, 'Четвер'], [4, 'П`ятниця'], [5, 'Субота'], [6, 'Неділя']), 0, 'week_day', 'День тижня моніторингу', 'Треба обрати день тижня зі списку'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderInput('start_0', 'Перший запуск моніторингу (в форматі <b>YYYY-mm-dd</b>)', '2018-04-05', 'Треба ввести дату першого запуску моніторингу'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderChbx ('is_active', 1, 'Статус активності моніторингу') ?>
            </div>
        </div>

    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save2db" data-query="<?php echo substr($qr, 1); ?>">Зберегти запис</button>
        <button type="button" class="btn btn-outline-warning" id="cancel" data-query="<?php echo substr($qr, 1); ?>">Скасувати</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooterSpec ($table, 'add'); ?>