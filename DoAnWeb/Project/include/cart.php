<?php
if(isset($_POST['addCart'])) {
    $productName = $_POST['productName'];
    $productID = $_POST['productID'];
    $productQTY = $_POST['productQty'];
    $productPrice = $_POST['productPrice'];
    $productIMG = $_POST['productIMG'];

    $sql_resetAI = mysqli_query($conn, "ALTER TABLE cart AUTO_INCREMENT = 0");
    $sql_cart = mysqli_query($conn,"INSERT INTO cart(product_id, pd_name, pd_price, pd_img, pd_qty) 
    values('$productID', '$productName', '$productPrice', '$productIMG', '$productQTY')");
    
    if($sql_cart == 0){
        header('Location:index.php?control=detail&id='. $productID);
    }
}
elseif(isset($_POST['addCartBack'])){
    $productName = $_POST['productName'];
    $productID = $_POST['productID'];
    $productQTY = $_POST['productQty'];
    $productPrice = $_POST['productPrice'];
    $productIMG = $_POST['productIMG'];

    $sql_resetAI = mysqli_query($conn, "ALTER TABLE cart AUTO_INCREMENT = 0");
    $sql_cart = mysqli_query($conn,"INSERT INTO cart(product_id, pd_name, pd_price, pd_img, pd_qty) 
    values('$productID', '$productName', '$productPrice', '$productIMG', '$productQTY')");
    
    if($sql_cart == 0){
        header('Location:index.php?control=detail&id='. $productID);
    }

    header('Location:index.php?control=category&id=all');
}
?>
        <!--cart items details-->
    <form id="orderForm" action="payment.html" onsubmit="alert('Order Success')">
        <div class="small-container cart-page">
            <table>
                <tr>
                    <th>Ordinal</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="number" name="qtyChange" value=""></td>
                    <td></td>
                    <td></td>
                    <!-- <td>$50.00</td> -->
                    <!-- <td><input class="ta-right bo-none" type="text" name="subTotalRow" readonly></td> -->
                </tr>

            </table>
            <div class="total-price">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <!-- <td>$2145.00</td> -->
                        <td><input class="ta-right bo-none" type="text" id="subTotal" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tax(10%)</td>
                        <td><input class="ta-right bo-none" type="text" id="Tax" readonly></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <!-- <td>$2180.00</td> -->
                        <td><input class="ta-right bo-none" type="text" id="Total" readonly></td>
                        
                    </tr>
                    
                </table>
                 
            </div>
            <input type="submit" value="Order" style="height:50px">
                
        </div>
    </form>
