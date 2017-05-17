<?php
	session_start();
	include_once "function.php";	
	updatePhno($_POST);
	$mrinfo=selmr($_POST['mrid']);
	//print_r($mrinfo);
?>
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
								
						
