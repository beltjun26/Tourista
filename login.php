<!DOCTYPE HTML>
<html>
<head>
	<title> Homepage </title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script src="../bootstrap/jquery/1.12.4/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/login_style.css">
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
				<img src="../images/Tourista_Logo_Outline.png" id="logo"><br>
				<span>WELCOME TO</span><hr>
				<h1>TOURISTA!</h1>
				<a href="Registration.html">CREATE ACCOUNT</a>
			</div>
			<form action="home_page.html">
					<label for="userName">USERNAME</label>
			  		<input type="text" required id="user_name" name="userName">
			  		<label for="first_name">PASSWORD</label>
			  		<input type="password" required id="first_name" name="firstname">
			  		<input type="checkbox" name="rememberMe" value="REMEMBER_ME" style="opacity: 0;">
			  		<label for="rememberMe" style="opacity: 0;">REMEMBER ME</label>
			  		<input type="submit" value="LOGIN">
			</form>
		</header>
	</div>
	
</body>

</html>