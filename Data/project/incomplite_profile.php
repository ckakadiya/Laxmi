<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="report";
		$menu="rep_incomplete";
		$fdir = $_SERVER['PHP_SELF'];
		include_once("function.php");
		include_once('paging.php');
		include_once("global.php");
	
		if(!isset($_GET['p']))
		{
			 $page=1;
		}
		else
		{
			$page = $_GET['p'];
		}
		
		//print_r($res_profile);
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
	<?php include_once("report_menu.php");?>
		<?php
			$res_profile=patientProfileIncomplite($_SESSION['cid']);
			if(isset($res_profile['id']))
			{
				$a=count($res_profile['id']);
				$pager=pagedata($GLOBALS['no_row'],$a,$page);
				//print_r($res_profile);
				//print_r($pager);
					$start=$pager['offset'];
					$end=$pager['limit'];
					if($end>$a)
					{
						$end=$a;
					}
			?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="profile-16"></span><h3>Patient with Incomplete Profile</h3></div>
			<div class="box-content no-padding">
					<fieldset>
			<table class="i-table fullwidth">
				<thead>
				<tr>
					<td>Patient Name</td>
					<td>Date of birth</td>
					<td>Gender</td>
					<td>Email</td>
					<td>Phone No</td>
					<td>street Name</td>
					<td>Date</td>
					<td>Time</td>
				
				</tr>
				</thead>
				<tbody>
			<?php
					for($i=$start;$i<$end;$i++)
					{
			
				?>
				
				<tr>
						<td title="<?php echo $res_profile['name'][$i];?>"><?php if(isset($res_profile['name'][$i])){echo compressDetail($res_profile['name'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></td>
						<td ><?php if(isset($res_profile['dob'][$i])){echo $res_profile['dob'][$i];}else{echo "-----";}?></td>
						<td ><?php if(isset($res_profile['gender'][$i])){echo $res_profile['gender'][$i];}else{echo "-----";}?></td>
						<td  title="<?php echo $res_profile['email'][$i];?>"><?php if(isset($res_profile['email'][$i])){echo compressDetail($res_profile['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></td>
						<td ><?php if(isset($res_profile['phone'][$i])){echo $res_profile['phone'][$i];}else{echo "-----";}?></td>
						<td  title="<?php echo $res_profile['street'][$i];?>"><?php if(isset($res_profile['street'][$i])){echo compressDetail($res_profile['street'][$i],$GLOBALS['scno']);}else{echo "-----";}?></td>
						<td ><?php if(isset($res_profile['date'][$i])){echo $res_profile['date'][$i];}else{echo "-----";}?></td>
						<td ><?php if(isset($res_profile['time'][$i])){echo $res_profile['time'][$i];}else{echo "-----";}?></td>
						<td>
                        <a href='patient_reg.php?pid=<?php echo $res_profile['id'][$i]; ?>' class="l-float edit-click">
							<input class="icon16 edit-16 " value="" type="button">
						</a>
                        </td>
					</tr>
					<?php
					}
					?>
				</tbody>
				</table>
					<section>
							<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								
									<span>
										<?php
    										page_strip($page,$fdir,$pager);
										?>	
									</span>
								
							</div>
							<div class="clearfix"></div>
						</section>
					</fieldset>
			</div>
		</div>
	</div>
	
</div>				      
		<?php
			}
			else
			{
		?>
        	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="profile-16"></span><h3>Patient with Incomplete Profile</h3></div>
			<div class="box-content no-padding">
					
					<section>
					

								<div class="alert-msg info-msg" align="center">None of Patient With Incomplete Profile</div>

							<div class="clearfix"></div>
						</section>
					
			</div>
		</div>
	</div>
	
</div>	
        <?php
			}
		?>
		
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
		</body>
	</html>
	<?php
	
	}
	else
	{
			header("location:location:login.php");
	}
	?>
		