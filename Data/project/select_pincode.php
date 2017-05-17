<?php

	if($_POST['city_id'])
	{
		include_once("connect.php");
		include_once("function.php");
		$arr_res_pincode=selPincode($_POST['city_id']);
		
					for($i=0;$i<count($arr_res_pincode);$i++)
					{
						
                        	$op="<option value='".$arr_res_pincode[$i]['id']."'>".$arr_res_pincode[$i]['areaname']."-".$arr_res_pincode[$i]['pincode']."</option>";
							$opt=$opt.$op;
                        
						
					}
					echo $opt;
	}
	
?>