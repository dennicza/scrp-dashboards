<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'departments';
    $subtitle = 'Edit item';
?>
    
<?php echo renderHeader ($table, $subtitle); ?>

<?php echo renderNav(); ?>
    
<?php
    if (isset($_GET['id'])) {

        $inner = getDepartmentByID ($DBH, $_GET['id']);
        $query = $_GET;
        $qr = '';
        foreach ($query as $key => $value) {
            $qr .= '&' . $key . '=' . $value;
        }

        print_r ($query);
?>

    <div class="container-fluid under_nav">
        <div class="row">
            <div class="col-md-3 mb-3">
                <?php echo renderDDL(getBranches($DBH), $inner['branch_id'], 'branch_id', 'Відділи', 'Треба обрати відділ зі списку'); ?>
            </div>
            <div class="col-md-3 mb-3">
                <?php echo renderInput('id', 'ID департаменту в обліковій системі', $_GET['id'], 'Треба ввести ID департаменту в обліковій системі') ?>
            </div>
            <div class="col-md-6 mb-3">
                <?php echo renderInput('name', 'Назва департаменту', $inner['name'], 'Треба ввести назву департаменту в обліковій системі'); ?>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-primary" data-department="<?php echo $_GET['id']; ?>" id="upd2db" data-query="<?php echo substr($qr, 1); ?>">Зберегти зміни</button>
        <button type="button" class="btn btn-outline-warning" id="cancel" data-query="<?php echo substr($qr, 1); ?>">Скасувати</button>
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