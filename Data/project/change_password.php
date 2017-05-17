<?php
	session_start();
	$str="no";
	if(isset($_SESSION['cid']))
	{
		
		include_once("function.php");
		$menu="resetpwd";
		
		$uname=$_SESSION['uname'];
		$cname=$_SESSION['cname'];
		$cid=$_SESSION['cid'];
		$uid=$_SESSION['uid'];
		 
		
		
		if(isset($_POST['submit']))
		{
			$arr_chpwd=array();
			$arr_chpwd['uid']=$uid;
			$arr_chpwd['que']=$_POST['txtque'];
			$arr_chpwd['ans']=$_POST['txtans'];
			$arr_chpwd['pwd']=$_POST['txtoldpwd'];
			$arr_chpwd['npwd']=$_POST['password'];
			$sel_res=changePassword($arr_chpwd);
			
		}
	
?>







<!DOCTYPE html>
<html>
<HEAD>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">
	<TITLE>Docters Helper</TITLE>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
    <LINK type="text/css" href="css/c1.css" rel="StyleSheet">
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>

</HEAD>
<body>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("setting_menu.php");?>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Reset Password</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="" class="i-validate"> 
					<fieldset>
					     <section>
							<div class="section-left-s">
								<label for="text_field">Clinic Name</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <select name="txtque"  class="i-text required" required>
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
								<div class="section-input">
                                <input name="txtans"  id="text_field"class="i-text required" type="text" placeholder="Ans" required>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Old Password</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input name="txtoldpwd"  id="text_field"class="i-text required" type="password" placeholder="********" required>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">New Password</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input type="password" name="password" id="password" required title="Enter Password." onKeyUp="pass()" onChange="flash()" class="i-text required" type="password" placeholder="********" required>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<div class="section-left-s">
								<label for="text_field">Conform Password</label>
							</div>
							<div class="section-right">
								<div class="section-input">
                                <input type="password" name="repassword" id="repassword" required title="Enter Comform Password." onKeyUp="repass()" onClick="repass()" onBlur="flashre()"  class="i-text required" type="text" placeholder="********" required>
                                </div>
							</div>
							<div class="clearfix"></div>
						</section>
                        <section>
							<input name="submit"  class="i-button no-margin" value="Submit" id="button" type="submit">
							<div class="clearfix"></div>
						</section>	
		</fieldset>
	</form>
    		<?php
			if(isset($_POST['submit']))
			{
			if($sel_res['result']==1)
			{
			?>
            		<section>
				    <div class="alert-msg success-msg" align="center">Password is successfully change</div>
					</section>
            <?php
				
			}
			else
			{?>
            	<section>
				    <div class="alert-msg error-msg" align="center"><?php echo $sel_res['result'];?></div>
					</section>
            <?php
			
				
			}
			}?>
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

















