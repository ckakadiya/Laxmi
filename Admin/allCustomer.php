<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		$menu="allCustomer";
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
			<div class="box-head-light"><span class="typography-16"></span><h3>Show All Records</h3></div>
			<div class="box-content no-padding">
			<section class="no-padding">
					<div class="lists">
						<ul class="datalist">
							<li><div><a href="show_clients_alpha_wise.php?sort=%" class="active">All</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=A%">A</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=B%">B</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=C%">C</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=D%">D</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=E%">E</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=F%">F</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=G%">G</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=H%">H</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=I%">I</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=J%">J</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=K%">K</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=L%">L</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=M%">M</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=N%">N</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=O%">O</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=P%">P</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=Q%">Q</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=R%">R</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=S%">S</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=T%">T</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=U%">U</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=V%">V</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=W%">W</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=X%">X</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=Y%">Y</a></div></li>
							<li><div><a href="show_clients_alpha_wise.php?sort=Z%">Z</a></div></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</section><br>
			<?php
			$qry="select * from clients order by clientid desc LIMIT ".$pageLimit." , ".$setLimit;
			$res=mysql_query($qry) or die(mysql_error());
			if (mysql_num_rows($res)>0)
			{
			?>
				<table class="i-table fullwidth">
				<thead>
				<tr align="center">
					<td>Client Name</td>
					<td>Mobile Number</td>
					<td>Email Id</td>
					<td>Total Policy</td>
					<td>Access</td>
					<td>Delete Client</td>
				</tr>
				</thead>
				<tbody>
					<?php		
						while($row=mysql_fetch_array($res))
						{
							echo "<tr align='center'>";
							echo "<td>".$row['firstName']." ".$row['middleName']." ".$row['lastName']."</td>";
							echo "<td>".$row['phoneNo']."</td>";
							echo "<td>".$row['emailId']."</td>";
							$qry1="select * from policy where clientId='".$row['clientId']."'";
							$res1=mysql_query($qry1) or die(mysql_error());
							$cnt=mysql_num_rows($res1);
							echo "<td>".$cnt."</td>";
						?>
							<td><a href="acessData.php?txtemail=<?php echo $row['emailId']; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='See Details'></a></td>
							<td><a href="deleteClient.php?txtemail=<?php echo $row['emailId']; ?>&clientId=<?php echo $row['clientId']; ?>" onClick="javascript: return confirm('Are You Sure To Delete This Client?');" ><input class="icon-16 button" type='button' name="updateaccess" value='Delete'></a></td></tr>
						<?php
						}	
					?>
				</tbody>
			</table>
			<?php 
			echo displayPaginationBelowAllCustomer($setLimit,$page);
			}
			else
			{
				echo "<div><span class='typography-14'></span><h3>There are no Any Clients.</h3></div>";
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
		header("location:index.php");
	}
?>
