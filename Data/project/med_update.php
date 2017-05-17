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
		//echo $cid;
		$meid=0;
		if(isset($_GET['meid']))
		{
			$meid=$_GET['meid'];
		}
		$meinfo=selMedicine($meid);
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
	<script src="js/medicine.js" type="text/javascript"></script>
</HEAD>

<BODY>
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
				<form novalidate="novalidate" method="post" action="" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin">Medicine Infornation</h4></section>
						<section class="no-padding" id="refmed">
							<ul class="list">
								<li>
									<?php	
										if ($meinfo['status'] == 0)
										{
									?>
										<input type="hidden" name="txtmeid" " id="meid" value="<?php echo $meid;?>"/>			
								</li>
								
								<LI>
									<label for="text_field">Medicine Name</label>
								</LI>
								<li class="wid-auto" id="editmedname">
									<label for="text_field" class="red" id="medname" value="<?php echo $meinfo['medicine_name']; ?>"><?php echo $meinfo['medicine_name']; ?></label>									
								</li>
								<li id="heditmedname" hidden="hidden">
									<input style="width:130px;" type="text" id="hmedname" value="<?php echo $meinfo['medicine_name']; ?>" />	
								</li> 
								<li></li>
							</ul>

							
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Description</label>
								</LI>
								<li class="wid-auto" id="editmedesc">
									<label for="text_field" class="red" id="medesc" value="<?php echo $meinfo['description']; ?>"><?php echo $meinfo['description']; ?><label>
									
								</li>
								<li id="heditmedesc" hidden="hidden">
									<input style="width:130px;" type="text" id="hmedesc" value="<?php echo $meinfo['description']; ?>" />	
								</li> 
								<li></li>
							</ul>
							<div class="clearfix"></div>
							
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float"><input class="icon16 edit-16 medicine" value="" id="edit" type="button"><input  value="save" id="save" type="button" hidden>

									</div>
									
									<div class="r-float"><input  value="cancel" type="button" id="cancel" hidden></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
					<section><h4 class="no-margin" >Content Information </h4></section>
					<section class="no-padding" id="refcon">
					<div class="lists " style="padding-top:3px; height:40px; font-weight:bold; background-color: #f4f4f4;">
							<ul class="list">
								<li style=" width: 120px;">Content</li>
								<li style=" width: 120px;">Description</li>
								<li style=" width: 120px;">Quantity</li>
								<li>
									<div class="clearfix"></div>
								</li>
							</ul>
							</div>
							<?php
								$size=0;
								$j=1;
								while($size < count($meinfo['content_name']))
								{
								?>
							<ul class="list" id="<?php echo 'con_'.$j; ?>">
								
								<li id="<?php echo 'concol_'.$j;?>" style=" width: 120px;"><?php echo $meinfo['content_name'][$size]; ?></li>
								<li id="<?php echo 'condesccol_'.$j;?>" style=" width: 120px;"><?php echo $meinfo['desc'][$size]; ?></li>
								<li id="conqty" ><?php echo $meinfo['qty'][$size]; ?></li>			
								<li class="content" style=" padding-left:0px; width: 30px;" id="<?php echo 'editcon_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="content" s	tyle="padding-left:0px; width: 30px;" id="<?php echo 'delcon_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>						
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hcon_'.$j;?>" hidden="hidden">
								<input type="hidden" size="2" id="<?php echo 'hcoid_'.$j;?>" name="hcoid" value="<?php echo $meinfo['coid'][$size]; ?>" />
								<li  id="<?php echo 'editcon_'.$j; ?>">
									<input style="width:130px;"  id="<?php echo 'hconname_'.$j; ?>" value="<?php echo $meinfo['content_name'][$size]; ?>" />	
								</li>
								<li  id="<?php echo 'editdesc_'.$j; ?>">
									<input style="width:130px;" id="<?php echo 'hcondesc_'.$j; ?>"value="<?php echo $meinfo['desc'][$size]; ?>" />	
								</li>
								<li  id="<?php echo 'editqty_'.$j; ?>">
									<input style="width:130px;" id="<?php echo 'hconqty_'.$j; ?>" value="<?php echo $meinfo['qty'][$size]; ?>" />	
								</li>
	
								<li style=" width:40px;" id="<?php echo 'save_'.$j;?>" class="content">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="content">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
								<?php
									$size++;
									$j++;
								}
								?>
								
								<ul class="list" id="newcontent">
								</ul>
								<ul class="list" id="contentbox">
									
									<li colspan="3" align="center" style="width:100%;"><a style="padding-left:60px;" href="javascript:void(0);" class="icon16-button forms-16" id="ncon" name="ncon">Add more Content</a></li>
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
<?php
}
?>
