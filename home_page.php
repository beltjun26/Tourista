
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
				<!-- <li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li> -->
				<li><a href="Notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
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
					<div id="addplace" class="modal">
						<div id="unavailable" class="modal-content">
							<div class="modal-header">
							    <span id="closeA2" class="close">×</span>
							    <h2>Place is unvailable.</h2>
							</div>
							<div class="modal-body">
								<span>This place is unavailable. Fill this form to register place.</span>
								<form id="addplaceform" enctype="multipart/form-data">
									<input id="place_name" type="text" name="place_name" placeholder="Place name...">
									<textarea id="description" name="description" placeholder="Description..."></textarea>
									<div id="map"></div>
									<input id="add_place" type="button" name="place" value="Register">
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
							<div id="emptylocation" class="error-tag-loc" style="display: none;">Please tag a location</div>
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
					<div class="modal" id="delete-post">
						<div class="modal-content">
							<div class="modal-header">
								<h2>DELETE POST</h2>
								<span class="close" onclick="document.getElementById('delete-post').style.display='none'">x</span>
							</div>
							<div class="modal-body">
								<span>Are you sure to delete this post?</span>
								<div>
									<button onclick="document.getElementById('delete-post').style.display='none'">Cancel</button>
									<button id="delete-button" class="delete">Delete</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal" id="edit-post">
						<div class="modal-content">
							<div class="modal-header">
								<h2>EDIT POST</h2>
								<span class="close" onclick="document.getElementById('edit-post').style.display='none'">x</span>
							</div>
							<div class="modal-body">
								<form method="post" action="edit.php">
									<textarea name="content" placeholder="Description..."></textarea>
									<input id="editpostid" type="text" name="postid" style="display: none">
									<div>
										<button onclick="document.getElementById('edit-post').style.display='none'">Cancel</button>
										<input id="edit-button" type="submit">	
									</div>
								</form>
							</div>
						</div>
					</div>

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
							<?php if($value['acc_id']==$_SESSION['userID']): ?>
								<span class="show-dropdown glyphicon glyphicon-chevron-down"></span>
								<ul class="dropdown">
									<li><button onclick="deletePost(<?=$value['post_id']?>)" class="delete">Delete</button></li>
									<li><button onclick="editPost(<?=$value['post_id']?>)">Edit</button></li>
								</ul>	
							<?php endif ?>
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
			</div>
		</div>
	</body>

	<script>
		var person_tagged= [];
		containerheight = $('#posting-container').outerHeight(true);
		console.log(containerheight);
		containerheight = containerheight + 10;
		console.log(containerheight);
		document.getElementById("posted-container").setAttribute("style","margin: "+containerheight+"px 0 20px 0;overflow: all; z-index: -1;");
		//function for image modal
		function showModal(post_id){
			var modal = document.getElementById('myModal'+post_id);
			var img = document.getElementById('myImg'+post_id);
			var modalImg = document.getElementById("img"+post_id);
			var captionText = document.getElementById("caption"+post_id);
		    modal.style.display = "block";
		    modalImg.src = 'images/post_img/'+post_id+'.jpg';

		}
		function deletePost(post_id){
			document.getElementById('delete-post').style.display="flex";
			$("#delete-button").click(function(){
				window.location.replace("delete.php?post_id="+post_id);

			});
			// window.location.replace("delete.php?post_id="+post_id);

		}
		function editPost(post_id){
			document.getElementById('edit-post').style.display="flex";
			document.getElementById('editpostid').value=post_id;
		}
		function deleteTag(tag_id){
			var temp = [];
			var tag_list = document.getElementById('tag_list');
			tag_list.innerHTML = "";
			person_tagged.forEach(function(people){
				if(people['id']!=tag_id){
					temp.push({'id':people['id'], 'name':people['name']});
					text = "<li>"+people['name']+"<span onclick=\"deleteTag("+people['id']+")\">x</span></li>";
					$("#tag_list").append(text);
				}

			});
			if(temp.length==0){
					tag_list.style.display = "none";
				}
			person_tagged = temp;
		}
		//function for tag modal
		function showOtherTag(post_id){
			$("#people").css("display", "flex");
			$.ajax({
				url:"othertag.php",
				type:"post",
				data:{'post_id':post_id},
				success:function(data){
					var result = JSON.parse(data);
					document.getElementById('list_tag_modal').innerHTML="";
					var x=0;
					result.forEach(function(i){
						if(x>2){
							var insert = "<li><img src='images/profile_pic_img/acc_id_"+i.acc_id+".jpg' onerror='this.src = 'images/default_profile.png''><a href='people_profile.php?acc_id="+i.acc_id+"'>"+i.fullname+"</a></li>";
							$("#list_tag_modal").append(insert);
						}
						x++;
					});

				}

			});
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
			$("#tag_modal_close").click(function(){
				$("#people").css("display","none");
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
				// document.getElementById('tagged_place').style.display = "block";
				document.getElementById('tagged_place').innerHTML = document.getElementById('location_tag').value;
				document.getElementById('emptylocation').style.display="none";	
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
		$(function(){
			$("#add_place").click(function(){
				var place_name = document.getElementById('place_name').value;
				var description = document.getElementById('description').value;
				if(place_name==""&&description==""){
					alert("Please enter the fields");
				}
				else if(place_name==""){
					alert("Please enter the Place name");
				}else if(description==""){
					alert("Please enter the description of place");
				}else{
					var places = searchBox.getPlaces();
					var google_placeId;
					places.forEach(function(place){
						google_placeId = place.place_id;
					});
					var formData = new FormData($("#addplaceform")[0]);
					console.log(formData);
					formData.append('place_id',google_placeId);
					$.ajax({
						url:"addplace.php",
						type:"POST",
						data:formData,
						success:function(data){
							$(".warning").css("display", "none");
							$("#addplace").css("display", "none");
							alert(data);
							document.getElementById('place_name').value="";
							document.getElementById('description').value="";

						},
						contentType: false,
		        		processData: false
					});
				}
			});

			$("#posting").click(function(){
				if(document.getElementById('tagged_place').innerHTML==""){
					document.getElementById('emptylocation').style.display="block";
					return;
				}
				var places = searchBox.getPlaces();
				var google_placeId;
				console.log(searchBox.getPlaces());
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
									success_tag = [];
									person_tagged.forEach(function(people){
										$.ajax({
											async: false,
											url:"tagging.php",
											type: "POST",
											data:{'acc_id':people['id'],'post_id':values.post_id},
											success:function(name){
												console.log(name);
												var tag_data = JSON.parse(name);
												success_tag.push({'acc_name':tag_data.fullname,'tagged_id':tag_data.acc_id});
												
											}
										});
									});
									console.log(success_tag.length);
									var tag = "";
									var monthNames = [
									  "January", "February", "March",
									  "April", "May", "June", "July",
									  "August", "September", "October",
									  "November", "December"
									];				
									var date = new Date();
									var hour = date.getHours();
									var suffix = hour>=12?"pm":"am";
									hour = ((hour + 11) % 12 + 1);
									var current_date = monthNames[date.getMonth()]+" "+date.getDate()+", "+date.getFullYear()+", "+hour+":"+date.getMinutes()+" "+suffix;				
									if(success_tag.length<4&&success_tag.length!=0){
										tag = tag+"<li>with</li>";
										success_tag.forEach(function(tag_people){
											console.log(tag_people);
											tag=tag+"<li><a href='people_profile.php?acc_id="+tag_people['tagged_id']+"'>"+tag_people['acc_name']+"</a>,</li>";
										});
									}
									if(values.if_image==0){

										
										var insert = '<div class="posted post-container"><span class="show-dropdown glyphicon glyphicon-chevron-down"></span><ul class="dropdown"><li><button onclick="deletePost('+values.post_id+')" class="delete">Delete</button></li><li><li><button onclick="editPost('+values.post_id+')">Edit</button></li></li></ul><a href="my_profile.php"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID'] ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$_SESSION['userName']?></h2></a><ul class="with-people">'+tag+'</ul><span class="time-date">'+current_date+'</span><p class = "posted-text">'+values.post+'</p><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span id="likes'+values.post_id+'" class="num-likes"></span><button id="likebutton'+values.post_id+'"onclick="likeTriggered('+values.post_id+')">LIKE</button></div></div>';
									}else{
										var insert = '<div class="posted post-container"><span class="show-dropdown glyphicon glyphicon-chevron-down"></span><ul class="dropdown"><li><button onclick="deletePost('+values.post_id+')" class="delete">Delete</button></li><li><li><button onclick="editPost('+values.post_id+')">Edit</button></li></li></ul><a href="my_profile.php"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID'] ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$_SESSION['userName']?></h2></a><ul class="with-people">'+tag+'</ul><span class="time-date">'+current_date+'</span><p class = "posted-text">'+values.post+'</p><button class="imagebtn"><img id="myImg'+values.post_id+'" onclick="showModal('+values.post_id+')" src="images/post_img/'+values.post_id+'.jpg"></button><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><div class="like"><span id="likes'+values.post_id+'" class="num-likes"></span><button id="likebutton'+values.post_id+'"onclick="likeTriggered('+values.post_id+')">LIKE</button></div></div></div><div id="myModal'+values.post_id+'" class="modal"><span class="close" onclick="document.getElementById(\'myModal'+values.post_id+'\').style.display=\'none\'">&times;</span><img class="modal-content postImg"  id="img'+values.post_id+'"><div id="caption'+values.post_id+'" class="caption"></div></div>';
									}

									// console.log(values.if_image);
									document.getElementById('post-text-area').value="";
									document.getElementById('file').value="";
									document.getElementById('location_tag').value="";
									document.getElementById('image_preview').src="";
									document.getElementById('tag_list').innerHTML="";
									document.getElementById('tagged_place').innerHTML="";
									$(".warning").css("display", "none");
									$(".posted-container").hide();
									$(".posted-container").prepend(insert);
									$(".posted-container").fadeIn();
									$("html, body").animate({ scrollTop: 200 }, "slow");
									$("#tag_list").css("display","none");

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
					var insert = "<li>"+ui.item.value+"<span onclick=\"deleteTag("+ui.item.id+")\">x</span></li>";
					$("#tag_list").css("display","flex");
					$("#tag_list").append(insert);
					person_tagged.push({'id':ui.item.id,'name':ui.item.value});
					
				}
				
			});


		});
			
		</script>
	
</html>