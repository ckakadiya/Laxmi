<?php
	include_once "function.php";
	$id=$_GET['id'];
	//echo $id;
	//$id=$_POST['vdid'];
	if(delVisitDoc($id))
	{
		header("Location: visit_doctor.php");	
	}
	else
	{
		return false;	
	}
?>
