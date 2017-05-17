<?php
	//session_start();
	//$meid=$_SESSION['meid'];
	//echo $meid;
	include_once "fun.php";
	if(isset($_POST['btnsubmit']))
	{
		//$state_name=$_POST['txtstatename'];
		//$phno=$_POST['txtphone_no'];
		$sid=ins_state($_POST);
		$cid=ins_city($sid,$_POST);
		ins_area($cid,$_POST);
		echo "<div class='alert-msg success-msg' align='center'>Insert Success<a href=''>×</a></div>";
		
	}
	else
	{
		//return 1;
		echo "<div class='alert-msg error-msg' align='center'>Not Insert<a href=''>×</a></div>";
	}
?>
