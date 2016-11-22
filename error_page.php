
<!-- THIS HAS NO NAV BAR -->
<?php
	session_start();  
	if(!isset($_SESSION["userName"])){ 
		header('location:login.php');
	}
	$username = $_SESSION["userName"];

	/*$query = "SELECT * FROM account WHERE username='{$_SESSION['username']}';";
	$result= mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	$_SESSION["userID"] = $row['acc_id'];*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Toursita</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta name="James Anthony Yatar" content="Navigation Bar">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/navigation_bar_and_body_style.css">
		<link rel="stylesheet" type="text/css" href="css/error.css">
	</head>
	<body>
		<div class="container">
			<span class="error">ERROR</span>
			<p>Sorry that page can't be displayed.</p>
			<a href="home_page.php">Go back to homepage.</a>
		</div>
	</body>
</html>
