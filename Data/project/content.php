<?php
	session_start();
	include_once "function.php";
	
	$meid=$_SESSION['meid'];
	echo $meid;
?>
<html>
	<head><title></title>
		<SCRIPT type="text/javascript" src="js/jquery.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="js/medicine.js"></SCRIPT>
		<link href="css/style.css" rel="StyleSheet"></link>
	
	</head>
	<body>
		<form name="f1" action="content_proc.php" method="POST">
		<table border=2  align="center">
			<tr>
				<th> Content_name</th>
				<th> Description </th>
				<th> Quantity </th>
			</TR>
			<TR>
				<td id="con_name1" >
					<?php
						$result=sel_content_name();
					?>
					<input type="text" list="con_name" name="txtconame" id="cn1" />
					<datalist id="con_name">
					<?php
						$cnt=0;
						while($cnt < count($result['id']))
						{
							$res=$result['con_name'][$cnt];
							echo "<option value='$res'>".$res."</option>";
							$cnt++;
						}
					?>
					<option id="other1" >other</option>					
					</datalist>
				</td>
				<td><input type="text" name="txtdesc" id="condesc" /></td>
				<td><input type="text" name="txtqty" id="qty" /></td>
				<TD><input type="text" hidden="hidden" name="txtmeid" value="<?php echo $meid; ?>"  /></TD>
			</TR>
			

			<tr>
				<td align="center" colspan="4"><input type="submit" name="btnsubmit"/></td>
			</tr>
		</table>
		</form>			
		<table border='1' id="tbl" align="center">
		<caption><b><h3>Content information</h3></b></caption>
			<tr>
				<th>content_name</th>
				<th>description</th>
				<th>Quantity</th>
			</tr>
			<tr>
			<?php
				//$meid=$_GET['id'];
				//echo $meid;
				$result=sel_content($meid);
				//print_r($result);
				
				if($result['status'] == 0)
				{
					//echo "hii";
					$cnt=0;
					while($cnt < count($result)-1)
					{			
						//echo $cnt;				
						echo "<tr>";
						echo "<td>".$result[$cnt]['content_name']."</td>";
						echo "<td>".$result[$cnt]['description']."</td>";
						echo "<td>".$result[$cnt]['qty']."</td>";
						echo "</tr>";
						$cnt++;
					}
				}
				else
				{
					echo "jhjssno data available";
				}
				
			?>
			</tr>
		</table>
		
	</body>
</html>
