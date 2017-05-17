<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="visit_doctor";
		$menu="all_vd";
		include_once("global.php");
		include_once("function.php");
		include_once("paging.php");
	 	$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		//echo $cid;
	 
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
<script src="js/form.js" type="text/javascript"></script>
<SCRIPT>
	/*$(document).ready(function(){
		$(".delete-click").click(function(){
			//alert($(".delete-click").html());
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			alert("dffd");
			alert($(this).attr("id"));
			$("#deletelight").css('display', 'block');
			$("#deletefade").css('display', 'block');
		});
		$("#deleteclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'none');
			$("#deletefade").css('display', 'none');
		});
		$(".edit-click").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			var c=$(this).attr("id");
			alert(c);
			alert($("#vdid_"+c).val());
			$("#editlight").css('display', 'block');
			$("#editfade").css('display', 'block');
		});
		$("#editclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#editlight").css('display', 'none');
			$("#editfade").css('display', 'none');
		});
	});*/
		function confirmSubmit()
		{
			var agree=confirm("Are you sure you wish to Delete this Entry?");
			if (agree)
				return true ;
			else
				return false ;
		}
	
</SCRIPT>

</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "vd_menu.php";
	?>
	<?php 
		if(isset($_REQUEST['op']) && $_REQUEST['op']=="delete")
		{
			$vdid=$_REQUEST['vdid'];
			//echo $mrid;
			$res_del=delVisitDoc($vdid);	
		}
	?>
		<div class="bit-14">
		<div class="box-element">
        	<div class="box-head-light"><span class="typography-16"></span><h3>Show All Visiting_Doctors</h3></div>	
			
			<div class="box-content no-padding">
				<form  method="post" action="" class="i-validate"> 
					<fieldset>
                    <section class="no-padding">
					<div class="lists"  style="height:40px">
						<ul class="datalist">
							<li><div><a href="visit_doc_alphawise.php?sort=%" class="active">All</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=A%">A</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=B%">B</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=C%">C</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=D%">D</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=E%">E</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=F%">F</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=G%">G</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=H%">H</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=I%">I</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=J%">J</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=K%">K</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=L%">L</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=M%">M</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=N%">N</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=O%">O</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=P%">P</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=Q%">Q</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=R%">R</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=S%">S</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=T%">T</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=U%">U</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=V%">V</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=W%">W</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=X%">X</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=Y%">Y</a></div></li>
							<li><div><a href="visit_doc_alphawise.php?sort=Z%">Z</a></div></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</section>
				<section class="no-padding">
					<div class="lists " style="padding-top:5px; height:50px; font-weight:bold; background-color: #f4f4f4;">
						<ul class="list">			
							<li>Name</li>
							<li>Speciality</li>
							<li style="width: 90px;">Start</li>
							<li style="width: 100px;">Till</li>
							<li style="width: 100px;">Day</li>
							<li>Email</li>
							<li>Phno</li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
				</section>
						
                        <?php
			
			$result=sel_visit_doc($cid);
			//print_r($result);
			if(isset($result['id']))
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
				<li><input type="text" hidden="hidden" value="<?php if(isset($result['id'][$i])){ echo $result['id'][$i];}?>" name="txtvid" id="<?php echo 'vdid_'.$i;?>"/></li>
				<LI title='<?php echo $result['doctor_name'][$i]; ?>'>
					<a href='visit_doc_profile.php?vdid=<?php echo $result['id'][$i];?>'>
					<?php if(isset($result['doctor_name'][$i])){echo compressDetail($result['doctor_name'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a></li>
				<li>
                                	<?php if(isset($result['speciality'][$i])){echo $result['speciality'][$i];}else{echo "-----";}?>
                                </li>
                                <li style="width: 90px;">
                                	<?php if(isset($result['start'][$i])){echo $result['start'][$i];}else{echo "-----";}?>
                                </li>
                                <li style="width: 100px;">
					<?php if(isset($result['till'][$i])){echo $result['till'][$i];}else{echo "-----";}?>				</li>
				<li style="width: 100px;">
					<?php if(isset($result['day'][$i])){echo $result['day'][$i];}else{echo "-----";}?>				</li>
				<li title="<?php echo $result['email'][$i];?>">
					<?php if(isset($result['email'][$i])){echo compressDetail($result['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>				</li>
				<li style="width: 100px;">
					<?php if(isset($result['phno'][$i])){echo $result['phno'][$i];}else{echo "-----";}?>				</li>


				<li>
					<div class="l-float edit-click" id="<?php echo $i; ?>"><a  href="visit_doc_up.php?vdid=<?php echo $result['id'][$i];?>" class="icon16 edit-16" id="<?php echo $i; ?>" type="button"></a></div>
					<!----<div class="l-float delete-click" id="<?php echo $i; ?>"><a href="visit_doc_delete.php?id=<?php echo $result['id'][$i];?>" class="icon16 cancel-16" type="button" id="<?php echo $i; ?>"></a></div>--->
					<div class="l-float"><a  onclick='return confirmSubmit()' href='visit_doctor.php?op=delete&vdid=<?php  echo $result['id'][$i]; ?>'>
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
			<!---<span id="datatable_first" class="first paginate_button paginate_button_disabled">First</span>-->
		        <?php page_strip($page,$fdir,$pager);?>
			<!----<span id="datatable_last" class="last paginate_button">Last</span>--->
		</div>
		<div class="clearfix"></div>
		</section>
                <?php
                }
                else
	        {
		?>
     		<section>
		<div class="alert-msg info-msg" align="center">No Visiting Doctor Exist</div>
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
	<form novalidate="novalidate" method="post" action="" class="i-validate"> 
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
<div id="editlight" class="bright_content">
<?php
	$id=4;
	$result=sel_visitdoc($id);
	if($result['status'] == 0)
	{
?>
<div class="box-content no-padding">
	<form novalidate="novalidate" method="post" action="visit_doctor_updateproc.php" class="i-validate"> 
		<fieldset>
			<section>
				<div><input name="txtname" value="<?php echo $result['id']; ?>" id="vdid"/></div>
				<div class="section-left-s">
					<label for="text_field">Name</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtdname" value="<?php echo $result['doctor_name']; ?>" id="docname"  class="i-text required" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="text_field">Speciality</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtspeciality" value="<?php echo $result['speciality']; ?>" id="speciality"  class="i-text required" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
					
			<section>
				<div class="section-left-s">
					<label for="text_field">Start</label>
				</div>
				<div class="section-right">
					
						<select class="chzn-single" style="width:340px;" tabindex="2"	 name="selstart" id="start" required>							
								<option><?php 
									if($result['start'] != "")
									{	
										$start=explode(" ",$result['start']);
				        					echo $start[0]; 
									}
									else
									{
										$result['start']="1:00:00 AM";
										$start=explode(" ",$result['start']);
				        					echo $start[0]; 
									}
								?></option>
										<?php
								$cnt=1;
								
								while($cnt <= 12)
								{
									if($cnt == $start[0])
									{
										$cnt++;
										continue;
									}
									$cnt1="$cnt:00:00";
									echo "<option value='$cnt1'>".$cnt1."</option>";
									$cnt++;
								}
							?>
					
						</select>
						<select class="chzn-single" style="width:340px;" tabindex="2" id="smed"  name="selsmed">
							<option><?php $start=explode(" ",$result['start']);
								      echo $start[1]; ?></option>
							<?php
								if($start[1] == AM)
								{
									echo "<option value='PM'>PM</option>";
								}
								else
								{
									echo "<option value='AM'>AM</option>";
								}
							?>
									

						</select>
				</div>
				
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Till</label>
				</div>
				<div class="section-right">
					<select class="chzn-single" style="width:340px;" tabindex="2" name="seltill" id="till" required>				
						<option><?php
									if($result['till'] != "")
									{	
										$till=explode(" ",$result['till']);
				        					echo $till[0]; 
									}
									else
									{
										$result['till']="1:00:00 AM";
										$till=explode(" ",$result['till']);
				        					echo $till[0]; 
									}
								?></option>

							<?php
								$cnt=1;
								while($cnt <= 12)
								{
									if($cnt == $till[0])
									{
										$cnt++;
										continue;
									}
									
									$cnt1="$cnt:00:00";
									echo "<option value='$cnt1'>".$cnt1."</option>";
									$cnt++;
								}
							?>
						</select>
						
						<select class="chzn-single" style="width:340px;" tabindex="2" id="tmed"  name="seltmed">
							<option><?php $till=explode(" ",$result['till']);
								      echo $till[1]; ?></option>
							<?php
								if($till[1] == AM)
								{
									echo "<option value='PM'>PM</option>";
								}
								else
								{
									echo "<option value='AM'>AM</option>";
								}
							?>
							
						</select>
				</div>
				
			</section>
					
			<section>
				<div class="section-left-s">
					<label for="text_field">Day</label>
				</div>
				<div class="section-right">
					<select class="chzn-single" style="width:340px;" tabindex="2"	 name="selday" id="day" required>				
							<?php 
								$day[0]="Monday";
								$day[1]="Tuesday";
								$day[2]="Wednesday";
								$day[3]="Thursday";
								$day[4]="Friday";
								$day[5]="Saturday";
								$day[6]="Sunday";	
								$cnt=0;
								if($result['day'] != "")
								{
									echo "<option>".$result['day']."</option>";
								}
								else
								{		
									$result['day']="Monday";
									echo "<option>".$result['day']."</option>";
								}
								while($cnt < count($day))
								{
									if($result['day'] == $day[$cnt])
									{
										$cnt++;
										continue;
									}
									echo "<option>".$day[$cnt]."</option>";	
									$cnt++;
								}						
							?>.			
						
					</select>
				</div>
				
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="text_field">Phone</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input value="<?php echo $result['phno']; ?>" name="txtphno" id="phno" class="i-text required" type="text"></div>
				</div>
				<div class="clearfix"></div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="text_field">Email ID</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input value="<?php echo $result['email']; ?>" name="txtemail" id="email" class="i-text required" type="text"></div>
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
}
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
