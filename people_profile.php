<!DOCTYPE html>
<html>
	<head>
		<title>TourisTA! - Homepage</title>
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
	</head>
	<body>

	<?php 
	$host = 'localhost';  
	$username = 'root'; 
	$password = ''; 
	$db = 'tourista'; 
	$dbconn = mysqli_connect($host,$username,$password) or die("Could not connect to database!"); 
	mysqli_select_db($dbconn, $db) or die( "Unable to select database");
	
	session_start();
	$_SESSION['user_id'] = 1;
	$user_id = $_SESSION['user_id'];
	// $user_id = 1;
	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $user_id && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$user_id";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname', about_me, profile_pic, cover_photo FROM account where acc_id=$user_id";
	$result = mysqli_query($dbconn, $queryfollowers);
	$followerscount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryfollowing);
	$followingcount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryuser);
	while($row = mysqli_fetch_array($result)){
		$username = $row["fullname"];
		$aboutme = $row["about_me"];
		$pathpp = $row["profile_pic"];
		$pathcp = $row["cover_photo"];
	} ?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search...">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"> HOME </a></li>
				<li><a href="visit.php"> VISITS </a></li>
				<li><a href="#"> STARRED PLACES </a></li>
				<li><a href="notifications.php"> NOTIFICATIONS </a></li>
				<li><a href="login.php"> LOGOUT </a></li>
				<li><!-- <a href="people_profile.php"> --><img src="images/pp_cover/<?php echo $pathpp;?>"><!-- </a> --></li>
			</ul>
		</div>
		<div class="container">	
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/pp_cover/<?php echo $pathcp;?>">
					<h1 id="username"><?php echo $username; ?></h1>
				</div>
				<div id="userphoto">
					<img src="images/pp_cover/<?php echo $pathpp;?>">
				</div>
				<div id="follows">
					<p><a href="people_profile_list_of_following.php">Following: <?php echo $followingcount['followingcount']; ?></a></p>
					<p><a href="people_profile_list_of_followers.php">Followers: <?php echo $followerscount['followerscount'];?></a> </p>
				</div>
				<div id="aboutme">
					<h1>ABOUT ME:</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
				</div>
				<div id="myModal" class="modal edit_profile">
			  	<div class="modal-content">
			    	<div class="modal-header">
						<h2>Edit Profile</h2>
			      		<span class="close">×</span>
			    	</div>
				    <div class="modal-body">
			      		<img id="output_cover" src="images/pp_cover/<?php echo $pathcp;?>">
			      		<img id="output_profile" src="images/pp_cover/<?php echo $pathpp;?>">
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
			</div>
			<div class="row">
				<div class="col-sm-3">
					<h2 class="user-options">USER OPTIONS</h2>
					<ul class="user-options">
						<li><a href="#">Feed</a></li>
						<li><a href="#">Visits</a></li>
						<li><a href="#">Starred Places</a></li>
						<li><a href="people_profile_list_of_followers.php">Followers</a></li>
						<li><a href="people_profile_list_of_following.php">Following</a></li>
						<li><a href="#">Notifications</a></li>
					</ul>
					<button id="myBtn">Edit Profile</button>
				</div>
				<div class="col-sm-6">
					<div class="posting-container">
						<h2>POST SOMETHING NEW?</h2>
						<div class="col-sm-2">
							<img src="images/pp_cover/<?php echo $pathpp;?>" alt="USER PHOTO">
						</div>
						<div class="col-sm-10">
							<a href="#">ADD A PHOTO</a>
							<form action="output.html" method="get">
								<textarea id="post-text-area" cols="50" rows="5" placeholder="TEXT HERE..."></textarea>
								<input type="text-field" placeholder="LOCATION TAG AUTOFILL">
							 	<input type="submit" value="POST">
							</form>
						</div>
					</div>
					<div class="posted-container">
						<img src="images/pp_cover/<?php echo $pathpp;?>" alt="USER PHOTO" id="pp">
						<h2 class="user-name">XON_123</h2>
						<img src="images/Body_Background.png">
						<div class="col-sm-10">
							<p class = "posted-text">Miag-ao Church.</p>
							<a href="#" class="tagged-location">MIAG-AO CHURCH</a>
						</div>
						<div class="col-sm-2">
							<button>LIKE</button>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<h2 class="visitor-options">VISITOR OPTIONS</h2>
					<ul class="visitor-options">
						<li><a href="Request_Form.php">Request for a tour</a></li>
						<li><a href="follower.php">Follow Xon_123</a></li>
					</ul>
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