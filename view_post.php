<!-- THIS HAS NO NAV BAR -->
<?php
	session_start();  
	if(!isset($_SESSION["userName"])){ 
		header('location:login.php');
	}
	$username = $_SESSION["userName"];
	$query  = "SELECT * from posted natural join account"
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
	<body style="padding: 0;"> 
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php" class=><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="Notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6" id="one-post">

					<div class="posted-container" id="posted-container">
					<!-- START OF POSTED -->

					<?php 
						require "connect.php";
						$acc_id = $_SESSION['userID'];
						$query = "SELECT * from upvote where acc_id = $acc_id";
						$result = mysqli_query($dbconn, $query);
						$likes_array=[];
						while($data = mysqli_fetch_assoc($result)){
							$likes_array[]=$data['post_id'];
						}
						$query = "SELECT *
								  FROM account 
								  NATURAL JOIN posted
								  NATURAL JOIN places
								  WHERE post_id = {$_GET['post_id']}
								  ";
						$result = mysqli_query($dbconn, $query);

						$value = mysqli_fetch_assoc($result);



					 ?>

							<div class="posted post-container">
								<a href="people_profile.php?acc_id_=1">
									<img src="images/profile_pic_img/acc_id_<?=$value['acc_id'];?>.jpg" alt="USER PHOTO" class="profile">
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
											$style = "style='background-color: #00E5FF'";
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
								<span class="close" onclick="document.getElementById('myModal<?=$value['post_id']?>').style.display='none'">&times;</span>
								<img class="modal-content postImg"  id="img<?=$value['post_id']?>">
								<div id="caption<?=$value['post_id']?>" class="caption"></div>
							</div>
							<?php endif; ?>
		</div>

		<script>
			function showModal(post_id){
				var modal = document.getElementById('myModal'+post_id);
				var img = document.getElementById('myImg'+post_id);
				var modalImg = document.getElementById("img"+post_id);
				var captionText = document.getElementById("caption"+post_id);
			    modal.style.display = "block";
			    modalImg.src = 'images/post_img/'+post_id+'.jpg';
			    
			    captionText.innerHTML = this.alt;

				var span = document.getElementById("close1");

				span.onclick = function() { 
				  modal.style.display = "none";
				}
			}
		</script>

		<script>
			function initMap(){
				var pyrmont = {lat: 12.879721, lng: 121.77401699999996};

		        map = new google.maps.Map(document.getElementById('map'), {
		          center: pyrmont,
		          zoom: 5
		        });
			};
			$(function(){
				$("#addform").click(function(){
					$("#addplace").css("display", "block");
					initMap();
				})
				$("#close2").click(function(){
					$("#addplace").css("display", "none");
				})
			});
		</script>
		
		<script>
			var loadFile = function(event){
				var image_preview = document.getElementById('image_preview');
				image_preview.src = URL.createObjectURL(event.target.files[0]);
			};
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjA-G7nAd-602rgQZiEzTq_hBzxM8eM0E&libraries=places&callback=initTag" async defer></script>
		<script >
			var searchBox;
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
						$("#likebutton"+post_id).css("background-color","#00E5FF");
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
			

			h = $('#navBar').outerHeight(true);
			console.log(h);
			x = window.innerHeight;
			console.log(x);
			x = x - h;
			console.log(x);
			document.getElementById('one-post').setAttribute("style","min-height: "+x+"px;");
		</script>
	</body>
</html>