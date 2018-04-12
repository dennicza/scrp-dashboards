<?php
    require_once 'functions.php';
	$DBH = dbConnection ();
	
	if (!isUAC($DBH)) header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    $table = 'main';
?>

<?php echo renderHeader ($table); ?>

    <div class="container-fluid">
        <div class="row mt-5">
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="competitors">Конкуренти</button>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="departments">Департаменти</button>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="monitoring">Розклад моніторингів</button>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="bindings">Зв’язування артикулів</button>
			</div>
			
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="results">Результати моніторингів</button>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" disabled id="stat">Статус монітор</button>
			</div>
        </div>
	</div>

	<nav class="navbar navbar-light bg-light">
		<button type="button" class="btn btn-outline-warning" id="logout">Вийти</button>
	</nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table); ?>