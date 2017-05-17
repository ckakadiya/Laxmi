<?php
	include_once "function.php";
	delContent($_POST);
	$meinfo=selMedicine($_POST['meid']);
	//print_r($mrinfo);
?>
<div class="lists " style="padding-top:3px; height:40px; font-weight:bold; background-color: #f4f4f4;">
							<ul class="list">
								<li style=" width: 120px;">Content</li>
								<li style=" width: 120px;">Description</li>
								<li style=" width: 120px;">Quantity</li>
								<li>
									<div class="clearfix"></div>
								</li>
							</ul>
							</div>
							<?php
								$size=0;
								$j=1;
								while($size < count($meinfo['content_name']))
								{
								?>
							<ul class="list" id="<?php echo 'con_'.$j; ?>">
								
								<li id="<?php echo 'concol_'.$j;?>" style=" width: 120px;"><?php echo $meinfo['content_name'][$size]; ?></li>
								<li id="<?php echo 'condesccol_'.$j;?>" style=" width: 120px;"><?php echo $meinfo['desc'][$size]; ?></li>
								<li id="conqty" ><?php echo $meinfo['qty'][$size]; ?></li>			
								<li class="content" style=" padding-left:0px; width: 30px;" id="<?php echo 'editcon_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="content" s	tyle="padding-left:0px; width: 30px;" id="<?php echo 'delcon_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>						
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" id="<?php echo 'hcon_'.$j;?>" hidden="hidden">
								<input type="hidden" size="2" id="<?php echo 'hcoid_'.$j;?>" name="hcoid" value="<?php echo $meinfo['coid'][$size]; ?>" />
								<li  id="<?php echo 'editcon_'.$j; ?>">
									<input style="width:130px;"  id="<?php echo 'hconname_'.$j; ?>" value="<?php echo $meinfo['content_name'][$size]; ?>" />	
								</li>
								<li  id="<?php echo 'editdesc_'.$j; ?>">
									<input style="width:130px;" id="<?php echo 'hcondesc_'.$j; ?>"value="<?php echo $meinfo['desc'][$size]; ?>" />	
								</li>
								<li  id="<?php echo 'editqty_'.$j; ?>">
									<input style="width:130px;" id="<?php echo 'hconqty_'.$j; ?>" value="<?php echo $meinfo['qty'][$size]; ?>" />	
								</li>
	
								<li style=" width:40px;" id="<?php echo 'save_'.$j;?>" class="content">
									<a href="javascript:void(0);">Save</a>
								</li>
								<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="content">
									<a href="javascript:void(0);">cancel</a>
								</li>
								<li><div class="clearfix"></div></li>
							</ul>
								<?php
									$size++;
									$j++;
								}
								?>
								
								<ul class="list" id="newcontent">
								</ul>
								<ul class="list" id="contentbox">
									
									<li colspan="3" align="center" style="width:100%;"><a style="padding-left:60px;" href="javascript:void(0);" class="icon16-button forms-16" id="ncon" name="ncon">Add more Content</a></li>
									<li><div class="clearfix"></div></li>
								</ul>
						<div class="clearfix"></div>
