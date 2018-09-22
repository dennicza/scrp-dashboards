<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST']);
    
    $table = 'users';
    $subtitle = 'register';
?>

<?php echo renderHeader ($table, $subtitle); ?>

    <div class="container-fluid">
        <div class="row mt-5 col-md-4 centered">
            <div class="form-group col-md-12">
                <label for="sname">Прізвище</label>
                <input type="text" class="form-control" id="sname" placeholder="Введіть Ваше прізвище">
            </div>
            <div class="form-group col-md-12">
                <label for="name">Ім'я</label>
                <input type="text" class="form-control" id="name" placeholder="Введіть Ваше ім'я">
            </div>
            <div class="form-group col-md-12">
                <label for="fname">По-батькові</label>
                <input type="text" class="form-control" id="fname" placeholder="Введіть Ваше по-батькові">
            </div>

            <div class="form-group mt-3 col-md-12">
                <label for="email">Адреса електронної пошти</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введіть електронну адресу Вашої пошти">
            </div>
            <div class="form-group col-md-12">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="pass" placeholder="Задайте пароль">
            </div>

            <nav class="navbar navbar-light bg-light mt-4 col-md-12">
                <button type="button" class="btn btn-outline-primary" id="register">Зареєструватися</button>
                <button type="button" class="btn btn-outline-warning" id="go2login">Вже маю аккаунт</button>
            </nav>
        </div>
    </div>

<?php $DBH = null; ?>

<?php echo renderFooter0 (); ?>