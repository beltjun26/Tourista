<?php	
	$host = 'localhost';  
	$username = 'root'; 
	$password = ''; 
	$db = 'database_name'; 
	$dbconn = mysqli_connect($host,$username,$password) or die("Could not connect to database!"); 
	mysqli_select_db($dbconn, 'tourista') or die( "Unable to select database");
?>