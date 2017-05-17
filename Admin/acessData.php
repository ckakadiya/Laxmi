<?php
	session_start();
	if(isset($_SESSION['username']) && isset($_GET['txtemail']))
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
				<form method="post" action="newPolicy.php" class="i-validate" id="Appointment_reg"> 
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
						
						
						
						<!--    Start    -->
						
						
						<?php
						 $qry="select * from clients where emailId='$email'";
						 $res=mysql_query($qry) or die(mysql_error());
						 $row=mysql_fetch_assoc($res);
						 $clientId=$row['clientId'];
						 //$email=$row['emailId'];
						 
						 $qry="select * from policy where clientId='$clientId'";
						 $res=mysql_query($qry) or die(mysql_error());
						 if (mysql_num_rows($res)>0)
						 {
						 ?>
						 <section>
						 <table class="i-table fullwidth">
						<thead>
						<tr align="center">
							<td colspan="5">All Policy</td>
						</tr>
						 <tr align="center">
							<td>Policy Name</td>
							<td>Policy Purpose</td>
							<td>Expire Date</td>
							<td>View</td>
							<td>Delete</td>
						</tr>
						</thead>
						<tbody>
						 <?php
						 while ($row=mysql_fetch_assoc($res))
						 {
						 	echo "<tr align='center'>";
							echo "<td>".$row['policyName']."</td>";
							echo "<td>".$row['policyType']."</td>";
							$tmp=explode('-',$row['expireDate']);
							$date=$tmp[2]."/".$tmp[1]."/".$tmp[0];
							echo "<td>".$date."</td>";
						?>
							<td><a href="pdf/<?php echo $email."/Policy/".$row['fileName']; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='See Policy'></a></td>
							<td><a href="deletePolicy.php?txtemail=<?php echo $email; ?>&fileName=<?php echo $row['fileName']; ?>&policyName=<?php echo $row['policyName'];?>&name=allClients"><input class="icon-16 button" type='button' name="updateaccess" value='Delete Policy'></a></td></tr>
							<?php
						 }
						 }
						?>
						</tbody>
						</table>
						
						  <!-- End -->
						
							
						</section>
						
						<section>
							<div class="section-left-s">
								<a href="updateClientDetails.php?txtemail=<?php echo $email; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='Update Details'></a>
							</div>
							<div class="section-right">
								<div class="section-input">
								<input name="submit" id="" class="i-button no-margin" value="Add Policy" type="submit">
								</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
						<!--<section>
							<input name="submit" id="" class="i-button no-margin" value="Add Policy" type="submit">
							<div class="clearfix"></div>
						</section>-->
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
			header("location:allCustomer.php");
	}
	
?>
