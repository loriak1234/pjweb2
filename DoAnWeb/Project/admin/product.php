<?php
include("../db/connect.php");

$productPerPage = 6;

$pageNum = 1;
$adjacents = 2;
if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}

$offset = ($pageNum - 1) * $productPerPage;

$sql = "SELECT * FROM product";

$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
$prevPage = $pageNum - 1;
$nextPage = $pageNum + 1;

$maxPage = ceil($numrows / $productPerPage);
$lpm1 = $maxPage - 1;

$self = "product.php?";
$nav  = '';

$sql_totalProduct = mysqli_query($conn, "SELECT COUNT(*) AS countProduct FROM product");
$i = mysqli_fetch_array($sql_totalProduct);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete = mysqli_query($conn, "DELETE FROM product WHERE product_id='$id'");
    $sql_detelePhotoDetail = mysqli_query($conn, "DELETE FROM image_detail WHERE product_id='$id'");
    header('location:product.php?page=' . $pageNum);
}
?>

<?php
include("include/head.php");
?>

<body>
    <?php
    include('header.php');
    ?>
    <?php
    $sql_productAdmin = mysqli_query($conn, "SELECT * FROM category, product 
    WHERE category.category_id = product.category_id ORDER BY product_id asc" . " LIMIT $offset, $productPerPage");
    ?>
    <form action="manageProduct.php?manage=add" method="POST" style="text-align: right;">
        <input type="hidden" name="productPerPage" value="<?php echo $productPerPage ?>">
        <input type="hidden" name="pageNumber" value="<?php echo $maxPage ?>">
        <input type="hidden" name="count" value="<?php echo $i['countProduct']; ?>">
        <div class="row" style="margin:0;">
            <div class="col">
                <button style="margin-top:15px;" name="addProduct" type="submit" class="btn btn-info">Add new product</button>
            </div>
        </div>
    </form>
    <div style="padding:15px;">
        <table style="border:1px solid grey" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bor-white" scope="col">ID</th>
                    <th class="bor-white" scope="col">Image</th>
                    <th class="bor-white" scope="col">Name</th>
                    <th class="bor-white" scope="col">Category</th>
                    <th class="bor-white" scope="col">Price</th>
                    <th class="bor-white" scope="col">Quantity</th>
                    <th class="bor-white" scope="col">Active</th>
                    <th class="bor-white" scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_productAdmin = mysqli_fetch_array($sql_productAdmin)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row_productAdmin['product_id'] ?></th>
                        <td>
                            <?php
                            if ($row_productAdmin['product_image'] != '') {
                            ?>
                                <img src="../images/<?php echo $row_productAdmin['product_image'] ?>" width="80">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $row_productAdmin['product_name'] ?></td>
                        <td><?php echo $row_productAdmin['category_name'] ?></td>
                        <td><?php echo $row_productAdmin['product_price'] ?></td>
                        <td><?php echo $row_productAdmin['product_quantity'] ?></td>
                        <td><?php echo $row_productAdmin['product_active'] ?></td>
                        <td class="w-19">
                            <form style="display:inline;" action="manageProduct.php?manage=update&id=<?php echo $row_productAdmin['product_id'] ?>" method="POST">
                                <input type="hidden" name="productPerPage" value="<?php echo $productPerPage ?>">
                                <input type="hidden" name="pageNumber" value="<?php echo $maxPage ?>">
                                <input type="hidden" name="currentPage" value="<?php echo $pageNum ?>">
                                <input type="hidden" name="count" value="<?php echo $i['countProduct']; ?>">
                                <button style="margin-right: 5px;" type="submit" class="btn btn-outline-success">Update</button>
                            </form>
                            <form style="display:inline;" action="manageProduct.php?manage=delete&id=<?php echo $row_productAdmin['product_id'] ?>" method="POST">
                                <input type="hidden" name="pageNumber" value="<?php echo $maxPage ?>">
                                <input type="hidden" name="currentPage" value="<?php echo $pageNum ?>">
                                <input type="hidden" name="count" value="<?php echo $i['countProduct']; ?>">
                                <input type="hidden" name="productPerPage" value="<?php echo $productPerPage ?>">
                                <button style="margin-left: 5px;" type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>

                        </td>

                    </tr>
                <?php
                }
                ?>
                </tr>
            </tbody>
        </table>



    </div>


    <div class="page-btn">
        <?php
        if ($maxPage > 1) {
            if ($pageNum > 1) {
                $page  = $pageNum - 1;
                $prev  = " <a href=\"$self&page=$page\"><span> <i class='fa-solid fa-angle-left'></i> </span></a>";

                $first = "<a href=\"$self&page=1\"><span> <i class='fa-solid fa-angles-left'></i> </span></a> ";
            } else {
                $prev  = '';
                $first = '';
            }


            if ($maxPage < 6 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $maxPage; $counter++) {
                    if ($counter == $pageNum) {
                        $nav .= "<span> $counter </span>";
                    } else {
                        $nav .= "  <a href=\"$self&page=$counter\"><span> $counter </span></a> ";
                    }
                }
            } elseif ($maxPage > 4 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if ($pageNum < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++) {
                        if ($counter == $pageNum)
                            $nav .= "<span> $pageNum </span>";
                        else
                            $nav .= "  <a href=\"$self&page=$counter\"><span>$counter</span></a> ";
                    }
                    $nav .= "<span>...</span>";
                    $nav .= " <a href=\"$self&page=$lpm1\"><span>$lpm1</span></a> ";
                    $nav .= " <a href=\"$self&page=$maxPage\"><span>$maxPage</span></a> ";
                }
                //in middle; hide some front and some back
                elseif ($maxPage - ($adjacents * 2) >= $pageNum && $pageNum > ($adjacents * 2)) {
                    $nav .= " <a href=\"$self&page=1\"><span> 1 </span></a> ";
                    $nav .= " <a href=\"$self&page=2\"><span> 2 </span></a> ";
                    $nav .= "<span>...</span>";
                    for ($counter = $pageNum - $adjacents; $counter <= $pageNum + $adjacents; $counter++) {
                        if ($counter == $pageNum)
                            $nav .= "<span>$counter</span>";
                        else
                            $nav .= " <a href=\"$self&page=$counter\"><span> $counter </span></a> ";
                    }
                    $nav .= "<span>...</span>";
                    $nav .= " <a href=\"$self&page=$lpm1\"><span> $lpm1 </span></a> ";
                    $nav .= " <a href=\"$self&page=$maxPage\"><span> $maxPage </span></a> ";
                }
                //close to end; only hide early pages
                else {
                    $nav .= " <a href=\"$self&page=1\"><span> 1 </span></a> ";
                    $nav .= " <a href=\"$self&page=2\"><span> 2 </span></a> ";
                    $nav .= "<span>...</span>";
                    for ($counter = $maxPage - ($adjacents * 2); $counter <= $maxPage; $counter++) {
                        if ($counter == $pageNum)
                            $nav .= "<span>$counter</span>";
                        else
                            $nav .= " <a href=\"$self&page=$counter\"><span> $counter </span></a> ";
                    }
                }
            }
            if ($pageNum < $maxPage) {
                $page = $pageNum + 1;
                $next = "<a href=\"$self&page=$page\"><span>  <i class='fa-solid fa-angle-right'></i> </span></a> ";

                $last = "<a href=\"$self&page=$maxPage\"><span>  <i class='fa-solid fa-angles-right'></i> </span></a> ";
            } else {
                $next = '';
                $last = '';
            }
            echo "<div style='text-align:center;'>$first $prev $nav $next $last</div>";
        }
        ?>

    </div>

</body>

</html>