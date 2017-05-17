<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		include_once("function.php");
		$str="appointment";
		$menu="app_reg";
		
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
<?php include_once("datepicker/dropdown-month-year.php");?>
</HEAD>
<BODY>

	<?php
	include_once("appointment_code.php");
	 include_once("header.php");?>
	<div id="container">
	<?php 
		include_once("app_menu.php");
		//$aid=countAppointment($_SESSION['cid'])+1;
		$aid=1;
	?>
	
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>Add New Customer</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="appointment_reg.php" class="i-validate" id="Appointment_reg"> 
					<fieldset>
						<section>
							<div class="section-left-s">
								<label for="text_field">Customer Id</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtappno" id="text_field" class="i-text required wid" type="text" value="<?php echo $aid++; ?>" readonly pattern="[0-9]" >
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Customer Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtpname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Customer Name">
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
								<input name="txtemail" id="text_field" class="i-text required wid" type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email Id">
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
							<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit">
							<div class="clearfix"></div>
						</section>
					</fieldset>
				</form>
				<?php
					if(isset($ins_Appointment['result']) && $ins_Appointment['result']==1)
					{
				?>
						<div class="alert-msg success-msg" align="center">Your Appointment is Sucsessfully Inserted</div>
				<?php
					}
					
					
				?>

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
			header("location:login.php");
	}
?>