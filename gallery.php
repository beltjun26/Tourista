<?php 
	
	session_start();
	if(!isset($_SESSION['userID'])){
				header("Location: login.php");
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tourista!</title>
	<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
	<meta name="Maynard Vargas and Rosjel Jolly Lambungan" content="Homepage">
	<meta name="James Anthony Yatar" content="Navigation Bar">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id = "navBar">
		<form action="search_results_places.php" method="get">
			<input type="text" placeholder="Search..." name="search">
		</form>
		<ul id = "navList">
			<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
			<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
			<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
		</ul>
	</div>
	<div class="container gal">
		<h2>Gallery for -Place-</h2>
		<div class="flex-images">

			<?php 
				require "connect.php";

				$query = "SELECT post_id
						  FROM posted
						  WHERE place_id = {$_GET['place_id']}
						  ;";
				$result = mysqli_query($dbconn, $query);

				foreach ($result as $value) {
			 ?>
			
			<a href="view_post.php?post_id=<?=$value['post_id'] ?>"><img src="images/post_img/<?=$value['post_id'] ?>.jpg" class="gal-image"></a>

			<?php } ?>

		</div>
	</div>
</body>
</html>