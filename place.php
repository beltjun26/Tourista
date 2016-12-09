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

		<?php 
			require "connect.php";
			session_start();

			$queryplaces = "SELECT * FROM places WHERE place_id = '{$_GET['place_id']}';";
			$result = mysqli_query($dbconn, $queryplaces);
			$row = mysqli_fetch_assoc($result);

			$placename = $row['name'];
			$description = $row['description'];
		?>

		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name = "search">
			</form>
			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
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
				<a href="gallery.php">View Gallery</a>
			</div>
		</div>
		<div class="container" id="desc">
			<h2>About the place</h2>
			<p><?=$description?></p>
		</div>
		<div class="container" id="rev">
			<h2>Overall Rating: <span>4.6</span></h2>
			<div class="review">
				<form method = "post" action = "">
					<h3>Love this place?</h3>
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
					<textarea placeholder="Comment here!"></textarea>
					<button name = "submitreview" type="submit">Review</button>
				</form>
				<div id="reviewscroll">
					<!--<p>php loop goes here</p>-->
					<?php
					$count=5;
					while($count!=0){?>
						<div class = "postedrev">
							<div class = "postedrevtop">
								<img src = "images/profile_pic_img/acc_id_<?=$count?>.jpg">
								<?php
								$nquery = "SELECT username FROM account WHERE acc_id=$count";
								$nresult = mysqli_query($dbconn, $nquery);
								if(mysqli_num_rows($nresult) > 0){
									$row = mysqli_fetch_assoc($nresult);?>
									<a href="people_profile.php?acc_id=<?=$count?>"><?=$row["username"]?></a>
								<?php
								}?>
								<span class="postedstars">
									<?php
									$count2 = $count;
									while($count2!=0){?>
										<span class="glyphicon glyphicon-heart-empty red"></span>
									<?php
									$count2 = $count2-1;
									}
									$count2 = 5-$count;
									while($count2!=0){?>
										<span class="glyphicon glyphicon-heart-empty gray"></span>
									<?php
									$count2 = $count2-1;
									}
									?>
								</span>
							</div>
							<div class="postedrevbot">
								<p>This is place is amazing!</p>
							</div>
						</div>
						<?php
						$count = $count-1;
					}
					?>
				</div>
			</div>
		</div>
		<div class="container" id="post">
			<h1 class="post-title">POSTS</h1>
			<div class="posted-container" id="posted-container" style="width:40%">
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
	</script>

	<script>
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
</html>