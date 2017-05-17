<?php
	include_once "function.php";
	updMrMedicine($_POST);
	$mrinfo=selMr($_POST['mrid']);
	//print_r($result);
?>
<?php
								$size=0;
								$j=1;
								if(isset($mrinfo['medicine_id']))
								{
																	
								while($size < count($mrinfo['medicine_id']))
								{
								?>
							<ul class="list" id="<?php echo 'medrow_'.$j;?>">
								<li style=" width: 160px;" id="<?php echo 'med_'.$j;?>"><?php echo $mrinfo['medicine_name'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $mrinfo['time'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $mrinfo['date'][$size]; ?></li>
								<!---<li style=" width: 120px;"><?php echo $mrinfo['company_name'][$size]; ?></li>-->								<li class="med" style=" padding-left:0px; width: 30px;" id="<?php echo 'editmed_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="med" style="padding-left:0px; width: 30px;" id="<?php echo 'delmed_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>		
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hmedrow_'.$j;?>" hidden="hidden">
								<input type="hidden" size="2" id="<?php echo 'hmedid_'.$j;?>" name="hmedid" value="<?php echo $mrinfo['medicine_id'][$size]; ?>" />
								<input type="hidden" size="2" id="<?php echo 'hmrmedid_'.$j;?>" name="hmrmedid" value="<?php echo $mrinfo['mr_med_id'][$size]; ?>" />
								<li  id="<?php echo 'editmed_'.$j; ?>" style="width:160px;">
									<input  type="text" id="<?php echo 'hmed_'.$j; ?>" name="h_med" value="<?php echo $mrinfo['medicine_name'][$size]; ?>" />	
								</li>
								<li style=" width: 120px;"><?php echo $mrinfo['time'][$size]; ?></li>
								<li style=" width: 120px;"><?php echo $mrinfo['date'][$size]; ?></li>
								
								<li style=" width:30px;" id="<?php echo 'save_'.$j;?>" class="med">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="med">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
								
							
							
							<?php
								$size++;
								$j++;
							}
							}
							?>
							<ul class="list" id="medbox">
								<li colspan="3" align="center" style="width:100%;"><a style="padding-left:60px;" href="medicine.php?mrid=<?php echo $mrid;?>" class="icon16-button forms-16" id="nmed" name="nmed">Add more Medicine</a></li>
									<li><div class="clearfix"></div></li>
								</ul>
						<div class="clearfix"></div>	
