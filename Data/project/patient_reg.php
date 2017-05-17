<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_today";
		if(isset($_REQUEST['pid']))
		{
			
			include_once("connect.php");
			include_once("function.php");
			include_once("patient_reg_code.php");
			$sel_res=selPatientDetail($_REQUEST['pid']);
			$day=substr($sel_res['dob'],8,2);
			$month=substr($sel_res['dob'],5,2);
			$year=substr($sel_res['dob'],0,4);
			//echo "$day,$month,$year";
			
			//print_r($sel_res);
		
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
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jq.js"></script>
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("app_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>New Patient</h3></div>
			<div class="box-content no-padding">
			<form  method="post" action="" class="i-validate"> 
			<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>">
					<fieldset>
						<section>
							<div class="section-left-s">
								<label for="text_field">Patient Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
							<input name="txtpname" required id="pname" value="<?php echo $sel_res['pname'];?>" class="i-text required" type="text" pattern="[a-Z]"></div>
								</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s" class="i-text required">
								<label for="text_field">Date of Birth:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<select name="dd" id="day" >
					   <?php
                       if($day!="00")
                       {
                   		?>
                       		<option value="<?php echo substr($sel_res['dob'],8,2);?>"><?php echo substr($sel_res['dob'],8,2);?></option>
					   <?php
					   }
					   		for($i=1;$i<=31;$i++)
							{
						?>
                   								<option <?php if($day==$i){echo "value='$day' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>	
						 <?php

                             }
					   ?>
						</select>
						<select name='mm' id='month'>
   						<?php
                       if($month!="00")
                       {
                   		?>
                     
                        <option value="<?php echo substr($sel_res['dob'],5,2);?>"><?php echo substr($sel_res['dob'],5,2);?></option>
							<?php
					   }
					   		for($i=1;$i<=12;$i++)
							{
							?>
								<option <?php if($month==$i){echo "value='$month' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>
							<?php
                            }
					   		?>	   
					   </select>
					   
                      
                      <select name="yyyy" id='year'>
							<?php
					   
					   		for($i=1940;$i<=date('Y');$i++)
							{
							?>
                            	<option <?php if($year==$i){echo "value='$year' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>
                            <?php
							}
					   		?>
					 </select>
								
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Phone No:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
							<input  type="text" id="phoneno" value="<?php echo $sel_res['phone'];?>" class="i-text required" type="text"  name="txtphone" required pattern="[0-9]{10}">
                            </div>
								</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="textarea">Gender</label>
							</div>
							<div class="radio section-right">  
								<input id="male" type="radio" name='gender' value='male' <?php if($sel_res['gender']=="male"){echo "checked"; } ?>>  
								<label for="male" class="lblchk">Male</label>  
								<input id="female" type="radio" name='gender' value='female' <?php if($sel_res['gender']=="female"){echo "checked"; } ?> >  
								<label for="female" class="lblchk">Female</label>  
							</div> 
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="textarea">Address</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<textarea rows="10" name="txtarea" id="textarea" class="i-text">
								<?php
									if(isset($sel_res['street']))
									{
										echo $sel_res['street'];
									}
								?>
								</textarea>
								</div> 
							</div>
							<div class="clearfix"></div>
						</section>
						
						
						<section>
							<div class="section-left-s">
								<label for="select">State</label> 
							</div>
							<div class="section-right">
								<select   id="state" class="i-text" style="width:340px;" tabindex="2"  name="txtstate" >
									<?php
										$res=selTable("state");
										while($row=mysql_fetch_array($res))
										{
											
											
									?>
									<option value="<?php echo $row['id'];?>" <?php if(isset($sel_res['state'])){if($row['state_name']==$sel_res['state']){echo "selected='selected'";}} ?> ><?php echo $row['state_name'];?></option>
									<?php
											
										}
									?>
								</select>
							</div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="select">City</label> 
							</div>
							<div class="section-right">
								<select class="i-text" id="city" style="width:340px;" tabindex="2" name="txtcity">

								</select>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="select">Pincode:</label> 
							</div>
							<div class="section-right">
								<select id="pincode" class="i-text" style="width:340px;" tabindex="2"name="txtpin" id="pincode" required  name="txtpin">
								</select>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Email ID</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input name="txtemail" value="<?php if(isset($sel_res['email'])){echo $sel_res['email'];}?>" type="type" class="i-text required"></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit">
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
				header("location:today_appoinment.php");
		}
	}
	else
	{
		header ("location:login.php");
	}
?>

