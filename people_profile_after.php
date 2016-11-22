<!DOCTYPE html>
<html>
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_style.css">
	</head>
	<body>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><img src="../images/temp_pp.png"></li>
			</ul>
		</div>
		<div class="headerprofile">
			<div id="coverphoto" style="background-image: url(images/pp_cover/clyde2cover.jpg);">
				<div id="info">
					<img src="images/pp_cover/clyde2.jpg" id="user-photo">
					<h1 id="username">XON_123</h1>
					<a href="#">Following: 111</a>
					<a href="#">Followers: 0</a>
				</div>
			</div>
			<div id="aboutme">
				<p>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<h1>ABOUT ME</h1>
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