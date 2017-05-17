<?php
	$con=mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("newdoctors_helper",$con)or die(mysql_error());
	date_default_timezone_set("Asia/Calcutta");
?>
