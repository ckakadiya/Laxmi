<?php
	session_start();
		
		if(isset($_POST['submit']))
		{
			include_once("function.php");
			$arr_fpwd=array();
			$arr_fpwd['email']=$_POST['txtemail'];
			$arr_fpwd['que']=$_POST['txtque'];
			$arr_fpwd['ans']=$_POST['txtans'];
			$arr_fpwd['npwd']=$_POST['password'];
			$sel_res=forgotPassword($arr_fpwd);
			if($sel_res['result']==1)
			{
				//echo "Password is successfully change";
				header("Location:login.php");
			}
			else
			{
				echo $sel_res['result'];
			}
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/c1.css" rel="stylesheet" type="text/css">
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>

</head>
<body>
<center>
<form name="form1" method="post" action="#">
	<div id="main">
		 <div class="lbl">Username :</div>
		<div class="ctrl">
			<input type="email" name="txtemail" id="t1" required>
			<label id="l1"></label>
		</div>

        <div class="lbl">Security Ques</div>
		<div class="ctrl">
			<select name="txtque" >
			  <option value="what is your nick name?">what is your nick name?</option>
			  <option value="what is your father name?">what is your father name?</option>
			  <option value="what is your feverit book?">what is your feverit book?</option>
			  <option value="what is your mother name">what is your mother name</option>
			
			</select>
		</div>
        <div class="lbl">Answer :</div>
		<div class="ctrl">
			<input type="text" name="txtans" id="t1" required>
			<label id="l1"></label>
		</div>
       
		<div class="lbl">New Password:</div>
		<div class="ctrl">
			<input type="password" name="password" id="password" required="required" title="Enter Password." onKeyUp="pass()" onChange="flash()" />
			<label id="l2"></label>
		</div>
		<div class="lbl">Conform Password:</div>
		<div class="ctrl">
			<input type="password" name="repassword" id="repassword" required="required" title="Enter Re-Enter Password." onKeyUp="repass()" onClick="repass()" onBlur="flashre()" />
			<label id="l3"></label>
		</div>
		<div class="ctrl" style="text-align:center">
			<input type="submit" name="submit" id="button" value="Submit">
		</div>
 	</div>			
</form>
</center>

</body>
</html>