<?php
	include_once "function.php";
	updMr($_POST);
	$mrinfo=selmr($_POST['mrid']);
	//print_r($mrinfo);
	$mrid=$_POST['mrid'];
?>

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
										//echo $result['gender'];
										if($mrinfo['gender'] == "male")
										{
										?>
                        				            <!----<div class="radio " style="height: 40px; width: 200px;">  
                                     					   <input type="radio" name="txtgender" value="male" checked>  
					                                   <label for="gender" class="lblchk ">Male</label>  
                                        				   <input  style="padding-top:1px;" type="radio" name="txtgender" value="female">  
				                                           <label for="gender" class="lblchk">Female</label> 
										 
                                   				    </div> ---><select style="width:70px" id="gender">
											<option value="Male" selected>Male</option>
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
											<option value="Female" selected>Female</option>
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
									<div class="r-float "><input class="icon16 edit-16 mr" value="" id="edit" type="button"><input value="save" id="save" type="button" hidden>

									</div>
									
									<div class="r-float"><input  value="cancel" type="button" id="cancel" hidden></div>
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
<?php
}
?> 
					
						
