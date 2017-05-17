
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
					<!--<li><a class="notifications-16 tt-top-center" title="Notifications"><span class="notification">2</span></a></li>-->
					<!--<li><a class="messages-16 tt-top-center"><span class="notification">3</span></a></li>-->
					<!--<li><a class="settings-16 tt-top-center" title="Settings"></a></li>
					<li><a class="profile-16 tt-top-center" href="user_profile.php" title="Profile Detail"></a></li>-->
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
		<!--<div id="sub-navigation">
			</div>
			<ul>
				<li><a class="tt-top-center">20</a><span>Remaining Appointment</span></li>
				<li><a class="blue tt-top-center">5</a><span>Complite Appointment</span></li>
				<li><a class="green tt-top-center">25</a><span>Total Appointment</span></li>
			</ul>

			<div id="navigation-search">
				<form>
					<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" name="search" id="search" placeholder="Search" type="text">
				</form>
			</div>
			<a class="comment-16 tt-top-center" id="show-modal">modal</a>
			<a class="info-16 tt-top-center" id="add-notify">notifications</a>
			<div class="clearfix"></div>

		</div>-->
	</div>
</div>
