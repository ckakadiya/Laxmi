<?php
	include_once("clinic_reg_code.php");
	include_once("connect.php");
?>
<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Clinic Registration</TITLE>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	<link href="css/c1.css" rel="stylesheet" type="text/css">
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
    </HEAD>
<BODY>
<div id="container">
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="forms-16"></span><h3>Clinic Registarion</h3></div>
			<div class="box-content no-padding">
				<form  method="post" action="" class="i-validate"> 
					<fieldset>
					     <section>
							<div class="section-left-s">
								<label for="text_field">Clinic Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtcname" id="text_field" class="i-text required" type="text" placeholder="Clinic Name" required></div>
							</div>
							<div class="clearfix"></div>
						</section>	
                        <section>
							<div class="section-left-s">
								<label for="textarea">Address</label>
							</div>
							<div class="section-right">

                                <div class="section-input"><textarea rows="5" name="txtarea" id="textarea" class="i-text" placeholder="Address" required></textarea></div> 
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">City</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtcity" id="text_field" class="i-text required" type="text" placeholder="City" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">State</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtstate" id="text_field" class="i-text required" type="text" placeholder="State" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Pincode</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtpin" id="text_field" class="i-text required" type="text" placeholder="Pincode" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Phone</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtpno" id="text_field" class="i-text required" type="text" placeholder="Phone No" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							
							<div class="section-right">
								<div class="section-input"><input class="icon16-button forms-16" value="Select Plane" type="button" name="showplane" id="showplane"></div></div>				
                         </section>
                         <section>
							<div class="clearfix"></div>
                                <div class=" radio section-right" id="planediv">
                                
                                    <table class="i-table">
                                    	<thead>
                                        <Tr>
											<td>No</td>
                                            <td>Plan Name</td>
                                            <td>Time Duration</td>
                                            <td>Number of appoinment</td>
                                            <td>cost</td>
	
                                        </Tr>
                                        </thead>
										<tbody>
                                        <?php
                                            $sql="select * from plan";
                                            $ans=mysql_query($sql) or die(mysql_error());
                                            $cnt=1;
                                            while($result=mysql_fetch_array($ans))
                                            {
                                        ?>
                                        <TR height="50px" >
                                            <TD><input type="radio"  name="txtplan" value="<?php echo $result[0]; ?>" id="male<?php echo $cnt;?>" required><label for="male<?php echo $cnt;?>" class="lblchk" ></label></TD>						
                                            <TD><?php echo $result[1]; ?></TD>
                                            <TD><?php echo $result[2]; ?></TD>
                                            <TD><?php echo $result[3]; ?></TD>
                                            <TD><?php echo $result[4]; ?></TD>
                                        </TR>
                                        <?php
											$cnt++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
							</div>
                     
                            
							
							<div class="clearfix"></div>
						</section>
                        
						<section>
							<input name="submit"  class="i-button no-margin" value="Submit" type="submit">
							<div class="clearfix"></div>
						</section>
                        <section>
                        	<div class="section-right"><span><?php 	?></span></div>
                        </section>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
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
