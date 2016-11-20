<!DOCTYPE html>
<html>
	<head>
		<title>TourisTA! - Homepage</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_style_before.css">
	</head>
	<body>

<?php	
	$host = 'localhost';  
	$username = 'root'; 
	$password = ''; 
	$db = 'database_name'; 
	$dbconn = mysqli_connect($host,$username,$password) or die("Could not connect to database!"); 
	mysqli_select_db($dbconn, 'tourista') or die( "Unable to select database");
	?>



		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search...">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"> HOME </a></li>
				<li><a href="visit.php"> VISITS </a></li>
				<li><a href="#"> EXPLORE </a></li>
				<li><a href="notifications.php"> NOTIFICATIONS </a></li>
				<li><a href="login.php"> LOGOUT </a></li>
				<li><img src="images/temp_pp.png"></li>
			</ul>
		</div>
		<div class="container">	
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/cover_photo3.png">
					<h1 id="username">XON_123</h1>
				</div>
				<div id="userphoto">
					<img src="images/pp_cover/clyde1.jpg">
				</div>
				<div id="follows">
					<p>Following: 111</p>
					<p>Followers: 0</p>
				</div>
				<div id="aboutme">
					<h1>ABOUT ME:</h1>
					<br>
					<p>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<h2 class="user-options">USER OPTIONS</h2>
					<ul class="user-options">
						<li><a href="#">Feed</a></li>
						<li><a href="#">Visits</a></li>
						<li><a href="#">Starred Places</a></li>
						<li><a href="#">Followers</a></li>
						<li><a href="#">Following</a></li>
						<li><a href="#">Notifications</a></li>
						<li><a href="#">Edit Profile</a></li>
					</ul>
				</div>
				<div class="col-sm-6">
					<div class="posting-container">
						<h2>POST SOMETHING NEW?</h2>
						<div class="col-sm-2">
							<img src="images/pp_cover/clyde1.jpg" alt="USER PHOTO">
						</div>
						<div class="col-sm-10">
							<a href="#">ADD A PHOTO</a>
							<form action="output.php" method="get">
								<textarea id="post-text-area" cols="50" rows="5" placeholder="TEXT HERE..."></textarea>
								<input type="text-field" placeholder="LOCATION TAG AUTOFILL">
							 	<input type="submit" value="POST">
							</form>
						</div>
					</div>
					<div class="posted-container">
						<img src="images/pp_cover/clyde1.jpg" alt="USER PHOTO" id="pp">
						<h2 class="user-name">XON_123</h2>
						<img src="images/Body_Background.png">
						<div class="col-sm-10">
							<p class = "posted-text">Miag-ao Church.</p>
							<a href="#" class="tagged-location">MIAG-AO CHURCH</a>
						</div>
						<div class="col-sm-2">
							<button>LIKE</button>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<h2 class="visitor-options">VISITOR OPTIONS</h2>
					<ul class="visitor-options">
						<li><a href="#">Request for a tour</a></li>
						<li><a href="#">Follow Xon_123</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>