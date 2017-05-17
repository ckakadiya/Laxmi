<?php

	if($_POST['state_id'])
	{
		include_once("connect.php");
		include_once("function.php");
		$arr_res_city=selCity($_POST['state_id']);
		
					for($i=0;$i<count($arr_res_city);$i++)
					{
						
                        	$op="<option value='".$arr_res_city[$i]['id']."' >".$arr_res_city[$i]['city_name']."</option>";
							$opt=$opt.$op;
                        
						
					}
					echo $opt;
	}
	
?>