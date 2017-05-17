<?php
	include_once("Function.php");
	if(isset($_POST['submit']))
	{
		$arr_login=array();
		
		$arr_login['uname']=$_POST['txtuser'];
		$arr_login['password']=$_POST['txtpass'];
		$sel_res=loginVerify($arr_login);
		if($sel_res['status']==1)
		{
			session_start();
			$_SESSION['adminid']=$sel_res['adminid'];
			$_SESSION['username']=$sel_res['username'];
			header("location:newCustomer.php");
		}
		else
		{
			echo "Incorrect Username and Password ";
		}
		
	}
?>
