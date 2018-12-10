<?php 
	$server = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "db_fastfood";
	$conn = mysqli_connect($server, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");
?>