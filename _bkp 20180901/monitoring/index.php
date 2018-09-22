<?php
    require_once 'functions.php';
    $DBH = dbConnection ();

    if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
    
    $table = 'monitoring';

    if (!isset($_GET['p']) || !$_GET['p']) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' . $table . '/?p=1');
    $per_page = 500;
    $page = isset($_GET['p']) ? $_GET['p'] : 1;
    unset($_GET['p']);

    $max = getRowsCount( $DBH, $table, $_GET );
    $am = ceil($max / $per_page);
    if ($am < $page ) {
        $location = 'Location: http://' . $_SERVER['HTTP_HOST'] . '/' . $table . '/?p=' . $am;
        foreach ($_GET as $key => $val) {
            $location .= '&' . $key . '=' . $val;
        }
        header($location);
    }
?>

<?php echo renderHeader ($table); ?>

<?php echo renderNav(); ?>

    <div class="container-fluid under_nav">
        <?php echo renderFilters ($DBH); ?>
    </div>

    <div class="container-fluid">
        <?php
            $arr = getTableFiltered ($DBH, $table, $page, $_GET);
            // print_r ($arr);
            print_r ( renderTable ( $arr , $page, $per_page ) );
        ?>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <button type="button" class="btn btn-outline-info" id="go2add">Додати рядок</button>
        <button type="button" class="btn btn-outline-warning" id="go2edit">Редагувати рядок</button>
        <button type="button" class="btn btn-outline-danger" id="delete">Видалити рядок</button>

        <button type="button" class="btn btn-outline-primary" id="download">Вивантажити в Excel</button>
        <select id="pages">
            <?php 
                for ($i = 1; $i <= $am; $i++) {
                    $from = 1 + ($i - 1) * $per_page;
                    $to = $i * $per_page;
                    $to = $to > $max ? $max : $to;

                    if ($i == $page) {
                        echo "<option value='{$i}' selected>" . $i . " [" . $from . " - " . $to . "]</option>";
                    } else {
                        echo "<option value='{$i}'>" . $i . " [" . $from . " - " . $to . "]</option>";
                    }
                }
            ?>
        </select>
    </nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table, true); ?>