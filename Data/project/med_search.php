<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="medicine";
		$menu="search_med";
		include_once("global.php");
		include_once("function.php");
		include_once('paging.php');
		$fdir = $_SERVER['PHP_SELF'];
		$cid=$_SESSION['cid'];
	
	
	//echo $fdir;
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
<script>
/*$(document).ready(function(){
		$(".delete-click").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'block');
			$("#deletefade").css('display', 'block');
		});
		$("#deleteclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#deletelight").css('display', 'none');
			$("#deletefade").css('display', 'none');
		});
		if($('#editlight').text()!="")
		{
			$("#editlight").css('display', 'block');
			$("#editfade").css('display', 'block');
		}

		$("#editclose").click(function(){
// 			$(this).addClass("dark_overlay");
// 			$(this).addClass("bright_content");
			$("#editlight").css('display', 'none');
			$("#editfade").css('display', 'none');
		});
		
	});*/
	function confirmSubmit()
		{
			var agree=confirm("Are you sure you wish to Delete this Entry?");
			if (agree)
				return true ;
			else
				return false ;
		}
</SCRIPT>

</HEAD>

<BODY>
<?php
	include_once "header.php";
?>
<div id="container">
	<?php
		include_once "medicine_menu.php";
	?>
	<?php 
		if(isset($_REQUEST['op']) && $_REQUEST['op']=="delete")
		{
			$meid=$_REQUEST['meid'];
			//echo $mrid;
			$res_del=del_medicine($meid);	
		}
	?>
			
	
	<div class="bit-14">
		<div class="box-element">
        	<div class="box-head-light"><span class="data-16"></span><h3>Search Medicine</h3></div>	
			
			<div class="box-content no-padding">
				<form method="post" action="" class="i-validate"> 
					<fieldset>
                    <section class="no-padding">
					<div class="lists">
						<ul class="datalist" style="height:40px"> 
							<li><div><a href="medicine_alphawise.php?sort=%" class="active">All</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=A%">A</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=B%">B</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=C%">C</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=D%">D</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=E%">E</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=F%">F</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=G%">G</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=H%">H</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=I%">I</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=J%">J</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=K%">K</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=L%">L</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=M%">M</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=N%">N</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=O%">O</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=P%">P</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Q%">Q</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=R%">R</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=S%">S</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=T%">T</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=U%">U</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=V%">V</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=W%">W</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=X%">X</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Y%">Y</a></div></li>
							<li><div><a href="medicine_alphawise.php?sort=Z%">Z</a></div></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</section>
				<section>
					<div class="section-input"><input name="text" id="t1" class="i-text required wid" type="text" placeholder="Name" required></div>
					<input name="submit" id="" class="i-button no-margin" value="Submit" type="submit" style="float:right;">
				<div class="clearfix"></div>
				</section>
				
				<section class="no-padding">
				</section>		
                        <?php
				if(isset($_POST['text']))
				{
					//print_r($_POST);
					if($_POST['text'] == "")
					{
						die();
					}
					else
					{
					$result=search_med($_POST);
					//print_r($result);
				
						if($result['name']== "medicine")
						{
					?>
           
                        <section class="no-padding">
			<ul class="list">
				<li ><input type="hidden"  value="<?php if(isset($result['id'])){ echo $result['id'];}?>" name="txtmeid" id="<?php echo 'meid_'.$i;?>"/>
					<a href='medicine_detail.php?id=<?php echo $result['id'];?>'>
					<?php if(isset($result['medicine_name'])){echo $result['medicine_name'];}else{echo "-----";}?></a>
				</li>
				<li>
                                	<?php if(isset($result['description'])){echo $result['description'];}else{echo "-----";}?>
                                </li>
				<li><div class="clearfix"></div></li>
			</ul>
</section><section>
				<div class="lists " style="padding-top:5px; height:50px; font-weight:bold; background-color: #f4f4f4;">
						<ul class="list">			
							<li>Content Name</li>
							<li>Description</li>
							<li>Quantity</li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
				
			<ul class="list">
				<?php
								$size=0;
								$i=1;
								while($size< count($result['content_name']))
								{
								?>
							
                             	<li >
					<?php if(isset($result['content_name'][$size])){echo $result['content_name'][$size];}else{echo "-----";}?>				</li>
				<li>
					<?php if(isset($result['desc'][$size])){echo $result['desc'][$size];}else{echo "-----";}?>				</li>
				<li>
				<li>
					<?php if(isset($result['qty'][$size])){echo $result['qty'][$size];}else{echo "-----";}?>				</li>
				</br><li><div class="clearfix"></div></li>
				<?php
									$size++;
									$i++;
								}
				}
				else
				{?>
				<section class="no-padding">
			<ul class="list">
				<li ><input type="hidden"  value="<?php if(isset($result['id'])){ echo $result['id'];}?>" name="txtmeid" id="<?php echo 'meid_'.$i;?>"/>
					<?php if(isset($result['content_name'])){echo $result['content_name'];}else{echo "-----";}?></a>
				</li>
				<li>
                                	<?php if(isset($result['desc'])){echo $result['desc'];}else{echo "-----";}?>
                                </li>
				<li><div class="clearfix"></div></li>
			</ul>
</section><section>
				<div class="lists " style="padding-top:5px; height:50px; font-weight:bold; background-color: #f4f4f4;">
						<ul class="list">			
							<li>Medicine Name</li>
							<li>Description</li>
							<li><div class="clearfix"></div></li>
						</ul>
					</div>
				
			<ul class="list">
				<?php
								$size=0;
								$i=1;
								//print_r($result);
								while($size< count($result['medicine_name']))
								{
								?>
							
                             	<li >
					<?php if(isset($result['medicine_name'][$size])){echo $result['medicine_name'][$size];}else{echo "-----";}?>				</li>
				<li>
					<?php if(isset($result['description'][$size])){echo $result['description'][$size];}else{echo "-----";}?>				</li>
				
				</br><li><div class="clearfix"></div></li>
				<?php
									$size++;
									$i++;
								}
			
								}
								?>
								
			</ul>
			<div class="clearfix"></div>
		</section>
			
                <?php
                }}
                else
	        {
		?>
     		<section class="no-padding">
			<ul class="list">
				<LI>
				<li>
                        </ul>
			<div class="clearfix"></div>
		</section>
                <?php
             
	}
                ?>
                </fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="deletelight" class="bright_content-delete">
<div class="box-content no-padding">
	<form novalidate method="post" action="" class="i-validate"> 
	<fieldset>
			<section class="no-padding">
				<ul class="list">
					<li class=" wid-auto">
						<span class="red">Are you sure, you want delete?</span>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
			<section class="no-padding">
				<ul class="list">
					<li class="wid-auto">
						<div class="r-float"><input class="button" value="Yes" id="btndelete" type="button"></div>
						<div class="r-float" id="deleteclose"><input class="button" value="No"  type="button"></div>
					</li>
					<li></li>
				</ul>
				<div class="clearfix"></div>
			</section>
		</fieldset>
	</form>
</div>
</div>
<div id="editfade" class="dark_overlay"></div>

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
