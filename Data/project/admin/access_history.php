<?php
	session_start();
	if(isset($_SESSION['adminid']))
	{
	
	
	$menu="access_history";
	$fdir = $_SERVER['PHP_SELF'];
	include_once("function.php");

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
			<div class="box-head-light"><span class="typography-16"></span><h3>Clini Access History</h3></div>
			<div class="box-content no-padding">
				<table class="i-table fullwidth">
				<thead>
				<tr align="center">
					<td>Clinic Name</td>
					<td>Address</td>
					<td>Date</td>
					<td>Phone No</td>
					
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
							echo "<td><a href='access_detail.php?cid=".$clinic['cid'][$i]."'>".$clinic['cname'][$i]."</a></td>";
							echo "<td title='".trim($clinic['address'][$i])."'>".compressDetail(trim($clinic['address'][$i]),25)."</td>";
							echo "<td>".showDate($clinic['date'][$i])."</td>";
							echo "<td>".$clinic['phno'][$i]."</td>";
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