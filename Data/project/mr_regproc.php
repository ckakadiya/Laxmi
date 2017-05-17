<?php
	session_start();
	include_once "function_mr.php";
	$cid=$_SESSION['cid'];
	if(isset($_POST['btninsert']))
	{
		print_r($_POST);
		//$val=ins_mr();
		//$mr_id=$_POST['txtid'];
		$email=$_POST['txtemail'];
		$phno=$_POST['txtphone_no'];
		//$min=$_POST['selmrmin'];
		//$med=$_POST['selmrmed'];
		//$time=$_POST['selmrtime']." ".$med;
		
		//echo $email,$phno;
		$mrid=ins_mr($_POST,$cid);
		ins_mr_email($mrid,$email);
		ins_mr_phone_no($mrid,$phno);

		//echo $email;
		//echo "hiii";
		//header("location:medicine.php?mrid=".$mrid);
	}
?>
