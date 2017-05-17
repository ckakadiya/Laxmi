<?php
	include_once "function.php";
	$result=sel_description($_POST);
	print_r($result['description']);
?>
