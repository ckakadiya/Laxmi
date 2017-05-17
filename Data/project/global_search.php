<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="";
		$menu="search";
	include_once("connect.php");
	include_once("global.php");
	include_once("function.php");
	 $fdir = $_SERVER['PHP_SELF'];
	 
	
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
</HEAD>

<BODY>
<?php include_once("header.php");?>
<div id="container">
<?php include_once("global_menu.php"); ?>
	<div class="bit-14">
		<div class="box-element">

			<div class="box-head-light"><span class="file-16"></span><h3>Global Search</h3></div>
			<div class="box-content no-padding">
				<form method="post" action="" class="i-validate"> 
					<fieldset>
						<section>
							
							<div class="clearfix"></div>
						</section>
                          </fieldset>
						
                        <?php
			
			$a=explode(',',$_POST['text']);
			$cnt=count($a);
			
			if ($cnt==1)
			{
				$flag=0;
				//Visiting Doctor...
				//echo $_POST['text'];;
				$text=array();
				$text['text']=$_POST['text'];
				$sel_res=searchDataVisitingDoctor($text,$_SESSION['cid']);
				//print_r($sel_res);
				$limit=count($sel_res['id']);
				if ($limit!=0)
				{
				$flag++;
				?>
				<fieldset>
			<section><h4 class="no-margin">Visiting Doctors Details</h4></section>
			<?php	
					for($i=0;$i<$limit;$i++)
					{
					?>
           
                        <section class="no-padding">
							<ul class="list">
								<LI title='<?php echo $sel_res['user'][$i];?>'>
									<?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?>
								
                                
                                <li>
                                	<?php //if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </li>
								<li>
									<?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>
								</li>
								<li>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</li>
                                <li>
									<?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>
								</li>
                                
								<li>
									<!--`<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
					}
            }
		
					
					
				//Doctor...
				//echo $_POST['text'];;
				$text=array();
				$text['text']=$_POST['text'];
				$sel_res=searchData($text,$_SESSION['cid']);
				//print_r($sel_res);
				$limit=count($sel_res['id']);
				if ($limit!=0)
				{
				$flag++;
				?>
			<section><h4 class="no-margin">Doctors Details</h4></section>
			<?php	
					for($i=0;$i<$limit;$i++)
					{
					?>
           
                        <section class="no-padding">
							<ul class="list">
								<LI title='<?php echo $sel_res['user'][$i];?>'>
									<?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?>
								
                                
                                <li>
                                	<?php //if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </li>
								<li>
									<?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>
								</li>
								<li>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</li>
                                <li>
									<?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?>
								</li>
                                
								<li>
									<!--<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
					}
            }
			
	
					
					
			
				//Patient Search..
				//echo $_POST['text'];;
				$text=array();
				$text['text']=$_POST['text'];
				$sel_res=searchDataPatient($text,$_SESSION['cid']);
				//print_r($sel_res);
				$limit=count($sel_res['id']);
				//echo "$limit";
				if ($limit!=0)
				{
				$flag++;
				?>
			<section><h4 class="no-margin">Patient Details</h4></section>
			<?php	
					for($i=0;$i<$limit;$i++)
					{
					?>
           
                        <section class="no-padding">
							<ul class="list">
								<LI title='<?php echo $sel_res['user'][$i];?>'>
									<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
								
                                
                                <li>
                                	<?php //if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </li>
								<li>
									<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
								<li>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</li>
                                <li>
									<a title='<?php echo $sel_res['address'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
                                
								<li>
									<!-- <div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
					}
				}
					
				if ($flag==0)
				{
					?>
                           				<section>
	                            
		<div class="alert-msg error-msg" align="center">No Search Data Found.</div>
	
	
	</section>
	<?php
				}
            
			
			
				
			}
			else if ($cnt==2)
			{
			$sel_res=allDataSearch($_POST,$_SESSION['cid']);
			//print_r($sel_res);
			
			$doc=$sel_res['doctor'];
			$patient=$sel_res['patient'];
			$flag=0;
			if ($doc>0)
			{
				$flag++;
				//echo "jdvh";
			//echo $patient;
			
			//echo "Patient Detail";
			?>
			<div class="box-head-light"><span class="file-16"></span><h3>Doctor Detail</h3></div>
			<?php	
					for($i=0;$i<$doc;$i++)
					{
					?>
           
                        <section class="no-padding">
							<ul class="list">
								<LI title='<?php echo $sel_res['user'][$i];?>'>
									<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
								
                                
                                <li>
                                	<?php //if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </li>
								<li>
									<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
								<li>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</li>
                                <li>
									<a title='<?php echo $sel_res['address'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
                                
								<li>
									<!--<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
								}
                                
                    ?>
                   
                   <?php
                              }
                            
							
                            

			if ($patient>0 && ($doc>0 || $doc==0))
			{
				$flag++;
				//echo "jdvh";
			//echo $patient;
			
			//echo "Patient Detail";	
			?>
			<div class="box-head-light"><span class="file-16"></span><h3>Patient Detail</h3></div>
			<?php	
					for($i=$doc;$i<($patient+$doc);$i++)
					{
					?>
           
                        <section class="no-padding">
							<ul class="list">
								<LI title='<?php echo $sel_res['user'][$i];?>'>
									<a href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['user'][$i])){echo compressDetail($sel_res['user'][$i],$GLOBALS['pcno']);}else{echo "-----";}?></a>
								
                                
                                <li>
                                	<?php //if(isset($sel_res['gender'][$i])){echo $sel_res['gender'][$i];}else{echo "-----";}?>
                                </li>
								<li>
									<a title='<?php echo $sel_res['email'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['email'][$i])){echo compressDetail($sel_res['email'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
								<li>
									<span class="red"><?php if(isset($sel_res['phno'][$i])){echo $sel_res['phno'][$i];}else{echo "-----";}?></span>
								</li>
                                <li>
									<a title='<?php echo $sel_res['address'][$i];?>'href="print_patient_detail.php?pid=<?php echo $sel_res['id'][$i];?>"><?php if(isset($sel_res['address'][$i])){echo compressDetail($sel_res['address'][$i],$GLOBALS['ecno']);}else{echo "-----";}?></a>
								</li>
                                
								<li>
									<!--<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
						</section>
						
											
							<?php
								}
                        }
						
					if ($flag==0)
				{
					?>
                           				<section>
	                            
		<div class="alert-msg error-msg" align="center">No Search Data Found.</div>
	
	
	</section>
	<?php
				}
                               
				}
				else
				{
					?>
                           				<section>
	                            
		<div class="alert-msg error-msg" align="center">No Search Data Found.</div>
	
	
	</section>
	<?php
				}
                            ?>
                      
				</form>
			</div>
		</div>
	</div>
</div>
<script src="../../Doctors helper with design/js/jquery.min.js" type="text/javascript"></script>
<script src="../../Doctors helper with design/js/multiselect.js" type="text/javascript"></script>
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