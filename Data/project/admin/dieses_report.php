<?php
	$menu="dieses";
	$fdir = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Docters Helper</TITLE>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	<?php 
		include_once("datepicker/dropdown-month-year.php");
		include_once("function.php");
		include_once("global.php");
	?>
	</HEAD>

<BODY>
<?php include_once("heading.php");?>
<div id="container">
	<?php include_once("admin_menu.php");?>
	
<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="data-16"></span><h3>Area wise Dieses count</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							<!--<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">-->
								<div class="section-input"><input  name="txtfromdate"  class="i-text required wid" type="text" placeholder="Start Date" id="from"></div>
								<div class="section-input"><input name="txttodate" class="i-text required wid" type="text" placeholder="End Date" id="to"></div>
								<div class="section-input"><input  name="dieses"  class="i-text required wid" type="text" placeholder="Dieses Name" id="from"></div>
								<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:right;">
							<div class="clearfix"></div>
							<input type="hidden" name="hid" value="1">
							
						</section>
					</fieldset>
				</form>
				<?php
								include_once("dieses_code.php");
	?>
			</div>
			
		</div>
	</div>
	</div>

</BODY>
</html>