<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$menu="newCustomer";
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
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
</HEAD>
<BODY>
<?php include_once("heading.php");?>
<div id="container">
	<?php 
		include_once("connect.php");
		include_once("admin_menu.php");
		include_once("Function.php");
		
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>New Customer</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="addCustomer.php" class="i-validate" id="Appointment_reg" enctype="multipart/form-data"> 
					<fieldset>
						
						
						<section>
							<div class="section-left-s">
								<label for="text_field">First Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtfname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="First Name">
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
								<input name="txtmname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Middle Name">
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
								<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name">
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
								<input name="txtphone" id="text_field" class="i-text required wid" type="text" required pattern="[0-9]{10,11}" placeholder="Phone">
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
								<input name="txtemail" id="text_field" class="i-text required wid" type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email ID">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="textarea">Gender</label>
							</div>
							<div class="radio section-right">  
								<input id="male" type="radio" name="gender" value="male" checked>  
								<label for="male" class="lblchk">Male</label>  
								<input id="female" type="radio" name="gender" value="female">  
								<label for="female" class="lblchk">Female</label>  
							</div> 
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Aadhar Card:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<!--<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name">-->
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
								<!--<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name">-->
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
								<!--<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name">-->
								<input name="other" class="i-text required wid" type="file" accept="image/*">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit">
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