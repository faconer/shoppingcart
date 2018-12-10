<?php
    require '../lib/db.php';
    if (isset($_REQUEST['btnSearch'])){
        $search = addslashes($_GET['search']);
        if (empty($search)){
            echo "Vui lòng nhập từ khóa tìm kiếm";
        }else{
            $query = "SELECT masp, hinhanh, tensp, dongia FROM monan WHERE tensp LIKE '%$search%'";
            $sql = $conn->query($query);
            $num = mysqli_num_rows($sql);
            if ($num > 0 && $search != ""){
                echo "$num kết quả trả về với từ khóa <b>$search</b><hr>";
                while ($row = mysqli_fetch_assoc($sql)) {
                echo "<div class='col-md-3'>
                        <div class='product'>
                            <img src='../images/$row[hinhanh]' class='img-responsive'>
                            <p class='text-center text-info'>$row[tensp]</p>
                            <p class='text-center text-danger'>$row[dongia] VNĐ</p>
                           <button type='button' class='btn btn-info shop'><a href='add-cart.php?id=$row[masp]'>Đặt Hàng</a></button>
                           <button type='button' class='btn btn-success view'><a href='view-product.php?id=$row[masp]'>Xem Thêm</a></button>
                        </div>
                    </div>";
                }
            }else {
                echo "Không tìm thấy kết quả";
            }
        }
    }
?>   
