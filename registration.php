<?php
$dbconn = mysqli_connect("localhost","root","","tourista") or die("Could not connect to database!");
mysqli_select_db($dbconn, "tourista");
$emailError = false;
$firstnameError = false;
$lastnameError = false;
$userNameError = false;
$passwordError = false;
$formError = false;
if(isset($_POST['submit']) ) { 
	$firstname = ($_POST['firstname']);
	$lastname = ($_POST['lastname']);
	$username = ($_POST['username']);
	$email = ($_POST['email']);
	$password = ($_POST['password']);
	$retype = ($_POST['retype']);

	if ($firstname == "" || $lastname == "" || $username == "" || $email == "" || $password == "" || $retype == "") {
		$formError = true;
	}

	if ($firstname == ""){
		$firstnameError = true;
	}

	if ($lastname == ""){
		$lastnameError = true;
	}

	//check username if duplicate
	$checkUserQuery = "SELECT username from account WHERE username = '$username'";
	$dupUserRes = mysqli_query($dbconn,$checkUserQuery);
	if(mysqli_num_rows($dupUserRes) != 0){
		$userNameError = true;
	}



	//check email if duplicate
	$checkEmailQuery = "SELECT email from account WHERE email = '$email'";
	$dupEmailRes = mysqli_query($dbconn,$checkEmailQuery);
	if(mysqli_num_rows($dupEmailRes) != 0){
		$emailError = true;
	}

	//match password and retype password
	if($password != $retype){
		$passwordError = true;
	}


	//add details to database
	if(!$formError && !$firstnameError && !$lastnameError && !$emailError && !$userNameError && !$passwordError){
		$addQuery = "INSERT INTO account(username, firstname, lastname, password, email) VALUES('{$_POST[username]}','{$_POST[firstname]}','{$_POST[lastname]}',MD5('{$_POST[password]}'),'{$_POST[email]}')";
		$addRes = mysqli_query($dbconn,$addQuery);
		header('Location: login.php');
	}

}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>TourisTA!</title>
		<link rel="shortcut icon" href="images/Tourista_Logo_Outline_blue.ico"/>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style_registration.css">
	</head>
	<body>
		<div class="container" id="container">
			<h1> CREATE ACCOUNT </h1>
			<form method = "post">
						<?php if($formError): ?>
				  			<span class="error">Please fill the form completely</span>
				  		<?php endif; ?>
				  		<input type="text" id="first_name" name="firstname" pattern="^[a-zA-Z\s]+$" value="<?php if(isset($_POST['submit'])) echo ($_POST['firstname']); ?>" placeholder="First Name" autofocus>

				  		<input type="text" id="last_name" name="lastname" pattern="^[a-zA-Z\s]+$" value="<?php if(isset($_POST['submit'])) echo ($_POST['lastname']); ?>" placeholder="Last Name">

						<!-- Add minimum length 8 and at least 1 integer. -->
				  		<input type="text" id="user_name" name="username"  value="<?php if(isset($_POST['submit']) && !$userNameError) echo ($_POST['username']); ?>" placeholder="Username">
				  		<?php if($userNameError): ?>
				  			<span class="error">Username already exists!</span>
				  		<?php endif; ?>

				  		<input pattern = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" type="password" id="password" name="password" placeholder="Password(at least 8 alphabet characters and 1 no.)">

				  		<!-- Need to retype password for verification. -->
				  		<input type="password" name="retype" placeholder="Retype Password">
				  		<?php if($passwordError): ?>
				  			<span class="error">Retype password does not match password input.</span>
				  		<?php endif; ?>


				 		<input type="email" name="email"  value="<?php if(isset($_POST['submit']) && !$emailError) echo ($_POST['email']); ?>" placeholder="Email (example123@sample.com)">
				  		<?php if($emailError): ?>
				  			<span class="error">Email is already taken.</span>
				  		<?php endif; ?>


						<input type="submit" name="submit" value="CREATE">
						<p>YOU HAVE AN ACCOUNT?</p>
						<a class="pagelink" href="login.php">SIGN IN</a>
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