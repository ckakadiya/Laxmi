<?php
	session_start();
	$str="report";
	$menu="rep_pending";
	if(isset($_SESSION['cid']))
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
<?php include_once("datepicker/dropdown-month-year.php");?>
</HEAD>
<BODY>

	
    <?php
		include_once("function.php");
		include_once("header.php");
		include_once("connect.php");
		include_once("global.php");
		include_once('paging.php');
		
	?>
	<div id="container">
	<?php 
		include_once("report_menu.php");
		//$arr=pendingTretment();
	?>
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
	 
	$sel_res=pendingTretment();
	//print_r($sel_res);
	$lan=count($sel_res);
	$pager=pagedata($GLOBALS['no_row'],$lan,$page);
	//print_r($sel_res);
	//print_r($pager);
	?>
	
    <?php
	
	$start=$pager['offset'];
	$end=$pager['limit'];
	if($end>$lan)
	{
		$end=$lan;
	}
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>Pending treatment</h3></div>
			<div class="box-content no-padding">
            <?php
			if($lan>0)
			{
			?>
				<table class="i-table fullwidth">
                     <thead>
                        <tr>
                        	<td>Appointment No</td>
							<td>patient Name</td>
							<td>Gender</td>
                        	<td>Date</td>
                            <td>time</td>
                        	<td>Time Duration</td>
                            <td>Notes</td>
                         </tr>
                      </thead>
				<tbody>	
              <?php
			  	for($i=$start;$i<$end;$i++)
				{
				echo "<tr>";
				echo "<td>".$sel_res[$i]['appointment_no']."</td>";
				?>
				
				<td><a href="print_patient_detail.php?pid=<?php echo $sel_res[$i]['pid'];?>"><?php echo $sel_res[$i]['pname'];?></a></td>
				<?php
				echo "<td>".$sel_res[$i]['gender']."</td>";
				echo "<td>".$sel_res[$i]['date']."</td>";
				echo "<td>".$sel_res[$i]['time']."</td>";
				echo "<td>".$sel_res[$i]['time_duration']."</td>";
				echo "<td title='".$sel_res[$i]['notes']."'>".compressDetail($sel_res[$i]['notes'],$GLOBALS['ncno'])."</td>";
				echo "</tr>";
				}
			  ?>
                </tbody>
                </table>
				<br>
                    <section>
					<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
					<?php
						page_strip($page,$fdir,$pager);
					?>
		</div>
		<div class="clearfix"></div>
	</section>
			<?php
			}
			else
			{
			?>
            
	<div class="alert-msg info-msg" align="center">No pending Tretment<a href="">×</a></div>
            <?php
			}
			?>
			</div>
		</div>
	</div>
</div>

</BODY>
</html>
<?php
	}
?>