<?php 
    require 'lib/db.php';
    session_start();
    $flag = NULL;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/main.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
                if (isset($_SESSION["username"])) {
                 echo "Welcome to: " .$_SESSION["username"]." | <a href='display/logout.php'>Logout</a> ";
               } else {
                    echo "<h4><a href='display/login.php'>Đăng Nhập</a> | <a href='display/dangky.php'>Đăng Ký</a></h4>";
               }
            ?>
            
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
                if ($flag == false) {
                    echo "<p class='text-right'>Không có sản phẩm nào trong  <a href='display/cart.php'> giỏ hàng </a></p>";
                }else{
                    $cart = $_SESSION['cart'];
                    echo "<p>Đã mua <a href='display/cart.php'>".count($cart)." sản phẩm </a></p>";
                }
                
             ?>
            
            <div class="col-md-12 search text-right">
                <form action="display/search.php" method="get">
                    <input type="text"  name="search">
                    <input type="submit" name="btnSearch" value="Tìm Kiếm">
                </form>
            </div>

            <?php 
                $sql = "SELECT masp, hinhanh, tensp, dongia FROM monan";
                $query = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($query)){
             ?>
        
            <div class="col-md-3">
                <div class="product">
                    <img src="images/<?= $row['hinhanh'] ?>" alt="" class="img-responsive">
                    <p class="text-center text-info"><?= $row['tensp'] ?></p>
                    <p class="text-center text-danger"><?= number_format($row['dongia']) ?> VNĐ</p>
                    <center>
                         <button type="button" class="btn btn-info shop"><a href="display/add-cart.php?id=<?= $row['masp'] ?>">Đặt Hàng</a></button>
                        <button type="button" class="btn btn-success view"><a href="display/view-product.php?id=<?= $row['masp'] ?>">Xem Thêm</a></button>
                    </center>
                </div>
            </div>

            <?php } mysqli_close($conn);?>
        
        </div>
    </div>
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>