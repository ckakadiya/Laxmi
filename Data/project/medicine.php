<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="medicine";
		$menu="new_medicine";
		include_once("global.php");
		include_once("function.php");
		include_once("paging.php");
	 	$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$mrid=0;
		if(isset($_GET['mrid']))
		{	
			$mrid=$_GET['mrid'];
			if(isset($_POST['btnsubmit']))
    			{
				$meid=ins_mr_medicine($_POST,$cid,$_GET['mrid']);
				$_SESSION['meid']= $meid; 
				echo $meid;
				header("location: medicine_content.php");
    			}
		}
		else
		{
			if(isset($_POST['btnsubmit']))
    			{
				//echo "hii";
				$meid=ins_medicine($_POST,$cid);
				$_SESSION['meid']= $meid; 
				echo $meid;
				header("location: medicine_content.php");
    			}
		}	
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
	<LINK type="text/css" href="css/custom.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/medicine.js" type="text/javascript"></script>
	<script src="js/jq.js" type="text/javascript"></script>
	<script>
		$(document).ready(function()
		{
			//alert("hiii");
			var mrid=$("#mrid").val();
			if(mrid != 0)
			{
				$("#company").hide();
			}
		
		});	

	</script>

<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "medicine_menu.php";
	?>
	<div class="bit-14" style="padding-left:5px;">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>Medicine</h3></div>
			<div class="box-content no-padding">
				<form  method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							<div class="section-left-s">
								<input type="text"  hidden name="txtmrid"  id="mrid" class="i-text" value="<?php echo $mrid;?>" required="required" >
								<label for="text_field">Medicine Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input type="text" name="txtmname"  id="mname" class="i-text" required="required" ></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Description</label>
							</div>
							<div class="section-right">  
								<div class="section-input"><textarea  name="txtdesc"  cols="25"  id="mdesc1"  class="i-text" required="required" rows="4"></textarea></div>
								
							</div> 
							<div class="clearfix"></div>
						</section>
						<section id="company">
							<div class="section-left-s">
								<label for="text_field">Company_name</label>
							</div>
							<div class="section-right">
								<div class="section-input">
									<input list="cname" id="c1"  name="txtcname" class="i-text" />
									<datalist id="cname">
										<?php
										$cnt=0;
										while($cnt < count($result['id']))
										{
											$res=$result['cname'][$cnt];
											echo "<option value='$res'>".$res."</option>";
											$cnt++;
										}
										?>	
									<option id="other" class="cmp"  value="other">other</option>						
									</datalist>
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<input name="btnsubmit" id="btnsub" class="i-button no-margin" value="Next" type="submit" style="padding-left: 25px; border-left-width: 1px; padding-top: 7px; padding-right: 25px; margin-left: 250px;">
							<div class="clearfix"></div>
						</section>
						
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div id="box" class="bright_content">
				<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="" class="i-validate"name="cmpf1">
					<fieldset>
						<h3 align="center">Company Registration Form</h3>
						<section>
							<div class="section-left-s">
								<label for="text_field">Company Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input type="text" name="txtcmpname" class="i-text required" id="cmpname"/></div>
							</div>
							<div class="clearfix"></div>
						</section>

						
						<section>
							<div class="section-left-s">
								<label for="text_field">Email</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input type="email" name="txtcmpemail" id="cmpemail" class="i-text required"/></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section>
							<div class="section-left-s">
								<label for="text_field">Phone-no</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input type="text" name="txtcmpphno" id="cmpphno" class="i-text required"/></div>
							</div>
							<div class="clearfix"></div>
						</section>

						<section>
							<div class="section-left-s">
								<label for="text_field">Address</label>
							</div>
							<div class="section-right">
								<div class="section-input"><textarea name="txtcmpadd" id="cmpadd" class="i-text" cols="25" rows="3"></textarea></div>
							</div>
							<div class="clearfix"></div>
						</section>
						<section class="no-padding">
							<ul class="list">
								<li class="wid-auto butt-margin">
								<div class="r-float"><input class="icon-16 button"  id="cmpsub" value="submit" type="submit"></div>
								<div class="r-float" id="editclose"><input class="button" value="Cancel" type="button" id="close"></div>
							</li>
							<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
					
				</form>
				</div>
			</div>
		</div>
<div id="main" class="dark_overlay"></div>
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
