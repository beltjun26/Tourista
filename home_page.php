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
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script src="js/jquery-1.12.4.js" ></script>
		<script src="js/jquery-ui.js" ></script>
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
				<li><a href="my_profile.php" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" onerror = "this.src = 'images/default_profile.png'"></a></li>
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="user-box">
						<a href="my_profile.php">
							<img src="images/cover_img/cover_<?=$_SESSION['userID']?>.png" alt="user-cover" class="cover" onerror = "this.src = 'images/default_cover.png'">
							<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="user-profile" onerror = "this.src = 'images/default_profile.png'" class="profile">
						</a>
						<h2 class="user-box-heading"><?=$username?></h2>
					</div>
				</div>
				<div class="col-sm-6">
					<div id="addplace" class="modal" style="display: block;" >
						<div id="unavailable" class="modal-content">
							<div class="modal-header">
							    <span id="closeA2" class="close">×</span>
							    <h2>Place is unvailable.</h2>
							</div>
							<div class="modal-body">
								<span>This place is unavailable. Fill this form to register place.</span>
								<form>
									<input type="text" name="place_name" placeholder="Place name...">
									<textarea placeholder="Description..."></textarea>
									<div id="map"></div>
									<input id="add_place" type="submit" name="place" value="Register">
								</form>
							</div>
						</div>
					</div>
					<div class="posting post-container" id="posting-container">
						<img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg" alt="USER PHOTO" class="profile" onerror = "this.src = 'images/default_profile.png'" >

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
							<div class="error" style="display: none;">Please tag a location</div>
							<div class="warning" style="display: none">
								<span>Place not available.</span>
								<input id="addform" type="button" name="addform" value="add">
								<!-- <button id="addform">add</button> -->
							</div>
							<input type="text-field" placeholder="Tag a person" class="tag-person" id="person_tag">
							<ul id="tag_list" style="display: none;" class="tagged-people">
								<!-- Echo people here. -->
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
								<span class="close" onclick="document.getElementById('myModal<?=$value['post_id']?>').style.display='none'">&times;</span>
								<img class="modal-content postImg"  id="img<?=$value['post_id']?>">
								<div id="caption<?=$value['post_id']?>" class="caption"></div>
							</div>
							<?php endif; ?>

						<?php endforeach; ?>
						
						<!-- END OF POSTED -->
					</div>
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
										var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span id="likes'+values.post_id+'" class="num-likes"></span><button id="likebutton'+values.post_id+'"onclick="likeTriggered('+values.post_id+')">LIKE</button></div></div>';
									}else{
										var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><button class="imagebtn"><img id="myImg'+values.post_id+'" onclick="showModal('+values.post_id+')" src="images/post_img/'+values.post_id+'.jpg"></button><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span id="likes'+values.post_id+'" class="num-likes"></span><button id="likebutton'+values.post_id+'"onclick="likeTriggered('+values.post_id+')">LIKE</button></div></div></div><div id="myModal'+values.post_id+'" class="modal"><span class="close" onclick="document.getElementById(\'myModal'+values.post_id+'\').style.display=\'none\'">&times;</span><img class="modal-content postImg"  id="img'+values.post_id+'"><div id="caption'+values.post_id+'" class="caption"></div></div>';
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

			$("#person_tag").autocomplete({
				source:"tag_person.php",
				minLength:2,
				select: function(event, ui){
					var insert = "<li>"+ui.item.value+"</li>";
					$("#tag_list").css("display","block");
					$("#tag_list").append(insert);
					document.getElementById('person_tag').value="sdf";
				}
				
			});


		});
			
		</script>
	
</html>