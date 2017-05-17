<?php
	include_once "fun.php";	
	session_start();
	if(isset($_SESSION['adminid']))
	{
	$menu="address";
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
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jq.js" type="text/javascript"></script>
	<script src="js/medicine.js" type="text/javascript"></script>
</HEAD>

<BODY>
<?php
	include_once "heading.php";
?>
<div id="container">
	<?php
		include_once "admin_menu.php";
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Add Data</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="#" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin"></h4></section>
						<section class="no-padding">
						<ul class="list">
							<li>
								<label for="text_field">State_name</label> 
							</li>
							<li class="wid-auto">
							<?php
								$result=sel_state();
							?>
						<input type="text" list="state_name" name="txtsname" id="state1" />
						<datalist id="state_name">
						<?php
							$cnt=0;
							while($cnt < count($result['id']))
							{
								$res=$result['state_name'][$cnt];
								echo "<option value='$res'>".$res."</option>";
								$cnt++;		
							}
						?>
						</datalist>
							</li>
							<div class="clearfix"></div>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
							<li>
								<label for="text_field">City_name</label> 
							</li>
							<li class="wid-auto">
							<?php
								$result=sel_city();
							?>
						<input type="text" list="city_name" name="txtcname" id="city1" />
						<datalist id="city_name">
						<?php
							$cnt=0;
							while($cnt < count($result['id']))
							{
								$res=$result['city_name'][$cnt];
								echo "<option value='$res'>".$res."</option>";
								$cnt++;		
							}
						?>
						</datalist>
							</li>
							<div class="clearfix"></div>
							</ul>
						<div class="clearfix"></div>
							<ul class="list">
							<li>
								<label for="text_field">Area_name</label> 
							</li>
							<li class="wid-auto">
							<?php
								$result=sel_area();
							?>
						<input type="text" list="area_name" name="txtaname" id="area1" />
						<datalist id="area_name">
						<?php
							$cnt=0;
							while($cnt < count($result['id']))
							{
								$res=$result['area_name'][$cnt];
								echo "<option value='$res'>".$res."</option>";
								$cnt++;		
							}
						?>
						</datalist>
							</li>
							<div class="clearfix"></div>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
							<li>
								<label for="text_field">pincode</label> 
							</li>
							<li class="wid-auto">
							<?php
								$result=sel_area();
							?>
						<input type="text" list="pincode" name="txtpincode" id="area1" />
						<datalist id="pincode">
						<?php
							$cnt=0;
							while($cnt < count($result['id']))
							{
								$res=$result['pincode'][$cnt];
								echo "<option value='$res'>".$res."</option>";
								$cnt++;		
							}
						?>
						</datalist>
							</li>
							<div class="clearfix"></div>
							</ul>
												
							<div class="clearfix"></div>
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float">
										<input class="icon16-button forms-16" value="Add" name="btnsubmit" id="addtime" type="submit"></div> 
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
						<section>
                        	<?php include_once("add_proc.php");?>
                        </section>
			<div class="clearfix"></div>
				</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/multiselect.js" type="text/javascript"></script>
<script type="text/javascript"> 
	var config = {
	'.chzn-select'           : {},
	'.chzn-select-deselect'  : {allow_single_deselect:true},
	'.chzn-select-no-single' : {disable_search_threshold:10},
	'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
	'.chzn-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	$(selector).chosen(config[selector]);
	}
</script>
</BODY>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>
