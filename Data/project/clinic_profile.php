
<?php
	//include_once("profile.php");
	session_start();
	$str="user_profile";
	$menu="client";
	include_once("connect.php");
	include_once("clinic_profile_update.php");
	
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
<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>
<SCRIPT  type="text/javascript">
	$(document).ready(function(){
		
		if($('#editlight').text()!="")
		{
			$("#editlight").css('display', 'block');
			$("#editfade").css('display', 'block');
		}

		$("#editclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#editlight").css('display', 'none');
			$("#editfade").css('display', 'none');
		});
		
	});
		function confirmSubmit()
		{
			var agree=confirm("Are you sure you wish to Delete this Entry?");
			if (agree)
				return true ;
			else
				return false ;
		}
</SCRIPT>
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("user_menu.php");?>
	<?php
	$sel_res=selClinic();
?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Clinic Profile</h3></div>
			<div class="box-content no-padding">
		
			<fieldset>
			
				<section class="no-padding">
					<ul class="list">
						<LI class="widd">
							<label for="text_field">clinic Name:</label>
						</LI>
						<li class="wid-auto">
							<label for="text_field" class="red"><?php echo $sel_res['cname'];?></label>
						</li>
						<li></li>
					</ul>
					</section>
					<div class="clearfix"></div>
					
					<section class="no-padding">
					<ul class="list">
						<LI class="widd">
							<label for="text_field">Address:</label>
						</LI>
						<li class="wid-auto">
							<label for="text_field" class="red"><?php echo trim($sel_res['address']);?></label>
						</li>
						<li></li>
					</ul>
					</section>
					<div class="clearfix"></div>
					
					<section class="no-padding">
					<ul class="list">
						<LI class="widd">
							<label for="text_field">Phone No::</label>
						</LI>
						<li class="wid-auto">
							<label for="text_field" class="red"><?php echo $sel_res['phoneno'];;?></label>
						</li>
						<li></li>
					</ul>
					</section>
					
					<div class="clearfix"></div>
					
					<section class="no-padding">
					<ul class="list">
						<LI>
								<label for="text_field">Plan Detail:</label>
						</LI>
						<li class="wid-auto">
								<label for="text_field" class="red">
								<table border="0" class="red">
									<tr>
										<td>Plan Name:</td>
										<td><?php echo $sel_res['plan']['name'];?></td>
									</tr>
									<tr>
										<td>No of Appointment :</td>
										<td><?php echo $sel_res['plan']['app'];?></td>
									</tr>
									<tr>
										<td>Time Duration :</td>
										<td><?php echo $sel_res['plan']['time'];?></td>
									</tr>
									<tr>
										<td>Cost :</td>
										<td><?php echo $sel_res['plan']['cost'];?></td>
									</tr>
								</table>
								</label>
						</li>
						<li></li>
					</ul>
					</section>
					<div class="clearfix"></div>
					
					<ul class="list">
						<li class="wid-auto butt-margin">
							<div class="r-float">
							<a href="clinic_profile.php?op=edit_detail">
							<input class="icon16 edit-16" value="" type="button"></a></div>
							
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
				</section>
			</fieldset>
			</div>
		</div>
	</div>
</div>
<div id="main1" class="main"> </div>
<?php
	$sel_res=selClinic();
	if(isset($_REQUEST['op']) && $_REQUEST['op']=="edit_detail")
	{
?>
		<div id="editlight" class="bright_content">
			<div class="box-content no-padding" >
				<form novalidate method="post" action="clinic_profile.php" class="i-validate"> 
					<fieldset>
		
			<section class="no-padding">
				<div class="section-left-s">
					<label for="text_field">Clinic Name:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
						<input type="text" readonly value="<?php echo $sel_res['cname']; ?>" class="i-text required">
					</div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section class="no-padding">
				<div class="section-left-s">
					<label for="text_field">Address:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
					<textarea rows="10" id="txtadd" class="i-text" name="txtadd">
							<?php echo trim($sel_res['address']);?>
					</textarea>
					</div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section class="no-padding">
				<div class="section-left-s">
					<label for="text_field">Phone No:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
					<input name="txtpno" value="<?php echo $sel_res['phoneno'];?>" class="i-text required" type="text">
					</div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="save"></div>
						<div class="r-float" id="editclose"><a href="clinic_profile.php"><input class="button" value="Cancel" type="button"></a></div>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
		</fieldset>
		</form>
		</div>
	</div>
	<?php
	if(isset($_POST['save']))
	{
		if(isset($res_clinic) && $res_clinic==1)
		{
			echo "Clinic updated Successfully";
		}
		else
		{
			echo $res_clinic;
		}
	}
	?>
</div>
<div id="editfade" class="dark_overlay"></div>		
<?php
	}

?>
</body>
</html>