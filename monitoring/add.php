<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'monitoring';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <title><?php echo ucfirst($table); ?> | Add item</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body data-table="<?php echo $table; ?>">

    <div class="container-fluid">
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
                <?php echo renderInput('start_0', 'Перший запуск моніторингу (в форматі <b>YYYY-mm-dd</b>)', '2018-03-19', 'Треба ввести дату першого запуску моніторингу'); ?>
            </div>

            <div class="col-md-3 mt-5">
                <?php echo renderChbx ('is_active', 1, 'Статус активності моніторингу') ?>
            </div>
        </div>

    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save2db">Зберегти моніторинг</button>
    </nav>

    <?php
        $DBH = null;
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/add.js"></script>
</body>
</html>