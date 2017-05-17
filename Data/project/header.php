<?php
	
	//session_start();
	//print_r($_SESSION);
	//print_r($_SERVER);
?>
<div id="container">
	<header>
		<div class="bit-6" id="header">
			<A id="logo"></A>
		</div>
		<div id="main-navigation" class="bit-2">
			<ul>
				<LI><A href="appointment_reg.php" <?php if($str=="appointment"){echo "class='active'";}?>><SPAN class="calendar-32" title="">Appoinment</SPAN></A></LI>
				<LI><A href="patient_search.php" <?php if($str=="patient"){echo "class='active'";}?>><SPAN class="users-32" title="">Patient</SPAN></A></LI>
				
			</ul>
		</div>
		<div class="bit-6">
		<div id="profile111">
			<div id="user-data">
				<?php
            	if(isset($_SESSION['cid']))
				{
					
					
					echo "Welcome:".$_SESSION['uname'];
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
					<li><a class="notifications-16 tt-top-center" title="Notifications"><span class="notification">2</span></a></li>
					<!--<li><a class="messages-16 tt-top-center"><span class="notification">3</span></a></li>-->
					<li><a class="settings-16 tt-top-center" title="Settings" href="change_password.php"></a></li>
					<li><a class="profile-16 tt-top-center" href="user_profile.php" title="Profile Detail"></a></li>
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
		<div id="sub-navigation">
			
			<ul>
				<li><a class="tt-top-center">
				<?php 
				$ta=totalAppointment($_SESSION['cid']);
				echo $ta;
				?></a><span>Total Appointment</span></li>
				<li><a class="blue tt-top-center">
				<?php 
				$ca=compliteAppointment($_SESSION['cid']);
				echo $ca; 
				?></a><span>Complite Appointment</span></li>
				<li><a class="green tt-top-center">
				<?php
				$ra=$ta-$ca;
				echo $ra;
				?>
				 </a><span>Remaining Appointment</span></li>
			</ul>

			<div id="navigation-search">
				<form action="global_search.php" method="post">
					<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" name="text" id="search" placeholder="Search" type="text" required="required" title="You can search in two way Ex 1) Name or phone_no or email Ex 2) Name,phone_no or phone_no,Name">
				</form>
			</div>
		</div>
	</div>
</div>
