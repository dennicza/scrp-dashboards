<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'monitoring';
    $subtitle = 'Edit item';
?>

<?php echo renderHeader ($table, $subtitle); ?>

<?php
    if (isset($_GET['monit_id']) && isset($_GET['comp_id']) && isset($_GET['dep_id'])) {

        $inner = getMonitoringByID ($DBH, $_GET['monit_id']);
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mt-3">
                <?php echo renderDDL(getCompetitors($DBH), $_GET['comp_id'], 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку'); ?>
            </div>

            <div class="col-md-6 mt-3">
                <?php echo renderDDL(getDepartments($DBH), $_GET['dep_id'], 'dep_id', 'Департаменти', 'Треба обрати департамент зі списку'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mt-5">
                <?php echo renderDDL(array([1, '1 раз на 4 тижні'], [2, '2 рази на 4 тижні'], [4, '4 рази на 4 тижні']), $inner['frequency'], 'frequency', 'Частота моніторингів', 'Треба обрати частоту зі списку'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderDDL(array([0, 'Понеділок'], [1, 'Вівторок'], [2, 'Середа'], [3, 'Четвер'], [4, 'П`ятниця'], [5, 'Субота'], [6, 'Неділя']), $inner['week_day'], 'week_day', 'День тижня моніторингу', 'Треба обрати день тижня зі списку'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderInput('start_0', 'Перший запуск моніторингу (в форматі <b>YYYY-mm-dd</b>)', $inner['start_0'], 'Треба ввести дату першого запуску моніторингу'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderChbx ('is_active', $inner['is_active'], 'Статус активності моніторингу') ?>
            </div>
        </div>

    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" data-monitoring="<?php echo $_GET['monit_id']; ?>" id="upd2db">Зберегти зміни</button>
        <button type="button" class="btn btn-outline-warning" id="cancel">Відміна</button>
    </nav>

<?php  $DBH = null; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/edit.js"></script>
    
<?php } ?>
</body>
</html>