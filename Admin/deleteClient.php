<?php
	include_once("Function.php");
	echo $email=$_GET['txtemail'];
	echo $clientId=$_GET['clientId'];
		
	$path="pdf/".$email;
	$path1="pdf/".$email."/AadharCard";
	$path2="pdf/".$email."/Other";
	$path3="pdf/".$email."/VotingCard";
	$path4="pdf/".$email."/Policy";
	array_map('unlink', glob("$path1/*.*"));
	array_map('unlink', glob("$path2/*.*"));
	array_map('unlink', glob("$path3/*.*"));
	array_map('unlink', glob("$path4/*.*"));

	if (rmdir($path1) && rmdir($path2) && rmdir($path3) && rmdir($path4) && rmdir($path))
	{
		$qry="delete from policy where clientId='$clientId'";
		$res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_assoc($res);
		
		$qry="delete from clients where clientId='$clientId'";
		$res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_assoc($res);		
		
		header("Location:allCustomer.php");
	}
	else
	{
		header("Location:allCustomer.php");	
	}
?>
