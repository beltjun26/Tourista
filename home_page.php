<!-- THIS HAS NO NAV BAR -->


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TourisTA! - Homepage</title>
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
	</head>
	<body>
		<div id = "navBar">
			<!-- <img src="images/Tourista_Logo_outline_black.png">
			<h1>TOURISTA!<br><span> HELLO USER </span></h1> -->

			<form action="search_results_places.html" method="get">
				<input type="text" placeholder="Search...">
				<!-- <input type="submit" value="SEARCH" > -->
			</form>
			<ul id = "navList">
				<li><a href="#" class="active"> HOME </a></li>
				<li><a href="visit.html"> VISITS </a></li>
				<li><a href="#"> EXPLORE </a></li>
				<li><a href="Notifications.html"> NOTIFICATIONS </a></li>
				<li><a href="login.html"> LOGOUT </a></li>
				<li><img src="images/temp_pp.png"></li>
				
				<!-- <li class="dropdown">
				    <a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">PROFILE<img src="images/temp_pp.png" class="dropbtn" alt="USER PHOTO" onclick="myFunction()"></a>
				    <div class="dropdown-content" id="myDropdown">
				      	<a href="#"> Visits </a>
						<a href="#"> Starred Places </a>
						<a href="#"> Notifications </a>
						<a href="#"> Logout </a>
				    </div>
				</li> -->
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="user-box">
						<a href="#">
							<img src="images/Body_Background.png" alt="USER PHOTO">
							<img src="images/temp_pp.png" alt="USER PHOTO">
						</a>
						<h2 class="user-box-heading">JOSP_123</h2>
						<!-- <a href="#"><h3 id="following-link">FOLLOWING: 111</h3></a>
							<a href="#"><h3 id="followers-link">FOLLOWERS: 0</h3></a> -->
					</div>
				</div>
				<div class="col-sm-6">
					<div class="posting-container">
						<div class="col-sm-2">
							<img src="images/temp_pp.png" alt="USER PHOTO">
						</div>
						<div class="col-sm-10">
							<a href="#">ADD A PHOTO</a>
							<form action="output.html" method="get">
								<textarea id="post-text-area" cols="50" rows="5" placeholder="TEXT HERE..."></textarea>
								<input type="text-field" placeholder="LOCATION TAG AUTOFILL">
							 	<input type="submit" value="POST">
							</form>
						</div>
					</div>
					<div class="posted-container">
						<img src="images/temp_pp.png" alt="USER PHOTO" id="pp">
						<h2 class="user-name">JOSP_123</h2>
						<button id="myBtn" class="imagebtn"><img src="images/Body_Background.png"></button>
						<div class="col-sm-10">
							<p class = "posted-text">Here in Miag-ao Church. This place is old!</p>
							<a href="place.html" class="tagged-location">MIAG-AO CHURCH</a>
						</div>
						<div class="col-sm-2">
							<button>LIKE</button>
						</div>
					</div>
					<div id="myModal" class="modal">
					  	<div class="modal-content">
					    	<div class="modal-header">
					      		<img src="images/temp_pp.png" alt="USER PHOTO" id="pp">
								<h2 class="user-name">JOSP_123</h2>
					      		<span class="close">×</span>
					    	</div>
						    <div class="modal-body">
						      	<img src="images/Body_Background.png" class="modalimg">
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var modal = document.getElementById('myModal');
			var btn = document.getElementById("myBtn");
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
		</script>
	</body>
</html>