<?php
	if(isset($_SESSION['cid']))
	{
		$str="patient";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>
	<form id="patient_reg" action="#" method="POST">
        <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>">
			<div id="main">
					<div style="float:left" class="lbl">Patient Name:</div>
					<div class="ctrl">
                    
					<input type="text" name="txtpname" required id="pname" value="<?php echo $sel_res['pname'];?>">
					<label id="l1"></label>
					</div>
					
					<div style="float:left" class="lbl">Date of Birth:</div>
					<div class="ctrl">
					<select name="dd" id="day" >
					   <?php
                       if($day!="00")
                       {
                   		?>
                       		<option value="<?php echo substr($sel_res['dob'],8,2);?>"><?php echo substr($sel_res['dob'],8,2);?></option>
					   <?php
					   }
					   		for($i=1;$i<=31;$i++)
							{
						?>
                   								<option <?php if($day==$i){echo "value='$day' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>	
						 <?php

                             }
					   ?>
						</select>
						<select name='mm' id='month' >
   						<?php
                       if($month!="00")
                       {
                   		?>
                     
                        <option value="<?php echo substr($sel_res['dob'],5,2);?>"><?php echo substr($sel_res['dob'],5,2);?></option>
							<?php
					   }
					   		for($i=1;$i<=12;$i++)
							{
							?>
								<option <?php if($month==$i){echo "value='$month' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>
							<?php
                            }
					   		?>	   
					   </select>
					   
                      
                      <select name="yyyy" id='year'>
							<?php
					   
					   		for($i=1940;$i<=date('Y');$i++)
							{
							?>
                            	<option <?php if($year==$i){echo "value='$year' selected='selected'";}else{ echo "value='$i'";}?>><?php echo $i;?></option>
                            <?php
							}
					   		?>
					 </select>
					 <label id="l1"></label>
                     
               		 </div>
					<div id="d1" style="float:left" class="lbl" >Phone No:</div>
					<div id="d2" class="ctrl">
						<input type="text" name="txtphone" required id="phoneno" value="<?php echo $sel_res['phone'];?>">
						<label></label>
					</div>
                    <div id="d1" style="float:left" class="lbl"></div>
					<div id="d2" class="ctrl"><a href="" id="msg"></a>
					</div>
                    	
                    <div id="hideform">
					<div style="float:left" class="lbl">Gender :</div>
					<div class="ctrl">
                    
						<input type='radio' name='gender' value='male' <?php if($sel_res['gender']=="male"){echo "checked"; } ?>>
						<label for='male'>Male</label>
						<input type='radio' name='gender' value='female' <?php if($sel_res['gender']=="female"){echo "checked"; } ?> >
						<label for='female'>Female</label>
						<label id="l1"></label>
					</div>
					
					<div style="float:left" class="lbl">Area Name:</div>
					<div class="ctrl">
						<textarea name="txtarea" cols="25" rows="3" required>
							<?php
								if(isset($sel_res['street']))
								{
									echo $sel_res['street'];
								}
							?>
						</textarea>
						<label></label>
					</div>
		
					<div style="float:left" class="lbl">State Name:</div>
					<div class="ctrl">
						<select  name="txtstate" id="state" required>
             	<?php
					
					$arr_res_state=selState();
					
					for($i=0;$i<count($arr_res_state);$i++)
					{
					
						?>
                        	<option value="<?php echo $arr_res_state[$i]['id']; ?>" <?php if($sel_res['state_id']==$arr_res_state[$i]['id']){echo "selected";}?>><?php echo $arr_res_state[$i]['state_name']; ?></option>
                        <?php
						
					}
					?>
            </select>

						<label></label>
					</div>
					
					<div style="float:left" class="lbl">City Name:</div>
					<div class="ctrl">
						<select name="txtcity" id="city" required>
                    	<option value="<?php echo $sel_res['city_id'];?>"><?php echo $sel_res['city'];?></option>
					
						</select>
						<label></label>
					</div>
					
					<div style="float:left" class="lbl">Pincode:</div>
					<div class="ctrl">
						<select name="txtpin" id="pincode"required >
				<option value="<?php echo $sel_res['pin_id'];?>"><?php echo $sel_res['pincode'];?></option>
					
						</select>
						<label></label>
					</div>
					
					<div style="float:left" class="lbl">Email id:</div>
					<div class="ctrl">
						<input type="email" name="txtemail" required value="<?php if(isset($sel_res['email'])){echo $sel_res['email'];}?>">
						<label></label>
					</div>
					
				
					<div id="d1" style="float:left" class="lbl"></div>
					<div id="d2" class="ctrl">
						<input type="submit" name="submit" value="submit">
					</div>
                    <input type="hidden" name="pageno" value=<?php echo $_REQUEST['p'];?>>
                    </div>
            </div>
        </form>
</div>
</body>
</html>
<?php
	}
	else
	{
		header("location:login.php");
	}
?>