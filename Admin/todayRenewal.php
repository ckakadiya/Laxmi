<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$menu="todayRenewal";
		$fdir = $_SERVER['PHP_SELF'];
		
		if(isset($_GET["page"]))
		$page = (int)$_GET["page"];
		else
		$page = 1;
	
		$setLimit = 4;
		$pageLimit = ($page * $setLimit) - $setLimit;
	
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
	<LINK type="text/css" href="css/pagging.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
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
			<div class="box-head-light"><span class="typography-16"></span><h3>Today's Renewal Policy</h3></div>
			<div class="box-content no-padding">
			<?php
				$date=date('Y-m-d');
						
				$qry="select * from policy where expireDate='$date' LIMIT ".$pageLimit." , ".$setLimit;
				 $res=mysql_query($qry) or die(mysql_error());
				 $cnt=mysql_num_rows($res);
				 if ($cnt>0)
				 {
						 
			?>
				<table class="i-table fullwidth">
				<thead>
				<tr align="center">
					<td>Client Name</td>
					<td>Mobile Number</td>
					<td>Email Id</td>
					<td>Policy Name</td>
					<td>Re-New Policy</td>
					<td>Delete Policy</td>
				</tr>
				</thead>
				<tbody>
					<?php
						
						
						while($row=mysql_fetch_assoc($res))
						{	
							$clientId=$row['clientId'];
							$qry1="select * from clients where clientId='$clientId'";
 							 $res1=mysql_query($qry1) or die(mysql_error());			
							 $row1=mysql_fetch_assoc($res1);
							 
							echo "<tr align='center'>";
							echo "<td>".$row1['firstName']." ".$row1['middleName']." ".$row1['lastName']."</td>";
							echo "<td>".$row1['phoneNo']."</td>";
							echo "<td>".$row1['emailId']."</td>";
							echo "<td>".$row['policyName']."</td>";
							$email=$row1['emailId'];
						?>
							<td><a href="renewalPolicy.php?txtemail=<?php echo $email; ?>&fileName=<?php echo $row['policyName']; ?>&policyName=<?php echo $row['policyName']; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='Re-New Policy'></a></td>
							<td><a href="deletePolicy.php?txtemail=<?php echo $email; ?>&fileName=<?php echo $row['fileName']; ?>&policyName=<?php echo $row['policyName']; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='Delete Policy'></a></td></tr>
						<?php
						}
					?>
				</tbody>
			</table>
			<?php
				echo displayPaginationBelowToday($setLimit,$page);
				}
				else
				{
					echo "<div class='alert-msg info-msg' align='center'><b>There is No Re-Newal Policy For Today</b></div>";
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
			header("location:newCustomer.php");
	}
	
?>