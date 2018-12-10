
<?php 
	session_start();
	$soluongmoi = $_POST['slm'];
	$masp = $_POST['masp'];
	$_SESSION['cart'][$masp] = $soluongmoi;
 ?>