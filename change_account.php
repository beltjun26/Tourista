<!DOCTYPE html>
<html>
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/Style_registration.css">
	</head>
	<body>
		<?php 
			require "connect.php";
			session_start();
		?>
		<div id = "navBar">
			<form action="search_results_places.php" method="get">
				<input type="text" placeholder="Search..." name="search">
			</form>

			<ul id = "navList">
				<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
				<li><a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
				<li><a href="my_profile.php?=<?=$_SESSION['userID']?>" class="image-list"><img src="images/profile_pic_img/acc_id_<?=$_SESSION['userID']?>.jpg"></a></li>
			</ul>
		</div>
		<div class="container" id="container">
			<h1>Change Account Settings</h1>
			<form>
				<input type="text" name="username" placeholder="Username">
				<span class="error" style="display: none;">Error<!-- Echo error here --></span>

				<input type="password" name="curpass" placeholder="Current Password">
				<span class="error" style="display: none;"><!-- Echo error here --></span>

				<input type="password" name="newpass" placeholder="New Password">
				<span class="error" style="display: none;"><!-- Echo error here --></span>

				<input type="password" name="retpass" placeholder="Retype Password">
				<span class="error" style="display: none;"><!-- Echo error here --></span>
				
				<input type="submit" name="changeset" value="CHANGE">
				<a class="pagelink" href="my_profile.php">CANCEL</a>
			</form>
		</div>
		<script>
			h = $('#navBar').outerHeight(true);
			console.log(h);
			x = window.innerHeight;
			console.log(x);
			x = x - h;
			console.log(x);
			document.getElementById('container').setAttribute("style","min-height: "+x+"px;width:100%;margin-top:"+h+"px;");
		</script>
	</body>
</html>