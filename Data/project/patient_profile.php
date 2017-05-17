<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
	$str="patient";
	$menu="patient_profile";
	include_once("connect.php");
	include_once("global.php");
	include_once("function.php");
	 $fdir = $_SERVER['PHP_SELF'];
	 
	
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
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("patient_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
        	
			<div class="box-head-light"><span class="file-16"></span><h3>Patient Profile</h3></div>
			<div class="box-content no-padding">
				<?php
				$sel_res=selPatient();
				if(isset($sel_res['id']))
				{
				?>
                <table class="i-table fullwidth">
				<thead>
					<tr>
						<td>Name</td>
						
						<td>Gender</td>
						<td>Email</td>
						
						<td>Phone</td>
						<td><div class="clearfix"></div></td>
						
					</tr>
				</thead>
				
					<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
						
				
						
                        <?php
			
			//print_r($sel_res);
				include_once('paging.php');
				if(!isset($_GET['p']))
				{
					 $page=1;
				}
				else
				{
					$page = $_GET['p'];
				}
				 
	
				$lan=count($sel_res['id']);	
				$pager=pagedata($GLOBALS['no_row'],$lan,$page);
				//print_r($pager);
				
			$start=$pager['offset'];
					$end=$pager['limit'];
					if($end>$lan)
					{
						$end=$lan;
					}
					
					for($i=$start;$i<$end;$i++)
					{
					?>
           
                        <section class="no-padding">
							<tr>
								<td title='<?php echo $sel_res['name'][$i];?>'>
									<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['name'][$i])){echo compressDetail($sel_res['name'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
								
                                
                                <td>
                                	<?php if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </td>
								<td>
									<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</td>
								<td>
									<span class="red"><?php if(isset($sel_res['phone'][$i])){echo $sel_res['phone'][$i];}else{echo "-----";}?></span>
								</td>
								<td align="right">
									<!--<input class="icon16 edit-16" value="" type="button">
									<input class="icon16 cancel-16" value="" type="button">-->
								</td>
							</tr>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
								}
                                
                    ?>
		</table>
                    <section>
							<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								
								
									
                                    <?php page_strip($page,$fdir,$pager);?>
										
								

						
							</div>
							<div class="clearfix"></div>
						</section>
                    <?php
                                }
                                else
                                {
                                  
							echo "<div class='alert-msg info-msg' align='center'>No Patient Exist</div>";
                                }
                            ?>
                        </fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="../../Doctors helper with design/js/jquery.min.js" type="text/javascript"></script>
<script src="../../Doctors helper with design/js/multiselect.js" type="text/javascript"></script>
<script type="text/javascript"> 
	var config = {
	'.chzn-select'           : {},
	'.chzn-select-deselect'  : {allow_single_deselect:true},
	'.chzn-select-no-single' : {disable_search_threshold:10},
	'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
	'.chzn-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	$(selector).chosen(config[selector]);
	}
</script>
</BODY>
</html>

<?php
	}
	else
	{
			header("location:login.php");
	}
?>
