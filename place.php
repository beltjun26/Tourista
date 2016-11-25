<!DOCTYPE html>
<html>
	<head>
		<title>TourisTA!</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/place.css">
	</head>
	<body>

		<?php 
			require "connect.php";
			session_start();

			$queryplaces = "SELECT * FROM places WHERE place_id = '{$_GET['place_id']}';";
			$result = mysqli_query($dbconn, $queryplaces);
			$row = mysqli_fetch_assoc($result);

			$placename = $row['name'];
			$description = $row['desciption'];
		?>

		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
			</ul>
		</div>
		<!-- <main>
			<div class="leftpage"> -->
				<div class="container header" id="head" style="background-image: url(images/places_img/place_id_<?=$_GET['place_id']?>.png);">
					<h1><?=$placename?></h1>
					<ul class="address">
						<li>Town,</li>
						<li>Province,</li>
						<li>Barangay</li>
					</ul>
					<ul class="options">
						<li><a href="#desc">About</a></li>
						<li><a href="#rev">Reviews</a></li>
						<li><a href="#post">Posts</a></li>
						<li><a href="gallery.php">Gallery</a></li>
					</ul>
				</div>
				<div class="container" id="desc">
					<h2>About the place</h2>
					<p><?=$description?></p>
				</div>
				<div class="container" id="rev">
					<h2>Reviews</h2>
				</div>
			<!-- </div>
			<div class="rightpage"> -->
				<div class="container" id="post">
					<h2>Posts go here</h2>
					<p>Temporary</p>
				</div>
			<!-- </div>
		</main> -->
		<a href="#head" id="backtop" data-toggle="tooltip" data-placement="left" title="Back to top?" trigger="hover">^</a>
	</body>

	<script>
		$(function() {
		  $('a[href*="#"]:not([href="#"])').click(function() {
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		      var target = $(this.hash);
		      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		      if (target.length) {
		        $('html, body').animate({
		          scrollTop: target.offset().top
		        }, 1000);
		        return false;
		      }
		    }
		  });
		});
	</script>

	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
</html>