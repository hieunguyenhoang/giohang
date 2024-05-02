<?php
    include "connect.php";

    // update query
    if(isset($_POST['update_product_quantity'])) {
        $update_value = $_POST['update_quantity'];
        // echo $update_value;
        $update_id = $_POST['update_quantity_id'];
        // echo $update_quantity_id;
        // query
        $update_quantity_query = mysqli_query($conn, "update cart set 
        quantity='$update_value' where id='$update_id'");
        if($update_quantity_query) {
            header('location: cart.php');
        }

    }
    if(isset($_GET['remove'])) {
        $remove_id = $_GET['remove'];
        
        // remove query
        mysqli_query($conn, "Delete from cart where id='$remove_id'");
        header('location: cart.php');
    }

    if(isset($_GET['delete_all'])) {
        mysqli_query($conn, "delete from cart");
        header('location: cart.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart page-project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- include header -->
    <?php 
        include "header.php";
    ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">Giỏ hàng của tôi</h1>
            <table>
                <?php
$select_cart_products = mysqli_query($conn, "select * from cart");
$grand_total = 0;
$num = 1;
if(mysqli_num_rows($select_cart_products) > 0) {
    echo "<thead>
    <th>Sl No</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Giá tiền</th>
    <th>Số lượng</th>
    <th>Tổng tiền</th>
    <th>Xóa</th>
    </thead>
    <tbody>";
    while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)) {
        
       ?>
            <td><?php echo $num?></td>
            <td><?php echo $fetch_cart_products['name']?></td>
            <td>
                <img src="images/<?php echo $fetch_cart_products['image']?>" alt="">
            </td>
            <td><?php echo $fetch_cart_products['price']?>.vnđ</td>
            <td>
                <form action="" method="post">
                    <input type="hidden" value="<?php 
                    echo $fetch_cart_products['id']?>" 
                    name="update_quantity_id">
                <div class="quantity_box">
                    <input type="number" min="1" value="<?php 
                    echo $fetch_cart_products['quantity']?>" 
                    name="update_quantity">
                    <input type="submit" class="update_quantity"
                     value="cập nhật" name="update_product_quantity">
                </div>
                </form>
            </td>
            <td><?php echo $subtotal=$fetch_cart_products['price'] *
            $fetch_cart_products['quantity']?>.000vnđ</td>
            <td>
                <a href="cart.php?remove=<?php echo $fetch_cart_products['id']?>"
                onclick="return confirm('Bạn có muốn xóa sản phẩm khỏi giỏi hàng.')";>
                    <i class="fa fa-trash"></i>
                </a>
            </td>
    </tbody>
    <?php
    $grand_total = $grand_total + ($fetch_cart_products['price'] * $fetch_cart_products['quantity']);
    $num++;
    }
}else {
    echo "<div class='empty_text'>Giỏ hàng hiện trống</div>";
}
                ?>
            </table>
            <!-- php code -->

            <?php 
    if($grand_total>0) {
        ?>
        <!-- bottom area -->
        
    
        <div class='table_bottom'>
            <a href='shop_product.php' 
            class='bottom_btn'>Tiếp tục mua sắm</a>
            <h3 class='bottom_btn'>Tổng tiền: <span><?php echo $grand_total?>.000vnđ</span></h3>
            <a href='chechout.php' class='bottom_btn'>Tiến hành kiểm tra</a>
        </div>";
          

            <a href="cart.php?delete_all=<?php ?>" class="delete_all_btn"
            onclick="return confirm('Bạn có muốn xóa hết sản phẩm ra khỏi giở hàng');">
                <i class="fas fa-trash"></i>Xóa tất cả
            </a>
<?php
    } else {
        echo "";
    }
?>
        </section>
    </div>


</body>
</html>