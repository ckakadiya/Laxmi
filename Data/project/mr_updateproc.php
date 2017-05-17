<?php
	include_once "function.php";
	
	if(isset($_POST['btnupdate']))
	{
		upd_mr($_POST);
		//$result=sel_mr();
		header("location:mr_reg.php");
	}
	else
	{
		echo "not update";
	}
?>
