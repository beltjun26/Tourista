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
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_Style_Before.css">
		<link rel="stylesheet" type="text/css" href="css/Style_Modal.css">
		<link rel="stylesheet" type="text/css" href="css/edit_profile_style.css">
		<link rel="stylesheet" type="text/css" href="css/posts.css">
		<link rel="stylesheet" type="text/css" href="css/profile_options.css">
	</head>
	<body>


	<?php 
	require "connect.php";
	session_start();


	if(isset($_GET['acc_id'])){
		if($_GET['acc_id'] == $_SESSION['userID']){
			header("Location: my_profile.php");
		}

		$userID = $_GET['acc_id'];
	}else{
		header("Location: error_page.php");
	}





	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $userID && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$userID";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname',about_me,username FROM account where acc_id = $userID";

	$result = mysqli_query($dbconn, $queryfollowers);
	$followerscount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryfollowing);
	$followingcount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryuser);
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];
	$fullname = $row['fullname'];
	$aboutme = $row['about_me'];
	?>
		<div id = "navBar">
			
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name="search">
			</form>

			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">	
			<div class="headerprofile">
				<img src="images/cover_img/cover_<?=$_GET['acc_id']?>.png" alt="user-cover" id="coverphoto">
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg" id="userphoto">
				<ul id="follows">
					<li><a href="people_profile_list_of_following.php">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME:</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
				</div>
			</div>
			<ul class="visitor-options">
				<li><a href="#">Feed<span class="glyphicon glyphicon-credit-card"></a></li>
				<li><a href="#">Follow<span class="glyphicon glyphicon-plus"></a></li>
				<li><a href="#">Ask for a Tour<span class="glyphicon glyphicon-sunglasses"></a></li>
				<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></a></li>
				<li><a href="people_profile_list_of_followers.php">Followers<span class="glyphicon glyphicon-hand-left"></a></li>
				<li><a href="people_profile_list_of_following.php">Following<span class="glyphicon glyphicon-hand-right"></a></li>
			</ul>
			<div class="row">
				<div class="col-sm-3">
				</div>

				<div class="col-sm-6">

					<div class="posted post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg" alt="USER PHOTO" class="profile">
						<h2 class="user-name"><?=$username?></h2>
						<p class = "posted-text">Here in Miag-ao Church. This place is old!</p>
						<button class="imagebtn"><img src="images/Body_Background.png"></button>
						<div class="contain">
							<a href="place.php" class="tagged-location">Miagao Church</a>
							<button class="like">LIKE</button>
						</div>
					</div>
					<div class="posted post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg" alt="USER PHOTO" class="profile">
						<h2 class="user-name"><?=$username?></h2>
						<p class = "posted-text">Here in Miag-ao Church. This place is old!</p>
						<button class="imagebtn"><img src="images/Body_Background.png"></button>
						<div class="contain">
							<a href="place.php" class="tagged-location">Miagao Church</a>
							<button class="like">LIKE</button>
						</div>
					</div>
					
					<div class="posted post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg" alt="USER PHOTO" class="profile">
						<h2 class="user-name"><?=$username?></h2>
						<p class = "posted-text">Here in Miag-ao Church. This place is old!</p>
						<button class="imagebtn"><img src="images/Body_Background.png"></button>
						<div class="contain">
							<a href="place.php" class="tagged-location">Miagao Church</a>
							<button class="like">LIKE</button>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<!-- <h2 class="visitor-options">VISITOR OPTIONS</h2>
					<ul class="visitor-options">
						<li><a href="Request_Form.php">Request for a tour</a></li>
						<li><a href="follower.php">Follow Xon_123</a></li>
					</ul> -->
				</div>
			</div>
		</div>
		<script>
			var modal = document.getElementById("EditPanel");
			var btn = document.getElementById("Edit");
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
		<script>
			var loadFile = function(event){
				var output_profile = document.getElementById('output_profile');
				output_profile.src = URL.createObjectURL(event.target.files[0]);
			};
		</script>
		<script>
			var loadFilecover = function(event){
				var output_cover = document.getElementById('output_cover');
				output_cover.src = URL.createObjectURL(event.target.files[0]);
			};
		</script>
	</body>
</html>