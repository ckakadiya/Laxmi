<?php
	if(isset($_SESSION['cid']))
	{
		
	if(isset($_POST['submit']) || isset($_GET['txtfromdate']))
	{
		
		
		$arr_patient=array();
		$arr_patient['from']=insDate($_REQUEST['txtfromdate']);
		$arr_patient['to']=insDate($_REQUEST['txttodate']);
		$fdir = $_SERVER['PHP_SELF'];
		//echo "sdds";
		include_once('paging.php');
		if((!isset($_GET['p']) )|| (isset($_POST['hid'])))
		{
			 $page=1;
		}
		else
		{
			$page = $_GET['p'];
		}
		$res_patient=patientBwDates($arr_patient);
		//print_r($res_patient);
?>


		<?php
			//echo "<h2 align='center'> Patient Profile </h2>";
			$lan=count($res_patient['id']);
			$pager=pagedata($GLOBALS['no_row'],$lan,$page);
			//print_r($pager);
			$start=$pager['offset'];
			$end=$pager['limit'];
			if($end>$lan)
			{
				$end=$lan;
			}
			if(count($res_patient)>0)
			{
		?>
        	<table class="i-table fullwidth">
				<thead>
				<tr>
					<td>Patient Name</td>
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
                <td>
				<span class="red" title="<?php echo $res_patient['name'][$i];?>">
					<?php if(isset($res_patient['name'][$i])){echo compressDetail($res_patient['name'][$i],$GLOBALS['pcno']);} else {echo "-----";}?>
				</span>
				</td>
								<!--<td>
									<span class="wid-auto">
										<?php //if(isset($res_patient['dob'][$i])){echo showDate($res_patient['dob'][$i]);}else{echo "-----";}?>
									</span>
								</td>-->
								<td>
									<span class="red" title="<?php echo $res_patient['email'][$i];?>">
										<?php if(isset($res_patient['email'][$i])){echo compressDetail($res_patient['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>
									</span>
								</td>
								<td>
									<span class="wid-auto">
										<?php if(isset($res_patient['phone'][$i])){echo $res_patient['phone'][$i];}else{echo "-----";}?>
									</span>
								</td>
                                
								<td>
									<span class="red" title="<?php echo $res_patient['street'][$i];?>">
										<?php if(isset($res_patient['street'][$i])){echo compressDetail(trim($res_patient['street'][$i]),$GLOBALS['scno']);}else{echo "-----";}?>
									</span>
								</td>
								<td>
									<span class="wid-auto">
										<?php if(isset($res_patient['date'][$i])){echo showDate($res_patient['date'][$i]);}else{echo "-----";}?>
									</span>
								</td>
								<td>
									<span class="wid-auto">
										<?php if(isset($res_patient['time'][$i])){echo $res_patient['time'][$i];}else{echo "-----";}?>
									</span>
								</td>
<!--								<td>
									<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>
								</td>-->
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
										page_strip_from_to($page,$fdir,$pager,"txtfromdate",$_REQUEST['txtfromdate'],"txttodate",$_REQUEST['txttodate']);
										?>									
									</span>
								
							</div>
							<div class="clearfix"></div>
						</section>
	<?php
	}
	else
	{
	?>
    	<section>
            <div class="alert-msg info-msg" align="center">Search Patient Not Found</div>
        </section>
    <?php
	}
	?>
	</center>
	</body>
</html>
<?php
	}
	}
	else
	{
			header("location:login.php");
	}
	
	
?>