
<input type="text" id="email">
<button id="save">Save email</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	
	$("#save").click(function() {
		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: { email: $("#email").val() }
		})
		.done(function( msg ) {
			if (msg > 0) {
				alert( msg );
			} else {
				alert ('Something went wrong\n\nPlease try again');
			}
		});
	});

</script>
