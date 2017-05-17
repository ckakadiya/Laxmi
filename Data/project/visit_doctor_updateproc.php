<?php
	include_once "function.php";
	if(isset($_POST['btnsubmit']))
	{	echo "hiiielllo";
		print_r($_POST);
		upd_visiting_doctor($_POST);
		//header("location: visit_doctor.php");
	}
?>
