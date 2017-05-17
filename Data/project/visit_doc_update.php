<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="visit_doctor";
		$menu="updel_vd";
		include_once("global.php");
		include_once("function.php");
	 	$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$id=$_GET['id'];
	
		$result=sel_visitdoc($id);
		if($result['status'] == 0)
		{

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
<script src="js/jquery.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jq.js" language="JavaScript" type="text/javascript"></script>

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
			<div class="box-head-light"><span class="forms-16"></span><h3>Update Visiting_Doctor</h3></div>
			<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="visit_doctor_updateproc.php" class="i-validate"> 
					<fieldset>		
						<section>
							<div><input hidden="hidden" type="text" name="txtvdid" placeholder="Enter eid" value="<?php echo $result['id']; ?>" /></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtname" id="text_field" class="i-text required" type="text" value="<?php echo $result['doctor_name']; ?>" placeholder="Enter name"></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Speciality</label>
							</div>
							<div class="section-right">  
								<div class="section-input"><input type="text" id="speciality" name="txtspeciality" placeholder="Enter Speciality" class="i-text required" value="<?php echo $result['speciality']; ?>" pattern = "[a-zA-Z]*"/></div>
								
							</div> 
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Start</label>
							</div>
							<div class="section-right">
								<select class="chzn-single" style="width:200px;" tabindex="2"	 name="selstart" id="start" required>							
								<option><?php 
									if($result['start'] != "")
									{	
										$start=explode(" ",$result['start']);
				        					echo $start[0]; 
									}
									else
									{
										$result['start']="1:00:00 AM";
										$start=explode(" ",$result['start']);
				        					echo $start[0]; 
									}
								?></option>
										<?php
								$cnt=1;
								
								while($cnt <= 12)
								{
									if($cnt == $start[0])
									{
										$cnt++;
										continue;
									}
									$cnt1="$cnt:00:00";
									echo "<option value='$cnt1'>".$cnt1."</option>";
									$cnt++;
								}
							?>
					
						</select>
						<select class="chzn-single" style="width:140px;" tabindex="2" id="smed"  name="selsmed">
							<option><?php $start=explode(" ",$result['start']);
								      echo $start[1]; ?></option>
							<?php
								if($start[1] == AM)
								{
									echo "<option value='PM'>PM</option>";
								}
								else
								{
									echo "<option value='AM'>AM</option>";
								}
							?>
									

						</select>
				</div>
				
					</section>
					<section>
				<div class="section-left-s">
					<label for="text_field">Till</label>
				</div>
				<div class="section-right">
					<select class="chzn-single" style="width:200px;" tabindex="2" name="seltill" id="till" required>				
						<option><?php
									if($result['till'] != "")
									{	
										$till=explode(" ",$result['till']);
				        					echo $till[0]; 
									}
									else
									{
										$result['till']="1:00:00 AM";
										$till=explode(" ",$result['till']);
				        					echo $till[0]; 
									}
								?></option>

							<?php
								$cnt=1;
								while($cnt <= 12)
								{
									if($cnt == $till[0])
									{
										$cnt++;
										continue;
									}
									
									$cnt1="$cnt:00:00";
									echo "<option value='$cnt1'>".$cnt1."</option>";
									$cnt++;
								}
							?>
						</select>
						
						<select class="chzn-single" style="width:140px;" tabindex="2" id="tmed"  name="seltmed">
							<option><?php $till=explode(" ",$result['till']);
								      echo $till[1]; ?></option>
							<?php
								if($till[1] == AM)
								{
									echo "<option value='PM'>PM</option>";
								}
								else
								{
									echo "<option value='AM'>AM</option>";
								}
							?>
							
						</select>
				</div>
				
			</section>
					
			<section>
				<div class="section-left-s">
					<label for="text_field">Day</label>
				</div>
				<div class="section-right">
					<select class="chzn-single" style="width:340px;" tabindex="2"	 name="selday" id="day" required>				
							<?php 
								$day[0]="Monday";
								$day[1]="Tuesday";
								$day[2]="Wednesday";
								$day[3]="Thursday";
								$day[4]="Friday";
								$day[5]="Saturday";
								$day[6]="Sunday";	
								$cnt=0;
								if($result['day'] != "")
								{
									echo "<option>".$result['day']."</option>";
								}
								else
								{		
									$result['day']="Monday";
									echo "<option>".$result['day']."</option>";
								}
								while($cnt < count($day))
								{
									if($result['day'] == $day[$cnt])
									{
										$cnt++;
										continue;
									}
									echo "<option>".$day[$cnt]."</option>";	
									$cnt++;
								}						
							?>.			
						
					</select>
				</div>
				
			</section>
			<section>
				<div class="section-left-s">
					<label for="text_field">Phone</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input value="<?php echo $result['phno']; ?>" name="txtphno" id="phno" class="i-text required" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="text_field">Email ID</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input value="<?php echo $result['email']; ?>" name="txtemail" id="email" class="i-text required" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			<section>
				<input name="btnsubmit" id="" class="i-button no-margin" value="Submit" type="submit">
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
?>
<?php
}
else
{
	header("location: login.php");
}
?>
