
<?php
if (
    isset($_POST['productName']) && isset($_POST['productID'])
    && isset($_POST['productQty']) && isset($_POST['productPrice']) && isset($_POST['productIMG'])
) {
    $sql_resetAI = mysqli_query($conn, "ALTER TABLE cart AUTO_INCREMENT = 0");
    $productName = $_POST['productName'];
    $productID = $_POST['productID'];
    $productQTY = $_POST['productQty'];
    $productPrice = $_POST['productPrice'];
    $productIMG = $_POST['productIMG'];

    $sql_checkDup = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = '$productID'");
    $checkDup = mysqli_num_rows($sql_checkDup);
    if ($checkDup > 0) {
        $row_checkDup = mysqli_fetch_array($sql_checkDup);
        $productQTY = $row_checkDup['pd_qty'] + $productQTY;
        $sql_cart = "UPDATE cart SET pd_qty = '$productQTY' WHERE product_id = '$productID'";
    } else {
        $sql_cart = "INSERT INTO cart(product_id, pd_name, pd_price, pd_img, pd_qty) 
    values('$productID', '$productName', '$productPrice', '$productIMG', '$productQTY')";
    }

    $insert_row = mysqli_query($conn, $sql_cart);

    if ($sql_cart == 0) {
        header('Location:index.php?control=detail&id=' . $productID);
    }
} elseif (isset($_POST['updateQuantity']) && isset($_POST['productID']) && isset($_POST['productQty'])) {
    for ($i = 0; $i < count($_POST['productID']); $i++) {
        $productID = $_POST['productID'][$i];
        $productQty = $_POST['productQty'][$i];
        $sql_update = mysqli_query($conn, "UPDATE cart SET pd_qty = '$productQty' WHERE product_id = $productID");
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_deleteCart = mysqli_query($conn, "DELETE FROM cart WHERE product_id = '$id'");
}
$sql_countCart = mysqli_query($conn, "SELECT COUNT(*) AS Items FROM cart");
$sql_count = mysqli_fetch_array($sql_countCart);
?>

<!--cart items details-->
<div class="index-cart">
    <a class="a-indexCart" href="index.php">
        <i style="padding:5px;" class="fa fa-home"></i>Home
        <span class="slider"></span>
    </a>

    <span>/</span>
    <span>Your Cart</span>
</div>
<h1 class="cart-h1">CART</h1>
<?php
if ($sql_count['Items'] > 0) {
?>
    <form id="orderForm" action="" method="POST">
        <div class="small-container cart-page">
            <table style="border-collapse:unset;">
                <tr>
                    <th class="pd-15">Ordinal</th>
                    <th class="pd-15">Image</th>
                    <th class="pd-15">Product</th>
                    <th class="pd-15">Quantity</th>
                    <th class="pd-15" style="text-align: right;">Price</th>
                    <th class="pd-15">Subtotal</th>
                    <!-- <th class="pd-15">Price</th> -->
                </tr>
                <?php
                $sql_productCart = mysqli_query($conn, "SELECT * FROM cart");
                $i = 1;
                $subTotal = 0;
                while ($row_productCart = mysqli_fetch_array($sql_productCart)) {
                    $subTotalRow = $row_productCart['pd_qty'] * $row_productCart['pd_price'];
                    $subTotal += $subTotalRow;
                    $id = $row_productCart['product_id'];
                    $sql_checkQty = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$id'");
                    $row_checkQty = mysqli_fetch_array($sql_checkQty);
                ?>
                    <tr>
                        <!-- <td class="pd-15"> <?php echo $i ?> </td> -->
                        <td class="pd-15"><?php echo $i; ?></td>
                        <td class="pd-15"> <img class="img-cart" src="images/<?php echo $row_productCart['pd_img'] ?>" alt=""> </td>
                        <td class="pd-15" style="width: 30%;">
                            <a href="?control=detail&id=<?php echo $row_productCart['product_id'] ?>" class="a-indexCart" style="color:black; font-size: 18px">
                                <span class="slider"></span>
                                <?php echo $row_productCart['pd_name'] ?>
                            </a>
                            <br>
                            <a class="removeItems" href="?control=cart&delete=<?php echo $row_productCart['product_id'] ?>" onclick="return confirm('Are you sure?')">Remove</a>
                        </td>
                        <td class="pd-15">
                            <input type="number" id="cartQty" name="productQty[]" min="1" max="<?php echo $row_checkQty['product_quantity'] ?>" value="<?php echo $row_productCart['pd_qty'] ?>" oninvalid=" var itemQTY = <?php echo $row_checkQty['product_quantity'] ?>; setCustomValidity('Product quantity must be less than ' + (itemQTY+1))" oninput="setCustomValidity('')">
                            <input type="hidden" name="productID[]" value="<?php echo $row_productCart['product_id'] ?>">
                        </td>

                        <td class="pd-15"> <?php echo '$' . number_format($row_productCart['pd_price'], 2); ?> </td>

                        <td class="pd-15" style="padding-right:0;"><?php echo '$' . number_format($subTotalRow, 2); ?></td>
                        <!-- <td><input class="ta-right bo-none" type="text" name="subTotalRow" readonly></td> -->
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>

            <div class="update-div">
                <button type="submit" id="updatec" class="input-order" name="updateQuantity">Update Cart</button>
            </div>
            <div class="total-price">

                <table>
                    <tr>
                        <td>Total</td>
                        <!-- <td>$2145.00</td> -->
                        <td><?php echo '$' . number_format($subTotal, 2) ?></td>
                    </tr>
                </table>

            </div>
            <div class="cart-order">
                <a href="include/checkOut.php"><button class="input-order" style="height: auto; width:100%" id="buttonCheck" type="button">Check Out</button></a>
            </div>

        </div>
    </form>

<?php
} else {
?>
    <div class="empty-div">
        <span class="emptyCart"> Your shopping cart is empty </span>
        <a class="emptyCart empty-a" href="?control=category&id=all">Continue Shopping</a>
    </div>


<?php
}
?>