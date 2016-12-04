<!DOCTYPE html>
<html>
<head>
	<title>Tourista!</title>
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
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
			<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
		</ul>
	</div>
	<div class="container gal">
		<h2>Gallery for -Place-</h2>
		<div class="image"><button id="myBtn" class="imagebtn"></button></div>
		<!-- <img id="myImg" src="images/places/diwata/1.jpg" alt="Trolltunga, Norway" width="300" height="200"> -->
		<div id="myModal" class="modal">
		  	<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
		  	<img class="modal-content" id="img01">
		  	<div id="caption"></div>
		</div>
		<div class="image"><button id="myBtn2" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn3" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn4" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn5" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn6" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn7" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn8" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn9" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn10" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn11" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn12" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn13" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn14" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn15" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn16" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn17" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn18" class="imagebtn"></button></div>
		<div class="image"><button id="myBtn19" class="imagebtn"></button></div>
		<!-- <div class="image"><button id="myBtn20" class="imagebtn"></button></div> -->
		<!-- <p class="place-name"></p> -->
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
</body>
</html>