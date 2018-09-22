<?php
    date_default_timezone_set ('Europe/Kiev');
    require_once 'functions.php';
    $DBH = dbConnection ();
    $table = 'main';
?>

<?php echo renderHeader ($table); ?>

    <div class="container-fluid">
        <div class="row mt-5">
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="bindings">Зв'язування</button>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="bindings-import">Імпортувати зв'язування</button><br>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="monitoring">Планування моніторингів</button><br>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="departments">Департаменти</button><br>
			</div>
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-link" id="competitors">Конкуренти</button><br>
			</div>
        </div>
	</div>

	<nav class="navbar navbar-light bg-light">
		<button type="button" class="btn btn-outline-warning" id="logout">Вийти</button>
	</nav>

<?php $DBH = null; ?>

<?php echo renderFooter ($table); ?>