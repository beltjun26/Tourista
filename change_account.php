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
	</head>
	<body>
		<div class="container">
			<h1>Change Account Settings</h1>
			<form>
				<input type="text" name="username" placeholder="Username"><span class="error"><!-- Echo error here --></span><br>
				<input type="password" name="curpass" placeholder="Current Password"><span class="error"><!-- Echo error here --></span><br>
				<input type="password" name="newpass" placeholder="New Password"><span class="error"><!-- Echo error here --></span><br>
				<input type="password" name="retpass" placeholder="Retype Password"><span class="error"><!-- Echo error here --></span><br>
				<input type="submit" name="changeset" value="Change">
			</form>
		</div>
	</body>