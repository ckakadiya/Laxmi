<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_date";
		$fdir = $_SERVER['PHP_SELF'];
		include_once("function.php");
		include_once("paging.php");
		include_once("global.php");
		include_once("datepicker/dropdown-month-year.php");
		
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
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("app_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="calendar-16"></span><h3>Date-wise Appoinment</h3></div>
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate">
					<fieldset>
						<section>
							<!--<div class="section-left-s">
								<label for="text_field">Name</label>
							</div>
							<div class="section-right">-->
							<form action="" method="post">
								<div class="section-input">
								<input  type="text" name="date"   class="i-text required wid" id="datepicker" required pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" placeholder="MM/DD/YYYY">
								</div>
								<input name="datesubmit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:right;">
<!-- 							</div> -->
							</form>
							<div class="clearfix"></div>
						</section>
						<table class="i-table fullwidth">
						<?php
						
						if(isset($_POST['datesubmit']) || isset($_REQUEST['date']))
						{
								$date=array();
								$date['date']=$_REQUEST['date'];
								$date['cid']=$_SESSION['cid'];
					
								if((!isset($_GET['p']) )|| (isset($_POST['hid'])))
								{
									 $page=1;
								}
								else
								{
									$page = $_GET['p'];
								}
								
								$sel_res=selAppointmentDateWise($date);
								$lan=count($sel_res);
								$pager=pagedata($GLOBALS['no_row'],$lan,$page);
								//print_r($sel_res);
								//print_r($pager);
								$start=$pager['offset'];
								$end=$pager['limit'];
								if($end>$lan)
								{
									$end=$lan;
								}
								if(count($sel_res)>0)
								{
						?>
				<thead>
				<tr class="dark">
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
					for($i=$start;$i<$end;$i++)
					{
				?>
						<tr <?php if($i % 2 == 0) {?> class="light" <?php } else {?> class="dark" <?php } ?>>
				<?php
						echo "<td height='35'>".$sel_res[$i]['appointment_no']."</td>";
						echo "<td title='".$sel_res[$i]['pname']."'>".compressDetail($sel_res[$i]['pname'],$GLOBALS['pcno'])."</td>";
						echo "<td>".$sel_res[$i]['gender']."</td>";
						echo "<td>".$sel_res[$i]['phone']."</td>";
						echo "<td>".showDate($sel_res[$i]['date'])."</td>";
						echo "<td>".$sel_res[$i]['time']."</td>";
						echo "<td>".$sel_res[$i]['time_duration']."</td>";
						echo "<td title='".$sel_res[$i]['notes']."'>".compressDetail($sel_res[$i]['notes'],$GLOBALS['ncno'])."</td>";
						echo "</tr>";
					}
					?>
					</tfoot>
			</table>
						<section>
							<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								
									<span>
									<?php
										page_strip_submit($page,$fdir,$pager,"date",$_REQUEST['date']);
									?>
									</span>
								
							</div>
							<div class="clearfix"></div>
						</section>
					</fieldset>
				</form>
                <?php
					}
					else
					{
				?>
                		<section>
                            <div class="alert-msg info-msg" align="center">No Appointment Exist</div>
                        </section>
                <?php
					}			
				?>
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
	 <?php
    	
	?>
	<?php
		}
	?>
</body>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>
