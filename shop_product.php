
<?php 
    include "connect.php";
    if(isset($_POST['add_to_cart'])) {
        $products_name     = $_POST['product_name'];
        $products_price    = $_POST['product_price'];
        $products_image    = $_POST['product_image'];
        $products_quantity = 1;

        // select cart data based on condition
        $select_cart = mysqli_query($conn, "select * from cart where name = '$products_name'");
        if(mysqli_num_rows($select_cart) > 0) {
            $display_message[] = "Sản phẩm này đã có trong giỏ hàng";

        } else {
            // chèn dữ liệu giỏ hàng trong bảng giỏ hàng
            $insert_products = mysqli_query($conn, "insert into cart (name, price, image, quantity)
            values ('$products_name', '$products_price', '$products_image', $products_quantity)");
            $display_message[] = "Đã thêm sản phẩm vào giỏ hàng";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products-Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <?php include "header.php";?>
   
    <div class="container">
    <?php 
        if(isset($display_message)) {
            foreach($display_message as $display_message) {
                echo "<div class='display_message'>
                <span>$display_message</span>
                <i class='fas fatimes' onClick='this.parentElement.style.display=`none`';></i>
                </div>";
            }
        }
    ?>
        <section class="products">
            <h1 class="heading">Cửa hàng</h1>
            <div class="product_container">
                <?php 
    $select_products = mysqli_query($conn, "select * from product");  // sanpham
    if(mysqli_num_rows($select_products) > 0) {
        while($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>            
            <form action="" method="post">
                    <div class="edit_form">
                        <img src="images/<?php echo $fetch_product['image']?>" alt="">
                        <h3><?php echo $fetch_product['name']?></h3>
                        <a href="">Thông tin chi tiết</a>
                        <div class="price">Giá tiền: <?php echo $fetch_product['price']?></div>
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']?>">
                        <input type="submit" class="submit_btn" value="Thêm +" name="add_to_cart">
                    </div>
                </form>          
    <?php
        }
    }
    else {
        echo "No products";
    }
    ?>

            </div>         
        </section>
    </div>
</body>
</html>