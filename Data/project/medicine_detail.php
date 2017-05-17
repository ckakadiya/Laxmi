<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="medicine";
		//$menu="profile";
		include_once("global.php");
		include_once("function.php");
		include_once('paging.php');
		$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$meid=0;
		if(isset($_GET['id']))
		{
			$meid=$_GET['id'];
			//echo $meid;
		}
		$meinfo=selMedicine($meid);
		//echo $meinfo;
	
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
	<script src="js/mr.js" type="text/javascript"></script>
</HEAD>

<BODY>
 	
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "medicine_menu.php";
	?>


<div class="bit-14">
	<div class="box-element">
		<div class="box-head-light"><span class="file-16"></span><h3>Medicine</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin">Medicine Information</h4></section>
						<section class="no-padding" id="refmr">
							<ul class="list">
								<li>
									<?php	
										if ($meinfo['status'] == 0)
										{
									?>
										<input type="hidden" name="txtmeid" " id="meid" value="<?php echo $meid;?>"/>			
								</li>
								
								<LI>
									<label for="text_field">Medicine name</label>
								</LI>
								<li class="wid-auto" id="editmrname">
									<label for="text_field" class="red" id="mename" value="<?php echo $mrinfo['medicine_name']; ?>"><?php echo $meinfo['medicine_name']; ?></label>									
								</li>
								<li></li>
							</ul>

							
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Medicine description</label>
								</LI>
								<li class="wid-auto" id="editmrgender">
									<label for="text_field" class="red" id="medesc"><?php echo $meinfo['description']; ?></label>
								</li>
								
								<li></li>
							</ul>
							<div class="clearfix"></div>

							</section>
													
					<section><h4 class="no-margin">Content Information</h4></section>
						<section class="no-padding" id="refemail">
						<ul class="list">
								<li style=" width: 120px;">Content</li>
								<li style=" width: 120px;">Description</li>
								<li style=" width: 120px;">Quantity</li>
								<li>
									<div class="clearfix"></div>
								</li>
<li>
</ul>						
								<?php
								$size=0;
								while($size < count($meinfo['content_name']))
								{
								?>
								<!---<ul class="list">-->
								<ul class="list">
								<li style=" width: 120px;"><?php echo $meinfo['content_name'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $meinfo['desc'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $meinfo['qty'][$size]; ?></li>
								<li>
									<div class="clearfix"></div>
								</li>
																								
							</ul>
							</section>
							<?php
								$size++;
							}
							?>
						<?php } ?>
					
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
	header("location: login.php");
}
?>

