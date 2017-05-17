<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$menu="allCustomer";
		$fdir = $_SERVER['PHP_SELF'];
	
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
				<form method="post" action="updateClient.php" class="i-validate" id="Appointment_reg" enctype="multipart/form-data"> 
					<fieldset>
						
						
						<section>
							<div class="section-left-s">
								<label for="text_field">First Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtfname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="First Name" value="<?php echo $row['firstName']; ?>">								
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
								<input name="txtmname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Middle Name" value="<?php echo $row['middleName']; ?>">
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
								<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name" value="<?php echo $row['lastName']; ?>">
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
								<input name="txtphone" id="text_field" class="i-text required wid" type="text" required pattern="[0-9]{10,11}" placeholder="Phone" value="<?php echo $row['phoneNo']; ?>">
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
								<input name="txtemail" id="text_field" class="i-text required wid" type="email" required readonly="readonly" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email ID" value="<?php echo $row['emailId']; ?>">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Aadhar Card:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="aadharCard" class="i-text required wid" type="file" accept="image/*">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Voting Card:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="votingCard" class="i-text required wid" type="file" accept="image/*">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Other Document:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="other" class="i-text required wid" type="file" accept="image/*">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<input type="hidden" name="aadhar" value="<?php $row['aadharCard']; ?>">
						<input type="hidden" name="voting" value="<?php $row['votingCard']; ?>">
						<input type="hidden" name="other" value="<?php $row['otherDoc']; ?>">
						
						<section>
							<div class="section-left-s">
								<input name="submit" id="" class="i-button no-margin" value="Update" type="submit">
							</div>
							<div class="section-right">
								<div class="section-input">
									<a href="acessData.php?txtemail=<?php echo $email; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='Back'></a>
								</div>
							</div>
							<div class="clearfix"></div>
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
			header("location:index.php");
	}
	
?>
