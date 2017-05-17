<?php
	session_start();
	include_once "function.php";
	del_email($_POST);
	$mrinfo=selmr($_POST['mrid']);
	//print_r($empinfo) or die();
?>
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
							
							
