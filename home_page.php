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
		<title>TourisTA!</title>
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
		<link rel="stylesheet" type="text/css" href="css/input_file.css">
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
						<form action="post.php" method="post" enctype="multipart/form-data">
							<textarea id="post-text-area" cols="50" rows="5" placeholder="Say something..." name = "post"></textarea>
							<input type="file" name="file" id="file" class="inputfile"/>
							<label for="file">Upload photo<span class="glyphicon glyphicon-download-alt"></span></label>
							<!-- <div id="uploadphoto">
								<span class="glyphicon glyphicon-camera"></span>
								<label for="photo" id="photo"><input type="file" name="photo" class="inputphoto" onchange="loadFile(event)"></label>
							</div> -->
							<img src="" alt="" id="image_preview" >

							<input type="text-field" placeholder="Tag a location" class="tag-location">
							<div class="contain">
								<span>Tagging:</span><p class="tagged-location">Filler text only</p>
								<input type="submit" value="POST">
							</div>
						</form>
					</div>
					<div id="unavailable" class="modal">
						<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
						<img class="modal-content postImg" id="img01">
						<div id="caption" class="caption"></div>
					</div>		
					<div class="posted-container">
					<!-- START OF POSTED -->
					<?php 
						require "connect.php";
						$acc_id = $_SESSION['userID'];
						$query = "SELECT * 
								  FROM posted 
								  NATURAL JOIN account
								  NATURAL JOIN places
								  WHERE acc_id 
								  IN (SELECT acc_id_follows 
								  	  FROM follow 
								  	  WHERE acc_id_follower = $acc_id)
								  OR acc_id = $acc_id 
								  ORDER BY time_post 
								  DESC;";

						$result = mysqli_query ($dbconn, $query);
						$num_rows = mysqli_num_rows($result);

						foreach ($result as $value):?>
							<div class="posted post-container">
								<a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>">
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
						
						<!-- END OF POSTED -->
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
		
		<script>
			var loadFile = function(event){
				var image_preview = document.getElementById('image_preview');
				image_preview.src = URL.createObjectURL(event.target.files[0]);
			};
		</script>

	</body>
</html>