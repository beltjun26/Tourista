<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta name="Maynard Vargas and Rosjel Jolly Lambungan" content="Search results places">
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
				<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
			</ul>
		</div>
		<div class="container">
			<div class="search-filter">	
				<h2 class="label result">You have searched for something. something results</h2>
				<ul>
					<li><a href="#" class="active">PLACES</a></li>
					<li><a href="search_results_people.php">PEOPLE</a></li>
				</ul>
			</div>	
			<div class="results-container">
				<div class="result-place">
					<a class="place-link" href="place.php">
						<img class = "place-photo" src="images/body_background2.png" alt="filler image">
					</a>
					<h2 class="place-name">MIAG-AO CHURCH</h2>
				</div>
				<div class="result-place">
					<a class="place-link" href="place.php">
						<img class = "place-photo" src="images/body_background2.png" alt="filler image">
					</a>
					<h2 class="place-name">MIAG-AO CHURCH</h2>
				</div>
				<div class="result-place">
					<a class="place-link" href="place.php">
						<img class = "place-photo" src="images/body_background2.png" alt="filler image">
					</a>
					<h2 class="place-name">MIAG-AO CHURCH</h2>
				</div>
				<div class="result-place">
					<a class="place-link" href="place.php">
						<img class = "place-photo" src="images/body_background2.png" alt="filler image">
					</a>
					<h2 class="place-name">MIAG-AO CHURCH</h2>
				</div>
				<div class="result-place">
					<a class="place-link" href="place.php">
						<img class = "place-photo" src="images/body_background2.png" alt="filler image">
					</a>
					<h2 class="place-name">MIAG-AO CHURCH</h2>
				</div>
			</div>
		</div>
	</body>
</html>