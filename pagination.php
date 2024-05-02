<?php 
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân trang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <table class="table">
            <thead class="bg-dark text-light">
                <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $sql = "select * from product";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            $numberPages=3;
            $totalPages=ceil($num/$numberPages);
            //echo $totalPages;
            // creating pagination buttons
            for ($btn = 1; $btn <= $totalPages; $btn++) {
                echo '<button class="btn btn-dark mx-1 my-3 mb-3">
                        <a href="pagination.php?page=' . $btn . '" class="text-light px-3">' . $btn . '</a>
                    </button>';
            }
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                //echo $page;
            }else {
                $page=1;
            }
            
            $startingLimit = ($page-1)*$numberPages;
            $sql = "SELECT * FROM product LIMIT " . $startingLimit . ", " . $numberPages;

            $result = mysqli_query($conn, $sql);

            // echo nums
            while($rows=mysqli_fetch_assoc($result)) {
                echo '<tr>
                <th scope="row">'.$rows['id'].'</th>
                <td>'.$rows['name'].'</td>
                <td>'.$rows['price'].'</td>
                <td>'.$rows['image'].'</td>
                </tr>';
            }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>