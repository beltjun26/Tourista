<!-- THIS HAS NO NAV BAR -->
<?php
	session_start();  
	if(!isset($_SESSION["userName"])){ 
		header('location:login.php');
	}
	$username = $_SESSION["userName"];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toursita</title>
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
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/posts.css">
	</head>
	<body>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="#" class="active"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="Notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="user-box">
						<a href="my_profile.php">
							<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover" class="cover">
							<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="user-profile" class="profile">
						</a>
						<h2 class="user-box-heading"><?=$username?></h2>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="posting post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile">
						<p class="user-name"><?=$username?></p>
						<form action="post.php" method="post">
							<textarea id="post-text-area" cols="50" rows="5" placeholder="Say something..." name = "post"></textarea>
							<label for="photo"><span class="glyphicon glyphicon-camera"> </span> Upload photo<input type="file" name="photo" class="inputphoto"></label>
							<!-- <img src="" alt="Preview Upload" class="preview-image"> -->
							<input type="text-field" placeholder="Tag a location" class="tag-location">
							<div class="contain">
								<span>Tagging:</span><p class="tagged-location">Miagao Church</p>
								<input type="submit" value="POST">
							</div>
						</form>
					</div>
					<div class="posted post-container">
						<a href="people_profile.php">
							<img src="images/temp_pp.png" alt="USER PHOTO" class="profile">
							<h2 class="user-name">JOSP_123</h2>
						</a>
						<p class = "posted-text">Here in Miag-ao Church. This place is old!</p>
						<button class="imagebtn"><img id="myImg" src="images/Body_Background.png"></button>
						<div class="contain">
							<a href="place.php" class="tagged-location">Miagao Church</a>
							<button class="like">LIKE</button>
						</div>
					</div>
					
					<div id="myModal" class="modal">
						<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
						<img class="modal-content postImg" id="img01">
						<div id="caption" class="caption"></div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var modal = document.getElementById('myModal');
			var img = document.getElementById('myImg');
			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			img.onclick = function(){
			    modal.style.display = "block";
			    modalImg.src = this.src;
			    captionText.innerHTML = this.alt;
			}

			var span = document.getElementsByClassName("close")[0];

			span.onclick = function() { 
			  modal.style.display = "none";
			}
		</script>
	</body>
</html>