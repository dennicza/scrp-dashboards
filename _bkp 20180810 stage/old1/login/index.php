<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST']);

    $table = 'users';
    $subtitle = 'login';
?>

<?php echo renderHeader ($table, $subtitle); ?>

    <div class="container-fluid">
        <div class="row mt-5 col-md-4 centered">
            <div class="form-group col-md-12">
                <label for="email">Адреса електронної пошти</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введіть електронну адресу Вашої пошти">
            </div>
            <div class="form-group col-md-12">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="pass" placeholder="Введіть Ваш пароль">
            </div>

            <nav class="navbar navbar-light bg-light mt-4 col-md-12">
                <button type="button" class="btn btn-outline-primary" id="login">Авторизуватися</button>
                <button type="button" class="btn btn-outline-warning" id="go2register">Створити аккаунт</button>
            </nav>
        </div>
    </div>

<?php $DBH = null; ?>

<?php echo renderFooter ($table); ?>