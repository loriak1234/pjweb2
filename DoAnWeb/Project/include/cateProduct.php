<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

if ($id == 'all') {
    $sql_category = mysqli_query($conn, "SELECT * FROM product ORDER BY product_id asc");
    $title = 'All Products';
} elseif (isset($_GET['id'])) {
    //         $sql_category_title = mysqli_query($conn, "SELECT * FROM category, product 
    // WHERE category.category_id = product.category_id AND product.category_id = '$id' ORDER BY product_id asc");
    $sql_category_title = mysqli_query($conn, "SELECT * FROM category
    WHERE category_id = '$id'");
    $row_tittle = mysqli_fetch_array($sql_category_title);
    $title = $row_tittle['category_name'];
}
?>

<div class="small-container">
    <div class="row row-2">
        <h2><?php echo $title ?></h2>
        <select>
            <option>Default Shorting</option>
            <option>Short by price</option>
            <option>Short by popularity</option>
            <option>Short by rating</option>
            <option>Short by sale</option>
        </select>
    </div>

    <!-- pagination  -->
    <?php
    $productPerPage = 8;

    $pageNum = 1;
    $adjacents = 2;

    if (isset($_GET['page'])) {
        $pageNum = $_GET['page'];
    }

    $offset = ($pageNum - 1) * $productPerPage;
    if ($id == 'all') {
        $sql = "SELECT * FROM product WHERE product_active = 1" .
            " LIMIT $offset, $productPerPage";
    } else {
        $sql = "SELECT * FROM category, product 
WHERE category.category_id = product.category_id AND product.category_id = '$id' AND product_active = 1 ORDER BY product_id asc" .
            " LIMIT $offset, $productPerPage";
    }
    $result = mysqli_query($conn, $sql);

    ?>

    <div style="justify-content: start;" class="row">
        <?php
        while ($col_product = mysqli_fetch_array($result)) {
        ?>
            <div class="col-4">
                <div class="p-relative">
                    <a href="?control=detail&id=<?php echo $col_product['product_id'] ?>">
                        <img src="images/<?php echo $col_product['product_image']; ?>">
                    </a>
                    <div class="block-addtocart-overlay">
                        <div class="block-addtocart">
                            <button class="but-addtocart fs15 hov1" type="button" onclick="pop_up()"> ADD TO CART </button>
                            <script>
                                function pop_up() {
                                    const el = document.createElement('form')
                                    var productName = "<?php echo $row_productDetail['product_name'] ?>";
                                    var productID = "<?php echo $row_productDetail['product_id'] ?>";
                                    var productQty = document.getElementById("qty").value;
                                    var productIMG = "<?php echo $row_productDetail['product_image'] ?>";
                                    var productPrice = "<?php echo $row_productDetail['product_price'] ?>";
                                    el.setAttribute("action", "?control=cart");
                                    el.setAttribute("method", "POST");
                                    el.innerHTML += "<input class=\"a-swal\" type = \"submit\" name = \"addCartBack\" value =\"Continue Shopping\">";
                                    el.innerHTML += "<input class=\"a-swal\" type = \"submit\" name = \"addCart\" value =\"View Cart\">";
                                    el.innerHTML += '<input class="a-swal" type = "hidden" name="productName" value ="' + productName + '"/>';
                                    el.innerHTML += '<input class="a-swal" type = "hidden" name="productID" value ="' + productID + '"/>';
                                    el.innerHTML += '<input class="a-swal" type = "hidden" name="productQty" value ="' + productQty + '"/>';
                                    el.innerHTML += '<input class="a-swal" type = "hidden" name="productPrice" value ="' + productPrice + '"/>';
                                    el.innerHTML += '<input class="a-swal" type = "hidden" name="productIMG" value ="' + productIMG + '"/>';


                                    swal({
                                        title: "Added!",
                                        content: el,
                                        button: false,
                                        icon: "success",
                                        closeOnEsc: false,
                                        closeOnClickOutside: false,
                                    })
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="?control=detail&id=<?php echo $col_product['product_id'] ?>">
                        <h4 class="h4_product"><?php echo $col_product['product_name']; ?></h4>
                    </a>
                    <p><?php echo '$' . number_format($col_product['product_price']); ?></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </form>

    <?php
    if ($id == 'all') {
        $sql = "SELECT * FROM product WHERE product_active = 1";
    } else {
        $sql = "SELECT * FROM category, product 
WHERE category.category_id = product.category_id AND product.category_id = '$id' AND product_active = 1
ORDER BY product_id asc";
    }
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);

    $prevPage = $pageNum - 1;
    $nextPage = $pageNum + 1;

    $maxPage = ceil($numrows / $productPerPage);
    $lpm1 = $maxPage - 1;
    $self = "?control=category&id=$id";
    $nav  = '';
    ?>

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

</div>