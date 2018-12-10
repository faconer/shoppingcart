<?php
	session_start();	
	require '../lib/db.php';
	
if (isset($_POST["ok"])) {
	if (empty($_POST["username"])) {
		echo "<script type='text/javascript'>alert('Vui long nhap username');</script>";
	} else {
		$username = addslashes($_POST["username"]);
	}
	if (empty($_POST["password"])) {
		echo "<script type='text/javascript'>alert('Vui long nhap password');</script>";
	} else {
		$password = $_POST["password"];
	}

	$sql = "SELECT * FROM khachhang where taikhoan ='$username' and matkhau ='$password'";
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) == 1) {
		$data = mysqli_fetch_assoc($result);
		$_SESSION["username"] = $username;
		echo "<script type='text/javascript'>alert('Đăng nhập thành công !');</script>";
      	header("refresh:1; url=../index.php");
		exit();
	} else {
		echo "<script language='javascript'>alert('Sai username or password!');</script>";
	}
	mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/main.css">
</head>
<body>
    <section class="login">
      <div class="container">
        <div class="row">
            <h3 class="log">Đăng Nhập</h3>
            <form action="" method="POST" role="form" class="form-log">
              <div class="form-group inp-log">
                <label for="">Username</label>
                <input type="text" class="form-control"  placeholder="Username" name="username">
              </div>
              <div class="form-group inp-log">
                <label for="">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <button type="submit" class="btn btn-primary" name="ok">Login</button>
            </form>
        </div>
      </div>
    </section>
 	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>