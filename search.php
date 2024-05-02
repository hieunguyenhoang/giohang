<?php
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <form action="" method="post">
            <input type="text" placeholder="Tìm kiếm" name="search">
            <button class="btn btn-dark btn-sm" name="submit">Tìm</button>
        </form>

        <div class="container my-5">
            <table class="table">         
            <!-- php code -->
                <?php
            if(isset($_POST['submit'])) {
                $search = $_POST['search'];

                $sql = "select * from product where name like 't%'
                or name like 'b%'"; // đồ án tìm theo tên sản phẩm

                $result=mysqli_query($conn, $sql);
                if($result) {
                    if(mysqli_num_rows($result) > 0 ) {
                        echo '<thead>
                            <tr>
                                <th>Sl NO</th>
                                <th>name</th>
                                <th>price</th>
                                <th>image</th>
                            </tr>
                        </thead>';
                        while($row=mysqli_fetch_assoc($result)) {
                            echo '<tbody>
                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['image'].'</td>
                            </tr>
                                </tbody>';
                        }
                    }
                    else {
                        echo '<h2 class="text-danger">Không tìm thấy dữ liệu</h2>';
                    }
                }
            }      
                ?>                                
            </table>
        </div>
    </div>
</body>
</html>