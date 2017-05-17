<?php
	include_once "function.php";
	
	if(isset($_POST['btnupdate']))
	{
		upd_medicine($_POST);
		//$result=sel_mr();
		header("location:medicine.php");
	}
	else
	{
		echo "not update";
	}
?>
