 <?php
	include_once "function.php";
	ins_cmp($_POST);
?>

			<form method="POST" action="">
				<table id="tbl">
					<caption><h3>Medicine Information</h3></caption>
					<TR>
						<TD>Medicine_name</TD>
						<td colspan="4" id="mname1" ><input type="text" required="required" name="txtmname"  id="mname" /></td>
					</TR>
					<TR>
						<TD>Description</TD>
						<td colspan="4"  id="mdesc" ><textarea required="required"  name="txtdesc"  cols="25"  id="mdesc1"  rows="4"></textarea></td>
					</TR>
					<TR>
						<TD>Company_name</TD>
						<td colspan="4" id="cname1">
							<?php
								$result=sel_cmp_name();
							?>
							<input list="cname" id="c1" name="txtcname" value="<?php echo $_POST['cmpname']; ?>" />
							<datalist id="cname">
								
								<?php
									$cnt=0;
									while($cnt < count($result['id']))
									{
										$res=$result['cname'][$cnt];
										if($res == $_POST['cmpname'])	
										{
											$cnt++;
											continue;
										}	
										echo "<option value='$res'>".$res."</option>";
										$cnt++;
									}
								?>
								<option id="other" class="cmp"  value="other">other</option>						
							</datalist>
						</td>
					</TR>
					<tr>
						<TD colspan="4" align="center"><input type="submit" value="Next" name="btnsubmit" id="btnsub"/></TD>
						
					</tr>			
				</table>
				</form>
			<div id="main" class="main"></div>
			<div class="box" id="box">
				<from name="cmpf1">
					<table>
						<h3 align="center">Company Registration Form</h3>
						<TR>
							<TD>Company Name</TD>
							<TD><input type="text" name="txtcmpname" id="cmpname" required="required"/></TD>
						</TR>
						<TR>
							<TD>Email</TD>
							<TD><input type="email" name="txtcmpemail" id="cmpemail" required="required"/></TD>
						</TR>
						<TR>
							<TD>Phone_no</TD>
							<TD><input type="text" name="txtcmpphno" id="cmpphno" required="required"/></TD>
						</TR>	
						<TR>
							<TD>Address</TD>
							<TD><textarea name="txtcmpadd" id="cmpadd" required="required" cols="25" rows="3"></textarea></TD>
						</TR>	
						<tr>
							<TD ><input type="submit" id="cmpsub" /></TD>
						</tr>
					</table>
					<div id="close">close</div>
				
			</div>
			</table>	
			</form>
	
