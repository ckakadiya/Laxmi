<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="mr";
		$menu="profile";
		include_once("global.php");
		include_once("function.php");
		include_once('paging.php');
		$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$mrid=0;
		if(isset($_GET['mrid']))
		{
			$mrid=$_GET['mrid'];
		}
		$mrinfo=selMr($mrid);
		//print_r($mrinfo);
	
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
	<script src="js/mr.js" type="text/javascript"></script>
</HEAD>

<BODY>
<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "mr_menu.php";
	?>


<div class="bit-14">
	<div class="box-element">
		<div class="box-head-light"><span class="file-16"></span><h3>MR</h3></div>
			<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin">MR Infornation</h4></section>
						<section class="no-padding" id="refmr">
							<ul class="list">
								<li>
									<?php	
										if ($mrinfo['status'] == 0)
										{
									?>
										<input type="hidden" name="txtmrid" " id="mrid" value="<?php echo $mrid;?>"/>			
								</li>
								
								<LI>
									<label for="text_field">Name</label>
								</LI>
								<li class="wid-auto" id="editmrname">
									<label for="text_field" class="red" id="mname" value="<?php echo $mrinfo['mr_name']; ?>"><?php echo $mrinfo['mr_name']; ?></label>									
								</li>
								<li id="heditmrname" hidden="hidden">
									<input style="width:130px;" type="text" id="hmname" value="<?php echo $mrinfo['mr_name']; ?>" />	
								</li> 
								<li></li>
							</ul>

							
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">Gender</label>
								</LI>
								<li class="wid-auto" id="editmrgender">
									<label for="text_field" class="red" id="mgender"><?php echo $mrinfo['gender']; ?></label>
								</li>
								<li id="heditmrgender" hidden>
									<?php 	
										//echo $mrinfo['gender'];
										if($mrinfo['gender'] == "Male")
										{ 
										?>
                        				            <!----<div class="radio " style="height: 40px; width: 200px;">  
                                     					   <input type="radio" name="txtgender" value="male" checked>  
					                                   <label for="gender" class="lblchk ">Male</label>  
                                        				   <input  style="padding-top:1px;" type="radio" name="txtgender" value="female">  
				                                           <label for="gender" class="lblchk">Female</label> 
										 
                                   				    </div> ---><select style="width:70px" id="gender">
											<option value="Male"  selected="selected">Male</option>
											<option value="Female">Female</option>
										</select>
                                   	                            <?php
									}
									else
									{
								    ?>
				                                  <!---- <div class="radio" style="height: 40px; width: 200px;">  
				                                           <input type="radio" name="txtgender" value="male">  
                                   				           <label for="male" class="lblchk ">Male</label>  
				                                           <input type="radio" name="txtgender" value="female"  checked>  
                                   					   <label for="female" class="lblchk">Female</label>  
                                    				    </div>--->
									<select style="width:70px" id="gender">
											<option value="Female" >Female</option>
											<option value="Male">Male</option>
									</select>

								    <?php
									}
								    ?>
                        
								</li> 
							
								<li></li>
							</ul>
							<div class="clearfix"></div>
							
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float"><input class="icon16 edit-16 mr" value="" id="edit" type="button"><input  value="save" id="save" type="button" hidden>

									</div>
									
									<div class="r-float"><input  value="cancel" type="button" id="cancel" hidden></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
						<section><h4 class="no-margin">MR_Email</h4></section>
						<section class="no-padding" id="refemail">
							<?php
								$size=0;
								$j=1;
								while($size < count($mrinfo['email']))
								{
								?>
							<ul class="list" id="<?php echo 'mailrow_'.$j; ?>">
								
								<li id="<?php echo 'mailcol_'.$j;?>" style=" width: 170px;"><?php echo $mrinfo['email'][$size]; ?></li>
								<li class="email" style=" padding-left:0px; width: 30px;" id="<?php echo 'editmail_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="email" style="padding-left:0px; width: 30px;" id="<?php echo 'delmail_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>						
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hmailrow_'.$j;?>" hidden="hidden">
								<input type="hidden" size="2" id="<?php echo 'heid_'.$j;?>" name="heid" value="<?php echo $mrinfo['eid'][$size]; ?>" />
								<li  id="<?php echo 'editmail_'.$j; ?>" style="width:150px;">
									<input  type="email" id="<?php echo 'hmail_'.$j; ?>" name="h_mail" value="<?php echo $mrinfo['email'][$size]; ?>" />	
								</li>
								<li style=" width:40px;" id="<?php echo 'save_'.$j;?>" class="email">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="email">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
								<?php
									$size++;
									$j++;
								}
								?>
								
								<ul class="list" id="newemail">
								</ul>
								<ul class="list" id="mailbox">
									
									<li colspan="3" align="center" style="width:100%;"><a style="padding-left:60px;" href="javascript:void(0);" class="icon16-button forms-16" id="nemail" name="nemail">Add more Email</a></li>
									<li><div class="clearfix"></div></li>
								</ul>
							
							
					</section>
				<section><h4 class="no-margin">MR Phone_no</h4></section>
				<section class="no-padding" id="refphno">
						<?php
						$size=0;
						$j=1;
						while($size < count($mrinfo['phno']))
						{
						?>	
							<ul class="list" id="<?php echo 'phnorow_'.$j; ?>">
								
								<li id="<?php echo 'phnocol_'.$j;?>" style=" width: 170px;"><?php echo $mrinfo['phno'][$size]; ?></li>
								<li class="phno" style=" padding-left:0px; width: 30px;" id="<?php echo 'editphno_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="phno" style="padding-left:0px; width: 30px;" id="<?php echo 'delphno_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>						
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hphnorow_'.$j;?>" hidden="hidden">
								<input  type="hidden" size="2" id="<?php echo 'hcid_'.$j;?>" name="hcid" value="<?php echo $mrinfo['cid'][$size]; ?>" />
								<li style="width:150px;" id="<?php echo 'editphno_'.$j; ?>">
									<input style="width:100px;" type="text" id="<?php echo 'hphno_'.$j; ?>" name="h_phno" value="<?php echo $mrinfo['phno'][$size]; ?>" />
								</li>
								<li style=" width:30px;" id="<?php echo 'save_'.$j;?>" class="phno">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="phno">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>	
							</ul>
							<?php
								$size++;
								$j++;
							}
							?>
							<ul class="list" id="newphno">
							</ul>
							<ul class="list" id="phnobox">
								<li colspan="3" align="center" style="width:100%;" >
									<label><a href="javascript:void(0);" class="icon16-button forms-16" style="padding-left:60px;" id="nphno" name="nphno">Add more Phone_no</a></label>			
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
				<?php
				}
				?>
				
							
					</section>		
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

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

