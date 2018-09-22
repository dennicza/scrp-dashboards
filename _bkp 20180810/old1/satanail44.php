<?php
	session_start ();
	require_once ('functions.php');

	$arr = array ('dev', 'qba', 'dnk');
?>

<div><?php print_r (lstSpec ($arr, $_GET['spec'])); ?></div>

<hr>

<?php print_r (getApplicats ($_GET['spec'])); ?>

<script type="text/javascript">
	function getApplicants (spec) {
		if (!spec.length) {
			window.location='/satanail44.php';
		} else {
			window.location='/satanail44.php/?spec=' + spec;
		}
	}
</script>

