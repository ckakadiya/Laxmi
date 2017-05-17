<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="medicine";
		include_once("global.php");
		include_once("function.php");
		include_once("paging.php");
	 	$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
		$meid=$_SESSION['meid'];
		//echo $meid;
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
<!--     <link rel="stylesheet" href="css/jquery-ui-1.css"> -->
<!-- 	<LINK type="text/css" href="jqtransform.css" rel="StyleSheet"> -->

<!-- <script src="Infinity%20_files/modernizr-2.js"></script> -->
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jq.js" type="text/javascript"></script>
	<script src="js/medicine.js" type="text/javascript"></script>
</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	
<div id="container">
	<div class="bit-6">
		<div id="left-menu">
			<ul>
				<li class="menu-trigger active"><a href="medicine.php" class="forms-16" id="c-elements">New</a></li>
			</ul>
		</div>
	</div>
	<div class="bit-14">
		<div class="box-element">
			<div class="box-head-light"><span class="file-16"></span><h3>Medicine_Content</h3></div>
			<div class="box-content no-padding">
				<form novalidate="novalidate" method="post" action="content_proc.php" class="i-validate"> 
					<fieldset>
						<section><h4 class="no-margin"></h4></section>
						<section class="no-padding">
						<ul class="list">
							<li>
								<label for="text_field">Content_name</label> 
							</li>
							<li class="wid-auto">
										<?php
											$result=sel_content_name();
										?>
										<input type="text" list="con_name" name="txtconame" id="cn1" />
										<datalist id="con_name">
										<?php
											$cnt=0;
											while($cnt < count($result['id']))
											{
												$res=$result['con_name'][$cnt];
												echo "<option value='$res'>".$res."</option>";
												$cnt++;		
											}
										?>
										<option id="other1" >other</option>					
									</datalist>
							</li>
							<div class="clearfix"></div>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<li>
									<label for="select">Description</label> 
								</li>
								<li class="wid-auto">
									<label><input type="text" name="txtdesc" id="condesc" /></label>
								</li>
								<div class="clearfix"></div>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<li>
									<label for="select">Quantity</label> 
								</li>
								<li class="wid-auto">
									<label><input type="text" name="txtqty" id="qty" /></label>
								</li>
								<div class="clearfix"></div>
							</ul>
							<div class="clearfix"></div>
							<ul class="list">
								<li class="wid-auto butt-margin">
									<div class="r-float">
										<input class="icon16-button forms-16" value="Add" name="btnsubmit" id="addtime" type="submit"></div> 
								</li>
								<li></li>
							</ul>
							<div class="clearfix"></div>
						</section>
						<section><h4 class="no-margin">Content information</h4></section>
				<section class="no-padding">
					<div class="lists " style="padding-top:5px; height:50px; font-weight:bold; background-color: #f4f4f4;">
						<ul class="list">			
							<li>Content_Name</li>
							<li>Description</li>
							<li>Quantity</li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
				</section>
				
				<?php
				//$meid=$_GET['id'];
				//echo $meid;
				$result=sel_content($meid);
				//print_r($result);
				
				if($result['status'] == 0)
				{
					$cnt=0;
					while($cnt < count($result)-1)
					{			
							
				?>
				<ul class="list">
				<li>
                                	<?php if(isset($result[$cnt]['content_name'])){echo $result[$cnt]['content_name'];}else{echo "-----";}?>
                                </li>
                                <li>
                                	<?php if(isset($result[$cnt]['description'])){echo $result[$cnt]['description'];}else{echo "-----";}?>
                                </li>
                                <li>
					<?php if(isset($result[$cnt]['qty'])){echo $result[$cnt]['qty'];}else{echo "-----";}?>				</li>
				<div class="clearfix"></div>
				</ul>
				<?php $cnt++;						
						}
					}
					else
					{
						//echo "no data available";
					}
				
				?>
			
			<div class="clearfix"></div>
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
	header("location: login.php");
}
?>
