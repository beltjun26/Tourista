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
	</head>
	<body>


	<?php 
	require "connect.php";
	session_start();


	if(isset($_GET['acc_id'])){
		if($_GET['acc_id'] == $_SESSION['userID']){
			header("Location: my_profile.php?acc_id=<?={$_SESSION['userID']}?>");
		}

		$acc_id = $_GET['acc_id'];
	}else{
		header("Location: error_page.php");
	}

	$queryfollowers = "SELECT count(*) as followerscount FROM account as acc, follow WHERE acc_id_follows = $acc_id && acc_id_follower=acc.acc_id";
	$queryfollowing = "SELECT count(*) as followingcount FROM account as acc, follow WHERE acc_id_follows = acc_id && acc_id_follower=$acc_id";
	$queryuser = "SELECT  CONCAT(firstname,' ', lastname) as 'fullname',about_me,username FROM account where acc_id = $acc_id";

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
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/cover_img/cover_<?=$acc_id?>.png" alt="user-cover">
				</div>
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<div id="userphoto">
					<img src="images/profile_pic_img/acc_id_<?=$_GET['acc_id']?>.jpg">
				</div>
				<ul id="follows">
					<li><a href="people_profile_list_of_following.php?acc_id=<?=$acc_id?>#follow-head">Following: <?php echo $followingcount['followingcount']; ?></a></li>
					<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers: <?php echo $followerscount['followerscount'];?></a></li>
				</ul>
				<div id="aboutme">
					<h1>ABOUT ME</h1>
					<br>
					<p><?php echo $aboutme ;?></p>
				</div>
			</div>
			<ul class="visitor-options">
				<li><a href="#"  class="active">Feed<span class="glyphicon glyphicon-credit-card"></a></li>
				<li><a href="follow.php?acc_id=<?=$acc_id?>">
					<?php
						$query = "SELECT * FROM follow WHERE acc_id_follower = {$_SESSION['userID']} AND acc_id_follows = {$_GET['acc_id']};";	
						$result = mysqli_query ($dbconn, $query);
						if (mysqli_num_rows($result) == 0){
							echo "Follow<span class='glyphicon glyphicon-plus'>";
						} else{
							echo "Unfollow<span class='glyphicon glyphicon-minus'>";
						}
					?>
				</span></a></li>
				<li><a href="#">Ask for a Tour<span class="glyphicon glyphicon-sunglasses"></a></li>
				<li><a href="visit.php?acc_id=<?=$_GET['acc_id']?>">Visits<span class="glyphicon glyphicon-map-marker"></a></li>
				<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers<span class="glyphicon glyphicon-hand-left"></a></li>
				<li><a href="people_profile_list_of_following.php?acc_id=<?=$acc_id?>#follow-head">Following<span class="glyphicon glyphicon-hand-right"></a></li>
			</ul>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="posted-container">
<!-- 				START OF POSTED -->
					<?php 
						require "connect.php";
						$acc_id = $_GET['acc_id'];
						$query = "SELECT * from upvote where acc_id = {$_SESSION['userID']}";
						$result = mysqli_query($dbconn, $query);
						$likes_array=[];
						while($data = mysqli_fetch_assoc($result)){
							$likes_array[]=$data['post_id'];
						}
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
									<button class="imagebtn"><img id="myImg<?=$value['post_id']?>" onclick="showModal(<?=$value['post_id']?>)" src="images/post_img/<?=$value['post_id'];?>.jpg"></button>

								<?php endif; ?>

								<a href="place.php?place_id=<?=$value['place_id'];?>" class="tagged-location"><?=$value['name'];?></a>
								<div class="like">
									<span id="likes<?=$value['post_id']?>" class="num-likes">
								<?php 
									$query = "SELECT count(*) as likes from upvote where post_id = {$value['post_id']};";
									$result = mysqli_query($dbconn, $query);
									$row = 0;
									$style = " ";
									if(mysqli_affected_rows($dbconn)){
										$data = mysqli_fetch_assoc($result);
										$row = $data['likes'];
									}
									if($row){
										if(in_array($value['post_id'], $likes_array)){
											$style = "style='background-color: grey'";
										}
										if($row==1){
											echo "1 Like";
										}else{
											echo $row." Likes";
										}
									}else{
										echo " ";
									}
								 ?>
									</span>
									<button id="likebutton<?=$value['post_id']?>" <?=$style?> onclick="likeTriggered(<?=$value['post_id']?>)">LIKE</button>
								</div>			
							</div>
							
							<?php if($value['if_image'] == 1): ?>
							<div id="myModal<?=$value['post_id']?>" class="modal">
								<span id="close1" class="close" onclick="document.getElementById('myModal<?=$value['post_id']?>').style.display='none'">&times;</span>
								<img class="modal-content postImg"  id="img<?=$value['post_id']?>">
								<div id="caption<?=$value['post_id']?>" class="caption"></div>
							</div>
							<?php endif; ?>

					<?php endforeach; ?>
					</div>
<!-- 				END OF POSTED -->
				</div>
				<div class="col-sm-3">
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

			var loadFile = function(event){
				var output_profile = document.getElementById('output_profile');
				output_profile.src = URL.createObjectURL(event.target.files[0]);
			};

			var loadFilecover = function(event){
				var output_cover = document.getElementById('output_cover');
				output_cover.src = URL.createObjectURL(event.target.files[0]);
			};

			function showModal(post_id){
			var modal = document.getElementById('myModal'+post_id);
			var img = document.getElementById('myImg'+post_id);
			var modalImg = document.getElementById("img"+post_id);
			var captionText = document.getElementById("caption"+post_id);
		    modal.style.display = "block";
		    modalImg.src = 'images/post_img/'+post_id+'.jpg';
		    
		}
		function likeTriggered(post_id){
			$.ajax({
				url:"like.php",
				type:"post",
				data:{'post_id': post_id},
				success:function(data){
					var values = JSON.parse(data);
					if(values.status=="deleted"){
						$("#likebutton"+post_id).css("background-color","#00BCD4");
					}
					if(values.status=="inserted"){
						$("#likebutton"+post_id).css("background-color","grey");
					}
					if(values.likes==0){
						document.getElementById("likes"+post_id).innerHTML=" ";
					}
					if(values.likes==1){
						document.getElementById("likes"+post_id).innerHTML="1 Like";	
					}if(values.likes>1){
						document.getElementById("likes"+post_id).innerHTML=values.likes+" Likes";	
					}
				}
			});
		}
		</script>
	</body>
</html>