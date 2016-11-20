<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TourisTA! - Search Results</title>
		<meta name="Maynard Vargas and Rosjel Jolly Lambungan" content="Search results people">
		<meta name="James Anthony Yatar" content="Navigation Bar">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/search_style.css">
	</head>
	<body>
		<div id = "navBar">
			<form action="test.php" method="get">
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
			<div class="search-filter">	
				<h2 class="label result">You have searched for something. something results</h2>
				<ul>
					<li><a href="search_results_places.php">PLACES</a></li>
					<li><a href="#" class="active">PEOPLE</a></li>
				</ul>
			</div>
			<div class="results-container">
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/ace1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">ACE_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/Andrew1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">AND_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/diana1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">DIA_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/donn1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">DON_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/jing1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">JIN_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/Maynard1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">NARD_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/rollin1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">ROL_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/rosiebelt1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">BELT_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/rosjel1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">ROS_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/salvy1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">SALV_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="#">
						<img src = "images/pp_cover/shebna1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="#" class = "username-link"><h2 class="username">SHEB_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
				<div class="result-people">
					<a class="userphoto-link" href="people_profile.php">
						<img src = "images/pp_cover/clyde1.jpg" alt="user image">
					</a>
					<div class = "user-details">
						<a href="people_profile.php" class = "username-link"><h2 class="username">XON_123</h2></a>
						<p>Lorem ipsum dolor sit amet, consectetur...</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>