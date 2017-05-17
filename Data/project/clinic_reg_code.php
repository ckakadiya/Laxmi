<?php
	include_once("connect.php");
	include_once("function.php");
	if(isset($_POST['submit']))
	{
		
		$clinic=$_POST['txtcname'];
		$area=$_POST['txtarea'];
		$city=$_POST['txtcity'];
		$state=$_POST['txtstate'];
		$pin=$_POST['txtpin'];
		$phone=$_POST['txtpno'];
		$date=$_POST['txtdate'];
		$plan=$_POST['txtplan'];

		$arr_clinic=array();
		$arr_clinic['clinic']=$clinic;
		$arr_clinic['address']=$area." ".$city." ".$state." ".$pin;
		$arr_clinic['phone']=$phone;
		$arr_clinic['date']=date('Y')."-".date('m')."-".date('d');
		$arr_clinic['plan']=$plan;
		//print_r($arr_clinic);
		$ins_result=insClinicReg($arr_clinic);
		if($ins_result['result']==0)
		{
				$cid=$ins_result['cid'];
				//print_r($ins_result);
				echo "Clinic insert Done successfully...";
				header("location:user_reg.php?cid=$cid");
		}
		else
		{
				echo $ins_res;
		}
	}
?>