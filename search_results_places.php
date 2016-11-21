<!DOCTYPE html>

<html lang="en">
	<head>
	<?php 
	
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$db = 'tourista';
	
				$dbconn = mysqli_connect ($host, $username, $password, $db)
				or die ("Could not connect to database!");
			
			if (isset($_GET["search"])) {
				$searchVal = $_GET["search"];
				
				$query = "SELECT * FROM places WHERE places.name like '%$searchVal%'";		
				$result = mysqli_query ($dbconn, $query);
				$numberR = mysqli_num_rows($result);
			}
	?>
	
	
	
		<title>TourisTA! - Search Results</title>
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
			<form action="search_results_places.php" method="get">
				<input type="text" name = "search" value = <?=$searchVal?> >
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
				<h2 class="label result">You have searched for <?=$searchVal?>. <?=$numberR?> results</h2>
				<ul>
					<li><a href="#" class="active">PLACES</a></li>
					<li><a href="search_results_people.php?search=<?=$searchVal?>&typeSearch=<?=$searchType?>">PEOPLE</a></li>
				</ul>
			</div>	
			<div class="results-container">
				<?php foreach ($variable as $key => $value) {?>
					<div class="result-place">
						<a class="place-link" href="place.php">
							<img class = "place-photo" src="images/body_background2.png" alt="filler image">
						</a>
						<h2 class="place-name">MIAG-AO CHURCH</h2>
					</div>
				<?php } ?>
					

				
			</div>
		</div>
		
	</body>
</html>