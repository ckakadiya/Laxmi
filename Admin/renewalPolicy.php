<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$menu="todayRenewal";
		$fdir = $_SERVER['PHP_SELF'];
		
		if (isset($_GET['txtemail']))
		{
	
?>
<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Insurance</TITLE>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	</HEAD>

<BODY>
<?php include_once("heading.php");?>
<div id="container">
	<?php 
		include_once("connect.php");
		include_once("admin_menu.php");
		include_once("Function.php");
		
		$email=$_GET['txtemail'];
		$qry="select * from clients where emailId='".$email."'";
		$res=mysql_query($qry) or die(mysql_error());
		$row=mysql_fetch_assoc($res);
	?>
	
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="typography-16"></span><h3>Client Details</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="renew.php" class="i-validate" id="Appointment_reg"> 
					<fieldset>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">First Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input id="text_field" class="i-text required wid" readonly value="<?php echo $row['firstName']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Middle Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input id="text_field" class="i-text required wid" readonly value="<?php echo $row['middleName']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Last Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input id="text_field" class="i-text required wid" readonly value="<?php echo $row['lastName']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Phone No:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input id="text_field" class="i-text required wid" readonly value="<?php echo $row['phoneNo']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Email Id:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtemail" id="text_field" class="i-text required wid" readonly value="<?php echo $row['emailId']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						
						<?php
						 $qry="select * from clients where emailId='$email'";
						 $res=mysql_query($qry) or die(mysql_error());
						 $row=mysql_fetch_assoc($res);
						 $clientId=$row['clientId'];
						 $fileName=$_GET['fileName'];
						 
						 $qry="select * from policy where clientId='$clientId' AND policyName='$fileName'";
						 $res=mysql_query($qry) or die(mysql_error());
						 $row=mysql_fetch_assoc($res);
						 ?>
						 <section>
							<div class="section-left-s">
								<label for="text_field">Policy Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtPolicyName" id="text_field" class="i-text required wid" readonly value="<?php echo $row['policyName']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Policy Purpose:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtpolicyPurpose" id="text_field" class="i-text required wid" readonly value="<?php echo $row['policyType']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">View Policy:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<a href="pdf/<?php echo $email."/Policy/".$row['fileName']; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='See Policy'></a>
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Renewal For:</label>
							</div>
							<div class="radio section-right">  
								<input id="male" type="radio" name="txtRenewDate" value="12" checked>  
								<label for="male" class="lblchk">1 Year</label>  
								<input id="female" type="radio" name="txtRenewDate" value="9">  
								<label for="female" class="lblchk">9 Month</label> 
								<input id="lmale" type="radio" name="txtRenewDate" value="6">  
								<label for="lmale" class="lblchk">6 Month</label>  
								<input id="lfemale" type="radio" name="txtRenewDate" value="3">  
								<label for="lfemale" class="lblchk">3 Month</label>  
							</div>
							
							<div class="clearfix"></div>
						</section>
						
						<section>
							<input name="submit" id="" class="i-button no-margin" value="Done" type="submit">
								<a href="todayRenewal.php"><input class="icon-16 button" type='button' name="updateaccess" value='Back'></a>
						</section>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

</BODY>
</html>
<?php
			}
			else
			{
				header("Location:todayRenewal.php");
			}
	}
	else
	{
			header("location:newCustomer.php");
	}
	
?>
