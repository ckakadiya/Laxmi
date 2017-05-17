
<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Insurance Login</TITLE>
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

            	<div id="login-container">
                       <div id="login">
                    	<div class="login-title"><h1>Admin Login</h1></div>
                        <fieldset>
                        <form action="#" method="post">
						
						<section>
							<div class="section-left-s">
							UserName:
							</div>
							<div class="section-left">
								
								<div class="section-input">
									<input type="email" placeholder="user@gmail.com" name="txtuname"  class="i-text required wid" required pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
								</div>
							</div>
							
							<div class="section-left-s">
								<br>
								Password:
							</div>
							<div class="section-left">
								<br>
								<div class="section-input">
									<input type="Password" placeholder="Password" name="txtpass"  class="i-text required wid" required >
								</div>
							</div>
							
							<div class="section-left-s">
								<br>
							</div>
							<div class="section-left">
								<br>
								<div class="section-input">
									<input name="submit"  class="i-button no-margin" value="Submit" type="submit">
								</div>
							</div>
							<div class="clearfix"></div>
							
							
                           
						</section>
                        				
							
							
								<div class="section-input">
									<a href="forget_password.php">Forget Password</a>   
								</div>
					
                            
                        
                        
                        </form>
                        </fieldset>    
                        
                    
                  
								<div class="section-input">
									<span><?php  include_once("login_code.php");?></span>
								</div>
								<div class="clearfix"></div>
                      
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