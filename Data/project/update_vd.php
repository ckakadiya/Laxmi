<?php
	include_once "function.php";
	updVd($_POST);
	$result=sel_visitdoc($_POST['vdid']);
	//print_r($mrinfo);
	$vdid=$_POST['vdid'];
?>

<ul class="list">
								<li>
									<?php	
										if ($result['status'] == 0)
										{
									?>
										<input type="hidden" name="txtvdid" " id="vdid" value="<?php echo $vdid;?>"/>			
								</li>
								<LI>
									<label for="text_field">Name</label>
								</LI>
								<li class="wid-auto" id="editvdname">
									<label for="text_field" class="red" id="vdname" value="<?php echo $result['doctor_name']; ?>"><?php echo $result['doctor_name']; ?></label>									
								</li>
								<li id="heditvdname" hidden="hidden">
									<input style="width:130px;" type="text" id="hvdname" value="<?php echo $result['doctor_name']; ?>" />	
								<li></li>
							</ul>
							<ul class="list">
								<LI>
									<label for="text_field">Speciality</label>
								</LI>
								<li class="wid-auto" id="editspeciality">
									<label for="text_field" class="red" id="speciality"><?php echo $result['speciality']; ?></label>
								</li>
								<li id="heditspeciality" hidden="hidden">
									<input style="width:130px;" type="text" id="hspeciality" value="<?php echo $result['speciality']; ?>" />	
								<li></li>
							</ul>
							<?php
								}
							?>
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float"><input class="icon16 edit-16 vd" value="" id="edit" type="button"><input  value="save" id="save" type="button" hidden>

									</div>
									
									<div class="r-float"><input  value="cancel" type="button" id="cancel" hidden></div>
								</li>
								<li></li>
							</ul>
							
