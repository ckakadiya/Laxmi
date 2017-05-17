<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="visit_doctor";
		$menu="new_vd";
		include_once("global.php");
		include_once("function.php");
	 	$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$vdid=0;
		if(isset($_POST['btnsubmit']))
		{
			$vdid=ins_visiting_doctor($cid,$_POST);
		}
		if(isset($_GET['vdid']))
		{
			$vdid=$_GET['vdid'];
		}
		//echo $vdid;
		$result=sel_visitdoc1($vdid);
		//print_r($result);
	
	
?><!DOCTYPE html>
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
</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "vd_menu.php";
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Visiting_Doctor</h3></div>
			<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="visit_doc_time_proc.php" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin">Visiting_doctor Infornation</h4></section>
						<section class="no-padding">
							<ul class="list">
								<li>
									<input name="txtvdid" hidden="hidden" id="vdid" value="<?php echo $result['id'];?>"/>								
								</li>
								
								<LI>
									<label for="text_field">Name</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $result['doctor_name'];?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Speciality</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $result['speciality'];?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Phone no.</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $result['phno'];?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Email Id</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $result['email'];?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							
							<div class="clearfix"></div>
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="r-float"><input class="icon16 cancel-16" value="" type="button"></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
						<section><h4 class="no-margin"> Select Visitng_doctor Timing</h4></section>
						<section class="no-padding">
						<ul class="list">
							<li>
								<label for="text_field">Day</label> 
							</li>
							<li class="wid-auto">
									<select class="chzn-single" style="width:100px;" tabindex="2" id="day" name="selday" >
										<option value="monday">Monday</option>
										<option value="tuesday" >Tuesday</option>
										<option value="wednesday" >Wednesday</option>
										<option value="thursday" >Thursday</option>
										<option value="friday">Friday</option>
										<option value="saturday">Saturday</option>
										<option value="sunday" >Sunday</option>
									</select>
							</li>
							<li>
								<div class="clearfix"></div>
							</li>
						</ul>
							
							
							<ul class="list">
							<li>
								<label for="select">Start</label> 
							</li>
							<li class="wid-auto">
									<select class="chzn-single" style="width:100px;" tabindex="2" id="start"  name="selstart">
									<?php
										$cnt=1;
										while($cnt <= 12)
										{
											$cnt1="$cnt:00:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt++;
										}
									?>	
									</select>
									<select class="chzn-single" style="width:60px;" tabindex="2" id="smin"  name="selsmin">
										<option value="00:00">00:00</option>
									<?php
										$cnt=05;
										while($cnt <= 55)
										{
											$cnt1="$cnt:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt=$cnt+5;
										}
									?>	
									</select>
									<select class="chzn-single" style="width:50px;" id="smed"  name="selsmed">
										<option value="AM">AM</option>
										<option value="PM">PM</option>
									</select>
									
        	     					
								
							</li>
							<li>
							<div class="clearfix"></div>
							</li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<li>
									<label for="select">Till</label> 
								</li>
								<li class="wid-auto">
									<select class="chzn-single" style="width:100px;" tabindex="2" id="till"  name="seltill">
									<?php
										$cnt=1;
										while($cnt <= 12)
										{
											$cnt1="$cnt:00:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt++;
										}
									?>	
									</select>
									<select class="chzn-single" style="width:60px;" tabindex="2" id="tmin"  name="seltmin">
										<option value="00:00">00:00</option>
									<?php
										$cnt=05;
										while($cnt <= 55)
										{
											$cnt1="$cnt:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt=$cnt+5;
										}
									?>	
									</select>
									
									<select class="chzn-single" style="width:50px;" id="tmed"  name="seltmed">
										<option value="AM">AM</option>
										<option value="PM">PM</option>
									</select>
									
        	     						</li>
							<li>
								<div class="clearfix"></div>
							</li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float">
									<input class="icon16-button forms-16" value="Add"  id="addtime" type="submit"></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
						<section><h4 class="no-margin">Visit_doctor_time</h4></section>
				<section class="no-padding">
			
				<?php
					$result1=visit_doc_time($vdid);	
					if($result1['status'] == 0)
					{	
						$cnt=0;
						while($cnt < count($result1['id']))
						{
						
				?>
				<ul class="list">
				<li>
                                	<?php if(isset($result1['start'][$cnt])){echo $result1['start'][$cnt];}else{echo "-----";}?>
                                </li>
                                <li>
                                	<?php if(isset($result1['till'][$cnt])){echo $result1['till'][$cnt];}else{echo "-----";}?>
                                </li>
                                <li>
					<?php if(isset($result1['day'][$cnt])){echo $result1['day'][$cnt];}else{echo "-----";}?>				</li>
				<li><div class="clearfix"</li>
				</ul>
				<?php $cnt++;						
						}
					}
					else
					{
// 						echo "no data available";
					}
				
				?>
			
			<div class="clearfix"></div>
		</section>		</fieldset>
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
