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
	<body style="padding: 0;"> 
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

							<div class="posted post-container">
								<a href="people_profile.php?acc_id_=1">
									<img src="images/profile_pic_img/acc_id_1.jpg" alt="USER PHOTO" class="profile">
									<h2 class="user-name"><!-- <?=$value['username'];?> -->Hello</h2>
								</a>
								<p class = "posted-text">asdasdasd</p>
								
									<button class="imagebtn"><img id="myImg1" onclick="showModal(1)" src="images/post_img/1.jpg"></button>


								<a href="place.php?place_id=1" class="tagged-location">asdads</a>
								<div class="like">
									<span class="num-likes">3 Likes</span>
									<button>LIKE</button>
								</div>
							</div>
							
							<div id="myModal<?=$value['post_id']?>" class="modal">
								<span id="close1" class="close" onclick="document.getElementById('myModal<?=$value['post_id']?>').style.display='none'">&times;</span>
								<img class="modal-content postImg"  id="img<?=$value['post_id']?>">
								<div id="caption<?=$value['post_id']?>" class="caption"></div>
							</div>

					</div>
				</div>
			</div>
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
			function initTag(){
				var input = document.getElementById('location_tag');
        		searchBox = new google.maps.places.SearchBox(input);
        		searchBox.addListener('places_changed', function() {
        			document.getElementById('tagged_place').style.display = "block";
        			document.getElementById('tagged_place').innerHTML = document.getElementById('location_tag').value;
        		});

			}
			$(function(){

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
											var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><button class="like">LIKE</button></div></div>';
										}else{
											var insert = '<div class="posted post-container"><a href="people_profile.php?acc_id_=<?=$value['acc_id'];?>"><img src="images/profile_pic_img/acc_id_<?=$value['acc_id']; ?>.jpg" alt="USER PHOTO" class="profile"><h2 class="user-name"><?=$value['username'];?></h2></a><p class = "posted-text">'+values.post+'</p><button class="imagebtn"><img id="myImg'+values.post_id+'" onclick="showModal('+values.post_id+')" src="images/post_img/'+values.post_id+'.jpg"></button><div class="contain"><a href="place.php?place_id='+values.placeID+'" class="tagged-location">'+values.location_name+'</a><button class="like">LIKE</button></div></div><div id="myModal'+values.post_id+'" class="modal"><span class="close" onclick="document.getElementById(\'myModal'+values.post_id+'\').style.display=\'none\'">&times;</span><img class="modal-content postImg"  id="img'+values.post_id+'"><div id="caption'+values.post_id+'" class="caption"></div></div>';
										}
										
										
										// console.log(values.if_image);
										document.getElementById('post-text-area').value="";
										document.getElementById('file').value="";
										document.getElementById('location_tag').value="";
										document.getElementById('image_preview').src="";
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
		<script>
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