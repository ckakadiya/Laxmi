<?php
if(isset($_POST['submit']) || isset($_GET['txtfromdate']))
	{
		
		
		$arr_patient=array();
		$arr['from']=insDate($_REQUEST['txtfromdate']);
		$arr['to']=insDate($_REQUEST['txttodate']);
		$arr['dieses']=$_REQUEST['dieses'];
		$fdir = $_SERVER['PHP_SELF'];
		//print_r($arr);
		$area=diesesReport($arr);
		//print_r($area);
		if(!empty($area))
		{
		$area_count=array_count_values($area['areaname']);	
		//print_r($area_count);
		include_once('paging.php');
		if((!isset($_GET['p']) )|| (isset($_POST['hid'])))
		{
			 $page=1;
		}
		else
		{
			$page = $_GET['p'];
		}
		
?>


		<?php
			//echo "<h2 align='center'> Patient Profile </h2>";
			$lan=count($area_count);
			
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
				<tr align="center">
					<td>Area Name</td>
					<td>No of patient</td>
				</tr>
				</thead>
				<tbody>
		<?php	
			foreach ($area_count as $key=>$value)
			{
				echo "<tr align='center'>";
				echo "<td>".$key."</td>";
				echo "<td>".$value."</td>";
				echo "</tr>";
			}
		?>
</tbody>
</table>
<?php
			}
			else
			{
				echo "<div class='alert-msg info-msg' align='center'>NO pattient of that dieses<a href=''>×</a></div>";
			}
?>
	</center>
	</body>
</html>
<?php
	}
?>