<?php
	session_start();
	unset( $_SESSION['cid'] );
	unset( $_SESSION['cname'] );
	unset( $_SESSION['uid'] );
	unset( $_SESSION['uname'] );
	unset( $_SESSION['eid'] );
	header("Location:login.php");
	//echo "loooo";
?>