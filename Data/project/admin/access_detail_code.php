<?php
	if(isset($_SESSION['adminid']))
	{
		if(isset($_POST['submit']) || isset($_GET['txtfromdate']))
		{
				$access=array();
				$access['cid']=$_REQUEST['cid'];
				$access['from']=insDate($_REQUEST['txtfromdate']);
				$access['to']=insDate($_REQUEST['txttodate']);
				$fdir = $_SERVER['PHP_SELF'];
				include_once('paging.php');
				if((!isset($_GET['p']) )|| (isset($_POST['hid'])))
				{
					 $page=1;
				}
				else
				{
					$page = $_GET['p'];
				}
				$res_access=accessDetail($access);
				$lan=count($res_access['id']);
				$pager=pagedata($GLOBALS['no_row'],$lan,$page);
				//print_r($pager);
				$start=$pager['offset'];
				$end=$pager['limit'];
				if($end>$lan)
				{
					$end=$lan;
				}
				if(count($res_access)>0)
				{
				?>
                <table class="i-table fullwidth">
				<thead>
				<tr >
					<td>User Name</td>
                    <td>Date</td>
					<td>Time</td>
					<td>IP Address</td>
					<td>Browser</td>
				</tr>
				</thead>
				<tbody>
                <?php
				for($i=$start;$i<$end;$i++)
				{
					echo "<tr>";
					echo "<td>".$res_access['user_name'][$i]."</td>";
					echo "<td>".$res_access['login_date'][$i]."</td>";
					echo "<td>".$res_access['login_time'][$i]."</td>";
					echo "<td>".$res_access['client_ip'][$i]."</td>";
					echo "<td title='".$res_access['browser'][$i]."'>".compressDetail($res_access['browser'][$i],$GLOBALS['bcno'])."</td>";
					echo "</tr>";
				}
				?>
            	</tbody>
            	</table>
            
						<section>
							<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								
									<span>
										<?php
											page_strip_log($page,$fdir,$pager,"txtfromdate",$_REQUEST['txtfromdate'],"txttodate",$_REQUEST['txttodate'],"cid",$_REQUEST['cid']);
				}
				else
				{
				?>
                	<section>
                    <div class="alert-msg info-msg" align="center">Search Date Not Found</div>
		            </section>
                <?php
				}
										?>									
									</span>
								
							</div>
							<div class="clearfix"></div>
						</section>

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