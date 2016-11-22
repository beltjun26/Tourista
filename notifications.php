<!DOCTYPE html>
<html>
<head>
	<title>Tourista!</title>
	<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
	<link rel="stylesheet" type="text/css" href="css/notifications.css">
</head>
<body>
	<div id = "navBar">
		<form action="search_results_places.php" method="get">
			<input type="text" placeholder="Search..." name = "search">
		</form>
		<ul id = "navList">
			<li><a href="home_page.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li><a href="visit.php"><span class="glyphicon glyphicon-map-marker"></span>VISITS</a></li>
			<li><a href="#"><span class="glyphicon glyphicon-globe"></span>EXPLORE</a></li>
			<li><a href="Notifications.php" class="active"><span class="glyphicon glyphicon-bell"></span>NOTIFICATIONS</a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li><a href="people_profile.php" class="image-list"><img src="images/pp_cover/Clyde1.jpg"></a></li>
		</ul>
	</div>
	<div class="container">
		<div class="notif-container">
			<img class="user-photo" src="images/pp_cover/Clyde1.jpg">
			<button type="button" class="close">&times;</button>
			<span class="username">Xon_123</span>
			<span class="time-stamp">4:00AM November 14, 2016</span>
			<p>Xon_123 started following you.</p><br>
			<a href="people_profile.php" class="view">View</a>
		</div>
		<div class="notif-container">
			<img class="user-photo" src="images/pp_cover/Clyde1.jpg">
			<button type="button" class="close">&times;</button>
			<span class="username">Xon_123</span>
			<span class="time-stamp">4:00AM November 14, 2016</span>
			<p>Xon_123 started following you.</p><br>
			<a href="people_profile.php" class="view">View</a>
		</div>
		<div class="notif-container">
			<img class="user-photo" src="images/pp_cover/Clyde1.jpg">
			<button type="button" class="close">&times;</button>
			<span class="username">Xon_123</span>
			<span class="time-stamp">4:00AM November 14, 2016</span>
			<p>Xon_123 started following you.</p><br>
			<a href="people_profile.php" class="view">View</a>
		</div>
		<div class="notif-container">
			<img class="user-photo" src="images/pp_cover/Clyde1.jpg">
			<button type="button" class="close">&times;</button>
			<span class="username">Xon_123</span>
			<span class="time-stamp">4:00AM November 14, 2016</span>
			<p>Xon_123 started following you.</p><br>
			<a href="people_profile.php" class="view">View</a>
		</div>
	</div>
</body>
</html>