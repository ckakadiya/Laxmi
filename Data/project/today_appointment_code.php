<?php
	if(isset($_POST['save']))
	{
		//echo "dsd";
		$flag=0;
		$appointment=array();
		$appointment['id']=$_POST['txtid'];
		$appointment['app_no']=$_POST['txtappno'];
		$appointment['date']=$_POST['txtdate'];
		$appointment['time']=$_POST['txttime'];
		$appointment['time_duration']=$_POST['txttime_duration'];
		$appointment['notes']=$_POST['txtnotes'];
		$res_update=updateAppointment($appointment);
		if($res_update==1)
		{
			$flag=1;
		}
		else
		{
?>
			<div class="alert-msg error-msg"><?php echo $res_update; ?><a href="">×</a></div>
<?php
			
		}
	}
?>