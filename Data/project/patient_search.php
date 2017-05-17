<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="patient";
		$menu="search";
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
<?php include_once("patient_menu.php"); ?>
	<div class="bit-14">
		<div class="box-element">

			<div class="box-head-light"><span class="file-16"></span><h3>Patient Profile</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							<div class="section-input"><input name="text" id="text_field" class="i-text required wid" type="text" placeholder="Name" required title="Please fill out this field"></div>
							
							<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:left;">
							<div class="clearfix"></div>
						</section>
						</fieldset>
				</form>
                        <?php
			
			
			
			//print_r($sel_res);
			if(isset($_POST['submit']))
			{
				include_once('paging.php');
				$sel_res=searchDataPatient($_POST,$_SESSION['cid']);
				//print_r($sel_res);	
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
					if(count($sel_res)>0)
					{
					?>
                    <table class="i-table fullwidth">
                    <thead>
                    <tr class="dark">

                        <td>Patient Name</td>
                        <td>Email</td>
                        <td>Phone No</td>
                        <td>Address</td>
                        
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php
					for($i=$start;$i<$end;$i++)
					{
					?>				
           				<tr>
                        	<td title='<?php echo $sel_res['user'][$i];?>'>
								<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
                            </td>
							
								<td>
									<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</td>
								<td>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</td>
                                <td>
									<a title='<?php echo $sel_res['address'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
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
								    <?php page_strip($page,$fdir,$pager);?>
															</div>
							<div class="clearfix"></div>
						</section>
                    <?php
      
								}
								else
								{
								?>
            	        			<section>
                                        <div class="alert-msg info-msg" align="center">Search Patient Not Found</div>
                                    </section>
                			    <?php
								}	  
	                      }
			                   
			
			
                            ?>
                        
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