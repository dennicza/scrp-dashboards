<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'aggregators';
    $subtitle = 'Edit item';
?>
    
<?php echo renderHeader ($table, $subtitle); ?>

<?php echo renderNav(); ?>
    
<?php
    if (isset($_GET['lnk'])) {

        $row = getAggrRow ($DBH, $_GET['lnk']);
?>

    <div class="container-fluid under_nav">
        <div class="row">
            <div class="col-md-3 mb-3" id="comp_goods">
                <?php echo renderDDL(getAggregators($DBH), $row['aggr_id'], 'aggr_id', 'Агрегатор', 'Треба обрати агрегатор зі списку'); ?>
            </div>
            
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getCompetitors($DBH), $row['comp_id'], 'comp_id', 'Конкуренти', 'Треба обрати конкурента зі списку', 1); ?>
            </div>

            <div class="col-md-6 mb-3">
                <?php echo renderInput('aggr_comp_name', 'Назва конкуренту в агрегатора', $row['aggr_comp_name'], 'Треба ввести назву конкуренту в агрегатора') ?>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" data-lnk="<?php echo $_GET['lnk']; ?>" id="upd2db">Зберегти зміни</button>
        <button type="button" class="btn btn-outline-warning" id="cancel">Скасувати</button>
    </nav>

<?php $DBH = null; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="../js/nav.js"></script>
    <script src="js/edit.js"></script>

<?php } ?>
</body>
</html>