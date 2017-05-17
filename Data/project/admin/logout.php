<?php
	session_start();
	unset( $_SESSION['adminid'] );
	header("Location:login.php");
	//echo "loooo";
?>