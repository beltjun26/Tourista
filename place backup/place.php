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
			$description = $row['description'];
		?>

		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
			</ul>
		</div>
		<div class="container header" id="head" style="">
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
			</ul>
			<div class="gallery">
				<span class="glyphicon glyphicon-camera"></span>
				<a href="gallery.php">View Gallery</a>
			</div>
		</div>
		<div class="container" id="desc">
			<h2>About the place</h2>
			<p><?=$description?></p>
		</div>
		<div class="container" id="rev">
			<h2 class="headline">Reviews</h2>
			<div class="review">
				<form method="POST">
					<h3>Love this place?</h3>
					<div class="hearts">	
						<input type="radio" name="star" id="star5">
						<label for="star5"><span class="glyphicon glyphicon-heart-empty"></span></label>
						<input type="radio" name="star" id="star4">
						<label for="star4"><span class="glyphicon glyphicon-heart-empty"></span></label>
						<input type="radio" name="star" id="star3">
						<label for="star3"><span class="glyphicon glyphicon-heart-empty"></span></label>
						<input type="radio" name="star" id="star2">
						<label for="star2"><span class="glyphicon glyphicon-heart-empty"></span></label>
						<input type="radio" name="star" id="star1">
						<label for="star1"><span class="glyphicon glyphicon-heart-empty"></span></label>
					</div>
					<textarea placeholder="Comment here!"></textarea>
					<input type="submit" name="review" value="REVIEW">
				</form>
				<div id="reviewscroll">
					<?php
					$count=5;
					while($count!=0){?>
						<div class = "postedrev">
							<div class = "postedrevtop">
								<img src = "images/profile_pic_img/acc_id_<?=$count?>.jpg">
								<?php
								$nquery = "SELECT username FROM account WHERE acc_id=$count";
								$nresult = mysqli_query($dbconn, $nquery);
								if(mysqli_num_rows($nresult) > 0){
									$row = mysqli_fetch_assoc($nresult);?>
									<p><?=$row["username"]?></p>
								<?php
								}?>
								<span class="postedstars">
									<?php
									$count2 = $count;
									while($count2!=0){?>
										<img src="images/staron.png">
									<?php
									$count2 = $count2-1;
									}
									$count2 = 5-$count;
									while($count2!=0){?>
										<img src="images/staroff.png">
									<?php
									$count2 = $count2-1;
									}
									?>
								</span>
							</div>
							<div class="postedrevbot">
								<h4>This is place is [insert some sort of opinion on the place here]!</h4>
							</div>
						</div>
						<?php
						$count = $count-1;
					}
					?>
				</div>
			</div>
		</div>
		<div class="container" id="post">
			<h2>Posts go here</h2>
			<p>Temporary</p>
		</div>
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

	<script>
		h = $('#navBar').outerHeight(true);
		console.log(h);
		x = window.innerHeight;
		console.log(x);
		x = x - h;
		console.log(x);
		document.getElementById('head').setAttribute("style","height: "+x+"px;width:100%;margin-top:"+h+"px;background-image: url(images/places_img/place_id_<?=$_GET['place_id']?>.png);");
	</script>
</html>