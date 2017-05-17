<?php
include_once("connect.php");
			$user['uid']=3;
			$seluser=array();
			$qry="select * from user where id='".$user['uid']."'";
			$res=mysql_query($qry) or die(mysql_error());
			$row=mysql_fetch_array($res);
			$seluser['uname']=$row['user_name'];
			
			$qry="select * from address where id=(select address_id from user_address where user_id='".$user['uid']."')";
			$res=mysql_query($qry) or die(mysql_error());
			$row=mysql_fetch_array($res);
			$seluser['street']=$row['street_name'];
			
			$qry="select * from area where id='".$row['area_id']."'";
			$res=mysql_query($qry) or die(mysql_error());
			$row=mysql_fetch_array($res);
			
			$seluser['pincode']=$row['pincode'];
			
			$qry="select * from city where id='".$row['city_id']."'";
			$sel_res=mysql_query($qry);
			$row=mysql_fetch_array($sel_res);
			$seluser['city']=$row['city_name'];
					
			$qry="select * from state where id='".$row['state_id']."'";
			$sel_res=mysql_query($qry);
			$row=mysql_fetch_array($sel_res);
			$seluser['state']=$row['state_name'];
					
			$qry="select * from email where id=(select email_id from user_email where user_id='".$user['uid']."')";
			$res=mysql_query($qry) or die(mysql_error());
			if(mysql_num_rows($res)>1)
			{
				/*while()
				{
				}*/
			}
			$row=mysql_fetch_array($res);
			$seluser['email']=$row['email_address'];
			
			$qry="select * from phone_no where id=(select phone_no_id from user_phone_no where user_id='".$user['uid']."')";
			$res=mysql_query($qry) or die(mysql_error());
			$row=mysql_fetch_array($res);
			$seluser['phone']=$row['phone_no'];
			
			$qry="select * from doctor where user_id='".$user['uid']."'";
			$res=mysql_query($qry) or die(mysql_error());
			$row=mysql_fetch_array($res);
			$seluser['speciality']=$row['speciality'];
			echo json_encode(array("result"=>$seluser));
?>