<?php 
	function checkUser($username, $password, $phone, $fullname, $address){
		require "../lib/db.php";
			$query = "SELECT taikhoan FROM khachhang WHERE taikhoan = '$username'";
			$excute = mysqli_query($conn, $query);
			if(mysqli_num_rows($excute) == 1 ){
				echo "<script type='text/javascript'>alert('Tài khoản này đã được đăng ký !');</script>";
			}else{
				if($username && $password && $phone && $fullname && $address){
				$sql = "INSERT INTO khachhang(taikhoan, matkhau, hoten, sodt, diachi) VALUES ('$username', '$password', '$phone', '$fullname', '$address')";
				$excute = $conn -> query($sql);
				    echo "<script language='javascript'>alert('Đăng ký thành công');</script>";	
				    header("refresh:1; url=../index.php");
			    }
			}
		mysqli_close($conn);
		}
?>