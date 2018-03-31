<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'users';
    $subtitle = 'register';
?>

<?php echo renderHeader ($table, $subtitle); ?>

    <div class="container-fluid">
        <div class="row  mt-3">
            <div class="form-group col-md-4">
                <label for="sname">Прізвище</label>
                <input type="text" class="form-control" id="sname" placeholder="Введіть ваше прізвище">
            </div>
            <div class="form-group col-md-4">
                <label for="name">Ім'я</label>
                <input type="text" class="form-control" id="name" placeholder="Введіть Ваше ім'я">
            </div>
            <div class="form-group col-md-4">
                <label for="fname">По-батькові</label>
                <input type="text" class="form-control" id="fname" placeholder="Введіть Ваше по-батькові">
            </div>
        </div>

        <div class="row  mt-3">
            <div class="form-group col-md-4">
                <label for="email">Адреса електронної пошти</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введіть електронну адресу вашої пошти">
            </div>
            <div class="form-group col-md-4">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="Задайте пароль">
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" id="save">Зареєструватися</button>
        <button type="button" class="btn btn-outline-success" id="cancel">Вже маю аккаунт</button>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table); ?>