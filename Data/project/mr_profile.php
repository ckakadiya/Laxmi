<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="mr";
		$menu="profile";
		include_once("global.php");
		include_once("function.php");
		include_once('paging.php');
		$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$mrid=0;
		if(isset($_GET['id']))
		{
			$mrid=$_GET['id'];
		}
		$mrinfo=selMr($mrid);
		//print_r($mrinfo);
	
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
<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "mr_menu.php";
	?>


<div class="bit-14">
	<div class="box-element">
		<div class="box-head-light"><span class="file-16"></span><h3>MR</h3></div>
			<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin">MR Infornation</h4></section>
						<section class="no-padding" id="refmr">
							<ul class="list">
								<li>
									<?php	
										if ($mrinfo['status'] == 0)
										{
									?>
										<input type="hidden" name="txtmrid" " id="mrid" value="<?php echo $mrid;?>"/>			
								</li>
								
								<LI>
									<label for="text_field">Name</label>
								</LI>
								<li class="wid-auto" id="editmrname">
									<label for="text_field" class="red" id="mname" value="<?php echo $mrinfo['mr_name']; ?>"><?php echo $mrinfo['mr_name']; ?></label>									
								</li>
								<li></li>
							</ul>

							
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Gender</label>
								</LI>
								<li class="wid-auto" id="editmrgender">
									<label for="text_field" class="red" id="mgender"><?php echo $mrinfo['gender']; ?></label>
								</li>
								
								<li></li>
							</ul>
							<ul class="list">
								<LI>
									<label for="text_field">Company</label>
								</LI>
								<li class="wid-auto" id="editmrgender">
									<label for="text_field" class="red" id="mrcompany"><?php echo $mrinfo['company_name']; ?></label>
								</li>
								
								<li></li>
							</ul>							
								
							<div class="clearfix"></div>
						</section>
						<section><h4 class="no-margin">Email</h4></section>
						<section class="no-padding" id="refemail">
							<?php
								$size=0;
								$j=1;
								while($size < count($mrinfo['email']))
								{
								?>
							<ul class="list">
								
								<li style=" width: 120px;"><?php echo $mrinfo['email'][$size]; ?></li>
												
								<li><div class="clearfix"></div></li>
							</ul>
							<?php
								$size++;
								$j++;
							}
							?>
							
						<div class="clearfix"></div>	
					</section>
				<section><h4 class="no-margin">Phone_no</h4></section>
				<section class="no-padding" id="refphno">
						<?php
						$size=0;
						$j=1;
						while($size < count($mrinfo['phno']))
						{
						?>	
							<ul class="list">
								
								<li style=" width: 120px;"><?php echo $mrinfo['phno'][$size]; ?></li>
								<li><div class="clearfix"></div></li>
							</ul>
							<?php
								$size++;
								$j++;
							}
							?>
								<?php
							}
						?>
						<div class="clearfix"></div>	
							
					</section>
					<section><h4 class="no-margin">Medicine</h4></section>
						<section class="no-padding" id="refmed">
							<?php
								$size=0;
								$j=1;
								if(isset($mrinfo['medicine_id']))
								{
																	
								while($size < count($mrinfo['medicine_id']))
								{
								?>
							<ul class="list" id="<?php echo 'medrow_'.$j;?>">
								<li style=" width: 160px;" id="<?php echo 'med_'.$j;?>"><?php echo $mrinfo['medicine_name'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $mrinfo['time'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $mrinfo['date'][$size]; ?></li>
								<!---<li style=" width: 120px;"><?php echo $mrinfo['company_name'][$size]; ?></li>-->								<li class="med" style=" padding-left:0px; width: 30px;" id="<?php echo 'editmed_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="med" style="padding-left:0px; width: 30px;" id="<?php echo 'delmed_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>		
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hmedrow_'.$j;?>" hidden="hidden">
								<input type="hidden" size="2" id="<?php echo 'hmedid_'.$j;?>" name="hmedid" value="<?php echo $mrinfo['medicine_id'][$size]; ?>" />
								<input type="hidden" size="2" id="<?php echo 'hmrmedid_'.$j;?>" name="hmrmedid" value="<?php echo $mrinfo['mr_med_id'][$size]; ?>" />
								<li  id="<?php echo 'editmed_'.$j; ?>" style="width:160px;">
									<input  type="text" id="<?php echo 'hmed_'.$j; ?>" name="h_med" value="<?php echo $mrinfo['medicine_name'][$size]; ?>" />	
								</li>
								<li style=" width: 120px;"><?php echo $mrinfo['time'][$size]; ?></li>
								<li style=" width: 110px;"><?php echo $mrinfo['date'][$size]; ?></li>
								
								<li style=" width:30px;" id="<?php echo 'save_'.$j;?>" class="med">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="med">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
								
							
							
							<?php
								$size++;
								$j++;
							}
							}
							?>
							<ul class="list" id="medbox">
								<li colspan="3" align="center" style="width:100%;"><a style="padding-left:60px;" href="medicine.php?mrid=<?php echo $mrid;?>" class="icon16-button forms-16" id="nmed" name="nmed">Add more Medicine</a></li>
									<li><div class="clearfix"></div></li>
								</ul>
						<div class="clearfix"></div>	
					</section>		
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

