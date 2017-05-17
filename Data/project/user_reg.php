<?php
	if(isset($_GET['cid']))
	{
		include_once("user_reg_code.php");
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
			<div class="box-head-light"><span class="forms-16"></span><h3>User Registarion</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="#" class="i-validate"> 
					<fieldset>
					     <section>
							<div class="section-left-s">
								<label for="text_field">User Name</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtuname" id="text_field" class="i-text required" type="text" placeholder="User/Dr. Name" required></div>
							</div>
							<div class="clearfix"></div>
						</section>	
                        <section>
							<div class="section-left-s">
								<label for="textarea">Address</label>
							</div>
							<div class="section-right">

                                <div class="section-input"><textarea rows="5" name="txtarea" id="textarea" class="i-text" placeholder="area/street" required></textarea></div> 
							</div>
							<div class="clearfix"></div>
						</section>
                        
                        <section>
							<div class="section-left-s">
								<label for="text_field">State</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <select name="txtstate"  class="i-text required" type="text" placeholder="State" required id="state">		
                                
									<?php
                                        $res=selTable("state");
                                        while($row=mysql_fetch_array($res))
                                        {
                                            echo "<option value='".$row['id']."'>".$row['state_name']."</option>";
                                            
                                        }
                                    ?>
                                 </select>
                                
                                
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">City</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <select id="city" name="txtcity"  class="i-text required" type="text" placeholder="City" required>
                                </select>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Pincode</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <select  name="txtpin" id="pincode"  class="i-text required" type="text" placeholder="Pincode" required>
                                </select>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Phone</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtphone" id="text_field" class="i-text required" type="text" placeholder="Phone No" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">speciality</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtspc" id="text_field" class="i-text required" type="text" placeholder="Speciality" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Email</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtemail" id="text_field" class="i-text required" type="email" placeholder="User@example.com" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Password</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtpwd" id="text_field" class="i-text required" type="password" placeholder="********" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Re-Enter Password</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtcpwd" id="text_field" class="i-text required" type="password" placeholder="********" required></div>
							</div>
							<div class="clearfix"></div>
						</section>
                           <section>
							<div class="section-left-s">
								<label for="text_field">Select Question</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <select  name="txtque"   class="i-text required" type="text"  required>
 	                               	<option value="what is your nick name?">what is your nick name?</option>
                                    <option value="what is your father name?">what is your father name?</option>
                                    <option value="what is your feverit book?">what is your feverit book?</option>
                                    <option value="what is your mother name">what is your mother name</option>
                                </select>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Answer</label>
							</div>
							<div class="section-right">
								<div class="section-input"><input name="txtans" id="text_field" class="i-text required" type="text" placeholder="Ans.." required></div>
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
<?php
		}
	else
	{
		header("location:login.php");		
	}
?>

















