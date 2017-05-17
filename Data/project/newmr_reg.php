<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		include_once "function.php";
		$str="mr";
		$menu="newmr";
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


</HEAD>

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
			<div class="box-head-light"><span class="forms-16"></span><h3>New MR</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="mr_regproc.php" class="i-validate"> 
					<fieldset>
                    <input hidden="hidden" type="text" name="txtid"/>
						<section>
							<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                             					   <input name="txtmr_name" placeholder="Enter Name" required class="i-text" type="text"></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        
                        <section>
							<div class="section-left-s">
								<label for="textarea">Gender</label>
							</div>
							<div class="radio section-right">  
								<input id="male" type="radio" name="txtgender" value="male" checked>  
								<label for="male" class="lblchk">Male</label>  
								<input id="female" type="radio" name="txtgender" value="female">  
								<label for="female" class="lblchk">Female</label>  
							</div> 
							<div class="clearfix"></div>
						</section>
                        			<section>
							<div class="section-left-s">
								<label for="text_field">Phone</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                					<input type="text"  name="txtphone_no" placeholder="Enter Phone_no" required class="i-text" type="text"></div>
								</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Email ID</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input type="email" name="txtemail" placeholder="Enter Email_address" required class="i-text">
                               	</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="textarea">Address</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                	<textarea rows="4" name="txtarea" id="textarea" class="i-text"></textarea>
                                </div> 
							</div>
							<div class="clearfix"></div>
						</section>
                        
						<section>
							<div class="section-left-s">
								<label for="select">State</label> 
							</div>
							<div class="section-right">
								<select class="chzn-single" style="width:340px;" tabindex="2"	 name="txtstate" id="state" required>
             							<?php
									$arr_res_state=selState();
									for($i=0;$i<count($arr_res_state);$i++)
									{
								?>
                			                      	<option value="<?php echo $arr_res_state[$i]['id']; ?>"><?php echo $arr_res_state[$i]['state_name']; ?></option>
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
								<select  class="chzn-single" tabindex="2" name="txtcity" id="city" style="width:340px;"  required>
								</select>
							</div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="select">Pincode</label> 
							</div>
							<div class="section-right">
								<select  class="chzn-single" tabindex="2" style="width:340px;" required name="txtpin" id="pincode" required>	
								</select>
							</div>
						</section>
						<!--<section>
							<div class="section-left-s">
								<label for="text_field">Time</label>
							</div>
							<div class="section-right">
								<select class="chzn-single" style="width:100px;" tabindex="2" id="mrtime"  name="selmrtime">
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
									<select class="chzn-single" style="width:60px;" tabindex="2" id="mrmin"  name="selmrmin">
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
									<select class="chzn-single" style="width:50px;" id="mrmed"  name="selmrmed">
										<option value="AM">AM</option>
										<option value="PM">PM</option>
									</select>
									
        	     					
							</div>
						</section>-->
						
						<section>
							<input name="btninsert" id="" class="i-button no-margin" value="Submit" type="submit">
							<div class="clearfix"></div>
						</section>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
    <?php
		
	?>
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
