<?php 
    include "connect.php";

    // setting the start from value
    $start = 0;

    // setting the number of rows to display in a page
    $rows_per_page = 4;

    // get the total number of rows
    $records = $conn->query("select * from product");
    $nr_of_rows = $records->num_rows;

    // caculating the nr of pages
    $pages = ceil($nr_of_rows / $rows_per_page);

    // if the user clicks on the pagination buttons we set a new starting point
    if(isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rows_per_page;
    }
    $result = $conn->query("select * from product limit ".$start.",".$rows_per_page."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân trang 2</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<?php
    if(isset($_GET['page-nr'])) {
        $id = $_GET['page-nr'];
    }else {
        $id = 1;
    }
?>

<body id="<?php echo $id?>">
    <!-- display the rows -->
    <div class="content">
        <!-- php code -->
        <?php 
            while($row = $result->fetch_assoc()) {
                ?>
                <p>
                    <?php echo $row['id']?> - <?php echo $row['name']?>
                </p>
            <?php
            }
        ?>
    </div>

    <!-- displaying the page info text -->
    <div class="page-info">
        <?php
            if(!isset($_GET['page-nr'])) {
                $page = 1;
            } else {
                $page = $_GET['page-nr'];
            }
        ?>
        Showing <?php echo $page?> of <?php echo $pages?> pages
    </div>

    <!-- displaying the pagination buttons -->
    <div class="pagination">
        <!-- Go to the first page -->
        <a href="?page-nr=1">Trang đầu</a>


        <!-- Go to the previous page -->
        <?php 
            if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                ?>
                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1?>">Trang trước</a>            
                <?php
            } else {
                ?>
                <a href="">Trang trước</a>
                <?php
            }
        ?>

        <!-- Output the page numbers -->
        <div class="page-numbers">
            <?php 
                for($counter=1; $counter <= $pages; $counter++) {
                    ?>
                    <a href="?page-nr=<?php echo $counter?>"><?php echo $counter?></a>
                    <?php
                }
            ?>
        </div>

        <!-- Go to the next page -->
        <?php 
            if(!isset($_GET['page-nr'])) {
                ?>
                <a href="?page-nr=2">Trang sau</a>
                <?php
            }else {
                if($_GET['page-nr'] >= $pages) {
                    ?>
                    <a href="">Trang cuối</a>
                    <?php
                } else {
                    ?>
                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1?>">Trang sau</a>
                    <?php
                }
            }
        ?>


        <!-- Go to the last page -->
        <a href="?page-nr=<?php echo $pages?>">Trang cuối</a>
    </div>
   

<script>
    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>
</body>