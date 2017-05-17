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
		
		if (isset($_POST['submit']) or isset($_GET['errors']))
		{
			if (isset($_GET['errors']))
			{
				echo "<div class='box-head-light'><span class='typography-16'></span><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_GET['errors']."</h3></div>";
				$email=$_GET['txtemail'];
			}
			else
			{
				$email=$_POST['txtemail'];
				$qry="select * from clients where emailId='".$email."'";
				$res=mysql_query($qry) or die(mysql_error());
				$row=mysql_fetch_assoc($res);
			}
		}
		else 
		{
			header("location:allCustomer.php");
		}
		
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="typography-16"></span><h3>Add Policy Details</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="addPolicy.php" class="i-validate" id="Appointment_reg"  enctype="multipart/form-data"> 
					<fieldset>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Policy Name:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtpolicyname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Plocy  Name">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Which Purpose:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtpurpose" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Which Purpose">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Policy Details:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<!--<input name="txtlname" id="text_field" class="i-text required wid" type="text" required pattern="[a-Z ]" placeholder="Last Name">-->
								<input name="pdffile" class="i-text required wid" type="file" required="required" accept="application/pdf">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<section>
							<div class="section-left-s">
								<label for="text_field">Expire Date:</label>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="txtdate"  class="i-text required wid" id="datepicker" type="text" required pattern="(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19|20)\d\d" placeholder="DD/MM/YYYY">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
									
								<input name="txtemail"  class="i-text required wid" type="hidden" value="<?php echo $email; ?>">
							
						<section>
							<input name="submit" id="" class="i-button no-margin" value="Add" type="submit">
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
			header("location:newCustomer.php");
	}
	
?>
