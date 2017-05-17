<?php
	session_start();
	include_once("global.php");
	if(isset($_SESSION['cid']))
	{
		$str="report";
		$menu="rep_disease";
		include_once("function.php");
		
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
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">

<?php include_once("report_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="typography-16"></span><h3>Patient with Disease</h3></div>
			<div class="box-content no-padding">
				<form  method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							<!--<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">-->
								<div class="section-input">
								<input list="dieses"  name="dieses" class="i-text required wid" placeholder="Disease" required />
        								<datalist id="dieses">
				 							<?php 		 	
												$array_dieses=dieses();
												for($i=0;$i<count($array_dieses['name']);$i++)
												{
														echo "<option value=".$array_dieses['name'][$i].">";
												}
											 ?>
										</datalist>
            							<input type="hidden" name="hid" value="1">	
									</div>							
										<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:right;">
<!-- 							</div> -->
							<div class="clearfix"></div>
						</section>
						<?php
							include_once("disease_report_code.php");
						?>
</body>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>