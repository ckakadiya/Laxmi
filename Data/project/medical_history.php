<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_today";
		include_once("connect.php");
		include_once("function.php");
		$sel_medical=medicalHistory($_REQUEST['pid']);
		//echo "`````";
		//print_r($sel_medical);
		if(isset($_POST['dieses_submit']))
		{
			//echo "ffff";
			$arr_mh_ins=array();
			$arr_mh_ins['pid']=$_REQUEST['pid'];
			$arr_mh_ins['dieses']=$_POST['dieses'];
			$arr_mh_ins['description']=$_POST['description'];
			//print_r($arr_mh_ins);
			$ins_res=medicalHistoryIns($arr_mh_ins);
			if($ins_res['result']==1)
			{
					echo "insert success";
					$sel_medical=medicalHistory($_REQUEST['pid']);
			}
			else
			{	
					echo $ins_res['result'];
			}
		}
		if(isset($_POST['presubmit']))
		{
			
			$prescription=array();
			$prescription['aid']=$_REQUEST['aid'];
			$prescription['pid']=$_REQUEST['pid'];
			$prescription['dname']=$_POST['dname'];
			$prescription['mname']=$_POST['mname'];
			$prescription['not']=$_POST['no_of_time'];
			$prescription['qty']=$_POST['qty'];
			$prescription['des']=$_POST['description'];
			$prescription['nextapp']=$_POST['nextapp'];
			$prescription['longtreat']=$_POST['longtreat'];
			//print_r($prescription);
			$ins_res=insPrescription($prescription);
		}

?>
<html>
	<head><TITLE>Medical history</TITLE>
	<link href="css/c1.css" rel="stylesheet" type="text/css">
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<meta charset="utf-8">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<LINK type="text/css" href="css/skeleton.css" rel="StyleSheet">
	<LINK type="text/css" href="css/base.css" rel="StyleSheet">
	<LINK type="text/css" href="css/style.css" rel="StyleSheet">
	<LINK type="text/css" href="css/table.css" rel="StyleSheet">
	<LINK type="text/css" href="css/multiselect.css" rel="StyleSheet">
	<script src="js/jquery.js" language="JavaScript"></script>
	<script src="js/jq.js" language="JavaScript"></script>
	<script language="javascript">
		$(document).ready(function() {
			if($('#apointment_box').text()!="")
			{
				$('#main1').css("display","block");
				$('#apointment_box').css("display","block");
			}
			$('.close').click(function()
			{
				$('#main1').css("display","none");
				$('#apointment_box').css("display","none");

			})
		});
</SCRIPT>
<?php include_once("datepicker/dropdown-month-year.php");?>
</head>
<BODY>
<?php include_once("header.php");?>
<div id="container">
	<?php include_once("app_menu.php");?>
	
	
	<div class="bit-14"  id="'apointment_box">
		<div class="box-element">
			<div class="box-head-light"><span class="data-16"></span><h3>Treatment</h3></div>
            <br>
            <div class="box-head-light" ><h3>Medical History</h3></div>
			<div class="box-content no-padding">
            
				<form novalidate method="post" action="medical_history.php" class="i-validate"> 
                <input type="hidden" name="aid" value="<?php echo $_REQUEST['aid']; ?>"/>
				<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"/>
                <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"/>
              
					<fieldset>
                    
						<section>
							<div class="section-input"><input name="dieses" id="text_field" class="i-text required wid" list="dieses" placeholder="Dieses Name">
                  <datalist id="dieses">
				 <?php 		 	
					$array_dieses=dieses();
					for($i=0;$i<count($array_dieses['name']);$i++)
					{
							echo "<option value=".$array_dieses['name'][$i].">";
					}
				 ?>
        	</datalist>
         <br>  
                            </div>
							<div class="section-input"><input name="description" id="text_field" class="i-text required wid" type="text" placeholder="Discription."></div>
							
							<input  class="i-button no-margin" name="dieses_submit" value="Save" type="submit" style="float:left;">
							<div class="clearfix"></div>
						</section>
                      </fieldset>
				</form>	
				 
						 <?php
							if($sel_medical['res']==0)
							{
							?>
                            
                            <section class="no-padding">
							<ul class="list">
								<li class="wid-auto">
								None Of Medical History..
                                </li>
								<li>
                                </li>
							</ul>
							<div class="clearfix"></div>
                            
						</section>
							
							
                         <?php   
                            }
							else
							{
						?>
                        	<section class="no-padding">
							<ul class="list">
								<li>
									<h4>Dieses</h4>
								</li>
							
								<li>
									<h4>Discription</h4>
								</li>
                                <li>
                                </li>
                                <li></li>
								
							</ul>
							<div class="clearfix"></div>
                            
						</section>

                        <?php
								
								for($i=1;$i<=count($sel_medical['dieses_name']);$i++)
								{
						?>		
                        
                            <section class="no-padding">
							<ul class="list">
								<li>
									
								</li>
								<li>
									<?php echo $sel_medical['dieses_name'][$i];?>
								</li>
								<li>
									<span class="red"><?php echo $sel_medical['description'][$i];?></span>
								</li>
								<li>
									
								</li>
							</ul>
							<div class="clearfix"></div>
                            
						</section>
                        

								
                         <?php		
								}
				
							}
						?>
			</div>
            <br>
            <div class="box-head-light" ><h3>Treatment Details</h3></div>
			<div class="box-content no-padding">
				<?php
						$treatment=array();
						$treatment['cid']=$_SESSION['cid'];
						$treatment['pid']=$_REQUEST['pid'];
					//	print_r($treatment);
						$sel_result=selTreatment($treatment);
						if(isset($sel_result['result']) && $sel_result['result']==1  )
						{
				?>
							<section class="no-padding">
							<ul class="list">
								<li>
									<h4>Treatment No</h4>
								</li>
							
								<li>
									<h4>Treatment Date</h4>
								</li>
                                <li>
                                </li>
                                <li></li>
								
							</ul>
							<div class="clearfix"></div>   
							</section>

							<?php
							
							$c=count($sel_result)-1;
							//print_r($sel_result);
							//echo $c;
							$j=1;
							for($i=0;$i<$c;$i++)
							{
							?>
                           	<section class="no-padding">
							<ul class="list">
								<li>
									
								</li>
								<li>
									<?php echo $j=$j+$i;?>
								</li>
								<li>
									<span class="red"><a href="treatment_detail.php?tid=<?php echo $sel_result[$i]['id']?>"><?php echo $sel_result[$i]['date']?></a></span>
								</li>
								<li>
							<!--		<div class="l-float"><input class="icon16 edit-16" value="" type="button"></div>
									<div class="l-float"><input class="icon16 cancel-16" value="" type="button"></div>-->
								</li>
							</ul>
							<div class="clearfix"></div>
                            
						</section>
								<tr>
								<td></td>
								<td></td>
								</tr>
							<?php 
							}
						}
						else
						{
							?>
                            <section class="no-padding">
							<ul class="list">
								<li class="wid-auto">
								None Of privious Treatment..
                                </li>
								<li>
                                </li>
							</ul>
							<div class="clearfix"></div>
                            
						</section>
                            <?php

						}
					?>
            </div>
            <br>
            <div class="box-head-light" ><h3>Prescription</h3></div>
			<div class="box-content no-padding">
                        <form novalidate method="post" action="medical_history.php" class="i-validate" enctype="multipart/form-data"> 
                       	<input type="hidden" name="aid" value="<?php echo $_REQUEST['aid']; ?>"/>
						<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"/>
                        <fieldset>
                       
                       <section class="no-padding" id="tblmedicine"> 
					<div class="section-input"><input id="text_field" class="i-text required wid" list="diesesname" name="dname" placeholder="Dieses Name">
                    <datalist id="diesesname">
         			<?php
					 	$array_dieses=dieses();
						for($i=0;$i<count($array_dieses['name']);$i++)
						{
								echo "<option value=".$array_dieses['name'][$i].">";
						}
					 ?>
			        </datalist>
                    
                    </div><br><br><br>
                 <div class="section-input"><input id="text_field" class="i-text required wid" list="medicinename" name="mname[]" placeholder="Medicine Name">
                 <datalist id="medicinename">
		         <?php
				 	$array_medicine=medicine();
					for($i=0;$i<count($array_medicine['name']);$i++)
					{
							echo "<option value=".$array_medicine['name'][$i].">";
					}
				 ?>
		        </datalist>
		        </div>
        
        		<div class="section-input">
                <input id="text_field" class="i-text required wid" name="no_of_time[]" placeholder="NO Of Time:1-1-1">								
                 </div>
                 <div class="section-input">
                <input id="text_field" class="i-text required wid" name="qty[]" placeholder="Qty.">								
                 </div>
                <input  class="i-button no-margin" id="addmore" value="Add More" type="button" style="float:left;">
                 <div class="clearfix"></div>
                 </section>   <br>
  
                <div class="section-input">
                <textarea rows="10" name="description" id="textarea" class="i-text" placeholder="Syntomes"></textarea>
                 </div>
                 <div class="section-input">
                <input type="file" name="pretreatment[]" multiple  class="i-text" title="Pre-Treatment Image"/>
                 </div>
                 <div class="section-input">
                <input type="file" name="posttreatment[]" multiple class="i-text" title="Post-Treatment Image"/>
                 </div>
                 <div class="checkbox section-right">
                <input type="text" name="nextapp" class="i-text wid" id="datepicker" placeholder="Next checkup Appointment Date"/>

                <input type="checkbox" name="longtreat" value="1"  id="male"/><label for="male" class="lblchk" >Check If treatment is Pending</label>
                 </div>
                 <div class="clearfix"></div> 
                                
                 				<input  class="i-button no-margin" name="presubmit" value="submit" type="submit" style="float:left;">

                              </fieldset>
                        </form>	
                
            </div>
        </div>
        </div>
        </div>
        
    </div>
 </div> 	
	
</center>
</BODY>
</html>
<?php
	}
	else
	{
			header("location:login.php");
	}
?>