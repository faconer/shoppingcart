
<?php 
	session_start(); 
	require '../lib/db.php';
	$flag = $tongtien = NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giỏ hàng</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/main.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Mã SP</th>
						<th>Tên SP</th>
						<th>Đơn giá</th>
						<td>Số lượng</td>
						<td>Thành Tiền</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!isset($_SESSION['cart'])){
						$flag = false;
					}else{
						foreach($_SESSION['cart'] as $masp=>$soluong){
							if(isset($masp)){
								$flag = true;
							}else{
								$flag = false;
							}
						}
					}
                	// khi gio hang chua co sp    
					if($flag == false){
						echo "Không có sản phẩm nào trong giỏ hàng";
						echo "<a href='../index.php'>Trở về trang chủ</a>";
					}else{ 
						foreach ($_SESSION['cart'] as $masp=>$soluong) {
							$arr[] = "'".$masp."'";
						}
						$string = implode(",", $arr);
						$sql = "SELECT masp, tensp, dongia FROM monan WHERE masp in ($string)";
						$qr = mysqli_query($conn, $sql);
						$tongtien = 0;
						while($data = mysqli_fetch_assoc($qr)){
					 ?>
					<tr>
						<td><?= $data['masp'] ?></td>
						<td><?= $data['tensp'] ?></td>
						<td><?= number_format($data['dongia'])?> VNĐ</td>
						<td>
							<select class="quantity" <?= "data-masp='$data[masp]'" ?>>
								<?php 
									$soluongmoi = $_SESSION['cart'][$data['masp']];
									for($i=1; $i <= 10; $i++){
										if ($i==$soluongmoi) {
											echo "<option value='$i' selected = 'selected'>$i</option>";	
										}else{
											echo "<option value='$i'>$i</option>";
										}
									}
								?>
							</select>
						</td>
						<?php 
							$thanhtien = $soluongmoi * $data['dongia'];
							$tongtien += $thanhtien;
							$_SESSION['tongtien'] = $tongtien;
						 ?>
						<td><?= number_format($thanhtien); ?> VNĐ</td>
						<td><button class="btn btn-danger"><a href="del.php?masp=<?= $data['masp'] ?>">Xóa</a></button></td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
			<?php
             if($flag == false){
             	echo "<div></div>";
             }else{
             	echo "<h4 class='text-left'>Tổng tiền : ".number_format($tongtien)." VNĐ </h4>
             	<div class='accept-shop'>
             		<button type='button' class='btn btn-info shop'><a href='../index.php'>Mua Tiếp</a></button>
             		<button type='button' class='btn btn-success view'><a href='order.php'>Xác Nhận</a></button>
             	</div>";
             }

             ?>
		</div>
	</div>
	<script src="../bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/main.js"></script>
</body>
</html>