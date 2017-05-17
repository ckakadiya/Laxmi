<?php
	include_once("Function.php");
	if (isset($_GET['txtemail']))
	{
		$email=$_GET['txtemail'];
		$fileName=$_GET['fileName'];
		$policyName=$_GET['policyName'];
		$file=explode('.',$fileName);
		$name=$file[0];
		
		$path="pdf/".$email."/Policy/".$fileName;
		if (unlink($path))
		{
			$qry="select * from clients where emailId='$email'";
			 $res=mysql_query($qry) or die(mysql_error());
			 $row=mysql_fetch_assoc($res);
			 $clientId=$row['clientId'];
			 
			 $qry="delete from policy where clientId='$clientId' AND fileName='$fileName' AND policyName='$policyName'";
			  $res=mysql_query($qry) or die(mysql_error());
			if  ($_GET['name']=="allClients")
				header("Location:acessData.php?txtemail=$email");
			else
				header("Location:todayRenewal.php?error='Error during Deleting Policy.'");
		}
		else
			header("Location:todayRenewal.php?error='Policy Not Found'");
	}
	else
	{
		header("Location:allCustomer.php");
	}
?>
