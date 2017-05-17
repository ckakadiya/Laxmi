<?php
	include_once("function.php");
	if(isset($_POST['submit']))
	{
		//echo "abc";
		$arr_login=array();
		
		$arr_login['email']=$_POST['txtuname'];
		$arr_login['password']=$_POST['txtpass'];
		//print_r($arr_login);
		$sel_res=loginVerify($arr_login);
		//print_r($sel_res);
		
		if($sel_res['result']==1)
		{
				
				session_start();
				$_SESSION['cid']=$sel_res['cid'];
				$_SESSION['cname']=$sel_res['cname'];
				$_SESSION['uid']=$sel_res['uid'];
				$_SESSION['uname']=$sel_res['username'];
				$_SESSION['eid']=$sel_res['eid'];
				$access=array();
				$access['cid']=$sel_res['cid'];
				$access['uid']=$sel_res['uid'];
				$access['client_ip']=$_SERVER['REMOTE_ADDR'];
				$access['browser']=$_SERVER['HTTP_USER_AGENT'];
				$access['login_date']=date('Y-m-d');
				$access['login_time']=date('h:m:s A');
				insAccess($access);
				header("location:appointment_reg.php");
		}
		else
		{
				if($sel_res['result']==2)
				{
					echo "Incorrect username and Password ";
				}
				else
				{
					echo "Reasion : ".$sel_res['result']."<br>";
					echo "please contect admin@example.com";
				}
		}
		
	}
?>