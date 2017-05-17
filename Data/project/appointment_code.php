<?php
	$flag=0;
	include_once("connect.php");
	include_once("function.php");
	/*$qry="select * from Appointment";
	$sel_res=mysql_query($qry);
	$last_app=mysql_num_rows($sel_res);
	$qry="select Appointment_no from Appointment where id='$last_app'";
	$sel_res=mysql_query($qry);
	$row=mysql_fetch_array($sel_res);*/
	
	if(isset($_POST['submit']))
	{
		$arr_app=array();
		$arr_app['cid']=$_SESSION['cid'];
		$arr_app['pname']=$_POST['txtpname'];
		$arr_app['gender']=$_POST['gender'];
		$arr_app['phno']=$_POST['txtphone'];
		$arr_app['ano']=$_POST['txtappno'];
		$arr_app['email']=$_POST['txtemail'];
		//print_r($arr_app);
		$search=searchPatient($arr_app);
		//print_r($search);
		if(isset($search['result']))
		{				
			$arr_app['result']=$search['result'];
		}
		if($arr_app['result']==1)	
		{
			$arr_app['pid']=$search['pid'];
		}
		$ins_Appointment=insAppointment($arr_app);
//		print_r($ins_Appointment);
		if($ins_Appointment['result']!=1)
		{
		echo $ins_Appointment['result'];; 
		}
		
	}
?>