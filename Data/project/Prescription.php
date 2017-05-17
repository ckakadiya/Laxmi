<?php
	if(isset($_REQUEST['pid']))
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prescription</title>
</head>
<body>
<h1>Prescription</h1><hr />
<table>
	<tr>
    	<td>Dieses Name : </td>
        <td><input list="diesesname" name="dname"/>
        <datalist id="diesesname">
         <?php
		 	$array_dieses=dieses();
			for($i=0;$i<count($array_dieses['name']);$i++)
			{
					echo "<option value=".$array_dieses['name'][$i].">";
			}
		 ?>
        </datalist><br />
        </td>
    </tr>
    <tr>
    	<td>Medicine Name : </td>
        <td>
		<input list="medicinename" name="mname"/>
        <datalist id="medicinename">
         <?php
		 	$array_medicine=medicine();
			for($i=0;$i<count($array_medicine['name']);$i++)
			{
					echo "<option value=".$array_medicine['name'][$i].">";
			}
		 ?>
        </datalist><br /></td>
    </tr>
    <tr>
    	<td>
        	No Of Time : 
        </td>
        <td>
        	<input type="text" placeholder="0-0-0" name="no_of_time" />
        </td>
    </tr>
    <tr>
    	<td>
        	Qty : 
        </td>
        <td>
        	<input type="text" placeholder="Qty." name="qty" />
        	
    </tr>
    <tr>
    	<td>
        	Pre-Treatement :  
        </td>
        <td>
        	<input type="file" name="pretreatement" multiple="multiple" />
        </td>
    </tr>
        <tr>
    	<td>
        	Post-Treatement :  
        </td>
        <td>
        	<input type="file" name="posttreatement" multiple="multiple" />
        </td>
    </tr>
        <tr>
    	<td colspan="2">
        	<input type="submit" name="submit"  value="Submit"/>
        </td>
    </tr>
</table>
</center>
</body>
</html>
<?php
	}
	else
	{
			header("location:profile.php");
	}
?>