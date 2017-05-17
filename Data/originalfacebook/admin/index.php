<?php
session_start();
unset($_SESSION['fbadmin']);
?>
<html>
<head>
<title> Facebook Admin </title>
<link href="fb_font/font.css" rel="stylesheet" type="text/css">
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.ico" />
<style>
#login_button
{
	font-size:15px;
	height:35;
	width:100;
	padding:2;
	background-color:#5B74A8; 
	color:#FFFFFF;
	border-top:#29447E;
	border-right-color:#29447E;
	border-bottom-color:#1A356E;
	border-left-color:#29447E;
	font-weight:bold;
	box-shadow:0px 0px 5px 2px rgb(0,0,0);
}
#go_to_fb
{
	font-size:15px;
	height:35;
	width:200;
	padding:2;
	background-color:#CCC; 
	color:#000;
	border-top:#29447E;
	border-right-color:#29447E;
	border-bottom-color:#1A356E;
	border-left-color:#29447E;
	font-weight:bold;
	box-shadow:0px 0px 5px 2px rgb(0,0,0);
}
</style>
</head>
<body>

<!--head background-->
    <form  method="post">
	<div style="position:absolute;left:0%;top:0%; height:13.2%; width:100%; z-index:-1; background:#3B5998">   </div>
	<!--text: faceback -->
	<div style="position:absolute;left:36%; top:3.3%; font-size:45; font-weight:900; color:#FFFFFF; font-weight:bold; box-shadow:0px -10px 20px 1px rgb(0,0,0);"> <font face="myFbFont"> facebook Admin </font> </div>
	<!--body background-->
	<div style="position:absolute;left:0%;top:13.2%; height:90%; width:100%; z-index:-1; background:#EDF0F5">   </div>
	<!--bottam background-->
	<div style="position:absolute;left:0%;top:110%; height:5%; width:100%; z-index:-1; background:#FFFFFF">   </div>
    
    <div style="position:absolute; left:10%; top:15%;"> <img src="img/fb1.png" width="500" height="500"> </div> 
    
    <div style="position:absolute;left:60%;top:26%; height:60%; width:30%; background:#FFF; box-shadow:0px 0px 10px 3px rgb(21,57,147);">   </div>
    
    <div style="position:absolute;left:70.5%; top:28%; font-size:45; font-weight:900; color:#3B5998; font-weight:bold;">  Login </div>
    
     <div style="position:absolute;left:60%;top:39%; height:2%; width:30%; background:#0F3; box-shadow:0px 0px 10px 3px rgb(21,57,147);">   </div>
     
     <div style="position:absolute;left:62%; top:45%; font-size:25; font-weight:900; color:#3B5998; font-weight:bold;">  Username </div>
     <div style="position:absolute; left:62%; top:50%;  "> <input type="text" name="username" style="width:350; height:40; font-size:20px;"/> </div>
     <div style="position:absolute;left:62%; top:58%; font-size:25; font-weight:900; color:#3B5998; font-weight:bold;">  Password </div>
     <div style="position:absolute;left:62%; top:63%; font-size:13px; "> <input type="password" name="password" style="width:350; height:40; font-size:20px;"> </div>
     <div style="position:absolute;left:80.5%;top:75%; ">  <input type="submit" name="login" value="Log In." id="login_button" />  </div>
    </form>
     	<div style="position:absolute;left:62%;top:75%; "> <a href="http://localhost/facebook/index.php" id="go_to_fb">Go back to Facebook</a> </div>
 </body>
</html>
<?php
if(isset($_POST['login']))
{
	$con=mysql_connect("localhost","root","")or die("DB connection Error");;
	mysql_select_db("faceback",$con)or die("DB selection Error");

	$u=$_POST['username'];
	$p=$_POST['password'];
	
	$q=mysql_query("select * from admin_info where Username='".$u."' and Password='".$p."'",$con) or die("Query error");;
	
	while($row=mysql_fetch_array($q))
	{
		if($row['Username']==$u && $row['Password']==$p)
		{
			$_SESSION['fbadmin'] = $u;
			echo '<script type="text/javascript">alert("Log in successfull");';
			echo 'window.location.href="fb_home/Home.php"';
			echo '</script>';
		}
		else
		{
			echo "<script>alert('Wrong UserID or Password');</script>";
		}
	}
?>