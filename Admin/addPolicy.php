<?php
	include_once("Function.php");
	if(isset($_POST['submit']) && isset($_FILES['pdffile']))
	{
		is_uploaded_file($_FILES['pdffile']['tmp_name']);
		$policyName=$_POST['txtpolicyname'];
		$policyPurpose=$_POST['txtpurpose'];

		$date=$_POST['txtdate'];
		$tmp=explode('/',$date);
		$date=$tmp[2]."-".$tmp[1]."-".$tmp[0];
		$email=$_POST['txtemail'];
		
		$path = "pdf/".$email."/Policy/";
		/*if (!is_dir($path))
		{
			mkdir($path, 0, true);
		}*/

      $error="";
      $file_name = $_FILES['pdffile']['name'];
      $file_size =$_FILES['pdffile']['size'];
      $file_tmp =$_FILES['pdffile']['tmp_name'];
      $file_type=$_FILES['pdffile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['pdffile']['name'])));
      
      if($file_type!="application/pdf"){
	  	$error='File is not upload';
		}
      	if($file_size > 15728640){
         $error='File is not upload';
      	}

      if(empty($error)==true){
         move_uploaded_file($file_tmp,$path.$file_name);
		 $qry="select * from clients where emailId='$email'";
		 $res=mysql_query($qry) or die(mysql_error());
		 $row=mysql_fetch_assoc($res);
		 $clientId=$row['clientId'];
		 
		 $qry="insert into policy values ('','$policyName','$policyPurpose','$file_name','$date','0','$clientId')";
		 $res=mysql_query($qry) or die(mysql_error());
		 header ("Location:acessData.php?txtemail=$email");
      }else{
         header("Location:newPolicy.php?errors=$error&txtemail=$email");
      }
	}
	else
	{
		header("Location:newCustomer.php");
	}
?>
