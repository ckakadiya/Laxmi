<?php
	include_once("function.php");
	if(isset($_POST['save']))
	{
		$clinic=array();
		$clinic['cid']=$_SESSION['cid'];
		$clinic['address']=$_POST['txtadd'];
		$clinic['phno']=$_POST['txtpno'];
		$res_clinic= updateClinic($clinic);
	}
?>