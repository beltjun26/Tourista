<!DOCTYPE HTML>
<html>
	<head>
		<title>Registration Page</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style_registration.css">
	</head>
	<body>
		<div class="container">
			<form action="thanks.php" id="regform">
						<h1> CREATE ACCOUNT </h1>
				<!-- <label for="first_name">FIRST NAME</label> -->
				  		<input type="text" required id="first_name" name="firstname" placeholder="First Name" autofocus>
				<!-- <label for="last_name">LAST NAME</label> -->
				  		<input type="text" required id="last_name" name="lastname" placeholder="Last Name">
				<!-- <label for="user_name">USERNAME</label> -->
				  		<input type="text" required id="user_name" name="username" placeholder="Username">
				<!-- <label for="password">PASSWORD</label> -->
				  		<input type="password" required id="password" name="password" placeholder="Password">
				<!-- <label for="email">E-MAIL</label> -->
				 		<input type="email"  required name="email" placeholder="Email (example123@sample.com)">
				<!-- <label for="etc"> ETC.(IMPORTANT DETAILS) </label> -->
				 		<!-- <textarea name="etc" form="regform">Enter text here...</textarea> -->
						<input type="submit" value="CREATE">
						<p>YOU HAVE AN ACCOUNT?</p>
						<a class="pagelink" href="login.php">SIGN IN</a>
			</form>
		</div>
	</body>
</html>