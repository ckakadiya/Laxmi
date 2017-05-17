<?php
	include_once "function.php";
	$id=$_GET['id'];	
	//$id=$_POST['vdid'];
	if(del_mr($id))
	{
		header("location:mr_reg.php");
	}
	else
	{
		return false;	
	}

	

?>
