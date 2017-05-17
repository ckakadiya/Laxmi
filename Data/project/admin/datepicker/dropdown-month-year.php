<?php
?>
	<link rel="stylesheet" href="datepicker/themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="datepicker/demos.css">
	<script src="datepicker/jq/jquery-1.10.2.js"></script>
	<script src="datepicker/jq/jquery.ui.core.js"></script>
	<script src="datepicker/jq/jquery.ui.widget.js"></script>
	<script src="datepicker/jq/jquery.ui.datepicker.js"></script>
    <script src="jq/jquery.ui.effect-slide.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker" ).datepicker( "option","showAnim", "slideDown" );
		
	});
	
	
	
	$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
	$(function() {
		$( "#from" ).datepicker();
		$( "#from" ).datepicker( "option","showAnim", "slideDown" );
		
	});

$(function() {
		$( "#to" ).datepicker();
		$( "#to" ).datepicker( "option","showAnim", "slideDown" );
		
	});

	
</script>
<?php
?>