
<?php
	session_start(); 
	$masp = $_GET['id'];
	if (isset($_SESSION['cart'][$masp])) {
		$soluong += $_SESSION['cart'][$masp];
	}else{
		$soluong = 1;
	}

	$_SESSION['cart'][$masp] = $soluong;
	header("location:cart.php");
	exit();
 ?>