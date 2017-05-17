<?php
	include_once("required_links.php");
	include_once("Connect.php");
	if(isset($_POST['submit']))
	{
		$arr_login=array();
		
		$arr_login['uname']=$_POST['txtemail'];
		$arr_login['password']=$_POST['txtpass'];
		
		$arr=array();
		$qry="select * from userlogin where emailId='".$arr_login['uname']."' and password='".$arr_login['password']."'";
		$res=mysql_query($qry) or die(mysql_error());
		if(mysql_num_rows($res)>0)
		{
			$row=mysql_fetch_assoc($res);
			session_start();
			//$_SESSION['adminid']=$sel_res['adminid'];
			$_SESSION['username']=$row['emailId'];
			header("location:dashboard.php");
		}
		else
		{
		?>
			</br>
			<div class="alert alert-danger alert-dismissable">
                    <strong>Incorrect Email or Password.</strong> 
            </div>
           
        <?php
		}		
	}
?>
