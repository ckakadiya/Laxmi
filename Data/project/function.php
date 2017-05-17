
<?php
	include_once("connect.php");
	include_once("function_mr.php");
	include_once("function_vd.php");
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

		function userUpdate($user)
	{
		$c=0;
		$sql="update user set user_name='".$user['uname']."' where id='".$user['uid']."'";
		if(mysql_query($sql))
		{
			
			$sql="update address set street_name='".$user['street']."',area_id='".$user['pin']."' where id=(select address_id from user_address where user_id='".$user['uid']."')";
			//echo $sql;
			if(mysql_query($sql))
			{
				$sql="update area set city_id='".$user['city']."' where id=(select area_id from address where id=(select address_id from user_address where user_id='".$user['uid']."'))";
				//echo $sql;
				if(mysql_query($sql))
				{
					$sql="update city set state_id='".$user['state']."' where id=(select city_id from area where id=(select area_id from address where id=(select address_id from user_address where user_id='".$user['uid']."'))";
					//echo $sql;
					if(!mysql_query($sql))
					{
						$err=mysql_error();
						//echo $err;
						$c++;
					}
				}
				else
				{
					$err=mysql_error();
					//echo $err;
					$c++;
				}
				
			}
			else
			{
				$err=mysql_error();
				//echo $err."1st";
				$c++;
			}
			
		}
		else
		{
			$err=mysql_error();
			echo $err;
			$c++;
		}
		if($c==0)
		{
			$error=1;
		}
		else
		{
				$error=$err;
		}
		return $error;
	}
	function insClinicReg($clinic)//clinic registration
	{
		$qry="insert into clinic values('','".$clinic['clinic']."','".$clinic['address']."',".$clinic['plan'].",'".$clinic['date']."','".$clinic['phone']."')";
		
		if(mysql_query($qry))
		{
				$res['result']=0;
				$res['cid']=mysql_insert_id();
		}
		else
		{
				$res['result']=mysql_error();
				
		}
		return $res;
	}
	
	
	function insUserReg($user)//User registration
	{
		$uid=0;
		$count=0;
		$qry="insert into user values('','".$user['username']."')";//user table data insert
	
		if(mysql_query($qry))//user table
		{
			$uid=mysql_insert_id();
			$qry="insert into doctor values('',$uid,'".$user['speciality']."')";
			if(mysql_query($qry))//doctor table
			{
					$did=mysql_insert_id();
					$qry="insert into doctor_clinic values('',$did,'".$user['cid']."')";
					if(!mysql_query($qry))//doctor_clinic table
					{
						$count++;  $errno=mysql_errno();
						echo mysql_error();	
					}	
					$qry="insert into email values('','".$user['email']."')";
					if(mysql_query($qry))//email table
					{
							$eid=mysql_insert_id();
							$qry="insert into user_email values('',$uid,$eid)";
							if(mysql_query($qry))//user_email table
							{
									$ueid=mysql_insert_id();
									$qry="insert into login values('','".$user['username']."','".$user['pwd']."','".$user['que']."','".$user['ans']."','$ueid')";
									if(mysql_query($qry))//login table
									{
										$lid=mysql_insert_id();
										$qry="insert into login_status values('$lid','1','')";
										if(!mysql_query($qry))
										{
											$count++;
											echo mysql_error();
										}
									}
									else
									{
										$count++;  $errno=mysql_errno(); 	
											echo mysql_error()."2";	
									}
							}
							else
							{
									$count++;  $errno=mysql_errno();
									echo mysql_error()."3"; 
							}
					}
					else
					{
							$count++;  $errno=mysql_errno(); 
							echo mysql_error()."4";
					}
					$qry="insert into phone_no values('',".$user['phone'].")";
					if(mysql_query($qry))//phone table
					{
						$pid=mysql_insert_id();
						$qry="insert into user_phone_no values('',$uid,$pid)";
						if(!mysql_query($qry))//user_phone table
						{
							$count++;  $errno=mysql_errno(); 
							echo mysql_error()."5";
						}
					}
					else
					{
							$count++;  $errno=mysql_errno();
							echo mysql_error(); 
					}
					$qry="insert into address values('','".$user['area']."',".$user['pin'].")";
					if(mysql_query($qry))//address table
					{
						$aid=mysql_insert_id();
						$qry="insert into user_address values('',$uid,$aid)";
						if(!mysql_query($qry))//usre_address table
						{
								$count++;  $errno=mysql_errno(); 
								echo mysql_error()."6";
						}
					}
					else
					{
							$count++;  $errno=mysql_errno();
							echo mysql_error()."7"; 
					}
					
			}
			else
			{
					$count++;  $errno=mysql_errno();
					echo mysql_error()."8"; 
			}
		}		
		else
		{
				$count++;  $errno=mysql_errno(); 
				echo mysql_error()."9";
		}
			//echo "function success";		
			if($count!=0)
			{
				$qry="delete  from user where uid='".$uid."'";
				mysql_query($qry);
				return $errno;
			}
			else
			{
					return 555555;
			}
	}
	function insAccess($access)//insert the user login access time ,ip ,browser
	{
			$qry="insert into access_history values('','".$access['cid']."','".$access['uid']."','".$access['client_ip']."','".$access['browser']."','".$access['login_date']."','".$access['login_time']."')";
			mysql_query($qry);
	}
	function loginVerify($login)
	{
		//print_r($login);
		$arr_login=array();
		$qry="select * from email where email_address='".$login['email']."' limit 1";
		$email_res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_array($email_res);
		$eid=$row['id'];
		$email=$row['email_address'];
		//echo "$row[id],$email";
		$qry="select * from user_email where email_id='$eid'";
		$email_res=mysql_query($qry);
		
		$row=mysql_fetch_array($email_res);

		$ueid=$row['id'];
		$uid=$row['user_id'];
		
		$qry="select * from login where password='".$login['password']."' and user_email_id='$ueid' limit 1";
		$login_res=mysql_query($qry) or die(mysql_error());
		if(mysql_num_rows($login_res)>0)
		{
			
	
			$login_res=mysql_query($qry);
			$row=mysql_fetch_array($login_res);
			$sql="select * from login_status where id='".$row['id']."'";
			$res=mysql_query($sql);
			$row1=mysql_fetch_array($res);
			if($row1['status']==1)
			{
				$arr_login['result']=1;	
				$arr_login['uid']=$uid;
				$arr_login['eid']=$eid;
				$arr_login['username']=$row['login_name'];
				//echo print_r($row);
				
				$qry="select * from clinic where id=(select clinic_id from doctor_clinic where doctor_id=(select id from doctor where user_id='$uid'))";
				$login_res=mysql_query($qry) or die (mysql_error());
				$row=mysql_fetch_array($login_res);
				//echo print_r($row);
				$arr_login['cid']=$row['id'];
				$arr_login['cname']=$row['clinic_name'];
			}
			else
			{
				$arr_login['result']=$row1['reasion'];	
			}
	
		}
		else{
			$arr_login['result']=2;
	
		}
		//print_r($arr_login);
		return $arr_login;
	}
		
	function selClinic()
	{
		$qry="select * from clinic where id='".$_SESSION['cid']."'";
		$res=mysql_query($qry);
		$row=mysql_fetch_array($res);
		$arr_clinic=array();
		$arr_clinic['cname']=$row['clinic_name'];
		$arr_clinic['address']=$row['address'];
		$arr_clinic['phoneno']=$row['phoneno'];
		
		$qry="select * from plan where id='".$row['plan_id']."'";
		$res=mysql_query($qry);
		$row=mysql_fetch_array($res);
		$arr_clinic['plan']['name']=$row['description'];
		$arr_clinic['plan']['app']=$row['no_of_appointment'];
		$arr_clinic['plan']['time']=$row['time_duration'];
		$arr_clinic['plan']['cost']=$row['cost'];
		return $arr_clinic;
	}
	
	function selUser($user)
	{
		$arr_user=array();
		$sql="select * from user where id='".$user['uid']."'";
		$res=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($res);
		$arr_user['uname']=$row['user_name'];
		
		$sql="select * from address where id=(select address_id from user_address where user_id='".$user['uid']."')";
		$res=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($res);
		$arr_user['street']=$row['street_name'];
		
		$qry="select * from area where id='".$row['area_id']."'";
		$sel_res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_array($sel_res);
		$arr_user['pincode']=$row['pincode'];
					
		$qry="select * from city where id='".$row['city_id']."'";
		$sel_res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_array($sel_res);
		$arr_user['city']=$row['city_name'];
					
		$qry="select * from state where id='".$row['state_id']."'";
		$sel_res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_array($sel_res);
		$arr_user['state']=$row['state_name'];
		
		$qry="select email_id from user_email where user_id='".$user['uid']."'";
		$res=mysql_query($qry) or die(mysql_error());
		$cnt=0;
		while($row=mysql_fetch_array($res))
		{
				$qry="select * from email where id='".$row['email_id']."'";
				$sel_res=mysql_query($qry) or die(mysql_error());
				$row=mysql_fetch_array($sel_res);
				$arr_user['eid'][$cnt]=$row['id'];	
				$arr_user['email'][$cnt]=$row['email_address'];	
				$cnt++;
		}
		
		$qry="select phone_no_id from user_phone_no where user_id='".$user['uid']."'";
		$res=mysql_query($qry) or die(mysql_error());
		$c=0;
		while($row=mysql_fetch_array($res))
		{
				$qry="select * from phone_no where id='".$row['phone_no_id']."'";
				$sel_res=mysql_query($qry) or die(mysql_error());
				$row=mysql_fetch_array($sel_res);
				$arr_user['phid'][$c]=$row['id'];	
				$arr_user['phone'][$c]=$row['phone_no'];	
				$c++;
		}
		//print_r($arr_user);
		return $arr_user;
	}

	function totalAppointment($cid)
	{
		
		$dt=date('Y-m-d');
		//echo $dt;
		$c=0;
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$sel_res=mysql_query($qry);
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and date='$dt'";
				//echo $qry;
				$sel_res1=mysql_query($qry);
				while($row=mysql_fetch_array($sel_res1))
				{
					$c++;
				}

			}
			return $c;
	}
	
	function compliteAppointment($cid)
	{
		$dt=date('Y-m-d');
		//echo $dt;
		$c=0;
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$sel_res=mysql_query($qry);
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and date='$dt'";
				//echo $qry;
				$sel_res1=mysql_query($qry);
				while($row=mysql_fetch_array($sel_res1))
				{
					$sql="select * from treatment where appointment_id='".$row['id']."'";
					$res=mysql_query($sql) or die (mysql_error());
					if(mysql_num_rows($res))
					{
						$c++;
					}
				}

			}
			return $c;
	}


	function deleteEmail($eid)
	{
		$sql="delete from email where id='$eid'";
		mysql_query($sql);
		echo "success";
		
	}
	
	function updateEmail($email)
	{
		$sql="update email set email_address='".$email['txtemail']."' where id='".$email['txtid']."'";
		mysql_query($sql) or die(mysql_error());
		//echo $email['sid']." update success";
	}
	
	function insertEmail($email)
	{
		//print_r($email);
		$sql="insert into email values('','".$email['email']."')";
		if(mysql_query($sql))
		{
			$id=mysql_insert_id();
			$sql="insert into user_email values('','".$email['uid']."','$id')";
			mysql_query($sql) or die (mysql_error());
		}
	}
	
	function insertPhoneNo($phone)
	{
		//print_r($phone);
		$sql="insert into phone_no values('','".$phone['phno']."')";
		if(mysql_query($sql))
		{
			$id=mysql_insert_id();
			$sql="insert into user_phone_no values('','".$phone['uid']."','$id')";
			mysql_query($sql) or die (mysql_error());
		}
	}
	
	function deletePhoneNo($phone)
	{
		$sql="delete from phone_no where id='$phone'";
		mysql_query($sql);
		echo "success";
	}
	
	function updatePhoneNo($phone)
	{
		//print_r($phone);
		$sql="update phone_no set phone_no='".$phone['txtphone']."' where id='".$phone['txtid']."'";
		mysql_query($sql) or die(mysql_error());
		//echo $phone['pid']." update success";
	}
		function deleteAppointment($app)
	{
		$sql="delete from appointment where id=$app";
		//echo $sql;
		if(mysql_query($sql))
		{
			return 1;
		}
		else
		{
			echo mysql_error();
			return mysql_errno();
		}
	}
	
	function updateAppointment($appointment)
	{
		$sql="update appointment set appointment_no=".$appointment['app_no'].",date='".$appointment['date']."',time='".$appointment['time']."',time_duration='".$appointment['time_duration']."',notes='".$appointment['notes']."' where id='".$appointment['id']."'";
		//echo $sql;
		if(mysql_query($sql))
		{
			return 1;
		}
		else
		{
			echo mysql_error();
			return mysql_errno();
		}
	}
	
	function searchPatient($patient)
	{
		//print_r($patient);
		$c=0;
		$arr_sel=array();
		$qry="select * from patient where patient_name='".$patient['pname']."' and gender='".$patient['gender']."' ";	
		$sel_res=mysql_query($qry)or die (mysql_error());
							
		if(mysql_num_rows($sel_res)>=1)
		{
			//echo "find";
			while($row=mysql_fetch_array($sel_res))
			{
				//echo "next";
				$qry="select * from patient_phone_no where patient_id='".$row['id']."' and phone_no='".$patient['phno']."'";
				$sel_res1=mysql_query($qry) or die (mysql_error());
				if(mysql_num_rows($sel_res1)>=1)
				{
					
						$arr_sel['result']=1;
						$pid=$row['id'];
						$qry="select id from patient_clinic where patient_id='".$row['id']."' and clinic_id='".$patient['cid']."'";
						$sel_res2=mysql_query($qry)or die (mysql_error());
						$row=mysql_fetch_array($sel_res2);
						//$arr_sel['result']=1;
						$arr_sel['pcid']=$row['id'];
						$arr_sel['pid']=$pid;
						$c++;
						return $arr_sel;	
				}
				//echo "nect";
			}
		}
		if($c==0)
		{
			$arr_sel['result']=0;
			return $arr_sel;
		}
		
	}
	function insPatient($patient)
	{
		//print_r($patient);
		$count=0;
		$arr_res=array();
		$dob=$patient['yyyy']."-".$patient['mm']."-".$patient['dd'];
		
		$qry="update patient set patient_name='".$patient['pname']."',date_of_birth='".$dob."',gender='".$patient['gender']."' where id='".$patient['pid']."'";
		if(mysql_query($qry)>0)
		{
			
			$qry ="select * from patient_email where patient_id='".$patient['pid']."'";
			$sel_res=mysql_query($qry);
			if(mysql_num_rows($sel_res)>0)
			{
				$qry="update patient_email set email_address='".$patient['email']."' where patient_id='".$patient['pid']."'";	
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}
			else
			{
				$qry="insert into patient_email values('','".$patient['pid']."','".$patient['email']."')";
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}
			
			$qry ="select * from patient_phone_no where patient_id='".$patient['pid']."'";
			$sel_res=mysql_query($qry);
			if(mysql_num_rows($sel_res)>0)
			{
				$qry="update patient_phone_no set phone_no='".$patient['phone']."' where patient_id='".$patient['pid']."'";	
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}
			else
			{
				$qry="insert into patient_phone_no values('','".$patient['pid']."','".$patient['phone']."')";
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}		
			
			$qry ="select * from patient_address where patient_id='".$patient['pid']."'";
			$sel_res=mysql_query($qry);
			if(mysql_num_rows($sel_res)>0)
			{
				$qry="update patient_address set street_name='".trim($patient['area'])."',area_id='".$patient['area_id']."' where patient_id='".$patient['pid']."'";				
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}
			else
			{
				$qry="insert into patient_address values('','".$patient['area']."','".trim($patient['area_id'])."','".$patient['pid']."')";
				if(!mysql_query($qry))
				{
					$count++;
					$error=mysql_error();
					echo mysql_error();
				}
			}			
		}
		else
		{
				$count++;
				$error=mysql_errno();
				echo mysql_error();
		}
		echo "$count";
		if($count==0)
		{
			
			$arr_res['result']=1;
			////print_r($arr_res);
			//return $arr_res;
		}
		else
		{
			
			$arr_res['result']=$err;
		//	return $arr_res;
		}
		return $arr_res;		
	}
	
	
	
	function updateClinic($clinic)
	{
		$sql="update clinic set address='".$clinic['address']."',phoneno='".$clinic['phno']."' where id='".$clinic['cid']."'";
		//echo $sql;
		if(mysql_query($sql))
		{
			return 1;
		}
		else
		{
			echo mysql_error();
			return mysql_errno();
		}
	}
	
	function changePassword($chpwd)
	{
		$arr_res=array();
		//print_r($chpwd);
		//echo "<br/>";
		$qry="select * from user_email where user_id='".$chpwd['uid']."'";
		$res=mysql_query($qry);
		$row=mysql_fetch_array($res);
		$ueid=$row['id'];
		//echo $ueid;
		$qry="select * from login where user_email_id='$ueid'";
			$res=mysql_query($qry);
			$row=mysql_fetch_assoc($res);
			//print_r($row);
			$que=$row['question'];
			$ans=$row['answer'];
			$pass=$row['password'];
			//echo $que.$ans.$pass;
			//echo $_POST['textconpwd'];
			if(($que==$chpwd['que'] && $ans==$chpwd['ans']) && ($pass==$chpwd['pwd']))
			{
				$qry="update login set password='".$chpwd['npwd']."' where user_email_id='$ueid'";
				$res=mysql_query($qry) or die(mysql_error());
				$arr_res['result']=1;
			}
			else
			{
				$arr_res['result']="Question Answer and password does not match";
			}
			return $arr_res;
	}
	
	function forgotPassword($arrfpwd)
	{
		$arr_res=array();
		$qry="select * from email where email_address='".$arrfpwd['email']."'";
		$res=mysql_query($qry);
		$row=mysql_fetch_assoc($res);
		$eid=$row['id'];
		$email=$row['email_address'];
		$qry="select * from user_email where email_id='$eid'";
		$res=mysql_query($qry);
		$row=mysql_fetch_assoc($res);
		$ueid=$row['id'];
		echo $ueid;
		$qry="select * from login where user_email_id='$ueid'";
		$res=mysql_query($qry);
		$row=mysql_fetch_assoc($res);
		$que=$row['question'];
		$ans=$row['answer'];
		echo $email.$que.$ans;
		if ($email==$arrfpwd['email'] && $que==$arrfpwd['que'] && $ans==$arrfpwd['ans'])
		{
			$qry="update login set password=".$arrfpwd['npwd']." where user_email_id='$ueid'";
			$res=mysql_query($qry);
			$arr_res['result']=1;
		}
		else
		{
			$arr_res['result']="Question Answer and password does not match";
		}
			return $arr_res;

	}
	function selPatient()
	{
		$patient=array();
		$qry="select * from patient_clinic where clinic_id='".$_SESSION['cid']."'";
		
		//echo $qry;
		$res=mysql_query($qry);
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			
			$patient['time'][$c]=$row['time'];
			$patient['date'][$c]=$row['date'];
			//echo $row['patient_id']; 
			$qry="select * from patient where id='".$row['patient_id']."'";
			//echo $qry."<br>";
			$res1=mysql_query($qry) or die(mysql_error());
			
			while($r1=mysql_fetch_array($res1))
			{
				
				$patient['id'][$c]=$r1['id'];
				$patient['name'][$c]=$r1['patient_name'];
				$patient['dob'][$c]=$r1['date_of_birth'];
				$patient['gender'][$c]=$r1['gender'];
				
				$qry="select * from patient_email where patient_id='".$patient['id'][$c]."'";
				$res2=mysql_query($qry) or die(mysql_error());
				$r2=mysql_fetch_array($res2);
				$patient['email'][$c]=$r2['email_address'];
				
				$qry="select * from patient_phone_no where patient_id='".$patient['id'][$c]."'";
				$res3=mysql_query($qry) or die(mysql_error());
				$r3=mysql_fetch_array($res3);
				$patient['phone'][$c]=$r3['phone_no'];
				
				$qry="select * from patient_address where patient_id='".$patient['id'][$c]."'";
				$res4=mysql_query($qry)or die(mysql_error());
				$r4=mysql_fetch_array($res4);
				$patient['street'][$c]=$r4['street_name'];
			}
			$c++;
			
		}
		//print_r($patient);
		return $patient;
	}
	
	
	function selPatientAlphaWise($arr)
	{
		$patient=array();
	
		$qry="select patient_clinic.* from patient,patient_clinic WHERE patient_name LIKE '".$arr['sort']."' and clinic_id='".$arr['cid']."' and  patient.id = patient_clinic.patient_id";
		
		//echo $qry;
		$res=mysql_query($qry);
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			
			$patient['time'][$c]=$row['time'];
			$patient['date'][$c]=$row['date'];
			//echo $row['patient_id']; 
			$qry="select * from patient where id='".$row['patient_id']."'";
			//echo $qry."<br>";
			$res1=mysql_query($qry) or die(mysql_error());
			
			while($r1=mysql_fetch_array($res1))
			{
				
				$patient['id'][$c]=$r1['id'];
				$patient['name'][$c]=$r1['patient_name'];
				$patient['dob'][$c]=$r1['date_of_birth'];
				$patient['gender'][$c]=$r1['gender'];
				
				$qry="select * from patient_email where patient_id='".$patient['id'][$c]."'";
				$res2=mysql_query($qry) or die(mysql_error());
				$r2=mysql_fetch_array($res2);
				$patient['email'][$c]=$r2['email_address'];
				
				$qry="select * from patient_phone_no where patient_id='".$patient['id'][$c]."'";
				$res3=mysql_query($qry) or die(mysql_error());
				$r3=mysql_fetch_array($res3);
				$patient['phone'][$c]=$r3['phone_no'];
				
				$qry="select * from patient_address where patient_id='".$patient['id'][$c]."'";
				$res4=mysql_query($qry)or die(mysql_error());
				$r4=mysql_fetch_array($res4);
				$patient['street'][$c]=$r4['street_name'];
			}
			$c++;
			
		}
		//print_r($patient);
		return $patient;
	}
	
	function PatientBwDates($arg_patient)
	{
		$patient=array();
		$qry="select * from patient_clinic where clinic_id='".$_SESSION['cid']."' and date BETWEEN '".$arg_patient['from']."' AND '".$arg_patient['to']."'";
		
		//echo $qry;
		$res=mysql_query($qry);
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			//print_r($row);
			$patient['time'][$c]=$row['time'];
			$patient['date'][$c]=$row['date'];
			//echo $row['patient_id']; 
			$qry="select * from patient where id='".$row['patient_id']."'";
			//echo $qry."<br>";
			$res1=mysql_query($qry) or die(mysql_error());
			$r1=mysql_fetch_array($res1);
				
				$patient['id'][$c]=$r1['id'];
				$patient['name'][$c]=$r1['patient_name'];
				$patient['dob'][$c]=$r1['date_of_birth'];
				$patient['gender'][$c]=$r1['gender'];
				
				$qry="select * from patient_email where patient_id='".$r1['id']."'";
				$res2=mysql_query($qry) or die(mysql_error());
				$r2=mysql_fetch_array($res2);
				$patient['email'][$c]=$r2['email_address'];
				
				$qry="select * from patient_phone_no where patient_id='".$r1['id']."'";
				$res3=mysql_query($qry) or die(mysql_error());
				$r3=mysql_fetch_array($res3);
				$patient['phone'][$c]=$r3['phone_no'];
				
				$qry="select * from patient_address where patient_id='".$r1['id']."'";
				$res4=mysql_query($qry)or die(mysql_error());
				$r4=mysql_fetch_array($res4);
				$patient['street'][$c]=$r4['street_name'];
		
			$c++;
			
		}
		//print_r($patient);
		return $patient;
	}
	
	function insAppointment($app)
	{
		$ins_res=array();
		$date=date('Y')."-".date('m')."-".date('d');
		$count=0;
		if(isset($app['result']))
		{
			if($app['result']==1)
			{
				$qry="select * from patient_clinic where patient_id='".$app['pid']."' and clinic_id='".$app['cid']."' limit 1";
				
				$sel_res=mysql_query($qry);
				if(mysql_num_rows($sel_res)>0)
				{
					$row=mysql_fetch_array($sel_res);
					$pcid=$row['id'];
				}
				
				else
				{
					
					$date_array = getdate();
					$time=$date_array['hours'].":".$date_array['minutes'].":".$date_array['seconds'];
					$qry="insert into patient_clinic values('','".$app['pid']."','".$app['cid']."','$time','$date')";
						
						if(mysql_query($qry))
						{
							$pcid=mysql_insert_id();
							
						}
						
						else
						{	
								$count++;
								$ins_res['result']=mysql_error()."1";
						}
				}
				
				if(isset($pcid))
				{
					$qry="insert into appointment values('',".$app['ano'].",'".$app['date']."','".$app['time']."',".$app['time_duration'].",'".$app['notes']."','$pcid','$date')";
							//echo $qry;
					if(!mysql_query($qry))
					{
						$count++;
						$ins_res['result']=mysql_error()."1";
					}
				}
			}
			else if($app['result']==0)
			{
				
				//print_r($app);
				
				$qry="insert into patient (id,patient_name,gender) values('','".$app['pname']."','".$app['gender']."')";
				if(mysql_query($qry))
				{
					$pid=mysql_insert_id();
					$qry="insert into patient_phone_no values('',$pid,'".$app['phno']."')";
					if(mysql_query($qry))
					{
						$qry="insert into patient_clinic values('',$pid,'".$app['cid']."','".$app['time']."','".$app['date']."')";
						if(mysql_query($qry))
						{
							$pcid=mysql_insert_id();
							$qry="insert into appointment values('',".$app['ano'].",'".$app['date']."','".$app['time']."',".$app['time_duration'].",'".$app['notes']."','$pcid','$date')";
							//echo $qry;
							if(!mysql_query($qry))
							{
								$count++;
								$ins_res['result']=mysql_error()."1";
			
							}
						}
						else
						{
							$count++;
							$ins_res['result']=mysql_error()."2";
						}
						
					}
					else
					{
						$count++;
						$ins_res['result']=mysql_error()."3";
					}
				}
				else
				{
					$count++;
					$ins_res['result']=mysql_error()."4";
				}
			}
		}
		else
		{
			$count++;
			$ins_res['result']="Not inserted";
		}
		if($count==0)
		{
			$ins_res['result']=1;
		}
		return $ins_res;
	}	

	function selPatientDetail($patient)
	{
			
					//print_r($patient);
					$arr_sel=array();
					$qry="select * from patient where id='$patient'";
					$sel_res=mysql_query($qry);
					$row=mysql_fetch_array($sel_res);
					
					$arr_sel['id']=$row['id'];
					$arr_sel['pname']=$row['patient_name'];
					$arr_sel['dob']=$row['date_of_birth'];
					$arr_sel['gender']=$row['gender'];
					
					$qry="select * from patient_address where patient_id='$patient'";
					$sel_res=mysql_query($qry);
					$row=mysql_fetch_array($sel_res);
					$arr_sel['street']=$row['street_name'];
					$pinid=$row['area_id'];
					
					if(mysql_num_rows($sel_res)==1)
					{
						$qry="select * from area where id='".$row['area_id']."'";
						$sel_res=mysql_query($qry);
						$row=mysql_fetch_array($sel_res);
						$arr_sel['pincode']=$row['pincode'];
						$cid=$row['pin_id']=$pinid;
						if(mysql_num_rows($sel_res)==1)
						{
							$qry="select * from city where id='".$row['city_id']."'";
							$sel_res=mysql_query($qry);
							$row=mysql_fetch_array($sel_res);
							$arr_sel['city']=$row['city_name'];
							$arr_sel['city_id']=$cid;
							if(mysql_num_rows($sel_res)==1)
							{
								$qry="select * from state where id='".$row['state_id']."'";
								$sel_res=mysql_query($qry);
								$row=mysql_fetch_array($sel_res);
								$arr_sel['state']=$row['state_name'];
								$arr_sel['state_id']=$row['id'];
							}
							else
							{
								$arr_sel['state']="";
								$arr_sel['state_id']="";
							}
						}
						else
						{
							$arr_sel['city']="";
							$arr_sel['city_id']="";
						}
					}
					else
					{
						$arr_sel['pincode']="";
						$cid=$row['pin_id']="";
					}
					
					
					$qry="select * from patient_email where patient_id='$patient'";
					$sel_res=mysql_query($qry) or die (mysql_error());
					$row=mysql_fetch_array($sel_res);
					$arr_sel['email']=$row['email_address'];
					
					$qry="select * from patient_phone_no where patient_id='$patient'";
					$sel_res=mysql_query($qry);
					$row=mysql_fetch_array($sel_res);
					$arr_sel['phone']=$row['phone_no'];
					
					//print_r($arr_sel);
			
			return $arr_sel;
	}
	
	function upcomingAppointment($appointment)
	{
		
			$date = date("Y-m-d");
			//echo "Today Date:".$date."<br>";
    		$date = strtotime($date);
    		$start_date = strtotime("+1 day", $date);
			$sdate=date('Y-m-d', $start_date);
			$last_date = strtotime("+5 day", $date);
			$ldate=date('Y-m-d', $last_date);
			//echo "<h3>Appointment b/w $sdate to $ldate</h3><br>";
			$arr_sel=array();
			
			$sql="select * from appointment where date between '$sdate' and '$ldate'";
			$res=mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($res) > 0)
			{
				
				$c=0;
				while($row=mysql_fetch_array($res))
				{
					
					$aid=$row['id'];
					$sql="select * from patient where id=(select patient_id from patient_clinic where id='".$row['patient_clinic_id']."' and clinic_id='".$appointment."')";
					$res1=mysql_query($sql) or die (mysql_error());
					if(mysql_num_rows($res1) == 1)
					{
						$arr_sel['result']=1;
						$arr_sel['aid'][$c]=$aid;
						$arr_sel['id'][$c]=$row['id'];
						$arr_sel['appointment_no'][$c]=$row['appointment_no'];
						$arr_sel['date'][$c]=$row['date'];
						$arr_sel['time'][$c]=$row['time'];
						$arr_sel['time_duration'][$c]=$row['time_duration'];
						$arr_sel['notes'][$c]=$row['notes'];
						
						$r=mysql_fetch_array($res1);
						
						$arr_sel['pid'][$c]=$r['id'];
						$arr_sel['pname'][$c]=$r['patient_name'];
						$arr_sel['gender'][$c]=$r['gender'];
						
						$sql="select * from patient_phone_no where patient_id='".$r['id']."'";
						$res1=mysql_query($sql) or die (mysql_error());
						$r=mysql_fetch_array($res1);
						$arr_sel['pno'][$c]=$r['phone_no'];
					
						$c++;
					}
				}
			}
			
			
			
			return $arr_sel;
	}

	
	
	function selAppointmentAlphaWise($patient)
	{
		
		$qry="select patient_clinic.* from patient,patient_clinic WHERE patient_name LIKE '".$patient['sort']."' and clinic_id='".$patient['cid']."' and  patient.id = patient_clinic.patient_id";
		//echo $qry;
		$sel_res=mysql_query($qry);
		$c=0;
		$b=0;
			$arr_sel=array();
				//$c=mysql_num_rows($sel_res);
				//echo $c;
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$pid=$row['patient_id'];
				//echo $pcid;
				
				$qry="select * from patient where id='$pid'" ;
				$sel_res2=mysql_query($qry);
				$row2=mysql_fetch_array($sel_res2);
				
				$pname=$row2['patient_name'];
				$gender=$row2['gender'];
				
				$qry="select * from patient_phone_no where patient_id=$pid";
				$sel_res3=mysql_query($qry) or die(mysql_error());
				$row3=mysql_fetch_array($sel_res3);
				$phone=$row3['phone_no'];
				
				$qry="select * from appointment where patient_clinic_id='".$pcid."'";
				$sel_res1=mysql_query($qry);
				while($row1=mysql_fetch_array($sel_res1))
				{
				//echo $row1['id'];
				
					$arr_sel[$c]['id']=$row1['id'];
					$arr_sel[$c]['appointment_no']=$row1['appointment_no'];
					$arr_sel[$c]['pname']=$pname;
					$arr_sel[$c]['gender']=$gender;
					$arr_sel[$c]['phone']=$phone;
					$arr_sel[$c]['date']=$row1['date'];
					$arr_sel[$c]['time']=$row1['time'];
					$arr_sel[$c]['time_duration']=$row1['time_duration'];
					$arr_sel[$c]['notes']=$row1['notes'];
					$c++;
				}
				
				
			}
			/*if($c==0)
			{
				$arr_sel['result']=0;
			}
			else
			{
				$arr_sel['result']=1;
			}*/
			return $arr_sel;
	}
	
	
		
	function selAllAppointment($patient)
	{
		$qry="select * from patient_clinic where clinic_id='".$patient['cid']."'";
		$sel_res=mysql_query($qry);
		$c=0;
		$b=0;
			$arr_sel=array();
				//$c=mysql_num_rows($sel_res);
				//echo $c;
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$pid=$row['patient_id'];
				//echo $pcid;
				
				$qry="select * from patient where id='$pid'" ;
				$sel_res2=mysql_query($qry);
				$row2=mysql_fetch_array($sel_res2);
				
				$pname=$row2['patient_name'];
				$gender=$row2['gender'];
				
				$qry="select * from patient_phone_no where patient_id=$pid";
				$sel_res3=mysql_query($qry) or die(mysql_error());
				$row3=mysql_fetch_array($sel_res3);
				$phone=$row3['phone_no'];
				
				$qry="select * from appointment where patient_clinic_id='".$pcid."'";
				$sel_res1=mysql_query($qry);
				while($row1=mysql_fetch_array($sel_res1))
				{
				//echo $row1['id'];
					$arr_sel[$c]['id']=$row1['id'];
					$arr_sel[$c]['appointment_no']=$row1['appointment_no'];
					$arr_sel[$c]['pname']=$pname;
					$arr_sel[$c]['gender']=$gender;
					$arr_sel[$c]['phone']=$phone;
					$arr_sel[$c]['date']=$row1['date'];
					$arr_sel[$c]['time']=$row1['time'];
					$arr_sel[$c]['time_duration']=$row1['time_duration'];
					$arr_sel[$c]['notes']=$row1['notes'];
					$c++;
				}
				
				
			}
			//print_r($arr_sel);
			return $arr_sel;
	}
	/*function selAllappointment($patient)
	{
		$qry="select * from patient_clinic where clinic_id='".$patient['cid']."'";
		$sel_res=mysql_query($qry);
		$c=0;
			$arr_sel=array();
				//$c=mysql_num_rows($sel_res);
				//echo $c;
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];          
				//echo $pcid;
				$qry="select * from appointment where patient_clinic_id='".$pcid."'";
				$sel_res1=mysql_query($qry);
			
				while($row1=mysql_fetch_array($sel_res1))
				{
				//echo $row1['id'];
				$arr_sel[$c]['id']=$row1['id'];
				$arr_sel[$c]['Appointment_no']=$row1['Appointment_no'];
				$arr_sel[$c]['date']=$row1['date'];
				$arr_sel[$c]['time']=$row1['time'];
				$arr_sel[$c]['time_duration']=$row1['time_duration'];
				$arr_sel[$c]['notes']=$row1['notes'];
				$c++;
				}
			}
			return $arr_sel;
	}
	*/
	function todayAppointment($patient)
	{
		$count=0;
		$dt=date('Y-m-d');
		//echo $dt;
		$qry="select * from patient_clinic where clinic_id='".$patient['cid']."'";
		$sel_res=mysql_query($qry);
		$c=0;
			$arr_sel=array();
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$pid=$row['patient_id'];
				//echo $pcid;
				
				$qry="select * from patient where id='$pid'";
				$sel_res2=mysql_query($qry);
				$row2=mysql_fetch_array($sel_res2);
				
				$pname=$row2['patient_name'];
				$gender=$row2['gender'];
				
				$qry="select * from patient_phone_no where patient_id=$pid";
				$sel_res3=mysql_query($qry) or die(mysql_error());
				$row3=mysql_fetch_array($sel_res3);
				$phone=$row3['phone_no'];
				
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and date='$dt'";
				$sel_res1=mysql_query($qry);
				while($row1=mysql_fetch_array($sel_res1))
				{
				//echo $row1['id'];
					$arr_sel[$c]['pid']=$pid;
					$arr_sel[$c]['id']=$row1['id'];
					$arr_sel[$c]['appointment_no']=$row1['appointment_no'];
					$arr_sel[$c]['pname']=$pname;
					$arr_sel[$c]['gender']=$gender;
					$arr_sel[$c]['phone']=$phone;
					$arr_sel[$c]['date']=$row1['date'];
					$arr_sel[$c]['time']=$row1['time'];
					$arr_sel[$c]['time_duration']=$row1['time_duration'];
					$arr_sel[$c]['notes']=$row1['notes'];
					$c++;
					$count++;
				}

			}
			if($count==0)
			{
				$arr_sel['result']=0;
			}
			else
			{
				$arr_sel['result']=1;
			}
			return $arr_sel;
	}
	function medicalHistory($pid)
	{
			$medical_history=array();
			
			$qry="select * from medical_history where patient_id='$pid'";
			$res=mysql_query($qry);
			if(mysql_num_rows($res)>0)
			{
				$medical_history['res']=1;
				$c=1;
				while($row=mysql_fetch_array($res))
				{
					$medical_history['description'][$c]=$row['description'];
					$qry="select * from dieses where id='".$row['dieses_id']."'";
					$res1=mysql_query($qry);
					$row1=mysql_fetch_array($res1);
					$medical_history['dieses_name'][$c]=$row1['dieses_name'];
					$c++;
				}
			}else
			{
					$medical_history['res']=0;
			}
			return($medical_history);
			
	}
	function medicalHistoryIns($dieses)
	{
		$ins_res=array();
		$qry="select * from dieses where dieses_name like '".$dieses['dieses']."'";
		$res=mysql_query($qry);
		if(mysql_num_rows($res)>0)
		{
				$row=mysql_fetch_array($res);
				$qry="select * from medical_history where patient_id='".$dieses['pid']."' and dieses_id='".$row['id']."'";
				$res2=mysql_query($qry);
				if(!mysql_num_rows($res2)>0)
				{
					$qry1="insert into medical_history values('','".$dieses['pid']."','".$row['id']."','".$dieses['description']."')";
					if(mysql_query($qry1))
					{
						$ins_res['result']=1;
					}
					else
					{
						$ins_res['result']=mysql_error();
					}
				}
				else
				{
					$ins_res['result']="Patient alrady Has this dieses";
				}
				
		}
		else
		{
			$ins_res['result']=mysql_error();
		}
		return($ins_res);
	}
	function dieses()
	{
			$c=0;
			$dieses=array();
			$qry="select * from dieses";
			$res_dieses=mysql_query($qry);
			while($row=mysql_fetch_array($res_dieses))
			{
					$dieses['id'][$c]=$row['id'];
					$dieses['name'][$c]=$row['dieses_name'];
					$c++;
			}
			
		return($dieses);
	}
	function medicine()
	{
			$c=0;
			$medicine=array();
			$qry="select * from medicine";
			$res_dieses=mysql_query($qry);
			while($row=mysql_fetch_array($res_dieses))
			{
					$medicine['id'][$c]=$row['id'];
					$medicine['name'][$c]=$row['medicine_name'];
					$c++;
			}
			//print_r($medicine);
		return($medicine);
	}

	
	function selAppointmentDateWise($app_date)
	{
		$qry="select * from patient_clinic where clinic_id='".$app_date['cid']."'";
		$sel_res=mysql_query($qry);
		$c=0;
		$b=0;
			$arr_sel=array();
				//$c=mysql_num_rows($sel_res);
				//echo $c;
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$pid=$row['patient_id'];
				//echo $pcid;
				
				$qry="select * from patient where id='$pid'";
				$sel_res2=mysql_query($qry);
				$row2=mysql_fetch_array($sel_res2);
				
				$pname=$row2['patient_name'];
				$gender=$row2['gender'];
				
				$qry="select * from patient_phone_no where patient_id=$pid";
				$sel_res3=mysql_query($qry) or die(mysql_error());
				$row3=mysql_fetch_array($sel_res3);
				$phone=$row3['phone_no'];
				
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and date='".insDate($app_date['date'])."'";
				$sel_res1=mysql_query($qry);
				while($row1=mysql_fetch_array($sel_res1))
				{
				//echo $row1['id'];
					$arr_sel[$c]['id']=$row1['id'];
					$arr_sel[$c]['appointment_no']=$row1['appointment_no'];
					$arr_sel[$c]['pname']=$pname;
					$arr_sel[$c]['gender']=$gender;
					$arr_sel[$c]['phone']=$phone;
					$arr_sel[$c]['date']=$row1['date'];
					$arr_sel[$c]['time']=$row1['time'];
					$arr_sel[$c]['time_duration']=$row1['time_duration'];
					$arr_sel[$c]['notes']=$row1['notes'];
					$c++;
				}
				
				
			}
			////print_r($arr_sel);
			return $arr_sel;
			
	}
	
	function selTable($tbl)
	{
		$qry="select * from $tbl order by id";
		$result=mysql_query($qry);
		return $result;
	}

	function select($str)
	{
		$result=mysql_query($str) or die(mysql_error());
		$row=mysql_fetch_array($result);
		return($row);
	}	
	

function insPrescription($prescription)
{	
		$tid=0;
		$qry="select * from dieses where dieses_name like '".$prescription['dname']."'";
		$result=mysql_query($qry);
		if(mysql_num_rows($result)>0)
		{		
				$row=mysql_fetch_array($result);
				$did=$row['id'];
				$qry="select * from treatment where appointment_id='".$prescription['aid']."' and dieses_id='$did'";
				$res=mysql_query($qry);
				if(!mysql_num_rows($res)>0)
				{
					$qry="insert into treatment values('','".$prescription['aid']."','$did','".$prescription['des']."')";
					mysql_query($qry);
					$tid=mysql_insert_id();
					echo $tid;
				}else
				{
						echo "teratment alreday exist";
						$tid=0;
				}
		}	
		else
		{
				echo "dises not found";
				$qry="insert into dieses values('','".$prescription['dname']."')";
				mysql_query($qry);
				$did=mysql_insert_id();
				$qry="select * from treatment where appointment_id='".$prescription['aid']."' and dieses_id='$did'";
				$res=mysql_query($qry);
				if(!mysql_num_rows($res)>0)
				{
					$qry="insert into treatment values('','".$prescription['aid']."','$did','".$prescription['des']."')";
					mysql_query($qry);
					$tid=mysql_insert_id();
					echo $tid;
				}else
				{
						echo "NEW teratment alreday exist";
					$tid=0;
				}
				
		}
		
		if($tid!=0)
		{
				for($i=0;$i<count($prescription['mname']);$i++)
				{
					$qry="select * from medicine where medicine_name like '".$prescription['mname'][$i]."'";
					$res=mysql_query($qry);
					if(mysql_num_rows($res)>0)
					{
						
						$row=mysql_fetch_array($res);
						$mid=$row['id'];
						echo "mid=".$mid."<br>";
						$qry="insert into prescription values('','$mid','$tid','".$prescription['qty'][$i]."','".$prescription['not'][$i]."','".$prescription['des']."')";
						mysql_query($qry);
					}
					else
					{
						echo "medicine id not found";
						$qry="insert into medicine values('','".$prescription['mname'][$i]."','null')";
						$res=mysql_query($qry);
						$mid=mysql_insert_id();
						echo "new mid=".$mid."<br>";
						$qry="insert into prescription values('','$mid','$tid','".$prescription['qty'][$i]."','".$prescription['not'][$i]."','".$prescription['des']."')";
						mysql_query($qry);
					}
				}
				
		if(isset($_FILES['pretreatment']['tmp_name']))
			{
				
				//print_r($_FILES);
				$a=0;
				foreach($_FILES["pretreatment"]["tmp_name"] as $k => $v)
				{
					if($_FILES['pretreatment']['size'][$k] > 0)
					{
						if($_FILES['pretreatment']['type'][$k] == "image/jpeg" || $_FILES['pretreatment']['type'][$k] == "image/png")
						{
							$a++;
							$type=substr($_FILES['pretreatment']['type'][$k],6);
							echo $type;
							move_uploaded_file($v,"upload/pretreatment/".$_FILES['pretreatment']['name'][$k]);
							rename("upload/pretreatment/".$_FILES['pretreatment']['name'][$k],"upload/pretreatment/img_".$tid."_".$a.".jpeg");
							$name="img_".$tid."_".$a.".".$type;
							$sql="insert into pre_treatment values('','$tid','$name','upload/pretreatment')";
							echo $sql;
							mysql_query($sql) or die(mysql_error());
						}
						else
						{
							die("This format does not allowed");
						}
					}
				}
				
				foreach($_FILES["posttreatment"]["tmp_name"] as $k => $v)
				{
					if($_FILES['posttreatment']['size'][$k] > 0)
					{
						if($_FILES['posttreatment']['type'][$k] == "image/jpeg" || $_FILES['posttreatment']['type'][$k] == "image/png")
						{
							$a++;
							$type=substr($_FILES['posttreatment']['type'][$k],6);
							echo $type;
							move_uploaded_file($v,"upload/posttreatment/".$_FILES['posttreatment']['name'][$k]);
							rename("upload/posttreatment/".$_FILES['posttreatment']['name'][$k],"upload/posttreatment/img_".$tid."_".$a.".jpeg");
							$name="img_".$tid."_".$a.".".$type;
							$sql="insert into post_treatment values('','$tid','$name','upload/posttreatment')";
							echo $sql;
							mysql_query($sql) or die(mysql_error());
						}
						else
						{
							die("This format does not allowed");
						}
					}
				}
				
			}		
			if(isset($prescription['nextapp']))
			{
				$qry="insert into next_appointment values('','".$prescription['aid']."','".insDate($prescription['nextapp'])."','".$prescription['longtreat']."')";
				mysql_query($qry) or die(mysql_error());
			}
				
		}
		
}
function selTreatment($treatment)
{
		$arr_treatment=array();
		$qry="select * from patient_clinic where patient_id='".$treatment['pid']."' and clinic_id='".$treatment['cid']."'";
		$res=mysql_query($qry);
		$c=0;
		if(mysql_num_rows($res)>0)
		{
			$row=mysql_fetch_array($res);
			$pcid=$row['id'];
			
			$qry="select * from appointment where patient_clinic_id='$pcid'";
			$res=mysql_query($qry);
				
			while($row1=mysql_fetch_array($res))
			{
				$qry="select * from  treatment where appointment_id='".$row1['id']."'";
				$result=mysql_query($qry);
				$row=mysql_fetch_array($result);
				
				if($row['id']!=0)
				{
					$arr_treatment[$c]['id']=$row['id'];
					$arr_treatment[$c]['date']=$row1['date'];
					$c++;
					$arr_treatment['result']=1;
				}
							
					
			}
			
		}
		
		return($arr_treatment);
}

function selTreatmentDetail($treatment)
{
		$p=0;
		$pp=0;
		$arr_treatment_detail=array();
		$qry="select * from treatment where id='".$treatment['tid']."'";
		
		$res=mysql_query($qry);
		if(mysql_num_rows($res)>0)
		{
				$row=mysql_fetch_array($res);
				
				$qry="select * from treatment where appointment_id='".$row['appointment_id']."'";
				
				$res=mysql_query($qry);
				$c=0;			
				while($row=mysql_fetch_array($res))
				{	
					
					//$arr_treatment_detail[$c]['id']=$row['id'];
					$qry1="select * from dieses where id='".$row['dieses_id']."'";
					$res1=mysql_query($qry1);
					$row1=mysql_fetch_array($res1);
					$arr_treatment_detail[$c]['did']=$row['dieses_id'];
					$arr_treatment_detail[$c]['dname']=$row1['dieses_name'];
					
					$qry2="select * from prescription where treatment_id='".$row['id']."'";
					//echo $qry2;
					$res2=mysql_query($qry2);
					if(mysql_num_rows($res2)>=1)
					{
						$i=0;
						$j=0;
						while($row2=mysql_fetch_array($res2))
						{
								$mid=$row2['medicine_id'];
								$qry3="select * from medicine where id='".$row2['medicine_id']."'";
								
								$res3=mysql_query($qry3);
								$row3=mysql_fetch_array($res3);
								
								$arr_treatment_detail[$c]['mname'][$i]=$row3['medicine_name'];
								$arr_treatment_detail[$c]['qty'][$i]=$row2['quantity'];
								$arr_treatment_detail[$c]['not'][$i]=$row2['no_of_time'];
								$arr_treatment_detail[$c]['description'][$i]=$row2['description'];
								$i++;
						}
						

					}
							
					$c++;

				}
		}
		//echo "<br>~~~~~~~<br>";
		////print_r($arr_treatment_detail);
		return($arr_treatment_detail);
}


function diesesReport($dieses)
{
	$arr_sel=array();
	$sql="select * from dieses where dieses_name like '".$dieses['dieses']."'";
	$res=mysql_query($sql)or die (mysql_error());
	$flag=0;
	$c=0;
	if(mysql_num_rows($res) > 0)
	{
		$row=mysql_fetch_array($res);
		$did=$row['id'];
		$sql="select * from patient_clinic where clinic_id='".$dieses['cid']."'";
		$res1=mysql_query($sql) or die (mysql_error());
		if(mysql_num_rows($res1)>0)
		{
			while($row1=mysql_fetch_array($res1))
			{
				$pid=$row1['patient_id'];
				
				$sql="select * from appointment where patient_clinic_id='".$row1['id']."'";
				$res2=mysql_query($sql) or die (mysql_error());
				if(mysql_num_rows($res2)>0)
				{
					while($row2=mysql_fetch_array($res2))
					{
						$date=$row2['date'];
						$time=$row2['time'];
					
						$sql="select * from treatment where appointment_id='".$row2['id']."' and dieses_id='$did'";
						$res3=mysql_query($sql) or die (mysql_error());
						if(mysql_num_rows($res3)>0)
						{
							
							$qry="select * from patient where id='".$pid."'";
							$sel_res=mysql_query($qry) or die(mysql_error());
							$r=mysql_fetch_array($sel_res);
									
							$arr_sel['id'][$c]=$r['id'];
							$arr_sel['pname'][$c]=$r['patient_name'];
							$arr_sel['dob'][$c]=$r['date_of_birth'];
							$arr_sel['gender'][$c]=$r['gender'];
									
							$qry="select * from patient_address where patient_id='".$pid."'";
							$sel_res=mysql_query($qry);
							$r=mysql_fetch_array($sel_res);
							$arr_sel['street'][$c]=$r['street_name'];
									
							$qry="select * from area where id='".$r['area_id']."'";
							$sel_res=mysql_query($qry);
							$r=mysql_fetch_array($sel_res);
							$arr_sel['pincode'][$c]=$r['pincode'];
									
							$qry="select * from city where id='".$r['city_id']."'";
							$sel_res=mysql_query($qry);
							$r=mysql_fetch_array($sel_res);
							$arr_sel['city'][$c]=$r['city_name'];
									
							$qry="select * from state where id='".$r['state_id']."'";
							$sel_res=mysql_query($qry);
							$r=mysql_fetch_array($sel_res);
							$arr_sel['state'][$c]=$r['state_name'];
							$arr_sel['state_id'][$c]=$r['id'];
									
							$qry="select * from patient_email where patient_id='$pid'";
							$sel_res=mysql_query($qry) or die (mysql_error());
							$r=mysql_fetch_array($sel_res);
							$arr_sel['email'][$c]=$r['email_address'];
									
							$qry="select * from patient_phone_no where patient_id='$pid'";
							$sel_res=mysql_query($qry);
							$r=mysql_fetch_array($sel_res);
							$arr_sel['phone'][$c]=$r['phone_no'];
							$arr_sel['date'][$c]=$date;
							$arr_sel['time'][$c]=$time;
							$c++;
							$flag++;
						}
					}	
				}
			}
		}
	}
	
	if($flag==0)
	{
		$arr_sel['result']=0;
	}
	else
	{
		$arr_sel['result']=1;
	}
	////print_r($arr_sel);
	return($arr_sel);
}
function patientProfileIncomplite($cid)
{
		$patient=array();
		$qry="select * from patient_clinic where clinic_id='$cid'";
		$res=mysql_query($qry);
		$c=0;
		while($row=mysql_fetch_array($res))
		{
			
			$patient['time'][$c]=$row['time'];
			$patient['date'][$c]=$row['date'];
			//echo $row['patient_id']; 
			$qry="select * from patient where id='".$row['patient_id']."'";
			//echo $qry."<br>";
			$res1=mysql_query($qry) or die(mysql_error());
			
			while($r1=mysql_fetch_array($res1))
			{
				$qry="select * from patient_email where patient_id='".$r1['id']."'";
				$res2=mysql_query($qry) or die(mysql_error());
				$r2=mysql_fetch_array($res2);
				
				$qry="select * from patient_phone_no where patient_id='".$r1['id']."'";
				$res3=mysql_query($qry) or die(mysql_error());
				$r3=mysql_fetch_array($res3);
				
				$qry="select * from patient_address where patient_id='".$r1['id']."'";
				$res4=mysql_query($qry)or die(mysql_error());
				$r4=mysql_fetch_array($res4);
				
				if(empty($r1['id']) || empty($r1['patient_name']) || empty($r1['date_of_birth']) || empty($r1['gender']) || empty($r2['email_address']) || empty($r3['phone_no']) || empty($r4['street_name']))
				{
					$patient['id'][$c]=$r1['id'];
					$patient['name'][$c]=$r1['patient_name'];
					$patient['dob'][$c]=$r1['date_of_birth'];
					$patient['gender'][$c]=$r1['gender'];
					$patient['email'][$c]=$r2['email_address'];
					$patient['phone'][$c]=$r3['phone_no'];
					$patient['street'][$c]=$r4['street_name'];
					$c++;
				}
			}
			
			
		}
		////print_r($patient);
		return $patient;

}

function selState()
	{
			
			$arr_state=array();
			$qry="select * from state";
			$res=mysql_query($qry);
			$i=0;
			while($row=mysql_fetch_array($res))
			{
					$arr_state[$i]['id']=$row['id'];
					$arr_state[$i]['state_name']=$row['state_name'];
					$i++;
			}
						return($arr_state);
	}
	function selCity($state)
	{
			
			$arr_city=array();
			$qry="select * from city where state_id='$state'";
			$res=mysql_query($qry);
			$i=0;
			while($row=mysql_fetch_array($res))
			{
					$arr_city[$i]['id']=$row['id'];
					$arr_city[$i]['city_name']=$row['city_name'];
					$i++;
			}
			
			return($arr_city);
	}
	
	function selPincode($city)
	{
			
			$arr_pincode=array();
			$qry="select * from area where city_id='$city'";
			$res=mysql_query($qry);
			$i=0;
			while($row=mysql_fetch_array($res))
			{
					$arr_pincode[$i]['id']=$row['id'];
					$arr_pincode[$i]['pincode']=$row['pincode'];
					$arr_pincode[$i]['areaname']=$row['area_name'];
					$i++;
			}
			
			return($arr_pincode);
	}
	
	
/*********************************Search*****************************************************/


//  Doctors Search

function searchDataVisitingDoctor($text,$cid)
{
	$data=array();
		if (preg_match("/^[0-9]*$/",$text['text']))
		{
			$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$row_vd=mysql_fetch_array($result_vd);
				
				$qry_upn="select * from user_phone_no where user_id='".$row_vd['user_id']."'";
				$result_upn=mysql_query($qry_upn) or die(mysql_error());		
				
				while ($row_upn=mysql_fetch_array($result_upn))
				{
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$text['text']."%'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
				
					if (mysql_num_rows($result_phno)>0)
						{
							
							$row_phno=mysql_fetch_assoc($result_phno);
							
							$qry_user="select * from user where id='".$row_upn['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
							$result_ue=mysql_query($qry_ue);
							$row_ue=mysql_fetch_assoc($result_ue);
							
							$qry_email="select * from email where id='".$row_ue['email_id']."'";
							$result_email=mysql_query($qry_email);
							$row_email=mysql_fetch_assoc($result_email);
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
				}
			}
			//print_r($data);
		
		}
		
		if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$text['text']))
		{
			$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$row_vd=mysql_fetch_array($result_vd);
				
				$qry_ue="select * from user_email where user_id='".$row_vd['user_id']."'";
				$result_ue=mysql_query($qry_ue);
							
				while ($row_ue=mysql_fetch_array($result_ue))
				{
					$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$text['text']."%'";;
					$result_email=mysql_query($qry_email);
										
				
					if (mysql_num_rows($result_email)>0)
						{
							
							$row_email=mysql_fetch_assoc($result_email);
							
							$qry_user="select * from user where id='".$row_ue['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
							$result_upn=mysql_query($qry_upn) or die(mysql_error());		
							$row_upn=mysql_fetch_array($result_upn);
							
							$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
							$result_phno=mysql_query($qry_phno) or die(mysql_error());
							$row_phno=mysql_fetch_assoc($result_phno);
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
				}
			}
			//print_r($data);
		
		}

		
		if(preg_match("/^[a-zA-Z]*$/",$text['text']))
		{
			$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$result_add=mysql_query($qry_vd) or die(mysql_error());
				
				
				$sel_user="select * from user where user_name like '".$text['text']."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$text['text']."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{
					$row_add=mysql_fetch_array($result_add);
				
				$qry_ua="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_ua=mysql_query($qry_ua);
						
				while ($row_ua=mysql_fetch_assoc($result_ua))
				{
					$qry_address="select * from address where id='".$row_ua['address_id']."' and street_name like '".$text['text']."%'";
					$result_address=mysql_query($qry_address);
						
					
					if (mysql_num_rows($result_address)>0)
					{
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
				
				while ($row_vd=mysql_fetch_array($result_vd))
				{
					$qry_user="select * from user where user_name like '".$text['text']."%' and id='".$row_vd['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());
					
					if (mysql_num_rows($result_user)>0)
					{
						
						$row_user=mysql_fetch_assoc($result_user); 
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
			}
			
		
		}
		//print_r($data);
		
}
	if(isset($row_user['id']))
	{
		$data['status']=0;
		return $data;
	}
}

// Doctors Search
function searchData($text,$cid)
	{
		$data=array();
				
		if (preg_match("/^[0-9]*$/",$text['text']))
		{
			
			$qry="select * from doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_d="select * from doctor where id='".$row['doctor_id']."'";
				$result_d=mysql_query($qry_d) or die(mysql_error());
				$row_d=mysql_fetch_array($result_d);
				
				$qry_upn="select * from user_phone_no where user_id='".$row_d['user_id']."'";
				$result_upn=mysql_query($qry_upn) or die(mysql_error());		
				
				while ($row_upn=mysql_fetch_array($result_upn))
				{
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$text['text']."%'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
					if (mysql_num_rows($result_phno)>0)
						{
							
							$row_phno=mysql_fetch_assoc($result_phno);
							
							$qry_user="select * from user where id='".$row_upn['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
							$result_ue=mysql_query($qry_ue);
							$row_ue=mysql_fetch_assoc($result_ue);
							
							$qry_email="select * from email where id='".$row_ue['email_id']."'";
							$result_email=mysql_query($qry_email);
							$row_email=mysql_fetch_assoc($result_email);
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
				}
			}
			//print_r($data);
			
		
		}
		
		
		if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$text['text']))
		{
			$qry="select * from doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_d="select * from doctor where id='".$row['doctor_id']."'";
				$result_d=mysql_query($qry_d) or die(mysql_error());
				$row_d=mysql_fetch_array($result_d);
				
				$qry_ue="select * from user_email where user_id='".$row_d['user_id']."'";
				$result_ue=mysql_query($qry_ue);
							
				while ($row_ue=mysql_fetch_array($result_ue))
				{
					$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$text['text']."%'";;
					$result_email=mysql_query($qry_email);
										
				
					if (mysql_num_rows($result_email)>0)
						{
							
							$row_email=mysql_fetch_assoc($result_email);
							
							$qry_user="select * from user where id='".$row_ue['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
							$result_upn=mysql_query($qry_upn) or die(mysql_error());		
							$row_upn=mysql_fetch_array($result_upn);
							
							$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
							$result_phno=mysql_query($qry_phno) or die(mysql_error());
							$row_phno=mysql_fetch_assoc($result_phno);
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
				}
			}
			//print_r($data);
		
		}
		

		if(preg_match("/^[a-zA-Z]*$/",$text['text']))
		{
			$qry="select * from doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_d="select * from doctor where id='".$row['doctor_id']."'";
				$result_d=mysql_query($qry_d) or die(mysql_error());
				$result_add=mysql_query($qry_d) or die(mysql_error());
				
				$sel_user="select * from user where user_name like '".$text['text']."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$text['text']."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{
					$row_add=mysql_fetch_array($result_add);
				
				$qry_ua="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_ua=mysql_query($qry_ua);
						
				while ($row_ua=mysql_fetch_assoc($result_ua))
				{
					$qry_address="select * from address where id='".$row_ua['address_id']."' and street_name like '".$text['text']."%'";
					$result_address=mysql_query($qry_address);
						
					
					if (mysql_num_rows($result_address)>0)
					{
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
				
				while ($row_d=mysql_fetch_array($result_d))
				{
					$qry_user="select * from user where user_name like '".$text['text']."%' and id='".$row_d['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());
					
					if (mysql_num_rows($result_user)>0)
					{
						
						$row_user=mysql_fetch_assoc($result_user); 
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
			}
			
		
		}
		//print_r($data);
			
}
if(isset($row_user['id']))
	{
		$data['status']=0;
		return $data;
	}

}

//patient search

	function searchDataPatient($text,$cid)
	{
		$data=array();				
		if (preg_match("/^[0-9]*$/",$text['text']))
		{
			$qry="select * from patient_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
				$qry_phno="select * from patient_phone_no where phone_no like '".$text['text']."%' and patient_id='".$row['patient_id']."'";
				$result_phno=mysql_query($qry_phno) or die(mysql_error());
				
					if (mysql_num_rows($result_phno)>0)
						{
							$row_phno=mysql_fetch_assoc($result_phno);
							
							$qry_patient="select * from patient where id='".$row_phno['patient_id']."'";
							$result_patient=mysql_query($qry_patient) or die(mysql_error());
							$row_patient=mysql_fetch_assoc($result_patient); 
						
							$qry_address="select * from patient_address where patient_id='".$row_patient['id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_email="select * from patient_email where patient_id='".$row_patient['id']."'";
							$result_email=mysql_query($qry_email);
							$row_email=mysql_fetch_assoc($result_email);
							
							($row_patient['id']!=NULL ? $data['id'][$cnt]=$row_patient['id'] : $data['id'][$cnt]="---");
							($row_patient['patient_name']!=NULL ? $data['user'][$cnt]=$row_patient['patient_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
			
			}
			//print_r($data);
			if(isset($row_patient['id']))
			{
			$data['status']=0;
			return $data;
			}
		
		}
		
		
		if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$text['text']))
		{
			$qry="select * from patient_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
	
				$qry_email="select * from patient_email where email_address like '".$text['text']."%' and patient_id='".$row['patient_id']."'";
				$result_email=mysql_query($qry_email) or die(mysql_error());
				
				
					if (mysql_num_rows($result_email)>0)
						{
							$row_email=mysql_fetch_assoc($result_email);
							
							$qry_patient="select * from patient where id='".$row_email['patient_id']."'";
							$result_patient=mysql_query($qry_patient) or die(mysql_error());
							$row_patient=mysql_fetch_assoc($result_patient); 
						
							$qry_address="select * from patient_address where patient_id='".$row_patient['id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
							$qry_phno="select * from patient_phone_no where patient_id='".$row_patient['patient_id']."'";
							$result_phno=mysql_query($qry_phno) or die(mysql_error());
							$row_phno=mysql_fetch_assoc($result_phno);
							
							($row_patient['id']!=NULL ? $data['id'][$cnt]=$row_patient['id'] : $data['id'][$cnt]="---");
							($row_patient['patient_name']!=NULL ? $data['user'][$cnt]=$row_patient['patient_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
						}
			
			}
			//print_r($data);
			if(isset($row_patient['id']))
			{
			$data['status']=0;
			return $data;
			}
		
		}
		

		if(preg_match("/^[a-zA-Z]*$/",$text['text']))
		{
			$qry="select * from patient_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			
			$result_p=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			
			
			$sel_patient="select * from patient where patient_name like '".$text['text']."%'";
			$res_patient=mysql_query($sel_patient);
			
			$sel_address="select * from patient_address where street_name like '".$text['text']."%'";
			$res_address=mysql_query($sel_address);
			
				
			if (mysql_num_rows($res_address)>0)
			{
				
						
				while ($row=mysql_fetch_assoc($result))
				{
					$qry_address="select * from patient_address where patient_id='".$row['patient_id']."' and street_name like '".$text['text']."%'";
					$result_address=mysql_query($qry_address);
						
					
					if (mysql_num_rows($result_address)>0)
					{
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_patient="select * from patient where id='".$row_address['patient_id']."'";
						$result_patient=mysql_query($qry_patient) or die(mysql_error());
						$row_patient=mysql_fetch_assoc($result_patient); 
						
						$qry_phno="select * from patient_phone_no where patient_id='".$row_patient['patient_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
											
						$qry_email="select * from patient_email where id='".$row_patient['patient_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_patient['id']!=NULL ? $data['id'][$cnt]=$row_patient['id'] : $data['id'][$cnt]="---");
						($row_patient['patient_name']!=NULL ? $data['user'][$cnt]=$row_patient['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
			}
			if (mysql_num_rows($res_patient)>0)
			{	
				
				while ($row_p=mysql_fetch_assoc($result_p))
				{
					
					$qry_patient="select * from patient where patient_name like '".$text['text']."%' and id='".$row_p['patient_id']."'";
					$result_patient=mysql_query($qry_patient) or die(mysql_error());
					
					if (mysql_num_rows($result_patient)>0)
					{
						
						$row_patient=mysql_fetch_assoc($result_patient); 
						
						$qry_phno="select * from patient_phone_no where patient_id='".$row_patient['id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_address="select * from patient_address where patient_id='".$row_patient['id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_email="select * from patient_email where patient_id='".$row_patient['id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_patient['id']!=NULL ? $data['id'][$cnt]=$row_patient['id'] : $data['id'][$cnt]="---");
						($row_patient['patient_name']!=NULL ? $data['user'][$cnt]=$row_patient['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
					}
				}
	
			}
			//print_r($data);
			if(isset($row_patient['id']))
			{
			$data['status']=0;
			return $data;
			}
		
		
	}
}



/****************************search End************************************/
function informationOfAppointment($aid)
{
	$sql="select * from treatment where appointment_id='$aid'";
	$res=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res)>0)
	{
		$row=mysql_fetch_array($res);
		$info['tid']=$row['id'];
		$info['result']=1;
	}
	else
	{
		$info['result']=0;
	}
	return $info;
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

function update_user($user)
{
	$sql="update from user set uname='".$user['uname']."' where id='".$user['uid']."'" ;
	if(mysql_query($sql))
	{
		$sql="";
	}
}

function selImage($treatment)
{
	$p=0;
	$pp=0;
	$arr_treatment_detail=array();
	$qry="select * from treatment where id='".$treatment['tid']."'";
		
		$res=mysql_query($qry);
		if(mysql_num_rows($res)>0)
		{
				$row=mysql_fetch_array($res);
				
				$qry="select * from treatment where appointment_id='".$row['appointment_id']."'";
				
				$res=mysql_query($qry);
				$c=0;			
				while($row=mysql_fetch_array($res))
				{
						
					$qry4="select * from pre_treatment where treatment_id='".$row['id']."'";
					$res4=mysql_query($qry4);
					if(mysql_num_rows($res4)>0)
					{
										
					while($row4=mysql_fetch_array($res4))
					{
							$arr_treatment_detail['preimg'][$p]['path']=$row4['image_path'];
							$arr_treatment_detail['preimg'][$p]['name']=$row4['image_name'];
							$p++;
					}
				}
							
					$qry5="select * from post_treatment where treatment_id='".$row['id']."'";
					$res5=mysql_query($qry5);
					if(mysql_num_rows($res5)>0)
					{
										
						while($row5=mysql_fetch_array($res5))
						{
								$arr_treatment_detail['postimg'][$pp]['path']=$row5['image_path'];
								$arr_treatment_detail['postimg'][$pp]['name']=$row5['image_name'];
								$pp++;
						}
					}
				}
		}
		return $arr_treatment_detail;
}


function countAppointment($cid)
{
		$dt=date('Y-m-d');
		$c=0;
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$sel_res=mysql_query($qry);
			while($row=mysql_fetch_array($sel_res))
			{

				$pcid=$row['id'];
				$qry="select * from appointment where patient_clinic_id='".$pcid."' and today_date='$dt'";
				//echo $qry;
				$sel_res1=mysql_query($qry);
				while($row=mysql_fetch_array($sel_res1))
				{
					$c++;
				}

			}
			return $c;
}


//****************************************Global Serach********************************************


//Global Search Phone Number and Email-Address
function phnoEmail($data1,$data2,$cid)
{
	$number=$data1;
	$email=$data2;
	$data=array();				
		$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
		$result=mysql_query($qry) or die(mysql_error());
		$cnt=0;
		$d=0;
		$p=0;
		
		while ($row=mysql_fetch_assoc($result))
			{
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$row_vd=mysql_fetch_array($result_vd);
				
				$qry_upn="select * from user_phone_no where user_id='".$row_vd['user_id']."'";
				$result_upn=mysql_query($qry_upn) or die(mysql_error());
				$row_upn=mysql_fetch_array($result_upn);
				
				//echo "VD:".$row_vd['id'];
				
				//echo "uid::::===".$row_upn['user_id'];
				
				$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."%'";
				$result_phno=mysql_query($qry_phno) or die(mysql_error());

				
				
				
				while ($row_phno=mysql_fetch_assoc($result_phno))
				{
				//echo $row_phno['id']."==";
				
				$qry_upnn="select * from user_phone_no where phone_no_id='".$row_phno['id']."'";
				$result_upnn=mysql_query($qry_upnn) or die(mysql_error());
				$row_upnn=mysql_fetch_array($result_upnn);
				//echo $row_upnn['user_id']."==";
				
				//echo mysql_num_rows($result_upn);		
				$qry_ue="select * from user_email where user_id='".$row_upnn['user_id']."'";
				$result_ue=mysql_query($qry_ue);
				$row_ue=mysql_fetch_assoc($result_ue);
				//echo $row_ue['email_id']."==";
				//echo "uid::::===".$row_upn['user_id'];
			
										
					//echo "kkkkkkkk".$row_phno['phone_no']."--------";
					
					
					
					
					$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."'";
					$result_email=mysql_query($qry_email);
					//echo "kkk".mysql_num_rows($result_email);
				
					if (mysql_num_rows($result_email)>0)
						{
							$row_email=mysql_fetch_assoc($result_email);
							//$row_phno=mysql_fetch_assoc($result_phno);
						
							$qry_user="select * from user where id='".$row_upn['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
			
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
							$d++;
						}
				}
			}
			
		$qry="select * from doctor_clinic where clinic_id='".$cid."'";
		$result=mysql_query($qry) or die(mysql_error());
		//$cnt=0;
	
		while ($row=mysql_fetch_assoc($result))
			{
				$qry_vd="select * from doctor where id='".$row['doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$row_vd=mysql_fetch_array($result_vd);
				
				$qry_upn="select * from user_phone_no where user_id='".$row_vd['user_id']."'";
				$result_upn=mysql_query($qry_upn) or die(mysql_error());
				$row_upn=mysql_fetch_array($result_upn);
				
				//echo "VD:".$row_vd['id'];
				
				//echo "uid::::===".$row_upn['user_id'];
				
				$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."%'";
				$result_phno=mysql_query($qry_phno) or die(mysql_error());

				
				
				
				while ($row_phno=mysql_fetch_assoc($result_phno))
				{
				//echo $row_phno['id']."==";
				
				$qry_upnn="select * from user_phone_no where phone_no_id='".$row_phno['id']."'";
				$result_upnn=mysql_query($qry_upnn) or die(mysql_error());
				$row_upnn=mysql_fetch_array($result_upnn);
				//echo $row_upnn['user_id']."==";
				
				//echo mysql_num_rows($result_upn);		
				$qry_ue="select * from user_email where user_id='".$row_upnn['user_id']."'";
				$result_ue=mysql_query($qry_ue);
				$row_ue=mysql_fetch_assoc($result_ue);
				//echo $row_ue['email_id']."==";
				//echo "uid::::===".$row_upn['user_id'];
			
										
					//echo "kkkkkkkk".$row_phno['phone_no']."--------";
					
					
					
					
					$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."'";
					$result_email=mysql_query($qry_email);
					//echo "kkk".mysql_num_rows($result_email);
				
					if (mysql_num_rows($result_email)>0)
						{
							$row_email=mysql_fetch_assoc($result_email);
							//$row_phno=mysql_fetch_assoc($result_phno);
						
							$qry_user="select * from user where id='".$row_upn['user_id']."'";
							$result_user=mysql_query($qry_user) or die(mysql_error());
							$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
							$result_ua=mysql_query($qry_ua);
							$row_ua=mysql_fetch_assoc($result_ua);
							
							$qry_address="select * from address where id='".$row_ua['address_id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
			
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
							$d++;
						}
				}
			}
			
			
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$result=mysql_query($qry) or die(mysql_error());
		//$cnt=0;
	
		while ($row=mysql_fetch_assoc($result))
			{
				$qry_user="select * from patient where id='".$row['patient_id']."'";
				$result_user=mysql_query($qry_user) or die(mysql_error());
				$row_user=mysql_fetch_array($result_user);
				//echo "VD:".$row_vd['id'];
				
				
				//$qry_upn="select * from user_phone_no where user_id='".$row_d['user_id']."'";
				//$result_upn=mysql_query($qry_upn) or die(mysql_error());
				//echo mysql_num_rows($result_upn);		
				
				//while ($row_upn=mysql_fetch_array($result_upn))
				//{
			
					$qry_phno="select * from patient_phone_no where patient_id='".$row_user['id']."' and phone_no like '".$number."%'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					$row_phno=mysql_fetch_assoc($result_phno);
					
					
					$qry_email="select * from patient_email where patient_id='".$row_phno['patient_id']."' and email_address like '".$email."'";
					$result_email=mysql_query($qry_email);
				
				
					if (mysql_num_rows($result_email)>0)
						{
						//echo "dsfsdfdsf--------";
							$row_email=mysql_fetch_assoc($result_email);
							
							//$qry_user="select * from user where id='".$row_upn['user_id']."'";
							//$result_user=mysql_query($qry_user) or die(mysql_error());
							//$row_user=mysql_fetch_assoc($result_user); 
						
							$qry_address="select * from patient_address where patient_id='".$row_user['id']."'";
							$result_address=mysql_query($qry_address);
							$row_address=mysql_fetch_assoc($result_address);
							
							$qry_a="select * from area where id='".$row_address['area_id']."'";
							$result_a=mysql_query($qry_a);
							$row_a=mysql_fetch_assoc($result_a);
							
							$qry_city="select * from city where id='".$row_a['city_id']."'";
							$result_city=mysql_query($qry_city);
							$row_city=mysql_fetch_assoc($result_city);
						
							$qry_state="select * from state where id='".$row_city['state_id']."'";
							$result_state=mysql_query($qry_state);
							$row_state=mysql_fetch_assoc($result_state);
							
					
							
							($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
							($row_user['patient_name']!=NULL ? $data['user'][$cnt]=$row_user['patient_name'] : $data['user'][$cnt]="---");
							($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
							($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
							($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
							($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
							($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
							$cnt++;
							$p++;
						}
				//}
			}
			
			
			
			
			
//			print_r($data);
			if(isset($row_user['id']))
			{
			$data['doctor']=$d;
			$data['patient']=$p;
			$data['status']=0;
			//print_r($data);
			return $data;
			}
				
}

// Global Search for Phone No and Name or Address
function phnoName($data1,$data2,$cid)
{
	$number=$data1;
	$name=$data2;
	$data=array();
			$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			$d=0;
			$p=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
			
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$result_add=mysql_query($qry_vd) or die(mysql_error());
				
				
				$sel_user="select * from user where user_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{
				
					$row_add=mysql_fetch_array($result_add);
					
				$qry_uadd="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_uadd=mysql_query($qry_uadd);
				$row_uadd=mysql_fetch_assoc($result_uadd);
				
				$qry_address="select * from address where id='".$row_uadd['address_id']."' and street_name like '".$name."%'";
				$result_address=mysql_query($qry_address);
						
				while ($row_address=mysql_fetch_assoc($result_address))
				{
					//echo "ssssss----";
					//echo "dsf".$row_ua['user_id'];
					//echo "add id".$row_ua['address_id'];
				$qry_ua="select * from user_address where address_id='".$row_address['id']."'";
				$result_ua=mysql_query($qry_ua);
				$row_ua=mysql_fetch_assoc($result_ua);	
					
					$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					$row_upn=mysql_fetch_assoc($result_upn);
					
					
					
					//echo "upn id".$row_upn['phone_no_id'];
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
						
					
					if (mysql_num_rows($result_phno)>0)
					{
					//echo "fsdfsd===";
						$row_phno=mysql_fetch_assoc($result_phno);
						
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "uid".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
					$row_vd=mysql_fetch_array($result_vd);
			
						
					$qry_user="select * from user where user_name like '".$name."%' and id='".$row_vd['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());

						
					
				//echo "jglkh----";
					 
				
				while ($row_user=mysql_fetch_assoc($result_user))
				{
					
									
					$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());
					$row_upn=mysql_fetch_assoc($result_upn);
					//$row_user=mysql_fetch_assoc($result_user); 
					
				
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
				
					
					
					
					
					if (mysql_num_rows($result_phno)>0)
					{
						//echo "UID".$row_user['id'];	
						//echo "lll---";		
						$row_phno=mysql_fetch_assoc($result_phno);
						
						//echo "llllllllllll:".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
			}
			
		
		}

	
		$qry="select * from doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			//$cnt=0;
			//$d=0;
			//$p=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
			
				$qry_d="select * from doctor where id='".$row['doctor_id']."'";
				$result_d=mysql_query($qry_d) or die(mysql_error());
				$result_add=mysql_query($qry_d) or die(mysql_error());
				
				
				$sel_user="select * from user where user_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{
				
					$row_add=mysql_fetch_array($result_add);
					
				$qry_uadd="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_uadd=mysql_query($qry_uadd);
				$row_uadd=mysql_fetch_assoc($result_uadd);
				
				$qry_address="select * from address where id='".$row_uadd['address_id']."' and street_name like '".$name."%'";
				$result_address=mysql_query($qry_address);
						
				while ($row_address=mysql_fetch_assoc($result_address))
				{
					//echo "ssssss----";
					//echo "dsf".$row_ua['user_id'];
					//echo "add id".$row_ua['address_id'];
				$qry_ua="select * from user_address where address_id='".$row_address['id']."'";
				$result_ua=mysql_query($qry_ua);
				$row_ua=mysql_fetch_assoc($result_ua);	
					
					$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					$row_upn=mysql_fetch_assoc($result_upn);
					
					
					
					//echo "upn id".$row_upn['phone_no_id'];
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
						
					
					if (mysql_num_rows($result_phno)>0)
					{
					echo //"fsdfsd===";
						$row_phno=mysql_fetch_assoc($result_phno);
						
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "uid".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
					$row_d=mysql_fetch_array($result_d);
			
						
					$qry_user="select * from user where user_name like '".$name."%' and id='".$row_d['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());

						
					
				//echo "jglkh----";
					 
				
				while ($row_user=mysql_fetch_assoc($result_user))
				{
					
									
					$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());
					$row_upn=mysql_fetch_assoc($result_upn);
					//$row_user=mysql_fetch_assoc($result_user); 
					
				
					$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
				
					
					
					
					
					if (mysql_num_rows($result_phno)>0)
					{
						//echo "UID".$row_user['id'];	
						//echo "lll---";		
						$row_phno=mysql_fetch_assoc($result_phno);
						
						//echo "llllllllllll:".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
			}
			
		
		}


		
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$result=mysql_query($qry) or die(mysql_error());
		//$cnt=0;

		while ($row=mysql_fetch_assoc($result))
			{

				$qry_p="select * from patient where id='".$row['patient_id']."'";
				$result_p=mysql_query($qry_p) or die(mysql_error());
				$result_add=mysql_query($qry_p) or die(mysql_error());
				
				
				$sel_user="select * from patient where patient_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from patient_address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{				
						
				while ($row_add=mysql_fetch_array($result_add))
				{
				
				
					/*$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					$row_upn=mysql_fetch_assoc($result_upn);*/
					
					$qry_address="select * from patient_address where patient_id='".$row_add['id']."' and street_name like '".$name."%'";
					$result_address=mysql_query($qry_address);
					$row_address=mysql_fetch_assoc($result_address);
					
					$qry_phno="select * from patient_phone_no where patient_id='".$row_address['patient_id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
				
						
					
					if (mysql_num_rows($result_phno)>0)
					{
					
						$row_phno=mysql_fetch_assoc($result_phno);
						
						
						
						$qry_user="select * from patient where id='".$row_phno['patient_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						//$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						//$result_ue=mysql_query($qry_ue);
						//$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from patient_email where patient_id='".$row_user['id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['patient_name']!=NULL ? $data['user'][$cnt]=$row_user['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$p++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
	
			
				while ($row_p=mysql_fetch_array($result_p))
				{
						
					//$row_user=mysql_fetch_assoc($result_user); 
					//echo $row_p['id']."--";
					//$qry_upn="select * from user_phone_no where user_id='".$row_vd['user_id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					//$row_upn=mysql_fetch_assoc($result_upn);
				
					$qry_phno="select * from patient_phone_no where patient_id='".$row_p['id']."' and phone_no like '".$number."'";
					$result_phno=mysql_query($qry_phno) or die(mysql_error());
					$row_phno=mysql_fetch_assoc($result_phno);
					
					
					$qry_user="select * from patient where patient_name like '".$name."%' and id='".$row_phno['patient_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());
					
					if (mysql_num_rows($result_user )>0)
					{
							//echo "UID".$row_user['id'];			
						
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "llllllllllll:".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						//$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						//$result_ua=mysql_query($qry_ua);
						//$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from patient_address where patient_id='".$row_user['id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						//$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						//$result_ue=mysql_query($qry_ue);
						//$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from patient_email where patient_id='".$row_user['id']."'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['patient_name']!=NULL ? $data['user'][$cnt]=$row_user['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$p++;
					}
				}
			}
			
		
		}
		
		
		
		//echo "UID".$row_user['id'];
		//print_r($data);
		//if (isset($data_user['id']))echo "yes";else echo "no";
	if(isset($data['id']))
	{
		//echo "SDGGGGGGGGGGG";
		$data['doctor']=$d;
		$data['patient']=$p;
		$data['status']=0;
		//print_r($data);
		return $data;
	}
}


// Global Search for Email and Name or Address
function nameEmail($data1,$data2,$cid)
{
	$name=$data1;
	$email=$data2;
	$data=array();
	//echo "Name:".$name."<br>Email:".$email."<br>";
	$qry="select * from visiting_doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			$cnt=0;
			$d=0;
			$p=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
			
				$qry_vd="select * from visiting_doctor where id='".$row['visiting_doctor_id']."'";
				$result_vd=mysql_query($qry_vd) or die(mysql_error());
				$result_add=mysql_query($qry_vd) or die(mysql_error());
				
				
				$sel_user="select * from user where user_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
					
				if (mysql_num_rows($res_address)>0)
				{
				//echo "df==";
					$row_add=mysql_fetch_array($result_add);
					
				$qry_uadd="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_uadd=mysql_query($qry_uadd);
				$row_uadd=mysql_fetch_assoc($result_uadd);
				
				$qry_address="select * from address where id='".$row_uadd['address_id']."' and street_name like '".$name."%'";
				$result_address=mysql_query($qry_address);
						
				while ($row_address=mysql_fetch_assoc($result_address))
				{
					//echo "ssssss----";
					//echo "dsf".$row_ua['user_id'];
					//echo "add id".$row_ua['address_id'];
				$qry_ua="select * from user_address where address_id='".$row_address['id']."'";
				$result_ua=mysql_query($qry_ua);
				$row_ua=mysql_fetch_assoc($result_ua);	
					
					//$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					//$row_upn=mysql_fetch_assoc($result_upn);
					$qry_ue="select * from user_email where user_id='".$row_ua['user_id']."'";
					$result_ue=mysql_query($qry_ue);
					$row_ue=mysql_fetch_assoc($result_ue);
					
					
					//echo "upn id".$row_upn['phone_no_id'];
					//$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
					$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."%'";
					$result_email=mysql_query($qry_email);
					//$row_email=mysql_fetch_assoc($result_email);
					
						
					
					if (mysql_num_rows($result_email)>0)
					{
					//echo "fsdfsd===";
						//$row_phno=mysql_fetch_assoc($result_phno);
						$row_email=mysql_fetch_assoc($result_email);
						
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "uid".$row_user['id'];
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						
						
						
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
					$row_vd=mysql_fetch_array($result_vd);
			
						
					$qry_user="select * from user where user_name like '".$name."%' and id='".$row_vd['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());

						
					
				//echo "jglkh----";
					 
				
				while ($row_user=mysql_fetch_assoc($result_user))
				{
					
									
					//$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());
					//$row_upn=mysql_fetch_assoc($result_upn);
					//$row_user=mysql_fetch_assoc($result_user); 
					
				
					//$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."%'";
						$result_email=mysql_query($qry_email);
						//$row_email=mysql_fetch_assoc($result_email);
					
					
					
					
					if (mysql_num_rows($result_email)>0)
					{
						//echo "UID".$row_user['id'];	
						//echo "lll---";		
						//$row_phno=mysql_fetch_assoc($result_phno);
						$row_email=mysql_fetch_assoc($result_email);
						
						//echo "llllllllllll:".$row_user['id'];
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
			}
			
		
		}

	
		$qry="select * from doctor_clinic where clinic_id='".$cid."'";
			$result=mysql_query($qry) or die(mysql_error());
			//$cnt=0;
			//$d=0;
			//$p=0;
			
			while ($row=mysql_fetch_assoc($result))
			{
			
				$qry_d="select * from doctor where id='".$row['doctor_id']."'";
				$result_d=mysql_query($qry_d) or die(mysql_error());
				$result_add=mysql_query($qry_d) or die(mysql_error());
				
				
				$sel_user="select * from user where user_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{
				
					$row_add=mysql_fetch_array($result_add);
					
				$qry_uadd="select * from user_address where user_id='".$row_add['user_id']."'";
				$result_uadd=mysql_query($qry_uadd);
				$row_uadd=mysql_fetch_assoc($result_uadd);
				
				$qry_address="select * from address where id='".$row_uadd['address_id']."' and street_name like '".$name."%'";
				$result_address=mysql_query($qry_address);
						
				while ($row_address=mysql_fetch_assoc($result_address))
				{
					//echo "ssssss----";
					//echo "dsf".$row_ua['user_id'];
					//echo "add id".$row_ua['address_id'];
				$qry_ua="select * from user_address where address_id='".$row_address['id']."'";
				$result_ua=mysql_query($qry_ua);
				$row_ua=mysql_fetch_assoc($result_ua);	
					
					//$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					//$row_upn=mysql_fetch_assoc($result_upn);
					
					
					
					//echo "upn id".$row_upn['phone_no_id'];
					//$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
					
						$qry_ue="select * from user_email where user_id='".$row_ua['user_id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."%'";
						$result_email=mysql_query($qry_email);
						//$row_email=mysql_fetch_assoc($result_email);
						
					
					if (mysql_num_rows($result_email)>0)
					{
					//
					//echo "fsdfsd===";
						//$row_phno=mysql_fetch_assoc($result_phno);
						$row_email=mysql_fetch_assoc($result_email);
						
						
						$qry_user="select * from user where id='".$row_ua['user_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "uid".$row_user['id'];
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
					$row_d=mysql_fetch_array($result_d);
			
						
					$qry_user="select * from user where user_name like '".$name."%' and id='".$row_d['user_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());

						
					
				//echo "jglkh----";
					 
				
				while ($row_user=mysql_fetch_assoc($result_user))
				{
					
									
					//$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());
					//$row_upn=mysql_fetch_assoc($result_upn);
					//$row_user=mysql_fetch_assoc($result_user); 
					
				
					//$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
				
				
						$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						$result_ue=mysql_query($qry_ue);
						$row_ue=mysql_fetch_assoc($result_ue);
						
						$qry_email="select * from email where id='".$row_ue['email_id']."' and email_address like '".$email."%'";
						$result_email=mysql_query($qry_email);
						//$row_email=mysql_fetch_assoc($result_email);	
				
					
					
					
					
					if (mysql_num_rows($result_email)>0)
					{
						//echo "UID".$row_user['id'];	
						//echo "lll---";		
						//$row_phno=mysql_fetch_assoc($result_phno);
						$row_email=mysql_fetch_assoc($result_email);	
						
						//echo "llllllllllll:".$row_user['id'];
						
						$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						$result_ua=mysql_query($qry_ua);
						$row_ua=mysql_fetch_assoc($result_ua);
						
						$qry_address="select * from address where id='".$row_ua['address_id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['user_name']!=NULL ? $data['user'][$cnt]=$row_user['user_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$d++;
					}
				}
			}
			
		
		}


		
		$qry="select * from patient_clinic where clinic_id='".$cid."'";
		$result=mysql_query($qry) or die(mysql_error());
		//$cnt=0;

		while ($row=mysql_fetch_assoc($result))
			{

				$qry_p="select * from patient where id='".$row['patient_id']."'";
				$result_p=mysql_query($qry_p) or die(mysql_error());
				$result_add=mysql_query($qry_p) or die(mysql_error());
				
				
				$sel_user="select * from patient where patient_name like '".$name."%'";
				$res_user=mysql_query($sel_user);
				
				$sel_address="select * from patient_address where street_name like '".$name."%'";
				$res_address=mysql_query($sel_address);
				
				if (mysql_num_rows($res_address)>0)
				{				
						
				while ($row_add=mysql_fetch_array($result_add))
				{
				
				
					/*$qry_upn="select * from user_phone_no where user_id='".$row_ua['user_id']."'";
					$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					$row_upn=mysql_fetch_assoc($result_upn);*/
					
					$qry_address="select * from patient_address where patient_id='".$row_add['id']."' and street_name like '".$name."%'";
					$result_address=mysql_query($qry_address);
					$row_address=mysql_fetch_assoc($result_address);
					
					//$qry_phno="select * from patient_phone_no where patient_id='".$row_address['patient_id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
					
					$qry_email="select * from patient_email where patient_id='".$row_address['id']."' and email_address like '".$email."%'";
					$result_email=mysql_query($qry_email);
					//$row_email=mysql_fetch_assoc($result_email);
				
						
					
					if (mysql_num_rows($result_email)>0)
					{
					
						//$row_phno=mysql_fetch_assoc($result_phno);
						$row_email=mysql_fetch_assoc($result_email);
						
						
						
						$qry_user="select * from patient where id='".$row_phno['patient_id']."'";
						$result_user=mysql_query($qry_user) or die(mysql_error());
						$row_user=mysql_fetch_assoc($result_user); 
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						$qry_phno="select * from patient_phone_no where patient_id='".$row_user['id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						//$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						//$result_ue=mysql_query($qry_ue);
						//$row_ue=mysql_fetch_assoc($result_ue);
						
						
						
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['patient_name']!=NULL ? $data['user'][$cnt]=$row_user['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$p++;
					}
				}
				
			}
			if (mysql_num_rows($res_user)>0)
			{
	
			
				while ($row_p=mysql_fetch_array($result_p))
				{
						
					//$row_user=mysql_fetch_assoc($result_user); 
					//echo $row_p['id']."--";
					//$qry_upn="select * from user_phone_no where user_id='".$row_vd['user_id']."'";
					//$result_upn=mysql_query($qry_upn) or die(mysql_error());		
					//$row_upn=mysql_fetch_assoc($result_upn);
						$qry_email="select * from patient_email where patient_id='".$row_p['id']."' and email_address like '".$email."%'";
						$result_email=mysql_query($qry_email);
						$row_email=mysql_fetch_assoc($result_email);
						
						
					//$qry_phno="select * from patient_phone_no where patient_id='".$row_p['id']."' and phone_no like '".$number."'";
					//$result_phno=mysql_query($qry_phno) or die(mysql_error());
					//$row_phno=mysql_fetch_assoc($result_phno);
					
					
					$qry_user="select * from patient where patient_name like '".$name."%' and id='".$row_email['patient_id']."'";
					$result_user=mysql_query($qry_user) or die(mysql_error());
					
					if (mysql_num_rows($result_user )>0)
					{
							//echo "UID".$row_user['id'];			
						
						$row_user=mysql_fetch_assoc($result_user); 
						//echo "llllllllllll:".$row_user['id'];
						
						/*$qry_upn="select * from user_phone_no where user_id='".$row_user['id']."'";
						$result_upn=mysql_query($qry_upn) or die(mysql_error());		
						$row_upn=mysql_fetch_assoc($result_upn);
					
						$qry_phno="select * from phone_no where id='".$row_upn['phone_no_id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);*/
						
						//$qry_ua="select * from user_address where user_id='".$row_user['id']."'";
						//$result_ua=mysql_query($qry_ua);
						//$row_ua=mysql_fetch_assoc($result_ua);
						$qry_phno="select * from patient_phone_no where patient_id='".$row_user['id']."'";
						$result_phno=mysql_query($qry_phno) or die(mysql_error());
						$row_phno=mysql_fetch_assoc($result_phno);
						
						$qry_address="select * from patient_address where patient_id='".$row_user['id']."'";
						$result_address=mysql_query($qry_address);
						$row_address=mysql_fetch_assoc($result_address);
						
						$qry_a="select * from area where id='".$row_address['area_id']."'";
						$result_a=mysql_query($qry_a);
						$row_a=mysql_fetch_assoc($result_a);
						
						$qry_city="select * from city where id='".$row_a['city_id']."'";
						$result_city=mysql_query($qry_city);
						$row_city=mysql_fetch_assoc($result_city);
					
						$qry_state="select * from state where id='".$row_city['state_id']."'";
						$result_state=mysql_query($qry_state);
						$row_state=mysql_fetch_assoc($result_state);
						
						//$qry_ue="select * from user_email where user_id='".$row_user['id']."'";
						//$result_ue=mysql_query($qry_ue);
						//$row_ue=mysql_fetch_assoc($result_ue);
						
					
						($row_user['id']!=NULL ? $data['id'][$cnt]=$row_user['id'] : $data['id'][$cnt]="---");
						($row_user['patient_name']!=NULL ? $data['user'][$cnt]=$row_user['patient_name'] : $data['user'][$cnt]="---");
						($row_address['street_name']!=NULL ? $data['address'][$cnt]=$row_address['street_name'] : $data['address'][$cnt]="---");
						($row_state['state_name']!=NULL ? $data['state'][$cnt]=$row_state['state_name'] : $data['state'][$cnt]="---");
						($row_city['city_name']!=NULL ? $data['city'][$cnt]=$row_city['city_name'] : $data['city'][$cnt]="---");
						($row_email['email_address']!=NULL ? $data['email'][$cnt]=$row_email['email_address'] : $data['email'][$cnt]="---");
						($row_phno['phone_no']!=NULL ? $data['phno'][$cnt]=$row_phno['phone_no'] : $data['phno'][$cnt]="---");
						$cnt++;
						$p++;
					}
				}
			}
			
		
		}
		
		
		
		//echo "UID".$row_user['id'];
		//print_r($data);
		//if (isset($data_user['id']))echo "yes";else echo "no";
	if(isset($data['id']))
	{
		//echo "SDGGGGGGGGGGG";
		$data['doctor']=$d;
		$data['patient']=$p;
		$data['status']=0;
		//print_r($data);
		return $data;
	}
}






//Global Search
function allDataSearch($text,$cid)
{
	$record=explode(',',$text['text']);
	
	$name=Array();
	//echo count($record);
	if (count($record)>2)
		echo "Record is Not Available";
	else
	{
		if (preg_match("/^[0-9]*$/",$record[0]) && strlen($record[0])>=5)
		{
			$number=$record[0];
			if (preg_match("/^[0-9]*$/",$record[1]))
			{
				echo "Both Number is not Valid";
				//return;
			}
			if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$record[1]))
			{
				$email=$record[1];
				$finalResult=phnoEmail($number,$email,$cid);
				return $finalResult;
				
			}
			if(preg_match("/^[a-zA-Z]*$/",$record[1]) && strlen($record[1])>=3)
			{
				
				$name[0]=$record[1];
				$finalResult=phnoName($number,$name[0],$cid);
				
				//print_r($finalResult);
				return $finalResult;
			}
			else
			{
				echo "Name Or Address Should be Sort";
				//return;
			}
		}
		else if(preg_match("/^[a-zA-Z]*$/",$record[0]) && strlen($record[0])>=2)
		{
			
			$name[0]=$record[0];
			
			if(preg_match("/^[a-zA-Z]*$/",$record[1]))
			{
				$name[1]=$record[1];
				if ($name[0]==$name[1])
				{
					echo "Enter Valid Name.";
					//return;
				}
				else
				{
					
					//$finalResult=nameAddress($name[0],$name[1],$cid);
					//print_r($finalResult);
					//return $finalResult;
				}
			}
			if (preg_match("/^[0-9]*$/",$record[1]))
			{
				$number=$record[1];
				$finalResult=phnoName($number,$name[0],$cid);
				//print_r($finalResult);
				return $finalResult;
			}
			if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$record[1]))
			{
				$email=$record[1];
				//echo "n==".$name[0]."E==".$email."<br>";
				$finalResult=nameEmail($name[0],$email,$cid);
				return $finalResult;
			}
			
		}
		else if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$record[0]) && strlen($record[0])>5)
		{
			$email=$record[0];
			if (preg_match("/^[0-9]*$/",$record[1]))
			{
				$number=$record[1];
				$finalResult=phnoEmail($number,$email,$cid);
				return $finalResult;
			}
			if (preg_match("/^[A-Za-z0-9_\-\.]*@[A-Za-z0-9_\-\.]*\.[A-Za-z]{2,4}$/",$record[1]))
			{
				echo "Both Email is Not Valid";
				//return;
			}
			if(preg_match("/^[a-zA-Z]*$/",$record[1]))
			{
				$name[0]=$record[1];
				$finalResult=nameEmail($name[0],$email,$cid);
				return $finalResult;
			}
		}
		else
		{
			echo "Plz Enter Valid Data.";
			//return;
		}
		
		
		
	
	//echo "Numbre:".$number;
	//echo "<br>Name:".$name[0]."---->".$name[1];
	//print_r($record);
	}
}




//***************************************End Global Search*****************************************

function pendingTretment()
{
	$arr_sel=array();
	$date1=date('Y-m-d');
	
	$qry="select * from next_appointment";
	$res=mysql_query($qry);
	$c=0;
	while($row=mysql_fetch_array($res))
	{
		$date2=date($row['date']);
		if(strtotime($date1)<strtotime($date2))
		{
   			if($row['flag']==1)
			{
				$qry="select * from appointment where id='".$row['a_id']."'";
				$sel_res1=mysql_query($qry);
				$row1=mysql_fetch_array($sel_res1);
				$arr_sel[$c]['id']=$row1['id'];
				$arr_sel[$c]['appointment_no']=$row1['appointment_no'];
				$arr_sel[$c]['date']=$row1['date'];
				$arr_sel[$c]['time']=$row1['time'];
				$arr_sel[$c]['time_duration']=$row1['time_duration'];
				$arr_sel[$c]['notes']=$row1['notes'];
				$c++;
				
			}
		}
		
	}
	//print_r($arr_sel);
	return $arr_sel;
}


?>