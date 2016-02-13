<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>West Coast Auto</title>

<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/catalogue.css" rel="stylesheet" type="text/css">


<!-- Php Includes and Requireds-->

<?php
require_once 'code/core/init.php';

?>

</head>

<body>

<div id="container">

<!--Header will contain the logo and main menu plus user login section-->
	<header>
		<div id="wca_logo">
			<img src="images/west_coast_auto_logo.jpg" alt="West Coast Auto Logo">
			<div id="contact_info">
				<p>
					West Coast Auto<br>
					375 Albany Hwy<br>
					Victoria Park<br>
					Perth WA 6100<br>
					Ph: 08 9415 1234
				</p>
			</div>
		</div>
		
<!--Menu contents is located below this point-->		
		<div id="menu_bar">
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="catalogue.php" class="current">Used Vehicles</a>
						<ul>
							<li><a href="catalogue_specials.php">Specials</a></li>						
						</ul>
					</li>
					<li><a href="finance.php">Finance</a>
						<ul>
							<li><a href="insurance.php">Insurance</a></li>
						</ul>
					</li>
					<li><a href="testimonials.php">Testimonials</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="privacy.php">Privacy</a></li>
				
<!--Control Panel only appears to users who have logged in and access to child pages will be based on permissions as outlined in the server-->
					<?php
						if (session_check())
						{
							$staff_id = $_SESSION['id'];
							$db = new db;
							
							if ($db->security_check($staff_id))
							{
								include 'code/includes/secure_1.php';
							}
						}
					?>
<!--End of the Secure Menu Items-->
				</ul>
			</nav>
<!--Login area for West Coast Auto Staff-->		
			<div id="login_panel">
				<?php
				
				if (session_check())
				{
					include 'code/includes/logout_form.php';
				}
				else
				{
					include 'code/includes/login_form.php';
				}
								
				?>
			</div>
		</div>
	</header>
	
<!--Description div will usually be a duplicate of the page title in larg-ish letters-->	
	<div id="description">
		<h1>
			Used Vehicles
		</h1>
	</div>

<!--Main Content div is where the actual content of each page will reside-->	
	<div id="main_content">
	
<!--Main Page Content is Displayed here-->
<!--The left content div will hold all the filter settings which change the vehicles displayed in the right_content_div-->
		<div id="left_content_div">
			<?php
			
			include 'code/includes/car_filter_form.php';
			
			?>
		</div>

<!--This is where the results to filters are displayed-->
		<div id="right_content_div">
			<?php
			
			include 'code/includes/results_table.php';
			
			?>
		</div>
	</div>

<!--Copyright, Privacy and other Documentation goes here-->	
	<footer>
		<p>
		© <?php $today = getdate();
		echo "$today[year]";
		?>
		 West Coast Auto
		</p>
	</footer>
</div>
</body>

</html>
