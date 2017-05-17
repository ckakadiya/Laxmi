<?php
	include_once("connect.php");
	include_once("function.php");
	if(isset($_POST['submit']))
	{	
		$arr_user=array();
		$cid=$_GET['cid'];	
		$arr_user['cid']=$cid;
		$arr_user['username']=$_POST['txtuname'];
		$arr_user['area']=$_POST['txtarea'];
		$arr_user['city']=$_POST['txtcity'];
		$arr_user['state']=$_POST['txtstate'];
		$arr_user['email']=$_POST['txtemail'];
		$arr_user['pwd']=$_POST['txtpwd'];
		$arr_user['que']=$_POST['txtque'];
		$arr_user['ans']=$_POST['txtans'];
		$arr_user['phone']=$_POST['txtphone'];
		$arr_user['pin']=$_POST['txtpin'];
		$arr_user['speciality']=$_POST['txtspc'];
		
		$ins_res=insUserReg($arr_user);
		echo $ins_res;
		if($ins_res==555555)
		{
				//echo "sucsess";
				header("location:login.php"); 
		}
		else
		{
			echo "user insert fail";
			echo $ins_res;
		}
	}
?>