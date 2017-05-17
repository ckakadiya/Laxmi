<?php
	include_once "connect.php";	
	function curr_dt()
	{
		$d=time();
		$str=date('Y-m-d g:i:sa',$d);
		return $str;
	}

	//select clinic data from clinic
	function sel_clinic()
	{
		$sql_sel="select * from clinic order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['id'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_clinic());
	function sel_visitdoc1($id)
	{
		//echo "hii";
		$sql_sel="select * from  visiting_doctor where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());	
		if (mysql_num_rows($sql_qry) > 0)
		{
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id']=$sql_res['id'];
				$data['user_id']=$sql_res['user_id'];
				$data['doctor_name']=sel_user_name($data['user_id']);
				$data['speciality']=$sql_res['speciality'];
				$result=sel_time($data['id']);
				$data['start']=$result['start'];
				$data['till']=$result['till'];
				$data['day']=$result['day'];
				$data['email']=sel_user_email($data['user_id']);
				$data['phno']=sel_user_phno($data['user_id']);
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	
	//select data from visiting_doctor
	function sel_visitdoc($id)
	{
		//echo "hii";
		$sql_sel="select * from  visiting_doctor where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());	
		if (mysql_num_rows($sql_qry) > 0)
		{
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id']=$sql_res['id'];
				$data['user_id']=$sql_res['user_id'];
				$data['doctor_name']=sel_user_name($data['user_id']);
				$data['speciality']=$sql_res['speciality'];
				//$result=sel_time($data['id']);
				//$data['start']=$result['start'];
				//$data['till']=$result['till'];
				//$data['day']=$result['day'];
				$sql_sel="select * from visiting_doctor_clinic where visiting_doctor_id=".$data['id']; 
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				if (mysql_num_rows($sql_qry) > 0)
				{
					$sql_res=mysql_fetch_assoc($sql_qry);
					$data['vdcid']=$sql_res['id'];			
					$sql_sel="select * from visit_doc_time where visit_doc_clinic_id=".$data['vdcid']; 
					$sql_qry=mysql_query($sql_sel) or die(mysql_error());
					if (mysql_num_rows($sql_qry) > 0)
					{
						$cnt=0;
						while($sql_res=mysql_fetch_assoc($sql_qry))
						{
							$data['tid'][$cnt]=$sql_res['id'];
							$data['start'][$cnt]=$sql_res['start'];
							$data['till'][$cnt]=$sql_res['till'];
							$data['day'][$cnt]=$sql_res['day'];
							$cnt++;
						}
							//return $data;
					}
				}					
			
				//$data['email']=sel_user_email($data['user_id']);
				$sql_sel="select email_id from user_email where user_id=".$data['user_id']."";
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				if (mysql_num_rows($sql_qry) > 0)
				{
					//echo mysql_num_rows($sql_qry);
					$cnt=0;
					while($sql_res=mysql_fetch_assoc($sql_qry))
					{
						//echo $sql_res['email_id'];
						$data['eid'][$cnt]=$sql_res['email_id'];
						$cnt++;
					}
					//echo $cnt;
					$c=0;
					while($cnt > $c)
					{
						$sql_sel="select email_address from email where id=".$data['eid'][$c].""; 
						$sql_qry=mysql_query($sql_sel) or die(mysql_error());
						$sql_res=mysql_fetch_assoc($sql_qry);
						$data['email'][$c]=$sql_res['email_address'];
						$c++;
					}
				}

				//$data['phno']=sel_user_phno($data['user_id']);
				$sql_sel="select phone_no_id from user_phone_no where user_id=".$data['user_id'];
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				if (mysql_num_rows($sql_qry) > 0)
				{
					//echo mysql_num_rows($sql_qry);
					$cnt=0;
					while($sql_res=mysql_fetch_assoc($sql_qry))
					{
						//echo $sql_res['email_id'];
						$data['pid'][$cnt]=$sql_res['phone_no_id'];
						$cnt++;
					}
					//echo $cnt;
					$c=0;
					while($cnt > $c)
					{
						$sql_sel="select phone_no from phone_no where id=".$data['pid'][$c].""; 
						$sql_qry=mysql_query($sql_sel) or die(mysql_error());
						$sql_res=mysql_fetch_assoc($sql_qry);
						$data['phno'][$c]=$sql_res['phone_no'];
						$c++;
					}
				 } 
				}
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_visitdoc(41));
	function delVisitDoc($id)
	{
		$sql_sel="select * from  visiting_doctor where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());	
		$sql_res=mysql_fetch_assoc($sql_qry);
		$uid=$sql_res['user_id'];
		$sql_del="DELETE FROM user WHERE id=$uid";				
		if(mysql_query($sql_del))
		{
			$sql_del="DELETE FROM visiting_doctor WHERE id=$id";				
			if(mysql_query($sql_del))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	
	}
	//delVisitDoc(3);
	//select visiting_doctor data of particular clinic
	function sel_visit_doc($cid)
	{
		$sql_sel="sELECT * from clinic,visiting_doctor,visiting_doctor_clinic where clinic.id=visiting_doctor_clinic.clinic_id and visiting_doctor.id=visiting_doctor_clinic.visiting_doctor_id and  clinic.id=".$cid;
		//$sql_sel="select * from  visiting_doctor order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		//echo mysql_num_rows($sql_qry);
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['visiting_doctor_id'];
				$data['user_id'][$cnt]=$sql_res['user_id'];
				$data['doctor_name'][$cnt]=sel_user_name($data['user_id'][$cnt]);
				$data['speciality'][$cnt]=$sql_res['speciality'];
				$result=sel_time($data['id'][$cnt]);
				$data['start'][$cnt]=$result['start'];
				$data['till'][$cnt]=$result['till'];
				$data['day'][$cnt]=$result['day'];
				$data['email'][$cnt]=sel_user_email($data['user_id'][$cnt]);
				$data['phno'][$cnt]=sel_user_phno($data['user_id'][$cnt]);
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_visit_doc(13));
	
	function selVisitDocAlphaWise($cid,$alpha)
	{
		
		$sql_sel="sELECT * from user,clinic,visiting_doctor,visiting_doctor_clinic where user_name LIKE '".$alpha."' and user.id=visiting_doctor.user_id and clinic.id=visiting_doctor_clinic.clinic_id and visiting_doctor.id=visiting_doctor_clinic.visiting_doctor_id and  clinic.id=".$cid;
		//$sql_sel="select * from  visiting_doctor order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		//echo mysql_num_rows($sql_qry);
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['visiting_doctor_id'];
				$data['user_id'][$cnt]=$sql_res['user_id'];
				$data['doctor_name'][$cnt]=sel_user_name($data['user_id'][$cnt]);
				$data['speciality'][$cnt]=$sql_res['speciality'];
				$result=sel_time($data['id'][$cnt]);
				$data['start'][$cnt]=$result['start'];
				$data['till'][$cnt]=$result['till'];
				$data['day'][$cnt]=$result['day'];
				$data['email'][$cnt]=sel_user_email($data['user_id'][$cnt]);
				$data['phno'][$cnt]=sel_user_phno($data['user_id'][$cnt]);
				$cnt++;

			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_visit_doc(13,"P"));
		
	//select user_name from user
	function sel_user_name($id)
	{
		$sql_sel="select user_name from user where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['user_name'];
		}
		else
		{
			return 0;
		}
	}
	
	//sel_user_name(6);
		
	//insert into visit_doc_time table
	function vd_time($cid,$arg)
	{
		//$cid=$arg['txtcid'];
		$vdid=$arg['txtvdid'];
		echo "hello";	
		$sql_sel="select * from visiting_doctor_clinic where visiting_doctor_id=".$vdid;
		echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$vdcid=$sql_res['id']; 
			echo $vdcid;
			$start1=$arg['selstart'];
			$till1=$arg['seltill'];
			$smin=$arg['selsmin'];
			$tmin=$arg['seltmin'];
			function addminute($time,$minute)
			{
				$piece=explode(":",$time);
				$min_piece=explode(":",$minute);
				$add=$piece[1]+$min_piece[0];
				$time=$piece[0].":".$add.":".$piece[2];
				return $time;
			}
			
			$day=$arg['selday'];
			$start=addminute($start1,$smin)." ".$arg['selsmed'];
			$till=addminute($till1,$tmin)." ".$arg['seltmed'];
			$sql_ins="INSERT INTO visit_doc_time values('','$vdcid','$start','$till','$day')";
			echo $sql_ins;
			if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
			{
				return $vdcid;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return 1;
		}
	}
	$arg['selday']="monday";
	$arg['selstart']="6:00:00";
	$arg['selsmed']="PM";
	$arg['seltill']="9:00:00";
	$arg['seltmed']="PM";
	//echo vd_time(17,114,$arg);
	//select data from visit_doc_time according vdcid
	function visit_doc_time($vdid)
	{
		$sql_sel="select * from visiting_doctor_clinic where visiting_doctor_id=".$vdid;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$vdcid=$sql_res['id'];
			//echo $vdcid;
			$sql_sel="select * from visit_doc_time where visit_doc_clinic_id=".$vdcid;
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{	
				$cnt=0;
				while($sql_res=mysql_fetch_assoc($sql_qry))
				{
					$data['id'][$cnt]=$sql_res['id'];
					$data['start'][$cnt]=$sql_res['start'];
					$data['till'][$cnt]=$sql_res['till'];
					$data['day'][$cnt]=$sql_res['day'];
					$cnt++;
				}
					$data['status']=0;
					return $data;
			}
			else
			{
				$data['status']=1;
				return $data;
			}
		}
		else
		{
			return 0;
		}
	}	
	//print_r(visit_doc_time(114));
	//select data from email
	function sel_user_email($id)
	{
		$sql_sel="select email_id from user_email where user_id=".$id."";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$data['eid']=$sql_res['email_id'];
			$sql_sel="select email_address from email where id=".$data['eid'].""; 
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$sql_res=mysql_fetch_assoc($sql_qry);
				return $sql_res['email_address'];
			}
			else
			{
				return 0;
			}
		}
	}
	//echo sel_user_email(5);
	//select data from phone_no
	function sel_user_phno($id)
	{	
		$sql_sel="select phone_no_id from user_phone_no where user_id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			//echo mysql_num_rows($sql_qry);
			$sql_res=mysql_fetch_assoc($sql_qry);
			$data['pid']=$sql_res['phone_no_id'];
			$sql_sel="select phone_no from phone_no where id=".$data['pid'].""; 
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$sql_res=mysql_fetch_assoc($sql_qry);
				return $sql_res['phone_no'];
			}	
			else
			{
				return 0;
			}
		}
	}
	//echo sel_user_phno(5);
	//select data from visiting_doctor_clinic,visit_doc_time
	function sel_time($vdid)
	{
		$sql_sel="select * from visiting_doctor_clinic where visiting_doctor_id=".$vdid; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$vdcid=$sql_res['id'];			
			$sql_sel="select * from visit_doc_time where visit_doc_clinic_id=".$vdcid; 
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$sql_res=mysql_fetch_assoc($sql_qry);
				$data['start']=$sql_res['start'];
				$data['till']=$sql_res['till'];
				$data['day']=$sql_res['day'];
				return $data;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_time(11));


	//insert into user 
	function ins_user($uname)
	{
		$sql_ins="INSERT INTO user(user_name)VALUE('$uname')";
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			return mysql_insert_id(); 
		}
		else
		{
			return 1;
		}
	}
	//echo ins_user("user47");
	function sel_state($state)
	{
		$sql_sel="select * from state where state_name='".$state."'";
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['id'];
		}
		else
		{
			return 0;
		}
		
	}
	//echo sel_state("s4");
	function sel_city($state)
	{
		$state_id=sel_state($state);
		$sql_sel="select * from city where state_id=".$state_id;
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$data[$cnt]=$sql_res['id'];
				$cnt++;
			}
			return $data;
		}
		else
		{
			return 0;
		}
		
	}
	//print_r(sel_city("s4"));
	function sel_area($state)
	{
		$id=sel_city($state);
		$cnt=0;
		/*while($cnt<count($id))
		{
			$sql_sel="select * from area where city_id=".$id['id'];
			echo $sql_sel;
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while($sql_res=mysql_fetch_assoc($sql_qry))
				{
					$data[$cnt]=$sql_res['id'];
					$cnt++;
				}
				return $data;
			}
			else
			{
				return 0;
			}
			$cnt++;
		}
		print_r(count($id));
	
		*/
		
	}
	//print_r(sel_area("s4"));
	
		
	function ins_visiting_doctor($cid,$arg)
	{
		$uname=$arg['txtname'];
		$uid=ins_user($uname);
		$email=$arg['txtemail'];
		$eid=ins_email($email);
		$phno=$arg['txtphno'];
		$pid=ins_phone_no($phno);
		$speciality=$arg['txtspeciality'];
		//$street=$arg['txtadd'];
		//$state=$arg['txtstate'];
		//$city=$arg['txtcity'];
		$pin=$arg['txtpin'];	
		$count=0;
		//echo $uname,$uid,$email,$eid,$phno,$pid,$speciality;
		//insert into visiting_doctor
		$sql_ins="insert into visiting_doctor(user_id,speciality)values('$uid','$speciality')";
		//echo "insert into visiting_doctor".$sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			//insert into visiting_doctor_clinic
			$vdid=mysql_insert_id();
			$sql_ins="insert into visiting_doctor_clinic values('','$cid','$vdid')"; 
			//echo "insert into visiting_doctor_clinic".$sql_ins;
			if($sql=mysql_query($sql_ins)or die (mysql_error()))
			{
				//$vdcid=mysql_insert_id();
			}
			else
			{
				$count++; 
			        $errno=mysql_errno();
				echo mysql_error();
			}
						
			//insert into user_email
			$sql_ins="insert into user_email values('','$uid','$eid')";
			//echo "insert into user_email".$sql_ins;
			if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
			{
				//insert into user_phone_no
				$sql_ins="insert into user_phone_no values('','$uid','$pid')";
				//echo "insert into user_phone_no".$sql_ins;
				$qry_ins=mysql_query($sql_ins)or die (mysql_error());
			}
			else
			{
				$count++;  
				$errno=mysql_errno();
				echo mysql_error();
			}
			
			$sql_ins="insert into address values('','".$arg['txtarea']."',".$arg['txtpin'].")";
			if($qry_ins=mysql_query($sql_ins) or die (mysql_error()))//address table
			{
				$aid=mysql_insert_id();
				$sql_ins="insert into user_address values('',$uid,$aid)";
				if(!mysql_query($sql_ins))//usre_address table
				{
					$count++;  
					$errno=mysql_errno(); 
					echo mysql_error();
				}
				return $vdid;
			}
			else
			{
				$count++;  $errno=mysql_errno();
				echo mysql_error(); 
			}
					
			
		}
		else
		{
			return 1;
		}
		if($count!=0)
		{
			$qry="delete  from user where uid='".$uid."'";
			mysql_query($qry);
			return $errno;
		}
		else
		{
			return false;
		}
				
		
	}
	//$arr=array('uname'=>'user48','speciality'=>'eye','day'=>'monday','start'=>'10:00:00','till'=>'12:00:00','email'=>'user48@yahoo.com','phno'=>'9658741230');
	//ins_visiting_doctor(13,$arr);
	//insert into email
	function ins_email($email)
	{
		$sql_ins="insert into email(email_address)values('$email')";
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			return mysql_insert_id();
		}
		else
		{
			return 1;
		}
	}
	//echo "id=".ins_email("usera@yahoo.com");
	//insert into phone_no
	function ins_phone_no($phno)
	{
		$sql_ins="insert into phone_no values('','$phno')";
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			return mysql_insert_id();
		}
		else
		{
			return 1;
		}
	}
	//echo "id=".ins_phone_no("9874563210");
	//update data of visiting_doctor,visit_doc_time
	function upd_visiting_doctor($arg)
	{
		$id=$arg['txtvdid'];
		$dname=$arg['txtname'];
		$user_id=upd_user($id,$dname);
		$speciality=$arg['txtspeciality'];
		$start=$arg['selstart']." ".$arg['selsmed'];
		$till=$arg['seltill']." ".$arg['seltmed'];
		$day=$arg['selday'];
		$email=$arg['txtemail'];
		upd_email($user_id,$email);
		$phno=$arg['txtphno'];
		upd_phone_no($user_id,$phno);
		$vdcid=sel_vdcid($id);
		echo $start,$till,$day,$id,$vdcid;
		$up="UPDATE visiting_doctor SET speciality='$speciality' WHERE id='$id'";
		$update=mysql_query($up) or mysql_error();
		if($update)
		{
			
			$up="UPDATE visit_doc_time SET start='".$start."',till='$till',day='$day' WHERE visit_doc_clinic_id=".$vdcid;
			echo "query=".$up;
			$update=mysql_query($up) or mysql_error();
			if($update)
			{	
				//echo "update";
				header("location: visit_doctor.php");
			}
			else
			{
				echo "not update";
			}
		}
		else
		{
			echo "Not update";
		}
	}
	function updVd($arg)
	{
		$id=$arg['vdid'];
		$vd_name=$arg['vdname'];
		$speciality=$arg['speciality'];

		$sql_sel="select * from visiting_doctor where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		$result=mysql_fetch_assoc($sql_qry);
		$uid=$result['user_id'];
		$up_user="UPDATE user SET user_name='$vd_name' WHERE id=".$uid;
		//echo $up_user;
		$update=mysql_query($up_user) or mysql_error();
		$up_vd="update visiting_doctor set speciality='$speciality' where id=".$id;
		$update=mysql_query($up_vd) or mysql_error();
	}
	function updEmailVd($data)
	{
		$qry="update email set email_address='".$data['email']."' where id=".$data['id'];
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function updPhnoVd($data)
	{
		$qry="update phone_no set phone_no='".$data['phno']."' where id=".$data['id'];
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function updTime($data)
	{
		$up="UPDATE visit_doc_time SET start='".$data['start']."',till='".$data['till']."',day='".$data['day']."' WHERE id=".$data['id'];
		//echo "query=".$up;
		$update=mysql_query($up) or mysql_error();
			
	}
	/*$data['start']="8:00:00";
	$data['smed']="AM";
	$data['till']="10:00:00";
	$data['tmed']="AM";
	$data['day']="tuesday";
	$data['id']="17";
	updTime($data);*/
	function delEmailVd($data)
	{
		//print_r($data);
		$qry="delete from email where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function delTime($data)
	{
		//print_r($data);
		$qry="delete from visit_doc_time where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}

	function delPhnoVd($data)
	{
		//print_r($data);
		$qry="delete from phone_no where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	
	function addVdEmail($data)
	{
		$qry="insert into email values('','".$data['email']."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
		$email_id=mysql_insert_id();
		$qry="insert into user_email values('','".$data['uid']."','".$email_id."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
		
	}
	function addVdPhno($data)
	{
		$qry="insert into phone_no values('','".$data['phno']."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
		$phid=mysql_insert_id();
		$qry="insert into user_phone_no values('','".$data['uid']."','".$phid."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
		
	}
	
	//select id of visiting_doctor_clinic table
	function sel_vdcid($id)
	{
		$sql_sel="select id from visiting_doctor_clinic where visiting_doctor_id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['id'];
		}
		else

		{
			return 0;
		}
	}
	//echo sel_vdcid(11);
	//insert into visit_doc_time table
	function ins_time($cid,$vdid,$arg)
	{
		$vdcid=sel_vdcid($vdid);
		//echo $vdcid;
		$start=$arg['start'];
		$till=$arg['till'];
		$day=$arg['day'];
		$sql_ins="insert into visit_doc_time values('','$vdcid','$start','$till','$day')";
		//echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			return 0;//mysql_insert_id();
		}
		else
		{
			return 1;
		}
	}
	//update user data
	function upd_user($id,$uname)
	{
		$sql_sel="select user_id from visiting_doctor where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$user_id=$sql_res['user_id'];
			$upd_user="update user set user_name='$uname' where id='$user_id'";	
			$update=mysql_query($upd_user) or mysql_error();
			if($update)
			{
				return $user_id;
			}
			else
			{
				return 1;
			} 
			
		}
		else
		{
			return 0;
		}
	}
	//upd_user(2,"user6");
	//update email data
	function upd_email($uid,$email)
	{
		$sql_sel="select email_id from user_email where user_id=".$uid;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$email_id=$sql_res['email_id'];
			$upd_email="update email set email_address='$email' where id='$email_id'";	
			$update=mysql_query($upd_email) or mysql_error();
			if($update)
			{
				return 0;//mysql_insert_id();
			}
			else
			{
				return 1;
			} 
		}
		else
		{
			return 0;
		}
	}
	//upd_email(5,"user5@yahoo.com");
	//update phone_no data
	function upd_phone_no($uid,$phno)
	{
		$sql_sel="select phone_no_id from user_phone_no where user_id=".$uid;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$phone_no_id=$sql_res['phone_no_id'];
			$upd_phno="update phone_no set phone_no='$phno' where id='$phone_no_id'";	
			$update=mysql_query($upd_phno) or mysql_error();
			if($update)
			{
				return 0;
			}
			else
			{
				return 1;
			} 
		}
		else
		{
			return 0;
		}
	}
	//upd_phone_no(6,"9658741230");
	//select company data from company table
	function sel_cmp_name()
	{
		$sql_sel="select * from company order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['id'];
				$data['cname'][$cnt]=$sql_res['company_name'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
		
	}
	function selMedicine($id)
	{
		$sql_sel="select * from  medicine where id=".$id;
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			 $sql_res=mysql_fetch_assoc($sql_qry);
			 $data['medicine_name']=$sql_res['medicine_name'];
			 $data['description']=$sql_res['description'];
			 //echo "hi";
				 $sql_sel="select * from  content,medicine_content where content.id=medicine_content.content_id and medicine_content.medicine_id=".$id;

				 //echo $sql_sel;
		        	 $sql_qry=mysql_query($sql_sel) or die(mysql_error());
				 if (mysql_num_rows($sql_qry) > 0)
				 {
				  	$cnt=0;
				 	while($result=mysql_fetch_assoc($sql_qry))
				 	{
						 $data['coid'][$cnt]=$result['content_id'];
						 $data['content_name'][$cnt]=$result['content_name'];
						 $data['desc'][$cnt]=$result['description'];
						 $data['qty'][$cnt]=$result['qty'];
						 $cnt++;
				 	}
				 }
				 
				 $sql_sel="select * from  company,medicine_company where company.id=medicine_company.company_id and medicine_company.medicine_id=".$id;
				//echo $sel_sel;
		        	 $sql_qry=mysql_query($sql_sel) or die(mysql_error());
				 if (mysql_num_rows($sql_qry) > 0)
				 {
				  	$cnt=0;
				 	while($result=mysql_fetch_assoc($sql_qry))
				 	{
						 $data['id'][$cnt]=$result['medicine_id'];
						 $data['company_name'][$cnt]=$result['company_name'];
						 $cnt++;
				 	}
				 }
				
	
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	function search_med($arg)
	{
		$text=$arg['text'];
		//echo $text;
		if(preg_match("/^[a-zA-Z0-9]*$/", $text))
		{
			//echo "hello";
			$sql_sel="select * from medicine where medicine_name='".$text."' ";
			//echo $sql_sel;
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			//echo mysql_num_rows($sql_qry);
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while ( $sql_res=mysql_fetch_assoc($sql_qry) )
				{
					$data['id']=$sql_res['id'];
					$data['medicine_name']=$sql_res['medicine_name'];
					$data['description']=$sql_res['description'];
					$result=SelContent($data['id'][$cnt]);
					//print_r($result);
					//print_r(count($result[0]['con_id']));
					$t=0;
					$temp=0;
					while($temp < count($result[$t]['con_id']))
					{
						//print_r(count($result[$t]['con_id']));
						$data['content_name'][$t]=$result[$t]['content_name'];
						$data['desc'][$t]=$result[$t]['con_desc'];
						$data['qty'][$t]=$result[$t]['qty'];
						$t++;
					}
					$cnt++;
				}
				$data['name']="medicine";		
				$data['status']=0;
				//print_r($data);
				return $data;
			}
			else
			{
				$sql_sel="select * from content where content_name='".$text."'  "; 					
				//echo $sql_sel;
				//echo $sql_sel;
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());			
				if (mysql_num_rows($sql_qry) > 0)
				{
					$cnt=0;
					while ( $sql_res=mysql_fetch_assoc($sql_qry) )
					{
						$data['id']=$sql_res['id'];
						$data['content_name']=$sql_res['content_name'];
						$data['desc']=$sql_res['description'];
						$result=sel_med($data['id']);
						//print_r($result);
						$t=0;
						$temp=0;
						while($temp < count($result['meid'][$t]))
						{
							//echo "hi";
							//print_r(count($result['meid'][$t]));
							$data['medicine_name'][$t]=$result['medicine_name'][$t];
							$data['description'][$t]=$result['description'][$t];
							$t++;
						}
						$cnt++;
					}
					$data['name']="content";		
					$data['status']=0;
					return $data;
				}
				else
				{
					$data['status']=1;
					return $data;
				}
			}
		}
	}
	function SelContent($meid)
	{
		$sql_sel="select * from  medicine_content where medicine_id=".$meid;
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$total=mysql_num_rows($sql_qry);
			$cnt1=0; 
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$med_con_id[$cnt1]=$sql_res['content_id'];
				$cnt1++;
				//echo $med_con_id;
			}
			$cnt=0;
			while($cnt < $total)
			{
				$sql_sel="select * from  content where id=".$med_con_id[$cnt];
				//echo $sql_sel;
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				if (mysql_num_rows($sql_qry) > 0)
				{
					$res=mysql_fetch_assoc($sql_qry);	
					$data['con_id']=$res['id'];
					$data['content_name']=$res['content_name'];
					$data['con_desc']=$res['description'];
					$data['qty']=sel_qty($meid,$res['id']);
					$main[$cnt]=$data; 
				}
				$cnt++;
			}
			$main['status']=0;
			return $main;
		}
		else
		{
			$main['status']=1;
			return $main;
		}
	}
	//$arg['txtconame']="con1";
	//print_r(SelContent($arg));
	function updMedicine($data)
	{
		//echo "hi";
		//echo $data['medicine_name'];
		$up="UPDATE medicine set medicine_name='".$data['medicine_name']."', description='".$data['description']."' where id=".$data['meid'];
		//echo $up;
		$update=mysql_query($up) or mysql_error();
	
	}
	function updContent($data)
	{	
	
		$up="UPDATE content set content_name='".$data['content_name']."',description='".$data['desc']."' where id=".$data['id'];
		//echo "query=".$up;
		$update=mysql_query($up) or mysql_error();
	
		$sql_sel="select * from medicine_content where medicine_id='".$data['meid']."' and content_id='".$data['id']."' ";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		$sql_res=mysql_fetch_assoc($sql_qry);
		$me_conid=$sql_res['id'];
			
		$up="UPDATE medicine_content set qty='".$data['qty']."' where id=".$me_conid;
		//echo "query=".$up;
		$update=mysql_query($up) or mysql_error();
			
	}
	//echo updContent(1);
	function delContent($data)
	{
		//print_r($data);
		$qry="delete from content where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	
	function insContent($data)
	{
		$qry="insert into content values('','".$data['content_name']."','".$data['desc']."')";
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
		$coid=mysql_insert_id();
		$qry="insert into medicine_content values('','".$data['meid']."','$coid','".$data['qty']."')";
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	//print_r(insContent($_POST));
	function del_medicine($meid)
	{
		$qry="delete from medicine_clinic where medicine_id=".$meid;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	
	function sel_medicine_alphawise($cid,$alpha)
	{
		$sql_sel="select * from  medicine,medicine_clinic where medicine_name LIKE '".$alpha."' and medicine.id=medicine_clinic.medicine_id and medicine_clinic.clinic_id=".$cid;
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['medicine_id'];
				$data['medicine_name'][$cnt]=$sql_res['medicine_name'];
				$data['description'][$cnt]=$sql_res['description'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_medicine_alphawise(3,"m"));
	
	//print_r(sel_cmp_name());
	function sel_medicine($cid)
	{
		$sql_sel="select * from medicine,medicine_clinic where medicine.id=medicine_clinic.medicine_id and medicine_clinic.clinic_id=".$cid;
		//echo $sql_sel;
 		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['medicine_id'];
				$data['medicine_name'][$cnt]=$sql_res['medicine_name'];
				$data['description'][$cnt]=$sql_res['description'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_medicine(3));
	function sel_med($coid)
	{
		//echo "hii";
		$sql_sel="select * from medicine_content where content_id=".$coid; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['meid'][$cnt]=$sql_res['medicine_id'];
				$data['qty'][$cnt]=$sql_res['qty'];
				$cnt++;			
			}
			echo $cnt;
			$t=0;
			while($cnt > $t) 
			{
				//echo $t;
				$sql_sel="select * from  medicine where id=".$data['meid'][$t];
				//echo $sql_sel;
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());	
				if (mysql_num_rows($sql_qry) > 0)
				{
					$cnt1=0;
					while ( $sql_res=mysql_fetch_assoc($sql_qry) )
					{
						//echo "cnt1=".$cnt1." ";
						//$data['meid'][$cnt1]=$sql_res['id'];
						$data['medicine_name'][$t]=$sql_res['medicine_name'];
						$data['description'][$t]=$sql_res['description'];
						$cnt1++;
						//echo "cnt1=".$cnt1." ";
					}
				}
				$t++;	 
			}
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}
	//print_r(sel_med(1));
	
	//select content data from content table
	function sel_content_name()
	{
		$sql_sel="select * from content order by id";
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['id'];
				$data['con_name'][$cnt]=$sql_res['content_name'];
				$cnt++;
			} 
			$data['status']=0;
			return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
		
	}
	//print_r(sel_content_name());
	//insert company data
	function ins_cmp($arg)
	{
		$name=$arg['cmpname'];
		$email=$arg['cmpemail'];
		$phno=$arg['cmpphno'];
		$address=$arg['cmpadd'];
		$sql_ins="insert into company values('','$name','$email','$phno','$address')";	
		//echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	//insert content data	
	function ins_content($arg)
	{
		//echo "hii";		
		$con_name=$arg['txtconame'];
		$desc=$arg['txtdesc'];
		echo $con_name;
		$check=sel_description($arg);
		//print_r($check);
		if($check != false)
		{
			return $check['id'];
		}
		else
		{
			$sql_ins="insert into content values('','$con_name','$desc')";	
			echo $sql_ins;
			if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
			{
				return mysql_insert_id();
				//return 0;
			}
			else
			{
				return 1;
			}	
		}
	}
	/*$arr['txtconame']="con2";
	$arr['txtdesc']="con_desc2";
	echo ins_content($arr);*/

	//insert company data
	function sel_content($meid)
	{
		$sql_sel="select * from  medicine_content where medicine_id=".$meid;
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$total=mysql_num_rows($sql_qry);
			$cnt1=0; 
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$med_con_id[$cnt1]=$sql_res['content_id'];
				$cnt1++;
				//echo $med_con_id;
			}
			$cnt=0;
			while($cnt < $total)
			{
				$sql_sel="select * from  content where id=".$med_con_id[$cnt];
				//echo $sql_sel;
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				if (mysql_num_rows($sql_qry) > 0)
				{
					$data=mysql_fetch_assoc($sql_qry);
					$data['qty']=sel_qty($meid,$data['id']);
					$main[$cnt]=$data; 
				}
				$cnt++;
			}
			$main['status']=0;
			return $main;
		}
		else
		{
			$main['status']=1;
			return $main;
		}
	}
	//print_r(sel_content(8));
	function sel_qty($meid,$coid)
	{
		//echo "in sel_qty function=".$meid,$coid;
		$sql_sel="select * from medicine_content where medicine_id='".$meid."'and content_id='".$coid."'";
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['qty'];
			
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_qty(10,33));
	
	function sel_description($arg)
	{
		$con_name=$arg['txtconame'];	
		$sql_sel="select * from content where content_name='".$con_name."'";
		//echo $sql_sel; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$res=mysql_fetch_assoc($sql_qry);
			$arg1['description']=$res['description'];
			$arg1['id']=$res['id'];
			//print_r($res);
			return $arg1;
		}
		else
		{
			return false;
		}
	}
	//$arg1['txtconame']="con1";
	//print_r(sel_description($arg1));
	/*function SelContent($arg)
	{
		$con_name=$arg['txtconame'];
		//echo $con_name;
		$sql_sel="select * from content where content_name='".$con_name."'";
		//echo $sql_sel; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			/*$sql_res=mysql_fetch_assoc($sql_qry);
			$data['id'][$cnt]=$sql_res['id'];
			$data['status']=0;
			return $data;*/
			/*echo "exist";
		}
		else
		{
			/*$data['status']=1;
			return $data;*/
			/*echo "not exist";
		}
		
	}*/
	$arg['txtconame']="con1";
	//SelContent($arg);
	
	function ins_mr_medicine($arg,$cid,$mrid)
	{
		echo "hello";
		$medicine_name=$arg['txtmname'];
		$desc=$arg['txtdesc'];
		$cname=$arg['txtcname'];
		//$time="11:00:00";
		$d1=curr_dt();
		$dt=explode(" ",$d1);
				
		$sql_ins="insert into medicine values ('','$medicine_name','$desc')";
		echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
				echo "insert medicine";
				$meid=mysql_insert_id();

				$sql_ins="insert into medicine_clinic values ('','$meid','$cid')";
				$qry_ins=mysql_query($sql_ins)or die (mysql_error());
		
				$sql_ins="insert into mr_medicine values ('','$mrid','$meid','".$dt[0]."','".$dt[1]."')";
				$qry_ins=mysql_query($sql_ins)or die (mysql_error());
				return $meid;
				
		}
		else
		{
				return 1;
		}
	}
	$val['txtmname']="med111111";
	$val['txtdesc']="desc111111";
	$val['txtcname']="company9";
	//print_r(ins_mr_medicine($val,12,21));


	//print_r(ins_content());
	function ins_medicine($arg,$cid)
	{
		echo "hello";
		$medicine_name=$arg['txtmname'];
		$desc=$arg['txtdesc'];
		$cname=$arg['txtcname'];
		$sql_ins="insert into medicine values ('','$medicine_name','$desc')";
		echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
				echo "insert medicine";
				$meid=mysql_insert_id();

				$sql_ins="insert into medicine_clinic values ('','$meid','$cid')";
				$qry_ins=mysql_query($sql_ins)or die (mysql_error());
		
				$sql_sel="select * from company where company_name='".$cname."'";
				echo $sql_sel; 
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				$sql_res=mysql_fetch_assoc($sql_qry);
				$cmpid=$sql_res['id'];
				$sql_ins="insert into medicine_company values ('','$meid','$cmpid')";
				echo $sql_ins;
				if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
				{
					echo $meid;
					return $meid;	
				}
				else
				{
					return 1;
				}
				
		}
		else
		{
				return 1;
		}
	}
	//$val['mname']="med111";
	//$val['mdesc1']="desc111";
	//print_r(ins_medicine($val));

	function ins_medicine_content($meid,$coid,$arg)
	{
		$qty=$arg['txtqty'];
		$sql_ins="insert into medicine_content values ('','$meid','$coid','$qty')";
		echo $sql_ins;
		if($qry_ins=mysql_query($sql_ins)or die(mysql_error()))
		{	
			echo "hiii";
			return 0;
		}
		else
		{
			echo "hello";
			return 1;	
		}
	}
	//ins_medicine_content(12,12,"potoh");
	function vd_search($text)
	{
		//print_r($text);
		if (preg_match("/^[0-9]*$/",$text['text']))
		{
			//get data from phone_no
			$sql_sel="select * from phone_no where phone_no='".$text['text']."' ";
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while ( $sql_res=mysql_fetch_assoc($sql_qry) )
				{
					$data['id'][$cnt]=$sql_res['id'];
					$data['phone_no'][$cnt]=$sql_res['phone_no'];
					$data['user_id'][$cnt]=sel_user_id($data['id'][$cnt]);
					$data['user_name'][$cnt]= sel_user_name($data['user_id'][$cnt]);
					$sql_res1=sel_vd($data['user_id'][$cnt]);
					$data['vdid'][$cnt]=$sql_res1['vdid'];
					$data['speciality'][$cnt]=$sql_res1['speciality'];
					$sql_res2=sel_time($data['vdid'][$cnt]);	
					$data['start'][$cnt]=$sql_res2['start'];
					$data['till'][$cnt]=$sql_res2['till'];	
					$data['day'][$cnt]=$sql_res2['day'];	
					//$data['email_id'][$cnt]=sel_email_id($data['user_id'][$cnt]);
					$data['email'][$cnt]= sel_user_email($data['user_id'][$cnt]);
					$cnt++;
				}
				$data['status']=0;
				return $data;
			}
			else
			{
				$data['status']=1;
				return $data;
			}
		}
		else if(preg_match("/^[a-zA-Z0-9@. ]*$/",$text['text']))
		{
			//get data from user
			$sql_sel="select * from user where user_name='".$text['text']."'";
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			//echo mysql_num_rows($sql_qry);
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while ( $sql_res=mysql_fetch_assoc($sql_qry) )
				{
					$data['user_id'][$cnt]=$sql_res['id'];
					$data['user_name'][$cnt]=$sql_res['user_name'];
					$sql_res1=sel_vd($data['user_id'][$cnt]);
					$data['vdid'][$cnt]=$sql_res1['vdid'];
					$data['speciality'][$cnt]=$sql_res1['speciality'];
					$sql_res2=sel_time($data['vdid'][$cnt]);	
					$data['start'][$cnt]=$sql_res2['start'];
					$data['till'][$cnt]=$sql_res2['till'];	
					$data['day'][$cnt]=$sql_res2['day'];
					//$data['email_id'][$cnt]=sel_email_id($data['user_id'][$cnt]);
					$data['email'][$cnt]= sel_user_email($data['user_id'][$cnt]);
					$data['phone_no'][$cnt]=sel_user_phno($data['user_id'][$cnt]);
					$cnt++;
				}
				$data['status']=0;
				return $data;
			}
			else
			{
				//get data from visiting_doctor
				$sql_sel="select * from visiting_doctor where speciality='".$text['text']."'";
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				//echo mysql_num_rows($sql_qry);				
				if (mysql_num_rows($sql_qry) > 0)
				{
					$cnt=0;
					while ( $sql_res=mysql_fetch_assoc($sql_qry) )
					{
						$data['vdid'][$cnt]=$sql_res['id'];
						$data['user_id'][$cnt]=$sql_res['user_id'];
						$data['speciality'][$cnt]=$sql_res['speciality'];	
						$data['user_name'][$cnt]=sel_user_name($data['user_id'][$cnt]); 
						$sql_res2=sel_time($data['vdid'][$cnt]);	
						$data['start'][$cnt]=$sql_res2['start'];
						$data['till'][$cnt]=$sql_res2['till'];	
						$data['day'][$cnt]=$sql_res2['day'];				
						$data['phone_no'][$cnt]=sel_user_phno($data['user_id'][$cnt]);		
						$data['email'][$cnt]= sel_user_email($data['user_id'][$cnt]);
						$cnt++;
					}
					$data['status']=0;
					return $data;
			
				}
				else
				{
					//get data from email
					$sql_sel="select * from email where email_address='".$text['text']."' ";	
					$sql_qry=mysql_query($sql_sel) or die(mysql_error());
					//echo mysql_num_rows($sql_qry);					
					if (mysql_num_rows($sql_qry) > 0)
					{
						$cnt=0;
						while ( $sql_res=mysql_fetch_assoc($sql_qry) )
						{
							$data['email_id'][$cnt]=$sql_res['id'];
							$data['email'][$cnt]=$sql_res['email_address'];
							$data['user_id'][$cnt]=sel_uid($data['email_id'][$cnt]);						
							$data['user_name'][$cnt]=sel_user_name($data['user_id'][$cnt]); 	
							$sql_res1=sel_vd($data['user_id'][$cnt]);
							$data['vdid'][$cnt]=$sql_res1['vdid'];
							$data['speciality'][$cnt]=$sql_res1['speciality'];
							$sql_res2=sel_time($data['vdid'][$cnt]);	
							$data['start'][$cnt]=$sql_res2['start'];
							$data['till'][$cnt]=$sql_res2['till'];	
							$data['day'][$cnt]=$sql_res2['day'];				
							$data['phone_no'][$cnt]=sel_user_phno($data['user_id'][$cnt]);		
							$cnt++;
						}			
						$data['status']=0;
						return $data;
					}
					else
					{
						$data['status']=1;
						return $data;
					}
					
				}
			}
		}
		else
		{
			return 0;
		}
		
	}
	//$data['text']="piyush";
	//print_r(vd_search($data));
	function sel_user_id($id)
	{
		$sel_user_phno="select * from user_phone_no where phone_no_id='".$id."' ";	
		$sql_qry=mysql_query($sel_user_phno) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['user_id'];
		}
		else
		{
			return 0;
		}		
	}
	//echo sel_user_id(13);
	function sel_vd($id)
	{
		$sel_vd="select * from visiting_doctor where user_id=".$id;	
		$sql_qry=mysql_query($sel_vd) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			$res['vdid']=$sql_res['id'];
			$res['speciality']=$sql_res['speciality'];
			return $res;
		}
		else
		{
			return 0;
		}		
	}
	//print_r(sel_vd(34));
	function sel_uid($id)
	{
		$sel_eid="select * from user_email where email_id='".$id."' ";
		$sql_qry=mysql_query($sel_eid) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			return $sql_res['user_id'];
		}
		else
		{
			return 0;
		}					
	}
	//echo "user_id=".sel_uid(16);
?>
