<?php
	session_start();
	if(isset($_SESSION['cid']))
	{
		$str="appointment";
		$menu="app_today";
	if(isset($_REQUEST['tid']))
		{
			
			include_once("function.php");
			$treatment=array();
			$treatment['cid']=$_SESSION['cid'];
			$treatment['tid']=$_REQUEST['tid'];
	//		print_r($treatment);
			$res_treatment_detail=selTreatmentDetail($treatment);

//			print_r($res_treatment_detail);
	
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
	<?php include_once("app_menu.php");?>
	<div class="bit-14">
	<div class="box-element">
			<div class="box-head-light"><h3>Treatment</h3><a href="" class="collapsable"></a></div>
			<div class="box-content no-padding">
			<fieldset>
			
			<table class="i-table fullwidth" >
				<thead>
				<tr>
					<td>Dieses</td>
					<td>medicine</td>
					<td>Qty</td>
					<td>No of Time</td>
					<td>Discription</td>
				</tr>
				</thead>
				<tbody>
				<?php
					$cnt=count($res_treatment_detail);
					for ($i=0;$i<$cnt;$i++)
					{
						$c=count($res_treatment_detail[$i]['mname']);
						
				?>
				<tr class="dark">
					
					<?php
						for($j=0;$j<$c;$j++)
						{
							if($j==0)
							{
								echo "<td rowspan=".$c.">".$res_treatment_detail[$i]['dname']."</td>";
							}
							
					?>
					
					<td><?php echo $res_treatment_detail[$i]['mname'][$j]; ?></td>
					<td><?php echo $res_treatment_detail[$i]['qty'][$j]; ?></td>
					<td><?php echo $res_treatment_detail[$i]['not'][$j]; ?></td>
					<td><?php echo $res_treatment_detail[$i]['description'][$j]; ?></td>
					</tr>	
					<?php
						}
					?>
						
				<?php 
					}
				?>
				</tbody>
				</table>
				</fieldset>
				
				
				
			<table border="1px" class="i-table fullwidth">
			<thead>
				<tr>
					<td colspan="3">Pre-Treatment Image</td>
				</tr>
			</thead>	

		<?php
			$img=selImage($treatment);
			if(isset($img['preimg']))
			{
			$img_count=count($img['preimg']);
		?>
       			
        <tr>
        	<?php
				$c=0;
				for($i=0;$i<$img_count;$i++)
				{
					$c++;
			?>
					<td>	
					<img src="<?php echo $img['preimg'][$i]['path']."/".$img['preimg'][$i]['name']; ?>" height="10px" width="50px"/> 
					</td>
			<?php
				if($c==3)
				{
					echo "</tr>";
					$c=0;
				}
				}
			}
			else
			{
				echo "<td><div class='alert-msg info-msg'>No images avelabal </div></td>";
			}
			?>
      
		  </table>
        
				
			<table border="1px" class="i-table fullwidth">
			<thead>
				<tr>
					<td colspan="3">Post-Treatment Image</td>
				</tr>
			</thead>	
        <?php
			$imge=selImage($treatment);
			if(isset($imge['postimg']))
			{
			$img_count=count($imge['postimg']);
		?>
      
        <tr>
        	<?php
				$c=0;
				for($i=0;$i<$img_count;$i++)
				{
					$c++;
			?>
					<td>	
					<img src="<?php echo $img['postimg'][$i]['path']."/".$img['postimg'][$i]['name']; ?>" height="10px" width="50px"/> 
					</td>
					
			<?php
					if($c==3)
					{
						echo "</tr>";
						$c=0;
					}
				}
			}
			else
			{
				echo "<td><div class='alert-msg info-msg'>No images avelabal </div></td>";
			}
			?>
          
        </table>
			</div>
		</div>
		</div>
</div>
</BODY>
</html>
<?php
	}
}
?>