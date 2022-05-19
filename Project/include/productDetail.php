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
            <form action="?control=cart" method="POST" id="cartDetailForm">
                <div class="col-2">
                    <p>Home / <?php echo $row_productDetail['product_name'] ?> </p>
                    <h1><?php echo $row_productDetail['product_name'] ?></h1>
                    <h4><?php echo '$' . number_format($row_productDetail['product_price'], 2) ?></h4>
                    <div>
                        <p>Material: <?php echo $row_productDetail['product_material'] ?></p>
                    </div>
                    <!-- <?php echo $row_productDetail['product_quantity']?> -->
                    <input style="width: 60px !important;" type="number" min="1" max="<?php echo $row_productDetail['product_quantity']?>" id="qty" name="productQty" value="1"
                    oninvalid="var itemQTY = <?php echo $row_productDetail['product_quantity']?>; setCustomValidity('Product quantity must be less than ' + (itemQTY+1))" oninput="setCustomValidity('')">
                    <input type="hidden" name="productName" value="<?php echo $row_productDetail['product_name'] ?>">
                    <input type="hidden" name="productID" value="<?php echo $row_productDetail['product_id'] ?>">
                    <input type="hidden" name="productPrice" value="<?php echo $row_productDetail['product_price'] ?>">
                    <input type="hidden" name="productIMG" value="<?php echo $row_productDetail['product_image'] ?>">
                    
                    <button class="btn btn-detail" type="submit" onclick="pop_up()"> ADD TO CART </button>

                    <h3>Description</h3>
                    <!-- Doan nay chinh lai gioi thieu san pham ao khoac jean-->
                    <p>
                        <?php
                        echo $row_productDetail['product_description'];
                        ?>
                    </p>
                </div>
            </form>
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

<script>
    function pop_up() {
        var qty = document.getElementById('qty');
        if(qty.checkValidity() == true){
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
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cartDetailForm').on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '?control=cart',
                data: $('#cartDetailForm').serialize(),
                success: function() {
                    //   alert('form was submitted');
                },
                error: function(data) {
                    alert('wrong');
                }
            });
        });
    });
</script>