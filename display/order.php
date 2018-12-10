<?php
  session_start();
  require '../lib/db.php';
  $ten = $sdt = $diachi = NULL;
  //check username
if(isset($_SESSION["username"])){
	if(isset($_POST["ok"])){
		$ten = $_SESSION['hoten'];
		$sdt = $_SESSION['sdt'];
		$diachi = $_SESSION['dc'];
	    if($ten && $sdt && $diachi){
	      //lay ma hoa don lon nhat trong csdl ra cong them 1 lam ma hoa don moi
	      
	      $ab = "SELECT max(mahd) FROM hoadon";
	      $re = mysqli_query($conn, $ab);
	      if(mysqli_num_rows($re) == 0 ){
	        $mahd = 1;
	      }else{
	        $data = mysqli_fetch_assoc($re);
	        $mahd = $data['max(mahd)']+1;
	      }
      	// thuc hien luu thong tin khach hang vao bang hoa don va thong tin hoa don
      	$qr = "INSERT INTO hoadon(mahd, ngay, tenkh, sdt, diachi, tongtien) VALUES ('$mahd',NOW(), '$_SESSION[hoten]','$_SESSION[sdt]','$_SESSION[dc]', '$_SESSION[tongtien]')";
      	$kq = mysqli_query($conn, $qr);

      	foreach($_SESSION['cart'] as $masp => $soluong){
      		$a = "INSERT INTO chitiet_hoadon(mahd, masp, soluong) VALUE ('$mahd', '$masp','$soluong')";
      		$kq = mysqli_query($conn, $a);
      	}
      // huy thong tin trong gio hang
      	session_destroy();
      	echo "<script type='text/javascript'>alert('Đặt hàng thành công !');</script>";
      	header("refresh:0.0001; url=../index.php");
      	mysqli_close($conn);
      	}
    }

    }else{
      	if(isset($_POST["ok"])){
      		if(empty($_POST["ten"])){
      			echo "<script type='text/javascript'>alert('Vui long nhap ho va ten');</script>";
      		}else{
      			$ten = $_POST["ten"];
      		}
      		if(empty($_POST["sdt"])){
      			echo "<script type='text/javascript'>alert('Vui long nhap so dien thoai');</script>";
      		}else{
      			$sdt = $_POST["sdt"];
      		}
      		if(empty($_POST["diachi"])){
      			echo "<script type='text/javascript'>alert('Vui long nhap dia chi');</script>";
      		}else{
      			$diachi = $_POST["diachi"];
      		}
      		if($ten && $sdt && $diachi){
	      //lay ma hoa don lon nhat trong csdl ra cong them 1 lam ma hoa don moi

      			$ab = "SELECT max(mahd) FROM hoadon";
      			$re = mysqli_query($conn, $ab);
      			if(mysqli_num_rows($re) == 0 ){
      				$mahd = 1;
      			}else{
      				$data = mysqli_fetch_assoc($re);
      				$mahd = $data['max(mahd)']+1;
      			}
	      // thuc hien luu thong tin khach hang vao bang hoa don va thong tin hoa don
      			$qr = "INSERT INTO hoadon(mahd, ngay, tenkh, sdt, diachi, tongtien) VALUES ('$mahd',NOW(), '$ten','$sdt','$diachi', '$_SESSION[tongtien]')";
      			$kq = mysqli_query($conn, $qr);

      			foreach($_SESSION['cart'] as $masp => $soluong){
      				$a = "INSERT INTO chitiet_hoadon(mahd, masp, soluong) VALUE ('$mahd', '$masp','$soluong')";
      				$kq = mysqli_query($conn, $a);
      			}
	      // huy thong tin trong gio hang
      			session_destroy();
      			echo "<script type='text/javascript'>alert('Dat hang thanh cong');</script>";
      			header("refresh:0.0001; url=../index.php");
      			mysqli_close($conn);
      		}
      	}
  	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thông tin khách hàng</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/main.css">
</head>
<body>
	<section class="checkout">
      <div class="container">
        <div class="row">
           <h3 class="info text-center">Thông Tin Đặt Hàng</h3>
            <div class="col-md-6">
              <div class="detail-product">
                <div class="namepr">
				<?php 
					foreach ($_SESSION['cart'] as $masp => $soluong) {
						$query_ex = "SELECT tensp, dongia FROM monan WHERE masp = '$masp'";
						$sql_ex = mysqli_query($conn, $query_ex);
						while ($data_ex = mysqli_fetch_assoc($sql_ex)){
							echo "<b>".$data_ex['tensp']." / ".$soluong." / ".number_format($data_ex['dongia'])." VNĐ</b> </br>";
              		 	} 
              		}
              	?>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="ship">
                  <p><b>Vận chuyển:</b> <span style="float: right">Giao hàng tận nơi</span> </p>
                  <p><b>Thanh toán: </b><span style="float: right">Sau khi giao hàng</span></p>
                </div>
                <hr>
                <div class="viewpay">
                  <p><b>Tạm tính: </b><span style="float: right"><?= number_format($_SESSION['tongtien']) ?> VNĐ</span> </p>
                  <p><b>Phí vận chuyển: </b><span style="float: right">Free</span></p>
                </div>
                <hr>
                <div class="total">
                   <p><b>Tổng cộng: </b><span style="float: right"><?= number_format($_SESSION['tongtien']) ?> VNĐ</span> </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            	<?php 
            		if (isset($_SESSION["username"])) {
            			$query_min = "SELECT hoten, sodt, diachi FROM khachhang WHERE taikhoan = '$_SESSION[username]'";
            			$sql_min = mysqli_query($conn, $query_min);
            			$data_min = mysqli_fetch_assoc($sql_min);
            			$a_min = $data_min['hoten']; $_SESSION['hoten'] = $a_min;
            			$b_min = $data_min['sodt']; $_SESSION['sdt'] = $b_min;
            			$c_min = $data_min['diachi']; $_SESSION['dc'] = $c_min;
		            	echo "
		            	<form action='order.php' method='POST' role='form' autocomplet='no'>
		            		<div class='form-group '>
		            			<label for=''>Họ và Tên</label>
		            			<input type='text' class='form-control' value='$data_min[hoten]' readonly>
		            		</div>
		            		<div class='form-group '>
		            			<label for=''>Số điện thoại</label>
		            			<input type='text' class='form-control' value='$data_min[sodt]' readonly >
		            		</div>
		            		<div class='form-group '>
		            			<label for=''>Địa chỉ</label>
		            			<input type='text' class='form-control' value='$data_min[diachi]' readonly>
		            		</div>
		            		<button type='submit' class='btn btn-info' name='ok'>Đặt Hàng</button>
		            	</form>";
            		}else{
            			echo "
            			<form action='order.php' method='POST' role='form' autocomplet='no'>
		            		<div class='form-group '>
		            			<label for=''>Họ và Tên</label>
		            			<input type='text' class='form-control'  placeholder='Họ và tên' name='ten' >
		            		</div>
		            		<div class='form-group '>
		            			<label for=''>Số điện thoại</label>
		            			<input type='text' class='form-control'  placeholder='Số điện thoại' name='sdt' >
		            		</div>
		            		<div class='form-group '>
		            			<label for=''>Địa Chỉ</label>
		            			<textarea type='text' class='form-control'  placeholder='Địa chỉ' name='diachi' ></textarea>
		            		</div>
		            		<button type='submit' class='btn btn-info' name='ok'>Đặt Hàng</button>
		            	</form>";
            		}
            	 ?>
            </div> 
        </div>
      </div>
    </section>	
	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>