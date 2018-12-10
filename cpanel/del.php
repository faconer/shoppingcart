<?php
	require '../lib/db.php'; 
	$mahd = $_GET['mahd'];
	$sql = "DELETE FROM hoadon, chitiet_hoadon WHERE mahd='$mahd'";
	$conn->query($sql);
	header("Location:../cpanel/list-bills.php");
	exit();
 ?>