<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_today";
		include_once("function.php");
		$arr_patient['cid']=$_SESSION['cid'];	
		
		if(isset($_REQUEST['op']) && $_REQUEST['op']=="delete")
		{
			$app_id=$_REQUEST['app_id'];
			$res_del=deleteAppointment($app_id);
			
		}
	
	
?>
<html>
	<head><TITLE>Registration Form</TITLE>
	<link href="css/c1.css" rel="stylesheet" type="text/css">
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
    <?php include_once("datepicker/dropdown-month-year.php");?>
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<SCRIPT>
	$(document).ready(function(){
		$(".delete-click").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'block');
			$("#deletefade").css('display', 'block');
		});
		$("#deleteclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'none');
			$("#deletefade").css('display', 'none');
		});
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
</head>
<BODY>


<?php include_once("header.php");?>
<div id="container">
	<?php include_once("app_menu.php");?>
    
	<?php
	$fdir = $_SERVER['PHP_SELF'];
	include_once("connect.php");
	include_once('paging.php');
	include_once("global.php");
	?>
	
	<div class="bit-14">
		<div class="box-element">
			<?php include_once("today_appointment_code.php");?>
			<div class="box-head-light"><span class="data-16"></span><h3>Today's Appoinment</h3></div>
			<div class="box-content no-padding">
			<?php
				$sel_res=todayAppointment($arr_patient);
				if($sel_res['result']==1)
				{
			?>
			<fieldset>
			<table class="i-table fullwidth">
				<thead>
				<tr>
					<br>
					<td>Apponiment no</td>
					<td>Patient Name</td>
					<td>Gender</td>
					<td>Phone No</td>
					<td>Date</td>
					<td>Time</td>
					<td>Time Duration</td>
        			<td>Notes</td>
					
				</tr>
				</thead>
				<tbody>
					<?php
						
						if(!isset($_GET['p']))
						{
							 $page=1;
						}
						else
						{
							$page = $_GET['p'];
						}
						$lan=count($sel_res)-1;
						$pager=pagedata($GLOBALS['no_row'],$lan,$page);
						//print_r($sel_res);
						//print_r($pager);
						$start=$pager['offset'];
						$end=$pager['limit'];
						if($end>$lan)
						{
							$end=$lan;
						}
						for($i=$start;$i<$end;$i++)
						{
					?>
						<tr>
					<?php	
						echo "<td ><a href='medical_history.php?pid=".$sel_res[$i]['pid']."&aid=".$sel_res[$i]['id']."'>".$sel_res[$i]['appointment_no']."</a></td>";
						echo "<td title='".$sel_res[$i]['pname']."'>".compressDetail($sel_res[$i]['pname'],$GLOBALS['pcno'])."</td>";
						echo "<td>".$sel_res[$i]['gender']."</td>";
						echo "<td>".$sel_res[$i]['phone']."</td>";
						echo "<td>".showDate($sel_res[$i]['date'])."</td>";
						echo "<td>".$sel_res[$i]['time']."</td>";
						echo "<td>".$sel_res[$i]['time_duration']."</td>";
						echo "<td title='".$sel_res[$i]['notes']."'>".compressDetail($sel_res[$i]['notes'],$GLOBALS['ncno'])."</td>";
					?>
						
						<td>
						
							<a href='patient_reg.php?pid=<?php echo $sel_res[$i]['pid'];?>&p=<?php echo $page; ?>'>
							<input class="icon16-button forms-16" value="Edit Patient" type="button">
							</a>
						
							<a href='today_appointment.php?op=update&app_id=<?php echo $i; ?>' class="l-float edit-click">
							<input class="icon16 edit-16 " value="" type="button">
							</a>
							<a  onclick='return confirmSubmit()' href='today_appointment.php?op=delete&app_id=<?php echo $sel_res[$i]['id']; ?>'>
								<input class="icon16 cancel-16" value="" type="button">
							</a>
								<input type="hidden" value="" id="aid">
						</td>	
					<?php
						echo "</tr>";
					}
					?>
                    </tr>
            </tbody>
                    
			
	</table>
						<section>
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
									<span>
										<?php page_strip($page,$fdir,$pager);?>
									</span>	
							</div>
							<div class="clearfix"></div>
						</section>
                        
					</fieldset>
			
		
</div>
<?php 
			if( isset($_REQUEST['op']) && $_REQUEST['op']=="delete")
			{
				if(isset($res_del) && $res_del==1 )
				{
					echo "<div class='alert-msg success-msg' align='center'>Succesfully Delete Appointment<a href=''>×</a></div>";
				
				}
				else
				{
					echo "<div class='alert-msg error-msg'>'". $res_del."'<a href=''>×</a></div>";
				}
			}
			if($flag==1)
			{
				echo "<div class='alert-msg success-msg' align='center'>Succesfully update Appointment<a href=''>×</a></div>";
			}
?>	

</div>
</div>
</div>

 	<?php
		}
		else
		{
	?>
	                         
	<div class="alert-msg info-msg" align="center">No today Appoitment<a href="">×</a></div>
	
	<?php
		}
	?>
	
<?php
	if( isset($_REQUEST['op']) && $_REQUEST['op']=="update")
	{
		$no=$_REQUEST['app_id'];
		//echo "$no";
	?>
	
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form novalidate method="post" action="today_appointment.php" class="i-validate"> 
		<fieldset>
			<input type="hidden" name="txtid" value="<?php echo $sel_res[$no]['id'];?>">
			<section>
				<div class="section-left-s">
					<label for="text_field">Appointment No</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtappno"  id="text_field" class="i-text required" type="text" value="<?php if(isset($sel_res[$no]['appointment_no'])){echo $sel_res[$no]['appointment_no'];}?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Date:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
                    <input name="txtdate"  class="i-text required wid" id="datepicker" type="date" required pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" placeholder="MM/DD/YYYY" value="<?php echo $sel_res[$no]['date'];?>">

				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Time:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txttime"  id="text_field" class="i-text required" type="text" value="<?php echo $sel_res[$no]['time'];?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Time Duration:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txttime_duration" id="text_field" class="i-text required" type="text" value="<?php echo $sel_res[$no]['time_duration'];?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Notes:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtnotes" id="text_field" class="i-text required" type="text" value="<?php echo $sel_res[$no]['notes'];?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="save"></div>
						<div class="r-float" id="editclose"><input class="button" value="Cancel" type="button"></div>
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
	}
	?>
<div id="editfade" class="dark_overlay"></div>
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
<div id="editfade" class="dark_overlay"></div>
</BODY>
</html>
<?php 

	}
	else
	{
			header("location:login.php");
	}
	
?>
