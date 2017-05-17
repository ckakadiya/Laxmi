<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="patient";
		$menu="patient_all";
	include_once("connect.php");
	include_once("global.php");
	include_once("function.php");
	 $fdir = $_SERVER['PHP_SELF'];
	
	//echo $fdir;
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
<?php include_once("patient_menu.php"); ?>
	<div class="bit-14">
		<div class="box-element">
        	<div class="box-head-light"><span class="typography-16"></span><h3>Show All Patient</h3></div>	
			
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
                    <section class="no-padding">
					<div class="lists">
						<ul class="datalist">
								<li><div><a href="show_patient_alpha_wise.php?sort=%" class="active">All</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=A%">A</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=B%">B</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=C%">C</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=D%">D</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=E%">E</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=F%">F</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=G%">G</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=H%">H</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=I%">I</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=J%">J</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=K%">K</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=L%">L</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=M%">M</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=N%">N</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=O%">O</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=P%">P</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=Q%">Q</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=R%">R</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=S%">S</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=T%">T</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=U%">U</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=V%">V</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=W%">W</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=X%">X</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=Y%">Y</a></div></li>
							<li><div><a href="show_patient_alpha_wise.php?sort=Z%">Z</a></div></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</section>
						
                <?php
				$arr_patient=array();
				$arr_patient['cid']=$_SESSION['cid'];
				if(isset($_GET['sort']))
				{
					$arr_patient['sort']=$_GET['sort'];
					$sel_res=selPatientAlphaWise($arr_patient);
					if(isset($sel_res['id']))
					{
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
					
					
					?>
                    <table class="i-table fullwidth">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>DOB</td>
                            <td>Gender</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td><div class="clearfix"></div></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					for($i=$start;$i<$end;$i++)
					{
					?>
           				<tr>
                        	<td title='<?php echo $sel_res['name'][$i];?>'>
							<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['name'][$i])){echo compressDetail($sel_res['name'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
                            </td>
							<td>
                                <?php if(isset($sel_res['dob'][$i])){echo $sel_res['dob'][$i];}else{echo "-----";}?>
                            </td>
                            <td>
                              	<?php if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                            </td>
                            <td>
								<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
							</td>
							<td>
								<span class="red"><?php if(isset($sel_res['phone'][$i])){echo $sel_res['phone'][$i];}else{echo "-----";}?></span>
							</td>
							<td>
									<!--<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
							</td>
							</tr>
							<?php
								}
  		                    ?>
                            
                            </tbody>
                            </table>
                    <section>
							<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
							<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
								<!--<span id="datatable_first" class="first paginate_button paginate_button_disabled">First</span>-->
								
									
                                    <?php page_strip_submit($page,$fdir,$pager,"sort",$_GET['sort']);?>
										
								

								<!--<span id="datatable_last" class="last paginate_button">Last</span>-->
							</div>
							<div class="clearfix"></div>
						</section>
                    <?php
                                }
                                else
                                {
									?>
                                    
                                    <section class="no-padding">
							<section>
                                <div class="alert-msg info-msg" align="center">No Patient Exist</div>
                            </section>
                                <div class="clearfix"></div>
                            </section>
                        <?php
                                }
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