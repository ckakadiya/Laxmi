<?php
	//session_start();
	include_once("connect.php");
	include_once("function.php");
	if(isset($_POST['submit']))
	{
		$arr_patient=array();
		$arr_patient['cid']=$_SESSION['cid'];
		$arr_patient['pid']=$_POST['pid'];
		$arr_patient['pname']=$_POST['txtpname'];
		$arr_patient['dd']=$_POST['dd'];
		$arr_patient['mm']=$_POST['mm'];
		$arr_patient['yyyy']=$_POST['yyyy'];
		$arr_patient['gender']=$_POST['gender'];
		$arr_patient['area']=$_POST['txtarea'];
		$arr_patient['state']=$_POST['txtstate'];
		$arr_patient['city']=$_POST['txtcity'];
		$arr_patient['area_id']=$_POST['txtpin'];
		$arr_patient['email']=$_POST['txtemail'];
		$arr_patient['phone']=$_POST['txtphone'];
		//print_r($arr_patient);
		$ins_patient=insPatient($arr_patient);
		print_r($ins_patient);
		if($ins_patient['result']=="1")
		{
			echo "Sucsess";
			$page=$_REQUEST['pageno'];
			header("location:today_appointment.php?p=$page");
		}
		else
		{
			echo "error NO:$ins_patient";
		}	
	}
	
?>
