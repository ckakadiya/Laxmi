<?php
	if(isset($_POST['submit']))
	{
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
?>
			<div class="alert-msg success-msg">Succesfully update Appointment</div>
<?php
		}
		else
		{
?>
			<div class="alert-msg error-msg"><?php echo $res_update; ?></div>
<?php
			
		}
	}
?>