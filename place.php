<?php 
	
	session_start();
	if(!isset($_SESSION['userID'])){
				header("Location: login.php");
	}
	require "connect.php";

	$_SESSION['place_id'] = $_GET['place_id'];

	$queryplaces = "SELECT * FROM places WHERE place_id = '{$_GET['place_id']}';";
	$result = mysqli_query($dbconn, $queryplaces);
	$row = mysqli_fetch_assoc($result);

	$placename = $row['name'];
	$description = $row['description'];
?>


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
	  	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Home_Page_style.css">
		<link rel="stylesheet" type="text/css" href="css/Place.css">
		<link rel="stylesheet" type="text/css" href="css/review.css">
		<link rel="stylesheet" type="text/css" href="css/posts.css">
	</head>
	<body>
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
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list active"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'"></a></li>
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
				<a href="gallery.php?place_id=<?=$_GET['place_id']?>">View Gallery</a>
			</div>
			<form class="background" method="post" action="upload_place_photo.php" enctype="multipart/form-data">
				<label for="background"><span class="glyphicon glyphicon-picture"></span> Change Background</label>
				<input type="file" name="background" id="background" onchange="loadFile(event)" accept=".png, .jpg, .jpeg, .gif" onchange="loadFile(event)">

				<input type="submit" name="upload" id = "submit" value="upload" name = "post">
				<input type="button" name="cancel" id = "cancel" value="cancel" class="cancel" onclick="cancel_upload(event)">
			</form>
		</div>
		<div class="container" id="desc">
			<h2>About the place</h2>
			<p><?=$description?></p>
		</div>
		<div class="container" id="rev">
			<?php 
				$query = "SELECT ROUND(AVG(rating_no), 1)
						  FROM rating
						  WHERE place_id = '{$_GET['place_id']}'
						  ;";
				$ratingresult = mysqli_query($dbconn, $query);
				$ratingrow = mysqli_fetch_row($ratingresult);


			 ?>




			<h2>Overall Rating: <span><?=$ratingrow[0]; ?></span></h2>
			<div class="review">
				<form name="reviewform" method="post" action="review.php" onsubmit="return validateReview(this)">
					<?php 
						$query = "SELECT * FROM rating WHERE acc_id = '{$_SESSION['userID']}' AND place_id = '{$_GET['place_id']}';"; 
						$result = mysqli_query($dbconn, $query);
						if(mysqli_affected_rows($dbconn)){ ?>
							<h3>Review this place again?</h3>
						<?php } else { ?>
							<h3>Love this place?</h3>
						<?php } ?>
							<div class="hearts">
								  <input id="rating5" type="radio" name="rating" value="5">
								  <label for="rating5"><span class="glyphicon glyphicon-heart-empty"></span></label>
								  <input id="rating4" type="radio" name="rating" value="4">
								  <label for="rating4"><span class="glyphicon glyphicon-heart-empty"></span></label>
								  <input id="rating3" type="radio" name="rating" value="3">
								  <label for="rating3"><span class="glyphicon glyphicon-heart-empty"></span></label>
								  <input id="rating2" type="radio" name="rating" value="2">
								  <label for="rating2"><span class="glyphicon glyphicon-heart-empty"></span></label>
								  <input id="rating1" type="radio" name="rating" value="1">
								  <label for="rating1"><span class="glyphicon glyphicon-heart-empty"></span></label>
							</div>
							<textarea placeholder="Comment here!" name="comment"></textarea>
							<div id="warning">
							  	<span class="closebtn">&times;</span> 
							  	<p>Rate the place first.<p>
							</div>
							<input type="hidden" name="place" value="<?=$_GET['place_id']?>">
						<?php if(mysqli_affected_rows($dbconn)){ ?>
							<button name="reviewagain" type="submit" onclick="return validateReview();">Review Again</button>
						<?php } else { ?>
							<button name="review" type="submit" onclick="return validateReview();">Review</button>
						<?php } ?>
				</form>
				<div id="reviewscroll">
					<!--<p>php loop goes here</p>-->
					<?php 
						$query = "SELECT * FROM rating NATURAL JOIN account WHERE place_id = '{$_GET['place_id']}';"; 
						$result = mysqli_query($dbconn, $query);
						if (mysqli_affected_rows($dbconn)) {
							foreach ($result as $value):?>
								<div class = "postedrev">
									<div class = "postedrevtop">
										<img src = "images/profile_pic_img/acc_id_<?=$value['acc_id']?>.jpg">
										<a href="people_profile.php?acc_id=<?=$value['acc_id']?>"><?=$value['username']?></a>
										<span class="postedstars">
											<?php
											$count = $value['rating_no'];
											while($count!=0){?>
												<span class="glyphicon glyphicon-heart-empty red"></span>
											<?php $count--; }
											$count = 5-$value['rating_no'];
											while($count!=0){?>
												<span class="glyphicon glyphicon-heart-empty gray"></span>
											<?php $count--; } ?>
										</span>
									</div>
									<?php if($value['comment'] != ""){ ?>
										<div class="postedrevbot">
											<p><?=$value['comment']?></p>
										</div>
									<?php } ?>
								</div>
							<?php endforeach; 
						} else { ?>
							<p class="no-review">No Reviews for this place</p>
						<?php } ?>
				</div>
			</div>
		</div>
		<div class="container" id="post">
			<h1 class="post-title">POSTS</h1>
			<div class="posted-container" id="posted-container" style="width:40%">
					<!-- START OF POSTED -->
					<?php 
						$acc_id = $_SESSION['userID'];
						$query = "SELECT * from upvote where acc_id = $acc_id";
						$result = mysqli_query($dbconn, $query);
						$likes_array=[];
						while($data = mysqli_fetch_assoc($result)){
							$likes_array[]=$data['post_id'];
						}
						$query = "SELECT * 
								  FROM posted 
								  NATURAL JOIN account
								  NATURAL JOIN places
								  WHERE place_id = '{$_GET['place_id']}'
								  ORDER BY time_post 
								  DESC;";
						$result = mysqli_query ($dbconn, $query);
						$num_rows = mysqli_num_rows($result);
						// Loop each post
						foreach ($result as $value):?>

							<div class="posted post-container">
								<span class="show-dropdown glyphicon glyphicon-chevron-down"></span>
								<ul class="dropdown">
									<li><button class="delete">Delete</button></li>
									<li><button>Edit</button></li>
								</ul>	
								<a href="<?php 
									if($value['acc_id']==$_SESSION['userID']){
										echo "my_profile.php";
									}else{
										echo "people_profile.php?acc_id=".$value['acc_id'];
									}
								 ?>">
									<img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" onerror = "this.src = 'images/default_cover.png'" alt="USER PHOTO" class="profile">

									<h2 class="user-name"><?=$value['username'];?></h2>
								</a>
								<ul class="with-people">
								<?php 
									$query= "SELECT username as fullname, acc_id from tag natural join account where post_id={$value['post_id']}";
									$res = mysqli_query($dbconn, $query);
									$no_tagged = mysqli_affected_rows($dbconn);
								 ?>
								 <?php if($no_tagged): ?>
								 
									<li>with</li>
									<?php 
										if($no_tagged<4){
											while($data_row = mysqli_fetch_assoc($res)){
												echo "<li><a href='people_profile.php?acc_id=".$data_row['acc_id']."'>".$data_row['fullname']."</a>,</li>";
											}
										}else{
											$tags = mysqli_affected_rows($dbconn);
											$tags = $tags-3;
												$data_row = mysqli_fetch_assoc($res);
												echo "<li><a href='people_profile.php?acc_id=".$data_row['acc_id']."'>".$data_row['fullname']."</a>,</li>";
												$data_row = mysqli_fetch_assoc($res);
												echo "<li><a href='people_profile.php?acc_id=".$data_row['acc_id']."'>".$data_row['fullname']."</a>,</li>";
												$data_row = mysqli_fetch_assoc($res);
												echo "<li><a href='people_profile.php?acc_id=".$data_row['acc_id']."'>".$data_row['fullname']."</a>,</li>";
												echo "<li>and <span onclick='showOtherTag(".$value['post_id'].")'>".$tags." others</span></li>";				
										}
									 ?>
								
								<?php endif ?>
								
								</ul>
								<span class="time-date"><?php echo date("F j, Y, g:i a", strtotime($value['time_post'])); ?></span>

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
							<!-- IF people are more than capacity. -->
						<?php endforeach; ?>
						<div id="people" class="modal tagged-panel" style="display: none;">
							<div class="modal-content">
								<div class="modal-header">
									<h2>tagged people</h2>
									<span id="tag_modal_close" class="close">×</span>
								</div>
								<div class="modal-body">
									<ul id="list_tag_modal" class="with-people-modal">
									</ul>
								</div>
							</div>
						</div>
						<!-- END OF POSTED -->
					</div>
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

	<script>
		function likeTriggered(post_id){
			$.ajax({
				url:"like.php",
				type:"post",
				data:{'post_id': post_id},
				success:function(data){
					var values = JSON.parse(data);
					if(values.status=="deleted"){
						$("#likebutton"+post_id).css("background-color","#006064");
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
		function validateReview(){
		    var rating = document.forms["reviewform"]["rating"].value;
			var warning = document.getElementById("warning");
		    if (rating == "") {
		    	warning.style.display = "inline-block";
		        warning.style.opacity = "1";	       
		        return false;
		    }
		}
		var close = document.getElementsByClassName("closebtn");
		var i;

		for (i = 0; i < close.length; i++) {
		    close[i].onclick = function(){
		        var div = this.parentElement;
		        div.style.opacity = "0";
		        setTimeout(function(){ div.style.display = "none"; }, 600);
		    }
		}
	</script>
	<script>
		
		var loadFile = function(event){
			var location = URL.createObjectURL(event.target.files[0]);

			h = $('#navBar').outerHeight(true);
			console.log(h);
			x = window.innerHeight;
			console.log(x);
			x = x - h;
			console.log(x);
			document.getElementById('head').setAttribute("style","height: "+x+"px;width:100%;margin-top:"+h+"px;background-image: url("+location+");");

			document.getElementById('cancel').style.display = "inline-block";	
			document.getElementById('submit').style.display = "inline-block";
		};

		var cancel_upload = function(event){
			document.getElementById('cancel').style.display = "none";	
			document.getElementById('submit').style.display = "none";

			h = $('#navBar').outerHeight(true);
			console.log(h);
			x = window.innerHeight;
			console.log(x);
			x = x - h;
			console.log(x);
			document.getElementById('head').setAttribute("style","height: "+x+"px;width:100%;margin-top:"+h+"px;background-image: url(images/places_img/place_id_<?=$_GET['place_id']?>.png);");
		}



	</script>
</html>