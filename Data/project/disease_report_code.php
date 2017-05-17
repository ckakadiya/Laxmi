<?php
	if(isset($_POST['dieses_submit']) || isset($_REQUEST['dieses']))
	{
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
		$dieses=array();
		$dieses['cid']=$_SESSION['cid'];
		$dieses['dieses']=$_REQUEST['dieses'];
		//echo $dieses['dieses'];
		$res_dises=diesesReport($dieses);
		//print_r($res_dises);
		if(isset($res_dises['result']) && $res_dises['result']==1)
		{
				$lan=count($res_dises['id']);
				$pager=pagedata($GLOBALS['no_row'],$lan,$page);
				//print_r($pager);
				$start=$pager['offset'];
				$end=$pager['limit'];
				if($end>$lan)
				{
					$end=$lan;
				}
		?>
		<table class="i-table fullwidth">
				<thead>
				<tr>
					<th height="35">Patient Name</th>
					<th>Date of birth</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Phone No</th>
					<th>street Name</th>
					<th>Date</th>
					<th>Time</th>
				</tr>
				</thead>
				<tbody>
		
		<?php
				for($i=$start;$i<$end;$i++)
				{
		?>
				<tr>
					
						<td align="center" title="<?php echo $res_dises['pname'][$i];?>" height="35"><?php if(isset($res_dises['pname'][$i])){echo compressDetail($res_dises['pname'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></td>
						<td align="center"><?php if(isset($res_dises['dob'][$i])){echo $res_dises['dob'][$i];}else{echo "-----";}?></td>
						<td align="center"><?php if(isset($res_dises['gender'][$i])){echo $res_dises['gender'][$i];}else{echo "-----";}?></td>
						<td align="center" title="<?php echo $res_dises['email'][$i];?>"><?php if(isset($res_dises['email'][$i])){echo compressDetail($res_dises['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></td>
						<td align="center"><?php if(isset($res_dises['phone'][$i])){echo $res_dises['phone'][$i];}else{echo "-----";}?></td>
						<td align="center" title="<?php echo $res_dises['street'][$i];?>"><?php if(isset($res_dises['street'][$i])){echo compressDetail($res_dises['street'][$i],$GLOBALS['scno']);}else{echo "-----";}?></td>
						<td align="center"><?php if(isset($res_dises['date'][$i])){echo $res_dises['date'][$i];}else{echo "-----";}?></td>
						<td align="center"><?php if(isset($res_dises['time'][$i])){echo $res_dises['time'][$i];}else{echo "-----";}?></td>
					
				</tr>
				
						<?php
							}
						?>
					</tfoot>
			</table>
						<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								
									<span>
										  <?php
    										page_strip_submit($page,$fdir,$pager,"dieses",$_REQUEST['dieses']);
											?>
									</span>
								
							</div>
							<div class="clearfix"></div>
						</section>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>     
	</body>
</html>
<?php
		}
		else
		{
		?>
			<section>
                    <div class="alert-msg info-msg" align="center"><?php echo "No Patient avelabal for<span>". $_POST['dieses'] ."</span>  dieses"; ?></div>
            </section>
			
		<?php
		}
	}
?>