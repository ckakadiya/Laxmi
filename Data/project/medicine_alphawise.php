<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="medicine";
		$menu="all_medicine";
		include_once("global.php");
		include_once("function.php");
		include_once('paging.php');
		$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		echo $cid; 	
		$alpha="%";
		if(isset($_GET['sort']))
		{
			$alpha=$_GET['sort'];
		}
	
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
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jq.js" type="text/javascript"></script>
<script>
/*$(document).ready(function(){
		$(".delete-click").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'block');
			$("#deletefade").css('display', 'block');
		});
		$("#deleteclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'none');
			$("#deletefade").css('display', 'none');
		});
		if($('#editlight').text()!="")
		{
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
	function confirmSubmit()
		{
			var agree=confirm("Are you sure you wish to Delete this Entry?");
			if (agree)
				return true ;
			else
				return false ;
		}*/
</SCRIPT>

</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "medicine_menu.php";
	?>
	<?php 
		if(isset($_REQUEST['op']) && $_REQUEST['op']=="delete")
		{
			$meid=$_REQUEST['meid'];
			//echo $mrid;
			$res_del=del_medicine($meid);	
		}
	?>
			
	
	<div class="bit-14">
		<div class="box-element">
        	<div class="box-head-light"><span class="typography-16"></span><h3>Show All Medicine</h3></div>	
			
			<div class="box-content no-padding">
				<form novalidate method="post" action="" class="i-validate"> 
					<fieldset>
                    <section class="no-padding">
					<div class="lists">
						<ul class="datalist" style="height:40px"> 
									<li><div><a href="medicine_alphawise.php?sort=%" class="active">All</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=A%">A</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=B%">B</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=C%">C</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=D%">D</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=E%">E</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=F%">F</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=G%">G</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=H%">H</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=I%">I</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=J%">J</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=K%">K</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=L%">L</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=M%">M</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=N%">N</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=O%">O</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=P%">P</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Q%">Q</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=R%">R</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=S%">S</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=T%">T</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=U%">U</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=V%">V</a></div></li>
							<li><div><a href="mr_reg_alphawise.php?sort=W%">W</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=X%">X</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Y%">Y</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Z%">Z</a></div></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</section>
				
                        <?php
				
			$result=sel_medicine_alphawise($cid,$alpha);
			
			if(count($result)>0)
			{
				?>
                <section class="no-padding">
					<div class="lists " style="padding-top:5px; height:50px; font-weight:bold; background-color: #f4f4f4;">
						<ul class="list">			
							<li>Medicine name</li>
							<li>View Detail</li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
				</section>
               <?php
			}
			//print_r($result);	
			//print_r($sel_res);
			if(isset($result['id']))
			{
				if(!isset($_GET['p']))
				{
					 $page=1;
				}
				else
				{
					$page = $_GET['p'];
				}
				 
	
				$lan=count($result['id']);
				$pager=pagedata($GLOBALS['no_row'],$lan,$page);
				//print_r($pager);
				
			$start=$pager['offset'];
					$end=$pager['limit'];
					if($end>$lan)
					{
						$end=$lan;
					}
					
					for($i=$start; $i<$end; $i++)
					{
					?>
           
                        <section class="no-padding">
			<ul class="list">
				<li><input type="hidden"  value="<?php if(isset($result['id'][$i])){ echo $result['id'][$i];}?>" name="txtmeid" id="<?php  echo $result['id'][$i]; ?>"/></li>
				<li>
                                	<?php if(isset($result['medicine_name'][$i])){echo $result['medicine_name'][$i];}else{echo "-----";}?>
                                </li>
                       		<li>
                                	<a href='medicine_detail.php?id=<?php echo $result['id'][$i];?>'>view</a>
                                </li>
                             		<div class="l-float edit-click" id="<?php echo $i; ?>"><a  href="med_update.php?meid=<?php echo $result['id'][$i];?>" class="icon16 edit-16" id="<?php echo $i; ?>" type="button"></a></div>
					<!--<div class="l-float delete-click" id="<?php echo $i; ?>"><a href="mr_del.php?id=<?php echo $result['id'][$i];?>" class="icon16 cancel-16" type="button" id="<?php echo $i; ?>"></a></div>--->
						<div class="l-float"><a  onclick='return confirmSubmit()' href='allmedicine.php?op=delete&meid=<?php echo $result['id'][$i]; ?>'>
								<input class="icon16 cancel-16" value="" type="button">
						</a></div>
				</li>
			</ul>
			<div class="clearfix"></div>
		</section>
			<?php
				}
			?>
                <section>
		<!--<div id="datatable_info" class="dataTables_info">Showing 1 to 10 of 57 entries</div>-->
		<div id="datatable_paginate" class="dataTables_paginate paging_full_numbers no-padding">
			<!--<span id="datatable_first" class="first paginate_button paginate_button_disabled">First</span>-->
		        <?php page_strip($page,$fdir,$pager);?>
<!--			<span id="datatable_last" class="last paginate_button">Last</span>-->
		</div>
		<div class="clearfix"></div>
		</section>
                <?php
                }
                else
	        {
		?>
     		<section>
		<div class="alert-msg info-msg" align="center">Search Data Not Found</div>
		</section>
                <?php
                }
                ?>
                </fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="deletelight" class="bright_content-delete">
<div class="box-content no-padding">
	<form novalidate method="post" action="" class="i-validate"> 
	<fieldset>
			<section class="no-padding">
				<ul class="list">
					<li class=" wid-auto">
						<span class="red">Are you sure, you want delete?</span>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto">
						<div class="r-float"><input class="button" value="Yes" id="btndelete" type="button"></div>
						<div class="r-float" id="deleteclose"><input class="button" value="No"  type="button"></div>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
		</fieldset>
	</form>
</div>
</div>
<div id="deletefade" class="dark_overlay"></div>
<?php
	
	if( isset($_REQUEST['op']) && $_REQUEST['op']=="update")
	{
		$id=$_REQUEST['meid'];
		//echo "$no";
?>

<div id="editlight" class="bright_content">
<?php
	//$id=4;
	$result=selmedicine($id);
	if($result['status'] == 0)
	{
?>
<div class="box-content no-padding">
	<form novalidate method="post" action="visit_doctor_updateproc.php" class="i-validate"> 
		<fieldset>
			<input hidden="hidden" type="text" name="txtid" value="<?php echo $result['id']; ?>"/>
                    	<section>
				<div class="section-left-s">
					<label for="text_field">Name</label>
				</div>
				<div class="section-right">
					<div class="section-input">
                        	        <input name="txtname" value="<?php echo $result['mr_name']; ?>" placeholder="Enter Name" required class="i-text" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
                        <?php 	
				//echo $result['gender'];
				if($result['gender'] == "male")
				{
			?>
                        <section>
                              <div class="section-left-s">
                        	      <label for="textarea">Gender</label>
                              </div>
                              <div class="radio section-right">  
                         	      <input id="male" type="radio" name="txtgender" value="male" checked>  
                                      <label for="male" class="lblchk">Male</label>  
                                      <input id="female" type="radio" name="txtgender" value="female">  
                                      <label for="female" class="lblchk">Female</label>  
                              </div> 
                              <div class="clearfix"></div>
                      </section>
                      <?php
				}
				else
				{
		      ?>
		      <section>
                              <div class="section-left-s">
                      		        <label for="textarea">Gender</label>
                              </div>
                              <div class="radio section-right">  
                                        <input id="male" type="radio" name="txtgender" value="male">  
                                        <label for="male" class="lblchk">Male</label>  
                                        <input id="female" type="radio" name="txtgender" value="female"  checked>  
                                        <label for="female" class="lblchk">Female</label>  
                              </div> 
                              <div class="clearfix"></div>
                     </section>
	             <?php
				}
		     ?>
                     <section>
			     <div class="section-left-s">
					<label for="text_field">Phone</label>
	                     </div>
			     <div class="section-right">
					<div class="section-input">
                                	<input type="text" name="txtphone_no"  placeholder="Enter Phone_no" required value="<?php echo $result['phno']; ?>" class="i-text" type="text"/></div>
			     </div>
			     <div class="clearfix"></div>
	            </section>
		    <section>
				<div class="section-left-s">
								<label for="text_field">Email ID</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input type="email" name="txtemail"placeholder="Enter Email_address"  value="<?php echo $result['email']; ?>" required class="i-text">
                               	</div>
							</div>
							<div class="clearfix"></div>
						</section>
						
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" name="btnsubmit" id="btnupdate" value="update" type="button"></div>
						<div class="r-float" id="editclose"><input class="button" value="Cancel" type="button"></div>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
		</fieldset>
	</form>
	<?php
}}
?>

</div>
</div>
<div id="editfade" class="dark_overlay"></div>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/multiselect.js" type="text/javascript"></script>
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
		header("location: login.php");
	}
?>
