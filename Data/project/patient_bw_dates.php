<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
	$str="report";
	$menu="rep_bwdate";
	include_once("connect.php");
	include_once("global.php");
	include_once("function.php");
	include_once("paging.php");
	
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
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
<?php include_once("datepicker/dropdown-month-year.php");?>
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("report_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="data-16"></span><h3>Patient Between Dates</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							<!--<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">-->
								<div class="section-input"><input  name="txtfromdate"  class="i-text required wid" type="text" placeholder="Start Date" id="from" required></div>
								<div class="section-input"><input name="txttodate" class="i-text required wid" type="text" placeholder="End Date" id="to" required></div>
								<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:right;">
<!-- 							</div> -->
							<div class="clearfix"></div>
							<input type="hidden" name="hid" value="1">
						<?php
							include_once("patient_bw_dates_code.php");
						?>
						</section>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	</div>
</body>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>