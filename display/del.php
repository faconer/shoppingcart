<?php 
	session_start();
	$masp = $_GET['masp'];
	unset($_SESSION['cart'][$masp]);
	header("Location:cart.php");
	exit();
 ?>