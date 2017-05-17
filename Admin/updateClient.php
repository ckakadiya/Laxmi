<?php
	include_once("Function.php");
	if(isset($_POST['submit']))
	{
		$fname=$_POST['txtfname'];
		$mname=$_POST['txtmname'];
		$lname=$_POST['txtlname'];
		$phone=$_POST['txtphone'];
		$email=$_POST['txtemail'];
		$aadharCard=$_POST['aadhar'];
		$votingCard=$_POST['voting'];
		$otherDoc=$_POST['other'];
		
		$error="";
		if (isset($_FILES['aadharCard']))
		{
			$path = "pdf/".$email."/AadharCard/";
			if (!is_dir($path))
			{
				mkdir($path, 0, true);
			}
			  
			  $aadharCard = $_FILES['aadharCard']['name'];
			  $file_size =$_FILES['aadharCard']['size'];
			  $file_tmp =$_FILES['aadharCard']['tmp_name'];
			  $file_type=$_FILES['aadharCard']['type'];
			  $file_ext=strtolower(end(explode('.',$_FILES['aadharCard']['name'])));
			  
			  $expensions= array("jpeg","jpg","png");
      
			  if(in_array($file_ext,$expensions)=== false){
				 $errors="extension not allowed, please choose a JPEG or PNG file.";
			  }
			  
				if($file_size > 15728640){
				 $error='File is not upload';
				}
		
			  if(empty($error)==true){
				 move_uploaded_file($file_tmp,$path.$aadharCard);
				}
				else
				{
					$error='File is not upload';
				}
				
		}
		
		if (isset($_FILES['votingCard']))
		{
			$path = "pdf/".$email."/VotingCard/";
			if (!is_dir($path))
			{
				mkdir($path, 0, true);
			}
			 
			  $votingCard = $_FILES['votingCard']['name'];
			  $file_size =$_FILES['votingCard']['size'];
			  $file_tmp =$_FILES['votingCard']['tmp_name'];
			  $file_type=$_FILES['votingCard']['type'];
			  $file_ext=strtolower(end(explode('.',$_FILES['votingCard']['name'])));
			  
			  $expensions= array("jpeg","jpg","png");
      
			  if(in_array($file_ext,$expensions)=== false){
				 $errors="extension not allowed, please choose a JPEG or PNG file.";
			  }
				if($file_size > 15728640){
				 $error='File is not upload';
				}
		
			  if(empty($error)==true){
				 move_uploaded_file($file_tmp,$path.$votingCard);
				}
				else
				{
					$error='File is not upload';
				}
		}
		
		if (isset($_FILES['other']))
		{
			$path = "pdf/".$email."/Other/";
			if (!is_dir($path))
			{
				mkdir($path, 0, true);
			}
			 
			  $otherDoc = $_FILES['other']['name'];
			  $file_size =$_FILES['other']['size'];
			  $file_tmp =$_FILES['other']['tmp_name'];
			  $file_type=$_FILES['other']['type'];
			  $file_ext=strtolower(end(explode('.',$_FILES['other']['name'])));
			  
			  $expensions= array("jpeg","jpg","png");
      
			  if(in_array($file_ext,$expensions)=== false){
				 $errors="extension not allowed, please choose a JPEG or PNG file.";
			  }
				if($file_size > 15728640){
				 $error='File is not upload';
				}
		
			  if(empty($error)==true){
				 move_uploaded_file($file_tmp,$path.$otherDoc);
				}
				else
				{
					$error='File is not upload';
				}
		}
		
		$qry="update clients set firstName='$fname' , middleName='$mname' , lastName='$lname' , phoneNo='$phone' , aadharCard='$aadharCard' , votingCard='$votingCard' , otherDoc='$otherDoc'  where emailId='$email'";
		
		if (mysql_query($qry) and $error=="")// or die(mysql_error());
		{
			header("Location:acessData.php?txtemail=$email");
		}
		else
		{
			header("Location:acessData.php?txtemail=$email&error=Problem During Updating Data.");
		}
	
	}
	else
	{
		header("location:newCustomer.php");
	}
?>
