<?php 
	require '../lib/db.php';
	$masp = $_GET['id'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Xem chi tiết sản phẩm</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/main.css">
</head>
<body>
	<div class="container main-detail">
		<div class="row">
			<?php 
				$sql = "SELECT hinhanh, tensp, dongia FROM monan WHERE masp = '$masp'";
				$query = mysqli_query($conn, $sql);
				$data = mysqli_fetch_assoc($query)
			 ?>
			<div class="col-md-6">
				<div class="img-product">
					<img src="../images/<?= $data['hinhanh'] ?>" alt="" width="100%">
				</div>
			</div>
			<div class="col-md-6">
				<div class="detail">
					<h4 class="text-primary">Tên sản phẩm : <?= $data['tensp'] ?></h4>
					<p>Mã món ăn : <?= $masp ?></p>
					<div class="price">
						<p><b>Giá sản phẩm : <soan class="text-danger"><?= number_format($data['dongia']) ?> VNĐ</span></b></p>
					</div>
					<div class="quantity">
						<p>Số lượng : 10</p>
					</div>
					<div class="description">
						<p>Giới thiệu:</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab quasi perferendis atque dignissimos saepe excepturi culpa natus repellendus repellat. Enim omnis impedit, minus dolores, qui minima aliquam velit beatae ducimus illo!</p>
					</div>
					<button class="btn btn-success order"><a href="add-cart.php?id=<?= $masp?>">Đặt Hàng</a></button>
				</div>
			</div>
			<?php  mysqli_close($conn); ?>
		</div>
	</div>
	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>