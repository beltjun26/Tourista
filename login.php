<?php
session_start();
$error=0;
if(isset($_POST["submit"])){
	$username = $_POST["userName"];
	$password = $_POST["password"];
	$connect = mysqli_connect("localhost","root","","tourista") or die("Could not connect to the database.");
	$query = "SELECT username, password FROM account WHERE account.username='$username' AND account.password='$password'";
	$result= mysqli_query($connect, $query) or die("Query failed.");

	if(mysqli_num_rows($result) == 1){
			$_SESSION["userName"] = $username;
			$query = "SELECT acc_id FROM account WHERE username='$username';";
			$result= mysqli_query($connect, $query);
			$row = mysqli_fetch_assoc($result);
			$_SESSION["userID"] = $row['acc_id'];
			header("Location:home_page.php");
	}else{
		$error = 1;
	}
}
?>

<!DOCTYPE HTML>
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
	<link rel="stylesheet" type="text/css" href="css/login_style.css">
	<script>
		$(document).ready(function(){
			$('a[href^="#"]').on('click',function (e) {
			    e.preventDefault();

			    var target = this.hash;
			    var $target = $(target);

			    $('html, body').stop().animate({
			        'scrollTop': $target.offset().top
			    }, 900, 'swing', function () {
			        window.location.hash = target;
			    });
			});
		});
	</script>	
</head>
<body>
	<div class="container">
		<header>
			<div>
				<img src="images/Tourista_Logo_Outline.png" id="logo"><br>
				<span class="welcome">WELCOME TO</span><hr>
				<h1>TOURISTA!</h1>
				<a href="Registration.php">CREATE ACCOUNT</a>
			</div>
			<form method="post">
					<label for="userName">USERNAME</label>
			  		<input type="text" required id="user_name" name="userName">
			  		<label for="password">PASSWORD</label>
			  		<input type="password" required id="password" name="password">
			  		<?php 
					if($error == 1){ ?>
						<span class="error"><?="The username/password you entered is incorrect."?></span>
					<?php } ?>
			  		<input type="submit" name="submit" value="LOGIN">
			</form>
		</header>
	</div>
	
</body>

</html>