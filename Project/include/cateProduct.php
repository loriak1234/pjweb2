<?php


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$orderCondition = "ORDER BY product_id asc";
$orderField = isset($_GET['field']) ? $_GET['field'] : "";
$orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
if (!empty($orderSort) && !empty($orderField)) {
    if($orderField == 'price'){
        $orderCondition = "ORDER BY Cast(product_" . $orderField . " AS Float) " . $orderSort;
    }
    else {
    $orderCondition = "ORDER BY product_" . $orderField . " " . $orderSort;
    }
}

if ($id == 'all') {
    $title = 'All Products';
} elseif (isset($_GET['id'])) {
    $sql_category_title = mysqli_query($conn, "SELECT * FROM category
    WHERE category_id = '$id'");
    $row_tittle = mysqli_fetch_array($sql_category_title);
    $title = $row_tittle['category_name'];
}
?>

<div class="small-container">
    <div class="row row-2">
        <h2><?php echo $title ?></h2>
        <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="?control=category&id=<?php echo $id ?>&field=default">Default Sorting</option>
            <option <?php if($orderField =='name' && $orderSort =='asc'){?> selected <?php }?> value="?control=category&id=<?php echo $id ?>&field=name&sort=asc">
                Name: A-Z
            </option>
            <option <?php if($orderField =='name' && $orderSort =='desc'){?> selected <?php }?> value="?control=category&id=<?php echo $id ?>&field=name&sort=desc">
                Name: Z-A
            </option>
            <option <?php if($orderField =='price' && $orderSort =='asc'){?> selected <?php }?> value="?control=category&id=<?php echo $id ?>&field=price&sort=asc">
                Price: Low-High
            </option>
            <option <?php if($orderField =='price' && $orderSort =='desc'){?> selected <?php }?> value="?control=category&id=<?php echo $id ?>&field=price&sort=desc">
                Price: High-Low
            </option>
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
        $sql = "SELECT * FROM product WHERE product_active = 1 " . $orderCondition
            . " LIMIT $offset, $productPerPage";
    } else {
        $sql = "SELECT * FROM category, product 
WHERE category.category_id = product.category_id AND product.category_id = '$id' AND product_active = 1 " . $orderCondition .
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
                            <form action="?control=cart" method="POST">
                                <input type="hidden" name="productName" value="<?php echo $col_product['product_name'] ?>" />
                                <input type="hidden" name="productID" value="<?php echo $col_product['product_id'] ?>" />
                                <input type="hidden" name="productPrice" value="<?php echo $col_product['product_price'] ?>" />
                                <input type="hidden" name="productIMG" value="<?php echo $col_product['product_image'] ?>" />
                                <input type="hidden" name="productQty" value="1" />
                                <button class="but-addtocart fs15 hov1" type="submit" onclick="pop_up()"> ADD TO CART </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="pdt-10">
                    <a href="?control=detail&id=<?php echo $col_product['product_id'] ?>">
                        <h4 class="h4_product"><?php echo $col_product['product_name']; ?></h4>
                    </a>
                    <p><?php echo '$' . number_format($col_product['product_price'], 2); ?></p>
                </div>
            </div>
        <?php
        }
        ?>

    </div>


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

                // $first = "<a href=\"$self&page=1\"><span> <i class='fa-solid fa-angles-left'></i> </span></a> ";
            } else {
                $prev  = '';
                // $first = '';
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
                    // $nav .= " <a href=\"$self&page=$lpm1\"><span>$lpm1</span></a> ";
                    $nav .= " <a href=\"$self&page=$maxPage\"><span>$maxPage</span></a> ";
                }
                //in middle; hide some front and some back
                elseif ($maxPage - ($adjacents * 2) >= $pageNum && $pageNum > ($adjacents * 2)) {
                    $nav .= " <a href=\"$self&page=1\"><span> 1 </span></a> ";
                    // $nav .= " <a href=\"$self&page=2\"><span> 2 </span></a> ";
                    $nav .= "<span>...</span>";
                    for ($counter = $pageNum - $adjacents; $counter <= $pageNum + $adjacents; $counter++) {
                        if ($counter == $pageNum)
                            $nav .= "<span>$counter</span>";
                        else
                            $nav .= " <a href=\"$self&page=$counter\"><span> $counter </span></a> ";
                    }
                    $nav .= "<span>...</span>";
                    // $nav .= " <a href=\"$self&page=$lpm1\"><span> $lpm1 </span></a> ";
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

                // $last = "<a href=\"$self&page=$maxPage\"><span>  <i class='fa-solid fa-angles-right'></i> </span></a> ";
            } else {
                $next = '';
                // $last = '';
            }
            echo "<div style='text-align:center;'> $prev $nav $next </div>";
        }

        ?>
    </div>

</div>

<script>
    function pop_up() {
        const el = document.createElement('div');
        el.innerHTML += "<a class='a-swal' href='?control=category&id=all'>Continue Shopping</a>";
        el.innerHTML += "<a class='a-swal' href='?control=cart'>View Cart</a>";
        swal({
            title: "Added!",
            content: el,
            button: false,
            icon: "success",
            // closeOnEsc: false,
            // closeOnClickOutside: false,
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').on("submit", function(event) {
            var formID = $(this).attr('id');
            if (formID != 'searchForm') {
                var url = $(this).attr('action');
                var data = $(this).serialize();
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function() {
                        //   alert('form was submitted');
                    },
                    error: function(data) {
                        alert('wrong');
                    }
                });
            }
        });
    });
</script>