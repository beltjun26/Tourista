<!-- THIS HAS NO NAV BAR -->
<?php
	session_start();  
	if(!isset($_SESSION["userName"])){ 
		header('location:login.php');
	}
	$username = $_SESSION["userName"];

	/*$query = "SELECT * FROM account WHERE username='{$_SESSION['username']}';";
	$result= mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	$_SESSION["userID"] = $row['acc_id'];*/
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
				<!-- <input type="submit" value="SEARCH" > -->
			</form>
			<ul id = "navList">
				<li><a href="#" class="active"> HOME </a></li>
				<li><a href="visit.php"> VISITS </a></li>
				<li><a href="#"> EXPLORE </a></li>
				<li><a href="Notifications.php"> NOTIFICATIONS </a></li>
				<li><a href="logout.php"> LOGOUT </a></li>
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
						<form action="output.php" method="get">
							<textarea id="post-text-area" cols="50" rows="5" placeholder="Say something..."></textarea>
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
						<button class="imagebtn"><img src="images/Body_Background.png"></button>
						<div class="contain">
							<a href="place.php" class="tagged-location">Miagao Church</a>
							<button class="like">LIKE</button>
						</div>
					</div>
					<div id="myModal" class="modal">
					  	<div class="modal-content">
					    	<div class="modal-header">
					      		<img src="images/temp_pp.png" alt="USER PHOTO" id="pp">
								<h2 class="user-name">JOSP_123</h2>
					      		<span class="close">×</span>
					    	</div>
						    <div class="modal-body">
						      	<img src="images/Body_Background.png" class="modalimg">
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var modal = document.getElementById('myModal');
			var btn = document.getElementById("myBtn");
			var span = document.getElementsByClassName("close")[0];

			btn.onclick = function() {
			    modal.style.display = "block";
			}

			span.onclick = function() {
			    modal.style.display = "none";
			}

			window.onclick = function(event) {
			    if (event.target == modal) {
			        modal.style.display = "none";
			    }
			}
		</script>
	</body>
</html>