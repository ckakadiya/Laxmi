<?php
	include_once "connect.php";
	include_once "function_vd.php";

	
	function ins_mr($arg,$cid)
	{
		$mrname=$arg['txtmr_name'];
		$mrgender=$arg['txtgender'];
		$sql_ins="INSERT INTO mr VALUE ('','$mrname','$mrgender')";
		{
			if($qry_ins=mysql_query($sql_ins)or die(mysql_error()))
			{
				$mrid=mysql_insert_id(); 
				//echo $mrid;
				$sql_ins="insert into mr_clinic values('','".$mrid."','".$cid."')";
				echo $sql_ins;
				mysql_query($sql_ins) or die ("ssfcds".mysql_error());
				$sql_ins="insert into mr_address values('','".$mrid."','".$arg['txtarea']."',".$arg['txtpin'].")";
				echo $sql_ins;
				if($qry_ins=mysql_query($sql_ins) or die (mysql_error()))//address table
				{	
					echo "hiii";
					return $mrid;
				}
			}
			else
			{
				echo "not insert";
			}
		}
	}
	/*$arr['txtmr_name']="mr8";
	$arr['txtgender']="female";
	$arr['txtarea']="katargam";
	$arr['txtpin']="395001";
	ins_mr($arr);*/
	//print_r(ins_mr()); 
	function ins_mr_email($mrid,$email)
	{
		//$email_address=$arg['txtemail'];
		$sql_ins="INSERT INTO mr_email VALUE('','$mrid','$email')";	
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			echo "email insert";
			//return 1;
		}
		else
		{
			echo "email not insert";
			//return 0;
		}		
	}
	//ins_mr_email(7,'mr1@yahoo.in');
	function ins_mr_phone_no($mrid,$phno)
	{
		//$phone_no=$arg['txtphone_no'];
		$sql_ins="INSERT INTO mr_phone_no VALUE('','$mrid','$phno')";	
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			echo "insert phone no";
			//return 1;
		}
		else
		{
			echo "not insert phone no";
			//return 0;
		}		
	}
	//ins_mr_phone_no(7,'9856321470');
	function ins_mr_clinic($mrid,$cid)
	{
		//$phone_no=$arg['txtphone_no'];
		$sql_ins="INSERT INTO mr_clinic VALUE('','$mrid','$cid')";
		//echo $sql_ins;	
		if($qry_ins=mysql_query($sql_ins)or die (mysql_error()))
		{
			//echo "insert mr_clinic";
			return 1;
		}
		else
		{
			//echo "not insert mr_clinic";
			return 0;
		}		
	}
	//echo ins_mr_clinic('2','12');
	function ins_clinic($arg)
	{
		$clinicname=$arg['txtclinic_name'];
		$add=$arg['txtadd'];
		$pid=$arg['txtpid'];
		$datetime=$arg['txtdatetime'];
		$phno=$arg['txtphone_no'];
		$sql_ins="INSERT INTO clinic VALUE ('','$clinicname','$add','$pid','$datetime','$phno')";
		{
			if($qry_ins=mysql_query($sql_ins)or die(mysql_error()))
			{
				
				return mysql_insert_id();
			
				//echo $lid;
				//return mysql_insert_id();
				//echo "insert";
				//$cid=mysql_insert_id();
				//echo $cid;
	
			}
			else
			{
				echo "not insert";
			}
		}
	}
	//print_r(ins_clinic());
	function sel_mr($cid)
	{
		$sql_sel="select * from  mr,mr_clinic where mr.id=mr_clinic.mr_id and mr_clinic.clinic_id=".$cid;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['mr_id'];
				$data['mr_name'][$cnt]=$sql_res['mr_name'];
				$data['gender'][$cnt]=$sql_res['gender'];
				//$result=sel_mr_email($data['id'][$cnt]);
				$data['email'][$cnt]=sel_mr_email($data['id'][$cnt]);
				$data['phno'][$cnt]=sel_mr_phno($data['id'][$cnt]);
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
	//print_r(sel_mr(12));
	
	function sel_mr_alphawise($cid,$alpha)
	{
		$sql_sel="select * from  mr,mr_clinic where mr_name LIKE '".$alpha."' and mr.id=mr_clinic.mr_id and mr_clinic.clinic_id=".$cid;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{	
			$cnt=0;
			while ( $sql_res=mysql_fetch_assoc($sql_qry) )
			{
				$data['id'][$cnt]=$sql_res['mr_id'];
				$data['mr_name'][$cnt]=$sql_res['mr_name'];
				$data['gender'][$cnt]=$sql_res['gender'];
				//$result=sel_mr_email($data['id'][$cnt]);
				$data['email'][$cnt]=sel_mr_email($data['id'][$cnt]);
				$data['phno'][$cnt]=sel_mr_phno($data['id'][$cnt]);
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
	//print_r(sel_mr(12));


	function selMr($id)
	{
		$sql_sel="select * from  mr where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			 $sql_res=mysql_fetch_assoc($sql_qry);
			 $data['id']=$sql_res['id'];
			 $data['mr_name']=$sql_res['mr_name'];
			 $data['gender']=$sql_res['gender'];
			 
			 $sql_sel="select * from  mr_email where mr_id=".$id;
		         $sql_qry=mysql_query($sql_sel) or die(mysql_error());
			 if (mysql_num_rows($sql_qry) > 0)
			 {
			  	$cnt=0;
			 	while($result=mysql_fetch_assoc($sql_qry))
			 	{
					 $data['eid'][$cnt]=$result['id'];
					 $data['email'][$cnt]=$result['email_id'];
					 $cnt++;
			 	}
			 }
			 
			 $sql_sel="select * from  mr_phone_no where mr_id=".$id;
		         $sql_qry=mysql_query($sql_sel) or die(mysql_error());
			 if (mysql_num_rows($sql_qry) > 0)
			 {
			  	$cnt=0;
			 	while($result=mysql_fetch_assoc($sql_qry))
			 	{
					 $data['cid'][$cnt]=$result['id'];
					 $data['phno'][$cnt]=$result['phone_no'];
					 $cnt++;
			 	}
			 }
			
			 $sql_sel="select * from  mr_medicine where mr_id=".$id;
		         $sql_qry=mysql_query($sql_sel) or die(mysql_error());
			 if (mysql_num_rows($sql_qry) > 0)
			 {
			  	$cnt=0;
			 	while($result=mysql_fetch_assoc($sql_qry))
			 	{
					 $data['mr_med_id'][$cnt]=$result['id'];
					 $data['medicine_id'][$cnt]=$result['medicine_id'];
					 $data['time'][$cnt]=$result['time'];
					 $data['date'][$cnt]=$result['date'];
					 $cnt++;
			 	}
				$t=0;
				while($t != $cnt)
				{
					 $sql_sel="select * from  medicine where id=".$data['medicine_id'][$t];
		       			 $sql_qry=mysql_query($sql_sel) or die(mysql_error());
					 $result=mysql_fetch_assoc($sql_qry);
					 $data['medicine_name'][$t]=$result['medicine_name'];
					 $data['medicine_desc'][$t]=$result['description'];
					 $t++;
				}
			 }
			
		         
			 $sql_sel="select * from  mr_company where mr_id=".$id;
		         $sql_qry=mysql_query($sql_sel) or die(mysql_error());
			 if (mysql_num_rows($sql_qry) > 0)
			 {
			  	$cnt=0;
			 	while($result=mysql_fetch_assoc($sql_qry))
			 	{
					 $data['company_id'][$cnt]=$result['company_id'];
					 $cnt++;
			 	}
				$t=0;
				while($t != $cnt)
				{
					 $sql_sel="select * from  company where id=".$data['company_id'][$t];
		       			 $sql_qry=mysql_query($sql_sel) or die(mysql_error());
					 $result=mysql_fetch_assoc($sql_qry);
					 $data['company_name']=$result['company_name'];
					 $t++;
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

	//print_r (selmr(6));
	function selmr1($id)
	{
		$sql_sel="select * from  mr where id=".$id;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			 $sql_res=mysql_fetch_assoc($sql_qry);
			 $data['id']=$sql_res['id'];
			 $data['mr_name']=$sql_res['mr_name'];
			 $data['gender']=$sql_res['gender'];
			 $data['email']=sel_mr_email($data['id']);
			 $data['phno']=sel_mr_phno($data['id']);	
			 $data['status']=0;
			 return $data;
		}
		else
		{
			$data['status']=1;
			return $data;
		}
	}


	function sel_mr_email($id)
	{
		$sql_sel="select * from mr_email where mr_id=".$id; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			//$data['id'][$cnt]=$sql_res['id'];
			//$data['email'][$cnt]=$sql_res['email_id'];
			return $sql_res['email_id'];
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_mr_email(4));	
	function updEmail($data)
	{
		$qry="update mr_email set email_id='".$data['email']."' where id=".$data['id'];
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function del_email($data)
	{
		//print_r($data);
		$qry="delete from mr_email where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function updMrMedicine($data)
	{
		$qry="update medicine set medicine_name='".$data['med_name']."' where id=".$data['med_id'];
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function delMrMedicine($data)
	{
		//print_r($data);
		$qry="delete from mr_medicine where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function updatePhno($data)
	{	
		$qry="update mr_phone_no set phone_no='".$data['phno']."' where id=".$data['id'];
		//echo $qry;
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	//$data=array('phno'=>'9875632014','id'=>'12');
	//upd_phno($data);
	function deletePhno($data)
	{
		$qry="delete from mr_phone_no where id=".$data['did'];
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function sel_mr_phno($id)
	{
		$sql_sel="select * from mr_phone_no where mr_id=".$id; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			//$data['id']=$sql_res['id'];
			//$data['phno']=$sql_res['phone_no'];
			return $sql_res['phone_no'];
		}
		else
		{
			return 0;
		}
	}
	//echo sel_mr_phno(5);
	function sel_company_name($com_id)
	{
		$sql_sel="select * from company where id=".$com_id; 
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$sql_res=mysql_fetch_assoc($sql_qry);
			//$data['id']=$sql_res['id'];
			//$data['phno']=$sql_res['phone_no'];
			return $sql_res['company_name'];
		}
		else
		{
			return 0;
		}
	}
	
	//select mrid according to companyid 
	function sel_mr_company($cid)
	{
		$sql_sel="select * from mr_company where company_id=".$cid; 
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$data['mr_id'][$cnt]=$sql_res['mr_id'];
				$cnt++;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_mr_company(3));
	//select mrid according to medicineid
	function sel_medicine_mr($meid)
	{
		$sql_sel="select * from mr_medicine where medicine_id=".$meid; 
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$data['mr_id'][$cnt]=$sql_res['mr_id'];
				$cnt++;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	
	//select company according to mrid
	function sel_company_mr($mrid)
	{
		$sql_sel="select * from mr_company where mr_id=".$mrid; 
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			$sql_res=mysql_fetch_assoc($sql_qry);
			$data['company_id']=$sql_res['company_id'];
			return $data['company_id'];
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_company_mr(23));
	function sel_mr_medicine($id)
	{
		$sql_sel="select * from mr_medicine where mr_id=".$id; 
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$data['medicine_id'][$cnt]=$sql_res['medicine_id'];
				$data['time'][$cnt]=$sql_res['time'];
				$cnt++;
			}
			$t=0;
			while($t < $cnt)
			{
				$sql_sel="select * from medicine where id=".$data['medicine_id'][$t]; 
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				$sql_res=mysql_fetch_assoc($sql_qry);
				$data['medicine_name'][$t]=$sql_res['medicine_name'];
				$t++;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	//print_r(sel_mr_medicine(21));
	function sel_company_medicine($com_id)
	{
		$sql_sel="select * from medicine_company where company_id=".$com_id; 
		//echo $sql_sel;
		$sql_qry=mysql_query($sql_sel) or die(mysql_error());
		if (mysql_num_rows($sql_qry) > 0)
		{
			$cnt=0;
			while($sql_res=mysql_fetch_assoc($sql_qry))
			{
				$data['medicine_id'][$cnt]=$sql_res['medicine_id'];
				$cnt++;
			}
			$t=0;
			while($t < $cnt)
			{
				$sql_sel="select * from medicine where id=".$data['medicine_id'][$t]; 
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				$sql_res=mysql_fetch_assoc($sql_qry);
				$data['medicine_name'][$t]=$sql_res['medicine_name'];
				$t++;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	
	function del_mr($d_id)
	{	
		$del="delete from mr where id=".$d_id;
		$qry=mysql_query($del) or die(mysql_error());
	}
	function del_mr_email($mrid)
	{	
		$del="delete from mr_email where mr_id=".$mrid;
		$qry=mysql_query($del) or die(mysql_error());
	}
	function del_mr_phone_no($mrid)
	{	
		$del="delete from mr_phone_no where mr_id=".$mrid;
		$qry=mysql_query($del) or die(mysql_error());
	}
	//del_mr(267);
	function addMrEmail($data)
	{
		$qry="insert into mr_email values('','".$data['mrid']."','".$data['email']."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function addMrPhno($data)
	{
		$qry="insert into mr_phone_no values('','".$data['mrid']."','".$data['phno']."')";
		$sql_qry=mysql_query($qry) or die(mysql_error());
	}
	function updMr($arg)
	{
		$id=$arg['mrid'];
		$mr_name=$arg['mrname'];
		$gender=$arg['gender'];
		$up="UPDATE mr SET mr_name='$mr_name', gender='$gender' WHERE id=".$id;
		//echo $up;
		$update=mysql_query($up) or mysql_error();
		
	}
	function upd_mr($arg)
	{
		$id=$arg['txtid'];
		$mr_name=$arg['txtname'];
		$gender=$arg['txtgender'];
		$email=$arg['txtemail'];
		echo $id,$mr_name,$gender,$email;
		upd_mr_email($id,$email);
		$phno=$arg['txtphone_no'];
		upd_mr_phone_no($id,$phno);

		$up="UPDATE mr SET mr_name='$mr_name', gender='$gender' WHERE id=".$id;
		echo $up;
		$update=mysql_query($up) or mysql_error();
		if($update)
		{
			echo "update";
  		}
		else
		{
			echo "Not update";	
		}
	}
	//print_r(upd_mr());
	function upd_mr_email($id,$email)
	{
			$upd_email="update mr_email set email_id='$email' where mr_id=".$id;
			$update=mysql_query($upd_email) or mysql_error();
			if($update)
			{
				//echo "email update";
				return 0;
			}
			else
			{
				//echo "email not update";
				return 1;
			}
		
	}
	//upd_email(4,"mr4@yahoo.in");
	function upd_mr_phone_no($id,$phno)
	{
		$upd_phno="update mr_phone_no set phone_no='$phno' where mr_id=".$id;
		$update=mysql_query($upd_phno) or mysql_error();
		if($update)
		{
			//echo "update phone_no";
			return 0;
		}
		else
		{
			//echo "not update phone_no";
			return 1;
		}
		
	}
	//upd_phone_no(6,"9658741230");
	function search($arg)
	{
		//echo "hi";
		$text=$arg['text'];
		if (preg_match("/^[0-9]*$/",$text))
		{
			//echo "ho..";
			//get data from phone_no
			$sql_sel="select * from mr_phone_no where phone_no=".$text;
			//echo $sql_sel;
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while ( $sql_res=mysql_fetch_assoc($sql_qry) )
				{
					$data['id'][$cnt]=$sql_res['mr_id'];
					$data['phno'][$cnt]=$sql_res['phone_no'];
					$result=selmr1($data['id'][$cnt]);
					//echo $result;
					$data['mr_name'][$cnt]=$result['mr_name'];
					$data['gender'][$cnt]=$result['gender'];
					//$sel=sel_mr_email($data['id'][$cnt]);
					$data['email'][$cnt]=sel_mr_email($data['id'][$cnt]);
					$data['company_id'][$cnt]=sel_company_mr($data['id'][$cnt]);
					$data['company_name'][$cnt]=sel_company_name($data['company_id'][$cnt]);
						
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
		else if(preg_match("/^[a-zA-Z0-9@. ]*$/",$text))
		{
			//echo "hello";
			$sql_sel="select * from mr where mr_name= '".$text."' ";
			$sql_qry=mysql_query($sql_sel) or die(mysql_error());
			//echo mysql_num_rows($sql_qry);
			if (mysql_num_rows($sql_qry) > 0)
			{
				$cnt=0;
				while ( $sql_res=mysql_fetch_assoc($sql_qry) )
				{
					$data['id'][$cnt]=$sql_res['id'];
					//$data['phone_no'][$cnt]=$sql_res['phone_no'];
					$data['mr_name'][$cnt]=$sql_res['mr_name'];
					$data['gender'][$cnt]=$sql_res['gender'];
					//$result=sel_mr_phone_no($data['id'][$cnt]);
					$data['phno'][$cnt]=sel_mr_phno($data['id'][$cnt]);
					$data['email'][$cnt]=sel_mr_email($data['id'][$cnt]);
					$data['company_id'][$cnt]=sel_company_mr($data['id'][$cnt]);
					$data['company_name'][$cnt]=sel_company_name($data['company_id'][$cnt]);
					$result1=sel_mr_medicine($data['id'][$cnt]);	
					$data['medicine_id'][$cnt]=$result1['medicine_id'][$cnt];
					$data['medicine_name'][$cnt]=$result1['medicine_name'][$cnt];
								
					//$sel=sel_mr_email($data['id'][$cnt]);
					//$data['email_id'][$cnt]=$sel['email_id'];
					$cnt++;
				}
				$data['status']=0;
				//print_r($data);
				return $data;
			}
			else
			{
				$sql_sel="select * from mr_email where email_id='".$text."'";	
				$sql_qry=mysql_query($sql_sel) or die(mysql_error());
				//echo mysql_num_rows($sql_qry);					
				if (mysql_num_rows($sql_qry) > 0)
				{
					$cnt=0;
					while ( $sql_res=mysql_fetch_assoc($sql_qry) )
					{
						//print_r($sql_res);
						$data['id'][$cnt]=$sql_res['mr_id'];
						$data['email'][$cnt]=$sql_res['email_id'];
						$result=selmr1($data['id'][$cnt]);
						$data['mr_name'][$cnt]=$result['mr_name'];
						$data['gender'][$cnt]=$result['gender'];
						$data['phno'][$cnt]=sel_mr_phno($data['id'][$cnt]);
						$data['company_id'][$cnt]=sel_company_mr($data['id'][$cnt]);
						$data['company_name'][$cnt]=sel_company_name($data['company_id'][$cnt]);
						$result1=sel_mr_medicine($data['id'][$cnt]);
						$data['medicine_id'][$cnt]=$result1['medicine_id'][$cnt];
						$data['medicine_name'][$cnt]=$result1['medicine_name'][$cnt];
								
						$cnt++;
					}			
					$data['status']=0;
					//print_r($data);
					return $data;
				}
				else
				{
					$sql_sel="select * from company where company_name='".$text."'";	
					$sql_qry=mysql_query($sql_sel) or die(mysql_error());
					//echo mysql_num_rows($sql_qry);					
					if (mysql_num_rows($sql_qry) > 0)
					{
						$cnt=0;
						while ( $sql_res=mysql_fetch_assoc($sql_qry) )
						{
							$data['company_id'][$cnt]=$sql_res['id'];
							$result=sel_mr_company($data['company_id'][$cnt]);
							$t=0;								
							while($t < count($result['mr_id']))
							{		
								$data['id'][$t]=$result['mr_id'][$t];
								$data['company_name'][$t]=$sql_res['company_name'];
								$data['email'][$t]=sel_mr_email($data['id'][$t]);
								$res=selmr1($data['id'][$t]);
								$data['mr_name'][$t]=$res['mr_name'];
								$data['gender'][$t]=$res['gender'];
								$data['phno'][$t]=sel_mr_phno($data['id'][$t]);
								$result1=sel_company_medicine($data['company_id'][$cnt]);
								$data['medicine_id'][$t]=$result1['medicine_id'][$t];
								$data['medicine_name'][$t]=$result1['medicine_name'][$t];
								$t++;
							}
								
							$cnt++;
						}			
						$data['status']=0;
						return $data;
					}
					else
					{
						$sql_sel="select * from medicine where medicine_name= '".$text."' ";
						$sql_qry=mysql_query($sql_sel) or die(mysql_error());
						//echo mysql_num_rows($sql_qry);
						if (mysql_num_rows($sql_qry) > 0)
						{
							$cnt=0;	
							while ( $sql_res=mysql_fetch_assoc($sql_qry) )
							{
								$data['medicine_id'][$cnt]=$sql_res['id'];
								$result=sel_medicine_mr($data['medicine_id'][$cnt]);
								$t=0;								
								while($t < count($result['mr_id']))
								{		
										$data['id'][$t]=$result['mr_id'][$t];
										$res=selmr1($result['mr_id'][$t]);	
										$data['mr_name'][$t]=$res['mr_name'];
										$data['gender'][$t]=$res['gender'];
										$data['medicine_name'][$t]=$sql_res['medicine_name'];		
										//$result=sel_mr_phone_no($data['id'][$cnt]);
										$data['phno'][$t]=sel_mr_phno($data['id'][$t]);
										$data['email'][$t]=sel_mr_email($data['id'][$t]);
										$data['company_id'][$t]=sel_company_mr($data['id'][$t]);
										$data['company_name'][$t]=sel_company_name($data['company_id'][$t]);
										$t++;
								}
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
			
		}
		else
		{
			return 0;
		}
	}
	$arr['text']="company14";
	//print_r(search($arr));					
?>

