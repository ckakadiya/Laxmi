<?php
if (isset($_SESSION['username']))
{
?>
<div id="container">
	<header>
		<div class="bit-6" id="header">
			<A id="logo"></A>
		</div>
		
		<div class="bit-6">
		<div id="profile111">
			<div id="user-data">
				<?php
            	if(isset($_SESSION['adminid']))
				{
					echo "Welcome:".$_SESSION['username'];
				}
				else
				{
				?>
                    	Please&nbsp;Login&nbsp;User
				<?php
				}
				?>
			</div>
			<div class="clearfix"></div>
			<div id="user-notifications">
				<ul id="user-notifications">
					<li><a id="logout" class="logout-16 tt-top-center" href="logout.php" title="Logout">logout</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div>
		</div>
	</header>
</div>
<div id="container">
	<div class="bit-1">
    <hr />
	</div>
</div>
<?php
}
else
	header("Location:allCustomer.php");
?>