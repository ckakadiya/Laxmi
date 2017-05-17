<?php
	session_start();
	$meid=$_SESSION['meid'];
	echo $meid;
	include_once "function.php";
	if(isset($_POST['btnsubmit']))
	{
		//return 0;
		//echo "hiii";
		//SelContent($_POST);
		$coid=ins_content($_POST);
		//echo $coid;
		//$meid=ins_medicine($_POST);
		//echo $coid,$meid;
		//$meid=$_POST['txtmeid'];
		//echo "medicine_id=".$meid;
		$status=ins_medicine_content($meid,$coid,$_POST);
		echo $status;
		header("location: medicine_content.php");
	}
	else
	{
		//return 1;
		echo "not insert";
	}
?>										 
