	<?php
	/********************************************

	For More Detail please Visit: 
	
	http://www.discussdesk.com/download-pagination-in-php-and-mysql-with-example.htm

	************************************************/

	//Make Database connectivity
	include_once "dbConfig.php"; 
	
	include_once "function.php";

	if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;

	$setLimit = 3;
	$pageLimit = ($page * $setLimit) - $setLimit;

	
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
	<title>Download Pagination in PHP and MySql With Example</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />


	<style type="text/css">
	.navi {
	width: 500px;
	margin: 5px;
	padding:2px 5px;
	border:1px solid #eee;
	}

	.show {
	color: blue;
	margin: 5px 0;
	padding: 3px 5px;
	cursor: pointer;
	font: 15px/19px Arial,Helvetica,sans-serif;
	}
	.show a {
	text-decoration: none;
	}
	.show:hover {
	text-decoration: underline;
	}


	ul.setPaginate li.setPage{
	padding:15px 10px;
	font-size:14px;
	}

	ul.setPaginate{
	margin:0px;
	padding:0px;
	height:100%;
	overflow:hidden;
	font:12px 'Tahoma';
	list-style-type:none;	
	}  

	ul.setPaginate li.dot{padding: 3px 0;}

	ul.setPaginate li{
	float:left;
	margin:0px;
	padding:0px;
	margin-left:5px;
	}



	ul.setPaginate li a
	{
	background: none repeat scroll 0 0 #ffffff;
	border: 1px solid #cccccc;
	color: #999999;
	display: inline-block;
	font: 15px/25px Arial,Helvetica,sans-serif;
	margin: 5px 3px 0 0;
	padding: 0 5px;
	text-align: center;
	text-decoration: none;
	}	

	ul.setPaginate li a:hover,
	ul.setPaginate li a.current_page
	{
	background: none repeat scroll 0 0 #0d92e1;
	border: 1px solid #000000;
	color: #ffffff;
	text-decoration: none;
	}

	ul.setPaginate li a{
	color:black;
	display:block;
	text-decoration:none;
	padding:5px 8px;
	text-decoration: none;
	}




	</style>    
	</head>

	<body>

	<div class="navi">
	<?php

	// Your SQL query go here. This query will display all record by setting the Limit.

	$sql = "SELECT * FROM clients LIMIT ".$pageLimit." , ".$setLimit;
	$query = mysql_query($sql);

	while ($rec = mysql_fetch_assoc($query)) {
	?>
	<div class="show"><a href="http://www.discussdesk.com/<?php echo $rec["firstName"];?>.htm" target="_blank"><?php echo $rec['emailId'];?></a></div>
	<?php }	?>
	</div>

	<?php
	// Call the Pagination Function to load Pagination.

	echo displayPaginationBelow($setLimit,$page);
	?>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--********************************************

	For More Detail please Visit: 
	
	http://www.discussdesk.com/download-pagination-in-php-and-mysql-with-example.htm

	************************************************-->

	</body>
	</html>


