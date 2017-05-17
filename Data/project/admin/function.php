<?php
	include_once "connect.php";
		function insDate($dt)
		{
			$date=explode("/",$dt);
			
			return "$date[2]/$date[0]/$date[1]";
		}
		
		function showDate($dt)
		{
			$date=explode("-",$dt);
			return "$date[2]/$date[1]/$date[0]";
	
		}
	function clinicAppointment()
	{
		$first_day_this_month = date('Y-m-01');
		$last_day_this_month  = date('Y-m-t');
	
		$clinic=array();
		$qry="select * from clinic";
		$res=mysql_query($qry) or die(mysql_error());
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			
			$count=0;
			$clinic['cid'][$c]=$row['id'];
			$clinic['cname'][$c]=$row['clinic_name'];
			$clinic['address'][$c]=$row['address'];
			$clinic['phno'][$c]=$row['phoneno'];
			$clinic['date'][$c]=$row['date'];
			
			$qry="select * from patient_clinic where clinic_id='".$row['id']."'";
			$res1=mysql_query($qry);
			while($row1=mysql_fetch_array($res1))
			{
				$pcid=$row1['id'];
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and date between '".$first_day_this_month."' and '".$last_day_this_month."'";
				//echo $qry;
				$sel_res=mysql_query($qry);
				while($row2=mysql_fetch_array($sel_res))
				{
					$count++;
				}

			}
			$clinic['no_of_app'][$c]=$count;
			$c++;
			
		}
		
			//print_r($clinic);
			return $clinic;
	}
	
	function accessDetail($access)
	{
		$qry="select * from access_history where clinic_id='".$access['cid']."'  and login_date BETWEEN '".$access['from']."' AND '".$access['to']."'";
		$res=mysql_query($qry) or die(mysql_error());
		$i=0;
		$res_access=array();
		while($row=mysql_fetch_array($res))
		{
			$res_access['id'][$i]=$row['id'];
			$res_access['cid'][$i]=$row['clinic_id'];
			$res1=mysql_query("select * from user where id='".$row['user_id']."'");
			$row1=mysql_fetch_array($res1);
			$res_access['user_name'][$i]=$row1['user_name'];
			$res_access['uid'][$i]=$row['user_id'];
			$res_access['client_ip'][$i]=$row['client_ip'];
			$res_access['browser'][$i]=$row['browser'];
			$res_access['login_date'][$i]=$row['login_date'];
			$res_access['login_time'][$i]=$row['login_time'];
			$i++;
		}
		return($res_access);
	}
	function clinicAccess()
	{
		$first_day_this_month = date('Y-m-01');
		$last_day_this_month  = date('Y-m-t');
		//echo $first_day_this_month;
		//echo $last_day_this_month;
	
		$clinic=array();
		$qry="select * from clinic";
		$res=mysql_query($qry) or die(mysql_error());
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			
			$count=0;
			$clinic['cid'][$c]=$row['id'];
			$clinic['cname'][$c]=$row['clinic_name'];
			$clinic['address'][$c]=$row['address'];
			$clinic['phno'][$c]=$row['phoneno'];
			$clinic['date'][$c]=$row['date'];
			$qry="select * from doctor_clinic where clinic_id='".$row['id']."'";
			$res1=mysql_query($qry);
			if(mysql_num_rows($res1)==1)
			{
					$row2=mysql_fetch_array($res1);
					$qry="select * from login_status where id=(select id from login where user_email_id=(select id from user_email where user_id=(select user_id from doctor where id=(select doctor_id from doctor_clinic where clinic_id='".$row 	['id']."'))))";
					//echo $qry."<br>";
					//echo $qry;
					
					$res3=mysql_query($qry) or die(mysql_error());
					$row3=mysql_fetch_array($res3);
					//print_r($row3);
					$clinic['status'][$c]=$row3['status'];
					$clinic['reasion'][$c]=$row3['reasion'];
					$clinic['lid'][$c]=$row3['id'];

			}
			$c++;
		}
			//print_r($clinic);
			return $clinic;
	}

	function compressDetail($text,$no)
	{
		$len=strlen($text);
		if($len > $no)
		{
			$str=substr($text,0,$no);
			$str=$str."...";
		}
		else
		{
			$str=$text;
		}
			return $str;
	}
	
	
	function updateStatus($arr_status)
	{
			print_r($arr_status);
			$qry="update login_status set status='".$arr_status['status']."',reasion='".$arr_status['reasion']."' where id='".$arr_status['lid']."'";
			if(mysql_query($qry) or die(mysql_error()))
			{
					$result=1;
			}
			else
			{
					$result=mysql_error();
			}
			return $result;
	}
	
	function loginVerify($login)
	{
		//print_r($login);
		$arr=array();
		$qry="select * from admin_login where user_name='".$login['uname']."' and password='".$login['password']."'";
		$res=mysql_query($qry) or die(mysql_error());
		//echo "abc";
		if(mysql_num_rows($res)>0)
		{
			$row=mysql_fetch_assoc($res);
			$arr['adminid']=$row['id'];
			$arr['username']=$row['user_name'];
			$arr['status']=1;
		}
		else
		{
			$arr['status']=0;
		}
		return $arr;
	}
	function diesesReport($dieses)
	{
		//print_r($dieses);
		$area=array();
		$sql="select * from dieses where dieses_name='".$dieses['dieses']."'";
		$res=mysql_query($sql) or die (mysql_error());
		if(mysql_num_rows($res) > 0)
		{
			$row=mysql_fetch_array($res);
			
			$sql="select * from treatment where dieses_id='".$row['id']."'";
			$res=mysql_query($sql) or die (mysql_error());
			$c=0;
			while($row1=mysql_fetch_array($res))
			{
				//print_r($row1);
				
				$qry="select * from appointment where id='".$row1['appointment_id']."' and date between '".$dieses['from']."' and '".$dieses['to']."'";
				$res1=mysql_query($qry) or die (mysql_error());
				if(mysql_num_rows($res1)>0)
				{
					$row=mysql_fetch_array($res1);
					$qry="select * from patient_clinic where id='".$row['patient_clinic_id']."'";
					$res1=mysql_query($qry) or die (mysql_error());
					$row=mysql_fetch_array($res1);
					$area['id'][$c]=$row['patient_id'];
					$qry="select * from area where id=(select area_id from patient_address where patient_id='".$row['patient_id']."')";
					$res1=mysql_query($qry) or die (mysql_error());
					$row=mysql_fetch_array($res1);
					if(isset($row['area_name']))
					{
						$area['areaname'][$c]=$row['area_name'];
					}
					else
					{
						$area['areaname'][$c]="No area specify";
					}
					$c++;
				}		
			}
		}
		else
		{
			//echo "not found";
		}
//		print_r($area);
		return $area;
	}
?>