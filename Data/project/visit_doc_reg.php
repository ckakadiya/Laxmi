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
	 
	//echo $fdir;
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
<SCRIPT>
	/*$(document).ready(function(){
		$(".delete-click").click(function(){
			//alert($(".delete-click").html());
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			alert("dffd");
			alert($(this).attr("id"));
			$("#deletelight").css('display', 'block');
			$("#deletefade").css('display', 'block');
		});
		$("#deleteclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'none');
			$("#deletefade").css('display', 'none');
		});
		$(".edit-click").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			var c=$(this).attr("id");
			alert(c);
			alert($("#vdid_"+c).val());
			$("#editlight").css('display', 'block');
			$("#editfade").css('display', 'block');
		});
		$("#editclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#editlight").css('display', 'none');
			$("#editfade").css('display', 'none');
		});
	});*/
</SCRIPT>

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
			<div class="box-head-light"><span class="forms-16"></span><h3>New Visiting_Doctor</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="visit_doc_reg_proc.php" class="i-validate"> 
					<fieldset>
						<section>
							<div class="section-left-s">
								<label for="text_field">First Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtname" id="text_field" class="i-text" required type="text" placeholder="Enter name"></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Speciality</label>
							</div>
							<div class="section-right">  
								<div class="section-input"><input type="text" id="speciality" name="txtspeciality" placeholder="Enter Speciality" class="i-text" required pattern = "[a-zA-Z]*"/></div>
								
							</div> 
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Phone</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtphno" id="text_field" class="i-text" required type="text" placeholder="Enter Phone-no"></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Email ID</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtemail" id="text_field" class="i-text" required type="text" placeholder="Enter Email"></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="textarea">Address</label>
							</div>
							<div class="section-right">
								<div class="section-input"><textarea rows="5" name="txtarea" id="txtarea" class="i-text" required></textarea></div> 
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="select">State</label> 
							</div>
							<div class="section-right">
								<select class="i-text" style="width:340px;" tabindex="2"	 name="txtstate" id="state" required>
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
								<select  tabindex="2" name="txtcity" id="city" style="width:340px;" class="i-text" required>
								</select>
							</div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="select">Pincode</label> 
							</div>
							<div class="section-right">
								<select  tabindex="2" style="width:340px;" class="i-text" required name="txtpin" id="pincode" required>	
								</select>
							</div>
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
else
{
	header("location: login.php");
}
?>
