<?php 
	
		require "connect.php";
			
		if (isset($_GET["search"])) {
			$searchVal = $_GET["search"];
			$query = "SELECT * FROM account WHERE username like '%$searchVal%' or firstname like '%$searchVal%' or middlename like '%$searchVal%' or lastname like '%$searchVal%' or email like '%$searchVal%'";		
			$result = mysqli_query ($dbconn, $query);
			$numberR = mysqli_num_rows($result);
		}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
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
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search" value= <?=$searchVal?>>
				<!-- <input type="submit" value="SEARCH" > -->
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
				<h2 class="label result">You have searched for <?=$searchVal?>. <?=$numberR?> results</h2>
				<ul>
					<li><a href="search_results_places.php?search=<?=$searchVal?>">PLACES</a></li>
					<li><a href="#" class="active">PEOPLE</a></li>
				</ul>
			</div>
			<div class="results-container">
				




				<?php foreach ($result as $value) {?>
					<div class="result-people">
						<a class="userphoto-link" href="people_profile.php">
							<img src = "images/profile_pic_img/acc_id_<?=$value['acc_id'] ?>.jpg" alt="user image">
						</a>
						<div class = "user-details">
							<a href="people_profile.php" class = "username-link">
							<h2 class="username"><?php echo $value['firstname']." ".$value['lastname'] ?></h2></a>
							<p><?=$value['about_me'] ?></p>
						</div>
					</div>
				<?php } ?>



			</div>
		</div>
	</body>
</html>