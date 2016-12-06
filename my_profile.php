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
		header("Location: my_profile.php");
	}
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
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list active"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'"></a></li>
			</ul>
		</div>
		<div class="container">	
			
			<div class="headerprofile">
				<div id="coverphoto">
					<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover"  onerror = "this.src = 'images/default_cover.png'">
					<button id="Editcovbtn">Edit Cover <span class="glyphicon glyphicon-pencil"></span></button>
				</div>
				<h1 id="username"><?=$fullname?><br><span class="usernameorig"><?=$username?></span></h1>
				<div id="userphoto">
					<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'" >
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
				<li><a href="visit.php">Visits<span class="glyphicon glyphicon-map-marker"></span></a></li>
				<li><a href="people_profile_list_of_followers.php?acc_id=<?=$acc_id?>#follow-head">Followers<span class="glyphicon glyphicon-hand-left"></span></a></li>
				<li><a href="people_profile_list_of_following.php?acc_id=<?=$acc_id?>#follow-head">Following<span class="glyphicon glyphicon-hand-right"></span></a></li>
				<li><a href="Change_account.php">Change Account<span class="glyphicon glyphicon-cog"></span></a></li>
			</ul>

				<div id="EditProfilePicture" class="modal edit_profile">
				  	<div class="modal-content">
				    	<div class="modal-header">
							<h2>Edit Profile Picture</h2>
				      		<span class="close">×</span>
				    	</div>
					    <div class="modal-body">
				      		<img id="output_profile" src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'">
					      	<form method="post" action="upload.php" enctype="multipart/form-data">
						      	<input type="file" name="profile" id="profile" class="inputfile" onchange="loadFile(event)">
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
				      		<img id="output_cover" src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" onerror = "this.src = 'images/default_cover.png'">
					      	<form method="post" action="upload.php" enctype="multipart/form-data">
					      		<input type="file" name="cover" id="cover" class="inputfile" onchange="loadFilecover(event)">
						      	<label for="cover">Choose Cover Photo<span class="glyphicon glyphicon-download-alt"></span></label>
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
					<div id="addplace" class="modal">
						<div id="unavailable" class="modal-content">
							<div class="modal-header">
							    <span id="closeA2" class="close">×</span>
							    <h2>Place is unvailable.</h2>
							 </div>
							<span>This place is unavailable. Do you want to add it?</span>
							<div id="map"></div>
							<input id="add_place" type="button" name="place" value="Register">
						</div>
					</div>
					<div class="posting post-container" id="posting-container">
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile" onerror = "this.src = 'images/default_profile.png'">
						<p class="user-name"><?=$username?></p>
						<form id="formsubmit" enctype="multipart/form-data">
							<textarea id="post-text-area" cols="50" rows="5" placeholder="Say something..." name = "post"></textarea>
							<input id="file" type="file" name="photo" class="inputfile" onchange="loadFile(event)">
							<label for="file">Upload photo<span class="glyphicon glyphicon-download-alt"></span></label>
							<!-- <div id="uploadphoto">
								<span class="glyphicon glyphicon-camera"></span>
								<label for="photo" id="photo"><input type="file" name="photo" class="inputphoto" onchange="loadFile(event)"></label>
							</div> -->
							<img src="" alt="" id="image_preview" style="display: block">
							<input type="text-field" placeholder="Tag a location" class="tag-location" id="location_tag">
							<div class="location">	
							<span class="tagged-location">Tagged place:</span>
							<p id="tagged_place" class="tagged-location"></p>
							</div>
							<div class="warning" style="display: none">
								<span>Place not available.</span>
								<input id="addform" type="button" name="addform" value="add">
								<!-- <button id="addform">add</button> -->
							</div>
							<input type="text-field" placeholder="Tag a person" class="tag-person" id="person_tag">
							<ul class="tagged-people">
								<!-- Echo people here. -->
								<li>Someone Somebody</li>
								<li>Somebody Something</li>
								<li>Something Someone</li>
							</ul>
							<input id="posting" type="button" value="POST">

						</form>
					</div>	

					<!-- Error message -->

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
								  FROM posted 
								  NATURAL JOIN account
								  NATURAL JOIN places
								  WHERE acc_id = $acc_id 
								  ORDER BY time_post 
								  DESC;";

						$result = mysqli_query ($dbconn, $query);
						$num_rows = mysqli_num_rows($result);
						// Loop each post
						foreach ($result as $value):?>
							<div class="posted post-container">

								<a href="people_profile.php">
									<img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" onerror = "this.src = 'images/default_cover.png'" alt="USER PHOTO" class="profile">

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
							
							<div id="myModal<?=$value['post_id']?>" class="modal">
								<span id="closeA1" class="close" onclick="document.getElementById('myModal<?=$value['post_id']?>').style.display='none'">&times;</span>
								<img class="modal-content postImg"  id="img<?=$value['post_id']?>">
								<div id="caption<?=$value['post_id']?>" class="caption"></div>
							</div>

						<?php endforeach; ?>
						
						<!-- END OF POSTED -->
					</div>
				</div>
		</div>
	</body>

	<script>
		containerheight = $('#posting-container').outerHeight(true);
		console.log(containerheight);
		containerheight = containerheight + 10;
		console.log(containerheight);
		document.getElementById("posted-container").setAttribute("style","margin: "+containerheight+"px 0 20px 0;overflow: all;");

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

		var loadFile = function(event){
			var output_profile = document.getElementById('output_profile');
			output_profile.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadFilecover = function(event){
			var output_cover = document.getElementById('output_cover');
			output_cover.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>

	<script>

		containerheight = $('#posting-container').outerHeight(true);
		console.log(containerheight);
		containerheight = containerheight + 10;
		console.log(containerheight);
		document.getElementById("posted-container").setAttribute("style","margin: "+containerheight+"px 0 20px 0;overflow: all;");
		//function for image modal
		function showModal(post_id){
			var modal = document.getElementById('myModal'+post_id);
			var img = document.getElementById('myImg'+post_id);
			var modalImg = document.getElementById("img"+post_id);
			var captionText = document.getElementById("caption"+post_id);
		    modal.style.display = "block";
		    modalImg.src = 'images/post_img/'+post_id+'.jpg';
			
		}

		//show map if add the place is clicked
		function initMap(){
			var pyrmont = {lat: 12.879721, lng: 121.77401699999996};
			var map;
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: pyrmont,
	          zoom: 5
	        });
	        var places = searchBox.getPlaces();
	        var bounds = new google.maps.LatLngBounds();
	        places.forEach(function(place){
	        	if (!place.geometry) {
	              console.log("Returned place contains no geometry");
	              return;
	            }
	            var icon = {
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(25, 25)
				};
				var marker = new google.maps.Marker({
					map: map,
					icon: icon,
					title: place.name,
					position: place.geometry.location
	            });
			            if (place.geometry.viewport) {
	              // Only geocodes have viewport.
	              bounds.union(place.geometry.viewport);
	            } else {
	              bounds.extend(place.geometry.location);
	            }
	          
	          });
	        map.fitBounds(bounds);
	        };
	        

		//show or unshow the modal for the place
		$(function(){
			$("#addform").click(function(){
				$("#addplace").css("display", "block");
				
				initMap();
			})
			$("#closeA2").click(function(){
				$("#addplace").css("display", "none");
			})
		});

		var loadFile = function(event){
			var image_preview = document.getElementById('image_preview');
			image_preview.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjA-G7nAd-602rgQZiEzTq_hBzxM8eM0E&libraries=places&callback=initTag" async defer></script>
	<script >
		var searchBox;
		function initTag(){
			var input = document.getElementById('location_tag');
			searchBox = new google.maps.places.SearchBox(input);
			searchBox.addListener('places_changed', function() {
				document.getElementById('tagged_place').style.display = "block";
				document.getElementById('tagged_place').innerHTML = document.getElementById('location_tag').value;
				$(".warning").css("display", "none");
			});

		}
		//function for liking
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
		$(function(){
			$("#add_place").click(function(){

			});

			$("#posting").click(function(){

				var places = searchBox.getPlaces();
				places.forEach(function(place){
					google_placeId = place.place_id;
				});
				$.ajax({
					url:"check_place.php",
					type:"post",
					data:{'place':google_placeId},
					success:function(data1){
						if(data1=='0'){
							$(".warning").css("display","block");
						}else{
							var formData = new FormData($("#formsubmit")[0]);
							formData.append('place', data1);
							$.ajax({
								url: "post.php",
								type: "post",
								data: formData,
								success:function(data){
									var values = JSON.parse(data);
									if(values.if_image==0){
										var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span class="num-likes">3 Likes</span><button>LIKE</button></div>';
									}else{
										var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><button class="imagebtn"><img id="myImg'+values.post_id+'" onclick="showModal('+values.post_id+')" src="images/post_img/'+values.post_id+'.jpg"></button><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span class="num-likes">3 Likes</span><button>LIKE</button></div></div></div><div id="myModal'+values.post_id+'" class="modal"><span class="close" onclick="document.getElementById(\'myModal'+values.post_id+'\').style.display=\'none\'">&times;</span><img class="modal-content postImg"  id="img'+values.post_id+'"><div id="caption'+values.post_id+'" class="caption"></div></div>';
									}
									
									
									// console.log(values.if_image);
									document.getElementById('post-text-area').value="";
									document.getElementById('file').value="";
									document.getElementById('location_tag').value="";
									document.getElementById('image_preview').src="";
									$(".warning").css("display", "none");
									$("#tagged_place").css("display", "none");
									$(".posted-container").hide();
									$(".posted-container").prepend(insert);
									$(".posted-container").fadeIn();
									$("html, body").animate({ scrollTop: 200 }, "slow");
								},
								contentType: false,
		        				processData: false
							});	
						}
						
					}
				});
			});


		});
			
		</script>

</html>