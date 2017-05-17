<?php
	session_start();
	include_once("function.php");
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_coming";
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
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
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
<div id="editfade" class="dark_overlay"></div>
	<?php
		include_once("connect.php");
		include_once("global.php");
		
		include_once('paging.php');
	?>
	<?php include_once("header.php");?>
	<div id="container">
<?php include_once("app_menu.php");?>
	
	<?php
	$fdir = $_SERVER['PHP_SELF'];

	
	if(!isset($_GET['p']))
	{
		 $page=1;
	}
	else
	{
		$page = $_GET['p'];
	}
		
	$sel_res=upcomingAppointment($_SESSION['cid']);
	//print_r($sel_res);
	?>
    <?php
	if(isset($sel_res['id']))
	{
	$lan=count($sel_res['id']);
	$pager=pagedata($GLOBALS['no_row'],$lan,$page);
	$start=$pager['offset'];
	$end=$pager['limit'];
	if($end>$lan)
	{
		$end=$lan;
	}
	}
	?>
	<div class="bit-14">
		<div class="box-element">
        <?php include_once("today_appointment_code.php");?>
			<div class="box-head-light"><span class="widgets-16"></span><h3>Upcoming Appoinment</h3></div>
			<div class="box-content no-padding">
            <?php
			
            if(isset($sel_res['result']))
			{
				?>
	
					<fieldset>
						<table class="i-table fullwidth" >
						<thead>
						<tr>
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
						<?php
								$color=0;
								for($i=$start;$i<$end;$i++)
								{
						?>
									
										<tr>
										
						<?php			echo "<td height='35'>".$sel_res['appointment_no'][$i]."</td>";
										echo "<td title='".$sel_res['pname'][$i]."'>".compressDetail($sel_res['pname'][$i],$GLOBALS['pcno'])."</td>";
										echo "<td>".$sel_res['gender'][$i]."</td>";
										echo "<td>".$sel_res['pno'][$i]."</td>";
										echo "<td>".$sel_res['date'][$i]."</td>";
										echo "<td>".$sel_res['time'][$i]."</td>";
										echo "<td>".$sel_res['time_duration'][$i]."</td>";
										echo "<td title='".$sel_res['notes'][$i]."'>".compressDetail($sel_res['notes'][$i],$GLOBALS['ncno'])."</td>";
							?>
                            			<td>	
                                        <a href='upcoming_appointment.php?op=update&app_id=<?php echo $i; ?>' class="l-float edit-click">
							<input class="icon16 edit-16 " value="" type="button">
							</a>
							<a  onclick='return confirmSubmit()' href='upcoming_appointment.php?op=delete&app_id=<?php echo $sel_res['aid'][$i]; ?>'>
								<input class="icon16 cancel-16" value="" type="button">
							</a>
									
						</td>
                            <?php
							
										echo "</tr>";
										$color++;
								}
						?>
						
				</table>
					<section>
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
		?>
			</div>
		</div>
</div>
</div>
<?php
	if( isset($_REQUEST['op']) && $_REQUEST['op']=="update")
	{
		$no=$_REQUEST['app_id'];
		//echo "$no";
	?>
	
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form novalidate method="post" action="upcoming_appointment.php" class="i-validate"> 
		<fieldset>
			<input type="hidden" name="txtid" value="<?php echo $sel_res['id'][$no];?>">
			<section>
				<div class="section-left-s">
					<label for="text_field">Appointment No</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtappno"  id="text_field" class="i-text required" type="text" value="<?php if(isset($sel_res['appointment_no'][$no])){echo $sel_res['appointment_no'][$no];}?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Date:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
                    <input name="txtdate"  class="i-text required wid" id="datepicker" type="date" required pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" placeholder="MM/DD/YYYY" value="<?php echo $sel_res['date'][$no];?>">

				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Time:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txttime"  id="text_field" class="i-text required" type="text" value="<?php echo $sel_res['time'][$no];?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Time Duration:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txttime_duration" id="text_field" class="i-text required" type="text" value="<?php echo $sel_res['time_duration'][$no];?>"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Notes:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtnotes" id="text_field" class="i-text required" type="text" value="<?php echo $sel_res['notes'][$no];?>"></div>
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

	<?php	
	}
	
	else
	{
	?>
</BODY>
</html>
<?php
	echo "<div class='alert-msg info-msg' align='center'>No Upcoming Appointment</div>";
	}
	}
	else
	{
			header("location:login.php");
	}
		
?>
