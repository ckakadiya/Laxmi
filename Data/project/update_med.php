<?php
	include_once "function.php";
	updMedicine($_POST);
	$meinfo=selMedicine($_POST['meid']);
	//print_r($mrinfo);
	$meid=$_POST['meid'];
?>

							<ul class="list">
								<li>
									<?php	
										if ($meinfo['status'] == 0)
										{
									?>
										<input type="hidden" name="txtmeid" " id="meid" value="<?php echo $meid;?>"/>			
								</li>
								
								<LI>
									<label for="text_field">Medicine Name</label>
								</LI>
								<li class="wid-auto" id="editmedname">
									<label for="text_field" class="red" id="medname" value="<?php echo $meinfo['medicine_name']; ?>"><?php echo $meinfo['medicine_name']; ?></label>									
								</li>
								<li id="heditmedname" hidden="hidden">
									<input style="width:130px;" type="text" id="hmedname" value="<?php echo $meinfo['medicine_name']; ?>" />	
								</li> 
								<li></li>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<LI>
									<label for="text_field">description</label>
								</LI>
								<li class="wid-auto" id="editmedesc">
									<label for="text_field" class="red" id="medesc" value="<?php echo $meinfo['description']; ?>"><?php echo $meinfo['description']; ?></label>									
								</li>
								<li id="heditmedesc" hidden="hidden">
									<input style="width:130px;" type="text" id="hmedesc" value="<?php echo $meinfo['description']; ?>" />	
								</li> 
								
								<li></li>
							</ul>
							<div class="clearfix"></div>
							
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float "><input class="icon16 edit-16 medicine" value="" id="edit" type="button"><input value="save" id="save" type="button" hidden>

									</div>
									
									<div class="r-float"><input  value="cancel" type="button" id="cancel" hidden></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
<?php
}
?> 
					
						
