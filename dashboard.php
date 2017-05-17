<?php
session_start();
include_once("header.php");
include_once("Connect.php");
$uEmailId=$_SESSION['username'];
?>


<!--start wrapper-->
<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="page_title">
                        <h2>User Dashboard</h2>
                    </div>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="index.php">Home</a>/</li>
                            <li>Dashboard</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>


<?php
if(isset($_SESSION['username']))
{
	//echo $uEmailId;
	$qry="select * from clients where emailId='$uEmailId'";
	$res=mysql_query($qry) or die(mysql_error());
	$row=mysql_fetch_assoc($res);
	$cId=$row['clientId'];
	
	$qry1="select * from policy where clientId='$cId'";
	$res1=mysql_query($qry1) or die(mysql_error());
	while($row1=mysql_fetch_assoc($res1))
	{
		$name=$row1['fileName'];
		echo "Policy Name : <a href='Admin/pdf/$uEmailId/Policy/$name'>".$row1['policyName']."</a><br>";
	}
	
}
else
{
	header("Location:index.php");
}
?>
</body>
<?php include 'footer.php';?>
</html>


