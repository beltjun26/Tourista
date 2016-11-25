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
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/People_Profile_Page_Style_Before.css">
		<link rel="stylesheet" type="text/css" href="css/Style_Modal.css">
		<link rel="stylesheet" type="text/css" href="css/edit_profile_style.css">
		<link rel="stylesheet" type="text/css" href="css/posts.css">
		<link rel="stylesheet" type="text/css" href="css/profile_options.css">
		<link rel="stylesheet" type="text/css" href="css/input_file.css">
	</head>
	<body>

	<?php 
	require "connect.php";
	session_start();

	$acc_id = $_SESSION['userID'];
	$username = $_SESSION['userName'];

	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $acc_id && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$acc_id";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname',about_me FROM account where acc_id = $acc_id";

	$result = mysqli_query($dbconn, $queryfollowers);
	$followerscount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryfollowing);
	$followingcount = mysqli_fetch_assoc($result);
	$result = mysqli_query($dbconn, $queryuser);
	$row = mysqli_fetch_assoc($result);
	$fullname = $row['fullname'];
	$aboutme = $row['about_me'];

	if(isset($_POST['change_profile'])){
		$about_me_val = $_POST['about_me_input'];
		$queryaboutme = "UPDATE account SET about_me = '$about_me_val' WHERE account.acc_id = $acc_id";
		$resultchangeaboutme = mysqli_query($dbconn, $queryaboutme);
	}
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
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list active"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">	
			
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover" >
					<button id="Editcovbtn">Edit Cover <span class="glyphicon glyphicon-pencil"></span></button>
				</div>
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<div id="userphoto">
					<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg">
					<button id="Editpicbtn">Edit Profile Picture <span class="glyphicon glyphicon-pencil"></span></button>
				</div>
				<ul id="follows">
					<li><a href="people_profile_list_of_following.php?acc_id=<?=$acc_id?>#follow-head">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
					<button id="Editdesbtn">Edit Description <span class="glyphicon glyphicon-pencil"></span></button>
				</div>
			</div>
			<ul class="user-options">
				<li><a href="#" class="active">Feed<span class="glyphicon glyphicon-credit-card"></span></a></li>
				<li><a href="#">Visits<span class="glyphicon glyphicon-map-marker"></span></a></li>
				<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers<span class="glyphicon glyphicon-hand-left"></span></a></li>
				<li><a href="people_profile_list_of_following.php?acc_id=<?=$acc_id?>#follow-head">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
				<!-- <li><a href="#">Notifications<span class="glyphicon glyphicon-bell"></span></a></li> -->
				<li><a href="Change_account.php">Change Account<span class="glyphicon glyphicon-cog"></span></a></li>
				<!-- <li><button id="Editallbtn">Edit Profile<span class="glyphicon glyphicon-pencil"></span></button></li>	 -->
			</ul>
			<!-- <div class="row">
				<div id="EditAll" class="modal edit_profile">
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
						      		<label for="profile" class="upload">Choose Profile Picture<input type="file" name="profile" onchange="loadFile(event)"></label>
						      		<label for="cover" class="upload">Choose Cover Photo<input type="file" name="cover" onchange="loadFilecover(event)"></label>
						      		<input type="submit" name="change_profile">
					      		</div>
					      	</form>
					    </div>
				  	</div>
				</div> -->
				<div id="EditProfilePicture" class="modal edit_profile">
				  	<div class="modal-content">
				    	<div class="modal-header">
							<h2>Edit Profile Picture</h2>
				      		<span class="close">×</span>
				    	</div>
					    <div class="modal-body">
				      		<img id="output_profile" src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg">
					      	<form method="post" action="upload.php" enctype="multipart/form-data">
						      	<input type="file" name="profile" id="profile" class="inputfile" onchange="loadFilecover(event)">
						      	<label for="profile">Choose Profile Picture<span class="glyphicon glyphicon-download-alt"></span></label>
						      	<input type="submit" name="change_profilepic" value="CHANGE">
					      	</form>
					    </div>
				  	</div>
				</div>
				<div id="EditCoverPhoto" class="modal edit_profile">
				  	<div class="modal-content">
				    	<div class="modal-header">
							<h2>Edit Cover Photo</h2>
				      		<span class="close">×</span>
				    	</div>
					    <div class="modal-body">
				      		<img id="output_cover" src="images/cover_img/cover_<?=$_SESSION['userID']?>.png">
					      	<form method="post" action="upload.php" enctype="multipart/form-data">
					      		<input type="file" name="profile" id="cover" class="inputfile" onchange="loadFilecover(event)">
						      	<label for="cover">Choose Profile Picture<span class="glyphicon glyphicon-download-alt"></span></label>
					      		<input type="submit" name="change_profilecover" value="CHANGE">
					      	</form>
					    </div>
				  	</div>
				</div>
				<div id="EditDescription" class="modal edit_profile">
				  	<div class="modal-content">
				    	<div class="modal-header">
							<h2>Edit Description</h2>
				      		<span class="close">×</span>
				    	</div>
					    <div class="modal-body">
							<form method="post" action="<?php $_PHP_SELF; ?>">
					      		<textarea placeholder="About Me..." name="about_me_input"><?php echo $aboutme;?></textarea>
						      	<input type="submit" name="change_profile" value="CHANGE">
					      	</form>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<div class="posting post-container">
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile">
						<p class="user-name"><?= $username ?></p>
						<form action="output.php" method="get">
							<textarea id="post-text-area" cols="50" rows="5" placeholder="Say something..."></textarea>
							<input type="file" name="file" id="file" class="inputfile" />
							<label for="file">Upload photo<span class="glyphicon glyphicon-download-alt"></span></label>
							<!-- <img src="" alt="Preview Upload" class="preview-image"> -->
							<input type="text-field" placeholder="Tag a location" class="tag-location">
							<div class="contain">
								<span>Tagging:</span><p class="tagged-location">Miagao Church</p>
								<input type="submit" value="POST">
							</div>
						</form>
					</div>






					<?php 
						require "connect.php";
						$acc_id = $_SESSION['userID'];
						$query = "SELECT * 
								  FROM posted 
								  NATURAL JOIN account
								  NATURAL JOIN places
								  WHERE acc_id = $acc_id 
								  ORDER BY time_post 
								  DESC;";

						$result = mysqli_query ($dbconn, $query);
						$num_rows = mysqli_num_rows($result);

						foreach ($result as $value):?>

						<div class="posted post-container">
								<a href="people_profile.php">
									<img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile">
									<h2 class="user-name"><?=$value['username'];?></h2>
								</a>
								<p class = "posted-text"><?=$value['content'];?></p>
								
								<?php if($value['if_image'] == 1): ?>
									<button class="imagebtn"><img id="myImg" src="images/post_img/<?=$value['post_id'];?>.jpg"></button>
								<?php endif; ?>

								<div class="contain">
									<a href="place.php?place_id=<?=$value['place_id'];?>" class="tagged-location"><?=$value['name'];?></a>
									<button class="like">LIKE</button>
								</div>
							</div>
							
							<div id="myModal" class="modal">
								<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
								<img class="modal-content postImg" id="img01">
								<div id="caption" class="caption"></div>
							</div>
						<?php endforeach; ?>
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
			/*var Editall = document.getElementById("EditAll");*/
			var Editpic = document.getElementById("EditProfilePicture");
			var Editcov = document.getElementById("EditCoverPhoto");
			var Editdes = document.getElementById("EditDescription");
			/*var btn1 = document.getElementById("Editallbtn");*/
			var btn1 = document.getElementById("Editpicbtn");
			var btn2 = document.getElementById("Editcovbtn");
			var btn3 = document.getElementById("Editdesbtn");
			var close1 = document.getElementsByClassName("close")[0];
			var close2 = document.getElementsByClassName("close")[1];
			var close3 = document.getElementsByClassName("close")[2];
			/*var close4 = document.getElementsByClassName("close")[3];*/

			/*btn1.onclick = function() {
			    Editall.style.display = "flex";
			}*/

			btn1.onclick = function() {
			    Editpic.style.display = "flex";
			}

			btn2.onclick = function() {
			    Editcov.style.display = "flex";
			}

			btn3.onclick = function() {
			    Editdes.style.display = "flex";
			}

			/*close1.onclick = function() {
			    Editall.style.display = "none";
			}*/

			close1.onclick = function() {
			    Editpic.style.display = "none";
			}

			close2.onclick = function() {
			    Editcov.style.display = "none";
			}

			close3.onclick = function() {
			    Editdes.style.display = "none";
			}

			window.onclick = function(event) {
			    /*if (event.target == Editall) {
			        Editall.style.display = "none";
			    } else */if (event.target == Editpic){
			    	Editpic.style.display = "none";
			    } else if (event.target == Editcov){
			    	Editcov.style.display = "none";
			    } else if (event.target == Editdes){
			    	Editdes.style.display = "none";
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