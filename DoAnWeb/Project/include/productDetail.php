
    <?php


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = '';
    }

    $sql_productDetail = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$id' ");
    ?>
    <?php
    while ($row_productDetail = mysqli_fetch_array($sql_productDetail)) {
    ?>
        <div class="small-container single-product">
            <div class="row">
                <div class="col-2">
                    <img src="images/<?php echo $row_productDetail['product_image'] ?>" width="100%" id="ProductImg">

                    <div class="small-img-row">
                        <div class="small-img-col">
                            <img src="images/<?php echo $row_productDetail['product_image'] ?>" width="100%" class="small-img">
                        </div>
                        <?php
                        $sql_imageDetail = mysqli_query($conn, "SELECT img_detail from product, image_detail WHERE product.product_id = image_detail.product_id AND image_detail.product_id = '$id'");
                        while ($row_imageDetail = mysqli_fetch_array($sql_imageDetail)) {
                        ?>
                            <div class="small-img-col">
                                <img src="images/<?php echo $row_imageDetail['img_detail'] ?>" width="100%" class="small-img">
                            </div>
                        <?php
                        }
                        ?>
                    </div>


                </div>
                <div class="col-2">
                    <p>Home / <?php echo $row_productDetail['product_name'] ?> </p>
                    <h1><?php echo $row_productDetail['product_name'] ?></h1>
                    <h4><?php echo '$' . number_format($row_productDetail['product_price']) ?></h4>
                    <div>
                        <p>Material: <?php echo $row_productDetail['product_material'] ?></p>
                    </div>
                    <input type="number" id="qty" value="1">
                    <button class="btn btn-detail" type="button" onclick="pop_up()"> ADD TO CART </button>
                    <script>
                        function pop_up() {
                            const el = document.createElement('form')
                            var productName = "<?php echo $row_productDetail['product_name'] ?>"; var productID = "<?php echo $row_productDetail['product_id'] ?>";
                            var productQty = document.getElementById("qty").value; var productIMG = "<?php echo $row_productDetail['product_image'] ?>";
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

                    <h3>Description</h3>
                    <!-- Doan nay chinh lai gioi thieu san pham ao khoac jean-->
                    <p>
                        <?php
                        echo $row_productDetail['product_description'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
        SmallImg[0].onclick = function() {
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function() {
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function() {
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function() {
            ProductImg.src = SmallImg[3].src;
        }
    </script>
