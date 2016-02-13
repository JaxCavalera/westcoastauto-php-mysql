<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>West Coast Auto</title>

<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/about.css" rel="stylesheet" type="text/css">


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
					<li><a href="about.php" class="current">About</a></li>
					<li><a href="catalogue.php">Used Vehicles</a>
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
		About West Coast Auto
		</h1>
	</div>

<!--Main Content div is where the actual content of each page will reside-->	
	<div id="main_content">
	
<!--Main Page Content is Displayed here-->		
		<div id="about_content">
			<p>
			The following belongs on the About page : <br>
			West Coast Auto is a family owned car dealership operated by Vaughn and Collette Dennis.  
			They deal in both new and used vehicles and have been in operation since 1975.  
			After starting as a car detailer and then salesman in the family business Vaughn took over the dealership from his father in 2003.  
			From here both Vaughn and Collette have progressively expanded the business ensuring that their staff have the same passion for customer service as they do.<br><br>
			Vaughn and Collette take a hands on approach to the business to ensure they offer the highest level of customer service and satisfaction possible.
			</p>
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
