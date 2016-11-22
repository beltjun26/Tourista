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

	$userID = $_SESSION['userID'];
	$username = $_SESSION['userName'];

	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $userID && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$userID";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname',about_me FROM account where acc_id = $userID";

	$result = mysqli_query($dbconn, $queryfollowers);
	$followerscount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryfollowing);
	$followingcount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryuser);
	$row = mysqli_fetch_assoc($result);
	$fullname = $row['fullname'];
	$aboutme = $row['about_me'];
	?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search...">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list active"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">	
			<div class="headerprofile">
				<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover" id="coverphoto">
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" id="userphoto">
				<ul id="follows">
					<li><a href="people_profile_list_of_following.php">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
				</div>
			</div>
			<ul class="user-options">
				<li><button id="Edit">Edit Profile<span class="glyphicon glyphicon-pencil"></span></button></li>
				<li><a href="#">Feed<span class="glyphicon glyphicon-credit-card"></span></a></li>
				<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></span></a></li>
				<li><a href="people_profile_list_of_followers.php">Followers<span class="glyphicon glyphicon-hand-left"></span></a></li>
				<li><a href="people_profile_list_of_following.php">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
				<li><a href="#">Notifications<span class="glyphicon glyphicon-bell"></span></a></li>
			</ul>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div id="EditPanel" class="modal edit_profile">
				  	<div class="modal-content">
				    	<div class="modal-header">
							<h2>Edit Profile</h2>
				      		<span class="close">×</span>
				    	</div>
					    <div class="modal-body">
				      		<img id="output_cover" src="images/cover_img/cover_<?=$_SESSION['userID']?>.png">
				      		<img id="output_profile" src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg">
					      	<form method="post" action="upload.php" enctype="multipart/form-data">
					      		<textarea placeholder="About Me..." name="about_me_input"><?php echo $aboutme;?></textarea><br>
					      		<div class="option-buttons">
						      		<label for="profile" class="upload">Change Profile Picture<input type="file" name="profile" onchange="loadFile(event)"></label>
						      		<label for="cover" class="upload">Change Cover Photo<input type="file" name="cover" onchange="loadFilecover(event)"></label>
						      		<input type="submit" name="change_profile">
					      		</div>
					      	</form>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-6">
					<div class="posting post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile">
						<p class="user-name"><?= $username ?></p>
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
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile">
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