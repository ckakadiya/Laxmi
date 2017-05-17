<?php
	session_start();
	include_once "function.php";	
	$cid=$_SESSION['cid'];		
	$vdid=$_POST['txtvdid'];
	//echo $cid,$vdid;
	print_r($_POST);
	$vdcid=vd_time($cid,$_POST);
	header("Location: visit_doc_reg_proc.php?vdid=".$vdid);
	
?>
