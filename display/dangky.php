<?php 
	require "../lib/db.php";
	require '../function/checkuser.php';
	if(isset($_POST['btnSubmit'])){
		$username   = addslashes($_POST['username']);
	    $password   = addslashes($_POST['password']);
	    $phone      = addslashes($_POST['phone']);
	    $fullname   = addslashes($_POST['fullname']);
	    $address    = addslashes($_POST['address']);
	    if (!$username || !$password || !$phone || !$fullname || !$address){
	    	echo "<script language='javascript'>alert('Vui lòng đầy đủ thông tin');</script>";
	    }
	    checkUser($username, $password, $phone, $fullname, $address);
	}
	mysqli_close($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng ký thành viên</title>
	<link rel="stylesheet" href="../bootstrap/css/dangky.css">
</head>
<body>
	<div class="main-register">
		<form action="dangky.php" method="post" autocomplete="off" id="form-group" class="group-2">
			<h2>Đăng ký thành viên</h2>
			
			<div class="input-group">
				<label for="username">Tên đăng nhập</label><br>
				<input type="text" name="username" id="usename" >
			</div>
			
			<div class="input-group">
				<label for="password">Mật khẩu</label><br>
				<input type="password" name="password" id="password" >
			</div>

			<div class="input-group">
				<label for="phone">Số điện thoại</label><br>
				<input type="text" name="phone" id="phone" >
			</div>

			<div class="input-group">
				<label for="fullname">Họ và tên</label><br>
				<input type="text" name="fullname" id="fullname" >
			</div>

			<div class="input-group">
				<label for="address">Địa chỉ</label><br>
				<input type="text" name="address" id="address" >
			</div>
			<button type="submit" name="btnSubmit">Đăng Ký</button>
		</form>
	</div>
</body>
</html>