<header class="header">
        <div class="header_body">
            <a href="index.php" class="logo">Đồ dùng học tập</a>
            <nav class="navbar">
                <a href="">Thêm sản phẩm</a>
                <a href="view_products.php">Xem sản phẩm</a>
                <a href="shop_product.php">Shoppit</a>
            </nav>

            <!-- select query -->
            <?php 
        $select_product = mysqli_query($conn, "select * from cart") or die('query failed');
        $row_count = mysqli_num_rows($select_product);
            ?>

            <!-- Shopping cart icon -->
            <a href="cart.php" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><sup>
                <?php echo $row_count?>
            </sup></span></a>
            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
        </div>
    </header>