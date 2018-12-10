<?php 
	require '../lib/db.php';
	$mahd = $_GET['mahd'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cpanel</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/main.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h4 class="text-center"> Thông tin chi tiết hóa đơn </h4>
	<?php 
		$qr1 = "SELECT ngay, tenkh, sdt, diachi, tongtien FROM hoadon WHERE mahd = '$mahd'";
		$sql1 = mysqli_query($conn, $qr1);
		$row1 = mysqli_fetch_assoc($sql1);
	 ?>
	<div class="info-customer">
		<p><b>Đơn hàng:</b>DH<?= $mahd ?> -- <b>Ngày: </b><?= $row1['ngay'] ?></p>
		<p><b>Họ Tên:</b> <?= $row1['tenkh'] ?> -- <b>Số điện thoại:</b> <?= $row1['sdt'] ?></p> 
		<p><b>Địa chỉ: </b><?= $row1['diachi'] ?></p>
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Hình Ảnh</th>
				<th>Tên Sản Phẩm</th>
				<th>Số Lượng</th>
				<th>Đơn Giá</th>
				<th>Thành Tiền</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$qr = "SELECT masp, soluong FROM chitiet_hoadon WHERE mahd = '$mahd'";
				$sql =  mysqli_query($conn, $qr);
				$stt = 1;
				while($row = mysqli_fetch_assoc($sql)){
					$qr2 = "SELECT hinhanh, tensp, dongia FROM monan WHERE masp = '$row[masp]'";
					$sql2 =  mysqli_query($conn, $qr2);
					$row2 = mysqli_fetch_assoc($sql2);
					$stt++;
			?>
			<tr>
				<td><?= $stt ?></td>
				<td><img src="../images/<?= $row2['hinhanh'] ?>" alt="" width='30'></td>
				<td><?= $row2['tensp'] ?></td>
				<td><?= $row['soluong'] ?></td>
				<td><?= number_format($row2['dongia']) ?> VND</td>
				<td><?= number_format($row2['dongia'] * $row['soluong']) ?> VND</td>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
	<h2><b>Tổng tiền : </b> <?= number_format($row1['tongtien']) ?> VNĐ</h2>
		</div>
	</div>
	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>