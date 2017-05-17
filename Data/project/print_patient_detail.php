<?php
	session_start();
if(isset($_SESSION['cid']))
	{
	$str="patient";
	$menu="patient_profile";
	
	if(isset($_REQUEST['pid']))
	{
		
		include_once("function.php");
		$sel_patient=array();
		$sel_patient['cid']=$_SESSION['cid'];
		$sel_patient['pid']=$_REQUEST['pid'];
		$sel_res=selPatientDetail($_REQUEST['pid']);//patient detail
		
	
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
</HEAD>

<BODY>

<?php include_once("header.php");?>
<div id="container">
	<?php include_once("patient_menu.php");?>
	<div class="bit-14">
		<div class="box-element">       
<div class="box-head-light"><span class="file-16"></span><h3>Patient Profile</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
						
						<section><h4 class="no-margin">Personal Infornation</h4></section>
						<section class="no-padding">
							<ul class="list">
								<LI class="widd">
									<label for="text_field">Name</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['pname'])){echo $sel_res['pname'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Gender</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['gender'])){echo $sel_res['gender'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Street</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['street'])){echo $sel_res['street'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
                            <div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">State</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['state'])){echo $sel_res['state'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
                            <div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">City</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['city'])){echo $sel_res['city'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
                            <div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Pincode</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['pincode'])){echo $sel_res['pincode'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Email Id</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php if(isset($sel_res['email'])){echo $sel_res['email'];}else{echo "---";}?></label>
								</li>
								<li></li>
							</ul>
							
							<div class="clearfix"></div>
							<!--<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="r-float"><input class="icon16 cancel-16" value="" type="button"></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>-->
						</section>
						
						
						
						<section><h4 class="no-margin">Treatment Information</h4></section>
						<?php
								$sel_result=selTreatment($sel_patient);
								if($sel_result['result']==1)
								{
									$j=1;
									$c=count($sel_result)-1;
									//print_r($sel_result);
									for($i=0;$i<$c;$i++)
									{
									?>					
                             <section class="no-padding">			
                            
                            <ul class="list">
								<LI class="widd">
									<label for="text_field"><a href="treatment_detail.php?tid=<?php echo $sel_result[$i]['id'];?>">Appoinment-<?php echo $j++;?></a></label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><a href="treatment_detail.php?tid=<?php echo $sel_result[$i]['id'];?>"><?php echo $sel_result[$i]['date'];?></a></label>
								</li>
								
								<li>
									<!--<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
                            </section>
                            <?php 
									}
								}
								else
								{
								?>
                                    <section class="no-padding">			
                                    <ul class="list">
                                        <LI class="wid-auto">
                                            <label for="text_field">No privious Treatment avelabal</label>
                                        </LI>
                                        <LI class="widd">
                                            <label for="text_field"></label>
                                        </LI>
                                    </ul>
                                    <div class="clearfix"></div>
                                    </section>
								<?php
									
								}
							?>
                            
						
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
			header("location:patient_profile.php");
	}
	

	}
	else
	{
			header("location:login.php");
	}

?>