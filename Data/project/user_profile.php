<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
	$str="user_profile";
	$menu="user";
	include_once("connect.php");
	include_once("function.php");
	
	if(isset($_SESSION['cid']))
	{
		//$refurl="location:user_profile.php";
		if(isset($_POST['save_detail']))
		{
			$user=array();
			$user['uname']=$_POST['txtuname'];
			$user['street']=$_POST['txtstreet'];
			$user['state']=$_POST['txtstate'];
			$user['city']=$_POST['txtcity'];
			$user['pin']=$_POST['txtpin'];
			$user['uid']=$_SESSION['uid'];

			//print_r($user);
			$msg = userUpdate($user);
			if($msg = 1)
			{
				//echo "Update sucsessfully";
			}
			else
			{
				echo $msg;
			}
		}
		if(isset($_REQUEST['op']) && $_REQUEST['op']=="del_email")
		{
			$id=$_REQUEST['id'];
			deleteEmail($id);
			//echo $id."suceess";
	
						
		}
		if(isset($_POST['edit_email']))
		{
			//print_r($_POST);
			updateEmail($_POST);
			//echo "suceess";
		}
		
		if(isset($_POST['save_email']))
		{
			$nemail=array();
			$nemail['email']=$_POST['txtemail'];
			$nemail['uid']=$_SESSION['uid'];
			insertEmail($nemail);
			//echo "suceess";
			
		}
		
		if(isset($_POST['save_phone']))
		{
			$ph=array();
			$ph['phno']=$_POST['txtphone'];
			$ph['uid']=$_SESSION['uid'];
			insertPhoneNo($ph);
			//echo "suceess";
			//header($refurl);
		}
		
			if(isset($_REQUEST['op']) && $_REQUEST['op']=="del_phone")
		{
			$id=$_REQUEST['id'];
			deletePhoneNo($id);
			//echo $id."suceess";			
			//header($refurl);
		}
		
		if(isset($_POST['edit_phone']))
		{
			updatePhoneNo($_POST);
			//echo "suceess";
		}
		$arr_user=array();
		$arr_user['uid']=$_SESSION['uid'];
		$res_user=selUser($arr_user);
		//print_r($res_user);
		

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
<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>
<SCRIPT  type="text/javascript">
	$(document).ready(function(){
		
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
		}
</SCRIPT>
</HEAD>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("user_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Doctor Profile</h3></div>
			<div class="box-content no-padding">
		
			<fieldset>
				<section><h4 class="no-margin">Personal Infornation</h4></section>
				<section class="no-padding">
					<ul class="list">
						<LI class="widd">
							<label for="text_field">User Name:</label>
						</LI>
						<li class="wid-auto">
							<label for="text_field" class="red"><?php echo $res_user['uname'];?></label>
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
					
					<ul class="list">
						<LI>
								<label for="text_field">Street Name:</label>
						</LI>
						<li class="wid-auto">
								<label for="text_field" class="red"><?php echo $res_user['street'];?></label>
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
					
					<ul class="list">
						<LI class="widd">
							<label for="text_field">Pincode:</label>
						</LI>
						<li class="wid-auto">
							<label for="text_field" class="red"><?php echo $res_user['pincode'];?></label>
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
					
					<ul class="list">
						<LI>
								<label for="text_field">City Name:</label>
						</LI>
						<li class="wid-auto">
								<label for="text_field" class="red"><?php echo $res_user['city'];?></label>
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
					
					<ul class="list">
						<LI>
								<label for="text_field">State Name:</label>
						</LI>
						<li class="wid-auto">
								<label for="text_field" class="red"><?php echo $res_user['state'];?></label>
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
					<ul class="list">
						<li class="wid-auto butt-margin">
							<div class="r-float">
							<a href="user_profile.php?op=edit_detail">
							<input class="icon16 edit-16" value="" type="button"></a></div>
							
						</li>
						<li></li>
					</ul>
					<div class="clearfix"></div>
				</section>
				<section><h4 class="no-margin">Email Infornation</h4></section>	
				<section class="no-padding">
				<?php
					$cnt=count($res_user['email']);
					if($cnt>0)
					{
						for($i=0;$i<$cnt;$i++)
						{
				?>
							<ul class="list">
								<LI>
									<label for="text_field">Email Id</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $res_user['email'][$i];?></label>
								</li>
								
								
								<li>
									<div class="l-float">
									<?php
									if($res_user['eid'][$i]==$_SESSION['eid'])
									{
										echo "Primary Email";	
									}
									else
									{
									?>
									
									<a href="user_profile.php?op=edit_email&id=<?php echo $i;?>">
									<input class="icon16 edit-16" value="" type="button">
									</a>
									</div>
									
									<div class="l-float">
									<a onclick="return confirmSubmit()" href="user_profile.php?op=del_email&id=<?php echo $res_user['eid'][$i];?>">
									
									<input class="icon16 cancel-16" value="" type="button">
									
									</a>
									<?php
									}
									?>
									</div>
								</li>
							</ul>
							<div class="clearfix"></div>

				<?php
						}
					}
					else
					{
						echo "No email";
					}
				?>
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float">
						<a href="user_profile.php?op=add_email">
						<input class="icon16-button forms-16" value="Add" type="button">
						</a>
						</div>
						</li>
						<li></li>
					</ul>
				<div class="clearfix"></div>
				</section>
				<section><h4 class="no-margin">Phone NO </h4></section>	
				<section class="no-padding">
				<?php
					$c=count($res_user['phone']);
					if($c>0)
					{
							for($i=0;$i<$c;$i++)
							{	
				?>
							<ul class="list">
								<LI>
									<label for="text_field">Phone No</label>
								</LI>
								<li class="wid-auto">
									<label for="text_field" class="red"><?php echo $res_user['phone'][$i];?></label>
								</li>
								<li>
									<div class="l-float"><a href="user_profile.php?op=edit_phone&id=<?php echo $i;?>">
									<input class="icon16 edit-16" value="" type="button"></a>
									</div>
									<div class="l-float">
									<a onclick="return confirmSubmit()" href="user_profile.php?op=del_phone&id=<?php echo $res_user['phid'][$i];?>">
									<input class="icon16 cancel-16" value="" type="button"></a>
									</div>
								</li>
							</ul>
							<div class="clearfix"></div>

				<?php
						}
					}
					else
					{
						echo "No phone no";
					}
				?>
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float">
						<a href="user_profile.php?op=add_phone">
						<input class="icon16-button forms-16" value="Add" type="button">
						</a>
						</li>
						<li></li>
					</ul>
				<div class="clearfix"></div>
				</section>
				</fieldset>
			</div>
		</div>
	</div>
</div>

<!--														Email Light Box-->
<?php
	if(isset($_REQUEST['op']) && $_REQUEST['op']=="edit_email")
	{
		$no=$_REQUEST['id'];
?>
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form method="post" action="user_profile.php" class="i-validate"> 
		<fieldset>
		
			<section>
			<input type="hidden" name="txtid" value="<?php echo $res_user['eid'][$no];?>">
				<div class="section-left-s">
					<label for="text_field">Email ID</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtemail" class="i-text required" type="text" value=<?php echo $res_user['email'][$no]; ?> required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="edit_email"></div>
						<div class="r-float" id="editclose"><a href="user_profile.php"><input class="button" value="Cancel" type="button"></a></div>
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

<!--//															Phone NO Light Box-->
<?php
	if(isset($_REQUEST['op']) && $_REQUEST['op']=="edit_phone")
	{
		$no=$_REQUEST['id'];
?>
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form method="post" action="user_profile.php" class="i-validate"> 
		<fieldset>
		
			<section>
			<input type="hidden" name="txtid" value="<?php echo $res_user['phid'][$no];?>">
				<div class="section-left-s">
					<label for="text_field">Phone No</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtphone" class="i-text required" type="text" value=<?php echo $res_user['phone'][$no];?> placeholder="phone no" required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="edit_phone"></div>
						<div class="r-float" id="editclose"><a href="user_profile.php"><input  required class="button" value="Cancel" type="button"></a></div>
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

<!--															Insert Email Light Box-->
<?php
	if(isset($_REQUEST['op']) && $_REQUEST['op']=="add_email")
	{
?>
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form  method="post" action="user_profile.php" class="i-validate"> 
		<fieldset>
		
			<section>
				<div class="section-left-s">
					<label for="text_field">Email ID</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtemail" class="i-text required" type="text" placeholder="Email" required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="save_email"></div>
						<div class="r-float" id="editclose"><a href="user_profile.php"><input class="button" value="Cancel" type="button" required></a></div>
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

 
<?php
	if(isset($_REQUEST['op']) && $_REQUEST['op']=="add_phone")
	{
		$no=$_REQUEST['id'];
?>
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form  method="post" action="user_profile.php" class="i-validate"> 
		<fieldset>
		
			<section>
				<div class="section-left-s">
					<label for="text_field">Phone No</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input name="txtphone" class="i-text required" type="text" placeholder="Phone No" required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="save_phone"></div>
						<div class="r-float" id="editclose"><a href="user_profile.php"><input class="button" value="Cancel" type="button" required></a></div>
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




<?php
if(isset($_REQUEST['op']) && $_REQUEST['op']=="edit_detail")
{
?>
<div id="editlight" class="bright_content">
<div class="box-content no-padding" >
	<form method="post" action="user_profile.php" class="i-validate"> 
		<fieldset>
		
			<section>
				<div class="section-left-s">
					<label for="text_field">User Name:</label>
				</div>
				<div class="section-right">
					<div class="section-input"><input  value="<?php echo $res_user['uname'];?>" name="txtuname" class="i-text required" type="text" required></div>
				</div>
				<div class="clearfix"></div>
			</section>
			
			<section>
				<div class="section-left-s">
					<label for="textarea">Address:</label>
				</div>
				<div class="section-right">
					<div class="section-input">
						<textarea rows="10" id="textarea" class="i-text" name="txtstreet" required>
							<?php echo $res_user['street'];?>
						</textarea>
					</div> 
				</div>
				<div class="clearfix"></div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="select">State:</label> 
				</div>
				<div class="section-right">
					<select  name="txtstate" class="i-text" id="state" style="width:340px;" tabindex="2">
					<?php
					
					$arr_res_state=selState();
					
					for($i=0;$i<count($arr_res_state);$i++)
					{
					
						?>
                        	<option value="<?php echo $arr_res_state[$i]['id']; ?>" <?php if($res_user['state']==$arr_res_state[$i]['id']){echo "selected";}?>><?php echo $arr_res_state[$i]['state_name']; ?></option>
                        <?php
						
					}
					?>
                    </select>
				</div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="select">City:</label> 
				</div>
				<div class="section-right">
					<select name="txtcity" data-placeholder="Choose a Country..." class="i-text" id="city" style="width:340px;" tabindex="2">
						
					</select>
				</div>
			</section>
			<section>
				<div class="section-left-s">
					<label for="select">Pincode:</label> 
				</div>
				<div class="section-right">
					<select   name="txtpin" data-placeholder="Choose a Country..." class="i-text"  id="pincode" style="width:340px;" tabindex="2">

					</select>
				</div>
			</section>
			
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto butt-margin">
						<div class="r-float"><input class="icon-16 button" value="Submit" type="submit" name="save_detail"></div>
						<div class="r-float" id="editclose"><a href="user_profile.php"><input class="button" value="Cancel" type="button"></a></div>
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
	}
	else
	{
		header("location:login.php");
	}
?>