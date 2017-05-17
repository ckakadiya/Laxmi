<?php
	include_once "function.php";
	delTime($_POST);
	$result=sel_visitdoc($_POST['vdid']);
	//print_r($mrinfo);
?>
<div class="lists " style="padding-top:3px; height:40px; font-weight:bold; background-color: #f4f4f4;">
<ul class="list">
								<li style=" width: 200px;">Start</li>
								<li style=" width: 200px;">Till</li>
								<li style=" width: 200px;">Day</li>
								<li>
									<div class="clearfix"></div>
								</li>
							</ul>
							</div>
							<?php
								$size=0;
								$j=1;
								while($size < count($result['start']))
								{
								?>
							<ul class="list" id="<?php echo 'time_'.$j; ?>">
								
								<li id="<?php echo 'startcol_'.$j;?>" style=" width: 200px;"><?php echo $result['start'][$size]; ?></li>
								<li id="<?php echo 'tillcol_'.$j;?>" style=" width: 200px;"><?php echo $result['till'][$size]; ?></li>
								<li id="<?php echo 'daycol_'.$j;?>" style=" width: 200px;"><?php echo $result['day'][$size]; ?></li>				
								<li class="time" style=" padding-left:0px; width: 30px;" id="<?php echo 'edittime_'.$j; ?>"><a href="javascript:void(0);" >Edit</a></li>
								<li class="time" style="padding-left:0px; width: 30px;" id="<?php echo 'deltime_'.$j; ?>"><a href="javascript:void(0);" >Delete</a></li>		
								<li><div class="clearfix"></div></li>
							</ul>
							<ul class="list" hidden id="<?php echo 'htime_'.$j;?>">
								<input type="hidden" size="2" id="<?php echo 'htid_'.$j;?>" value="<?php echo $result['tid'][$size]; ?>" />
								<li  id="<?php echo 'edittime_'.$j; ?>" style="width:200px;">
									<input style="width:130px;" type="text" hidden	 id="<?php echo 'hstart_'.$j; ?>" value="<?php echo $result['start'][$size]; ?>" />	
								<?php //echo $size;?>
								<div >
								<select class="chzn-single" style="width:70px;" tabindex="2" name="selstart" id="<?php echo 'start_'.$j;?>" required>							
									<option><?php 
										if($result['start'][$size] != "")
										{	
											$start=explode(" ",$result['start'][$size]);
											$start1=explode(":",$start[0]);
											$start[0]=$start1[0].":00:00";
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
							<select class="chzn-single" style="width:60px;" tabindex="2" id="<?php echo 'smin_'.$j;?>""  name="selsmin">
										<option><?php 
										if($result['start'][$size] != "")
										{	
											$start=explode(" ",$result['start'][$size]);
											$time=explode(":",$start[0]);
				        						echo $time[1].":00"; 
										}
										else
										{
											$result['start']="1:00:00 AM";
											$start=explode(" ",$result['start']);
											$time=explode(':',$start[0]);
				        						echo $time[1].":00"; 
										}
									?></option>
									
									<?php
										$cnt=05;
										while($cnt <= 55)
										{
											if($cnt == $time[1])
											{
												$cnt=$cnt+5;
												continue;
											}
											$cnt1="$cnt:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt=$cnt+5;
										}
									?>	
									</select>
									
							<select class="chzn-single" style="width:40px;" tabindex="2" id="<?php echo 'smed_'.$j;?>"  name="selsmed">
								<option><?php $start=explode(" ",$result['start'][$size]);
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
						</li>
						<li style="width:200px;">
							<input style="width:130px;" type="text" hidden id="<?php echo 'htill_'.$j; ?>"  value="<?php echo $result['till'][$size]; ?>" />	
							<div>
							<select class="chzn-single" style="width:70px;" tabindex="2" name="seltill" id="<?php echo 'till_'.$j;?>" required>							<option><?php
									if($result['till'][$size] != "")
									{	
										$till=explode(" ",$result['till'][$size]);
										$till1=explode(":",$till[0]);
										$till[0]=$till1[0].":00:00";
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
							<select class="chzn-single" style="width:60px;" tabindex="2" id="<?php echo 'tmin_'.$j;?>""  name="seltmin">
									<option><?php 
										if($result['till'][$size] != "")
										{	
											$till=explode(" ",$result['till'][$size]);
											$time=explode(":",$till[0]);
				        						echo $time[1].":00"; 
										}
										else
										{
											$result['till']="1:00:00 AM";
											$till=explode(" ",$result['till']);
											$time=explode(':',$till[0]);
				        						echo $time[1].":00"; 
										}
									?></option>
									
									<?php
										$cnt=05;
										while($cnt <= 55)
										{
											if($cnt == $time[1])
											{
												$cnt=$cnt+5;
												continue;
											}
											$cnt1="$cnt:00";
											echo "<option value='$cnt1'>".$cnt1."</option>";
											$cnt=$cnt+5;
										}
									?>	</select>
									
							<select class="chzn-single" style="width:40px;" tabindex="2" id="<?php echo 'tmed_'.$j;?>"  name="seltmed">
								<option><?php $till=explode(" ",$result['till'][$size]);
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
						</li>
						<li style="height: 40px; width: 140px; padding-top: 0px;">
							<input style="width:130px;" type="text" hidden id="<?php echo 'hday_'.$j; ?>"  value="<?php echo $result['day'][$size]; ?>" />	
							<div class="section-left-s">
							<select class="chzn-single" style="width:80px;" tabindex="2"	 name="selday" id="<?php echo 'day_'.$j;?>" required>				
							<?php 
								$day[0]="Monday";
								$day[1]="Tuesday";
								$day[2]="Wednesday";
								$day[3]="Thursday";
								$day[4]="Friday";
								$day[5]="Saturday";
								$day[6]="Sunday";	
								$cnt=0;
								if($result['day'][$size] != "")
								{
									echo "<option>".$result['day'][$size]."</option>";
								}
								else
								{		
									$result['day']="Monday";
									echo "<option>".$result['day']."</option>";
								}
								while($cnt < count($day))
								{
									if($result['day'][$size] == $day[$cnt])
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
						</li>	
						<li style=" width:40px;" id="<?php echo 'save_'.$j;?>" class="time">
							<a href="javascript:void(0);">Save</a>
						</li>
						<li style="width:30px;" id="<?php echo 'cancel_'.$j;?>" class="time">
							<a href="javascript:void(0);">cancel</a>
						</li>
								
						<li><div class="clearfix"></div></li>	
					</ul>
							
							<?php
								$size++;
								$j++;
							}
							?>
						<ul class="list" id="newtime">
						</ul>
								
						<ul class="list" id="timebox">
						<li colspan="3" align="center" style="width:100%;">
							<a style="padding-left:60px;" href="javascript:void(0);" class="icon16-button forms-16" id="ntime" name="ntime">Add more Time</a>
						</li>
						<li><div class="clearfix"></div></li>
					</ul>
					
						<div class="clearfix"></div>	
