<?php 
	require '../lib/db.php';
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
	<h4 class="text-center">List bills</h4>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Đơn hàng</th>
				<th>Ngày</th>
				<th>Họ và tên khách hàng</th>
				<th>Tổng tiền</th>
				<th>Xem</a></th>
				<th>Xóa</a></th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$qr = "SELECT mahd, tenkh, ngay, tongtien FROM hoadon ORDER BY mahd DESC";
				$sql =  mysqli_query($conn, $qr);
				while($row = mysqli_fetch_assoc($sql)){
			?>
			<tr>
				<td><?= $row['mahd'] ?></td>
				<td><?= $row['ngay'] ?></td>
				<td><?= $row['tenkh'] ?></td>
				<td><?= number_format($row['tongtien']) ?> VND</td>
				<td><a href="detail-bills.php?mahd=<?= $row['mahd'] ?>">Xem</a></td>
				<th><a href="del.php?mahd=<?= $row['mahd']?>">Xóa</a></th>
			</tr>
			<?php 
				}
			?>
		</tbody>
	</table>
	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>