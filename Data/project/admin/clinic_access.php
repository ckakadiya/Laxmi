<?php
	session_start();
	if(isset($_SESSION['adminid']))
	{
	
	
	$menu="clinic_access";
	$fdir = $_SERVER['PHP_SELF'];
	include_once("function.php");
	
	if(isset($_POST['upd_status']))
	{	
		$arr_login=array();
		
		if(isset($_POST['txtstatus']) && $_POST['txtstatus']==0)
		{
			$arr_login['status']=1;
		}
		elseif(isset($_POST['txtstatus']) && $_POST['txtstatus']==1)
		{
			$arr_login['status']=0;
		}
			$arr_login['lid']=$_REQUEST['txtlid'];
			$arr_login['reasion']=$_REQUEST['txtreasion'];
			$res=updateStatus($arr_login);
			
	}
?>
<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Docters Helper</TITLE>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<SCRIPT  type="text/javascript">
	$(document).ready(function(){
		
		if($('#editlight').text()!="")
		{
			//alert($('#editlight').text());
			
			$("#editlight").css('display', 'block');
			$("#editfade").css('display', 'block');
		}

		$("#editclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#editlight").css('display', 'none');
			$("#editfade").css('display', 'none');
		});
		
	});
	</script>
    </HEAD>

<BODY>
<?php include_once("heading.php");?>
<div id="container">
	<?php 
		include_once("connect.php");
		include_once("admin_menu.php");
		include_once("function.php");
		include_once("paging.php");
		include_once("global.php");
		$clinic=clinicAccess();
		//print_r($clinic);
		
	?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="typography-16"></span><h3>Show All Appoinment</h3></div>
			<div class="box-content no-padding">
				<table class="i-table fullwidth">
				<thead>
				<tr align="center">
					<td>Clinic Name</td>
					<td>Address</td>
					<td>Date</td>
					<td>Phone No</td>
					<td>Operation</td>
				</tr>
				</thead>
				<tbody>
					<?php
						if(!isset($_GET['p']))
						{
							 $page=1;
						}
						else
						{
							$page = $_GET['p'];
						}
						$lan=count($clinic['cid']);
						$pager=pagedata($GLOBALS['no_row'],$lan,$page);
						$start=$pager['offset'];
						$end=$pager['limit'];
						if($end>$lan)
						{
							$end=$lan;
						}
					
						for($i=$start;$i<$end;$i++)
						{
							
							echo "<tr align='center'>";
							echo "<td>".$clinic['cname'][$i]."</td>";
							echo "<td title='".trim($clinic['address'][$i])."'>".compressDetail(trim($clinic['address'][$i]),25)."</td>";
							echo "<td>".showDate($clinic['date'][$i])."</td>";
							echo "<td>".$clinic['phno'][$i]."</td>";
						?>
							<td><a href="clinic_access.php?op=upd&status=<?php echo $clinic['status'][$i]; ?>&lid=<?php echo $clinic['lid'][$i]; ?>"><input class="icon-16 button" type='button' name="updateaccess" value='<?php if($clinic['status'][$i]==0){echo "Unblock";}else{echo "Block";} ?>'></a></td>
													<?php	
						}
					?>
				</tbody>
			</table>
						<section>
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
                                    <?php  page_strip($page,$fdir,$pager);?>
							</div>
							<div class="clearfix"></div>
						</section>
                        <?php
									if(isset($_POST['upd_status']))
									{
									if($res==1)
									{
							?>
										<section>
											<div class="alert-msg success-msg" align="center">Login Status Successfully Updated</div>
										</section>
							<?php
									}
									else
									{
									
							?>
										<section>
											<div class="alert-msg error-msg" align="center"><?php echo $res ;?></div>
										</section>
							<?php	
									}
									}
							?>
			</div>
		</div>
	</div>
    
</div>
<?php
if(isset($_REQUEST['op']) && $_REQUEST['op']=="upd")
{
	$status=$_REQUEST['status'];
	$lid=$_REQUEST['lid'];
?>		
<div id="editlight" class="bright_content">
<div class="box-content no-padding">
	<form  method="post" action="clinic_access.php" class="i-validate"> 
		<fieldset>
			<input type="hidden" value="<?php echo $status; ?>" name="txtstatus">
            <input type="hidden" value="<?php echo $lid; ?>" name="txtlid">
			<section>
				<div class="section-left-s">
					<label for="text_field">Reasion</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtreasion" class="i-text required" type="text" placeholder="Reasion" required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="upd_status"></div>
						<div class="r-float" id="editclose"><a href="clinic_access.php"><input class="button" value="Cancel" type="button" required></a></div>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
		</fieldset>
	</form>
<?php
	}
?>	
</div>
</div>
<div id="editfade" class="dark_overlay"></div>
</BODY>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>