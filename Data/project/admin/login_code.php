<?php
	include_once("function.php");
	if(isset($_POST['submit']))
	{
		//echo "abc";
		$arr_login=array();
		
		$arr_login['uname']=$_POST['txtuname'];
		$arr_login['password']=$_POST['txtpass'];
		//print_r($arr_login);
		$sel_res=loginVerify($arr_login);
		//print_r($sel_res);
		
		if($sel_res['status']==1)
		{
				
				session_start();
				$_SESSION['adminid']=$sel_res['adminid'];
				$_SESSION['username']=$sel_res['username'];
				header("location:clinic_wise_app.php");
		}
		else
		{
					echo "Incorrect username and Password ";
		}
		
	}
?>