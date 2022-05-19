<?php
session_start();
include('../db/connect.php');
if (isset($_POST['checkOut'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $user_id = $_SESSION['userID'];
    $sql_users = mysqli_query($conn, "UPDATE users SET username = '$name', phone = '$phone', address = '$address' WHERE user_id = '$user_id'");

    $note = $_POST['note'];
    $totalPrice = $_POST['totalPrice'];
    if ($sql_users) {
        $sql_resetAI = mysqli_query($conn, "ALTER TABLE invoice AUTO_INCREMENT = 0");
        $sql_resetAI = mysqli_query($conn, "ALTER TABLE transaction AUTO_INCREMENT = 0");
        $code = rand(0, 9999);
        for ($i = 0; $i < count($_POST['productID']); $i++) {
            $productID = $_POST['productID'][$i];
            $productQTY = $_POST['productQTY'][$i];
            $sql_invoice = mysqli_query($conn, "INSERT INTO invoice(user_id, product_id, quantity, total_price, invoice_code, note) values ('$user_id','$productID','$productQTY', '$totalPrice', '$code', '$note')");
            $sql_transaction = mysqli_query($conn, "INSERT INTO transaction(user_id, product_id, quantity, total_price, transaction_code) values ('$user_id','$productID','$productQTY', '$totalPrice', '$code')");
            $sql_delete_cart = mysqli_query($conn, "DELETE FROM cart WHERE product_id='$productID'");
        }
        header("Location: ../index.php?control=login");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale=1.0">
    <title>Check Out</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="checkOut.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/ed211a9bdb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<?php
$sql_readCart = mysqli_query($conn, "SELECT * FROM cart");
$row_readCart = mysqli_fetch_array($sql_readCart);
?>

<body>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="../index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <?php
            if (!isset($_SESSION['userName'])) {
            ?>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="border p-4 rounded" role="alert">
                            You must be logged in to checkout! <a href="../index.php?control=login">Login here</a>
                        </div>
                    </div>

                </div>
            <?php
            } else{
            ?>
            <form action="" method="post" class="creditly-card-form agileinfo_form" style="margin-top:15px;">
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="checkout-left">
                                <div class="address_form_agile mt-sm-5 mt-4">


                                    <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                        <div class="information-wrapper">
                                            <?php
                                            if (isset($_SESSION['userID'])) {
                                                $userID = $_SESSION['userID'];
                                            }
                                            $sql_userInfomation = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$userID'");
                                            $fetch_userInfomation = mysqli_fetch_array($sql_userInfomation);
                                            ?>
                                            <div class="first-row">
                                                <div class="controls form-group">
                                                    <input class="billing-address-name form-control" type="text" name="name" placeholder="Name" required value="<?php echo $fetch_userInfomation['username'] ?>">
                                                </div>
                                                <div class="w3_agileits_card_number_grids">
                                                    <div class="w3_agileits_card_number_grid_left form-group">
                                                        <div class="controls">
                                                            <input type="text" class="form-control" placeholder="Phone Number" name="phone" required value="<?php echo $fetch_userInfomation['phone'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="w3_agileits_card_number_grid_right form-group">
                                                        <div class="controls">
                                                            <input type="text" class="form-control" placeholder="Address" name="address" required value="<?php echo $fetch_userInfomation['address'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="controls form-group">
                                                    <textarea style="resize: none;" class="form-control" placeholder="Note" name="note"></textarea>
                                                </div>
                                                <div class="controls form-group">
                                                    <input class="COD" type="radio" value="1002772758" checked>
                                                    <div style="display:inline-block;padding:10px;"> <img style="padding: 10px;" src="../images/other.png" alt=""> Cash On Delivery</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-5">


                            <div class="col-md-12">

                                <h2 class="h3 mb-3 text-black">Your Order : </h2>
                                <div class="p-3 p-lg-5 border">

                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th class="ta-right">Price</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_readCart = mysqli_query($conn, "SELECT * FROM cart");
                                            $subTotal = 0;
                                            while ($row_readCart = mysqli_fetch_array($sql_readCart)) {
                                                $rowTotal = $row_readCart['pd_price'] * $row_readCart['pd_qty'];
                                                $subTotal += $rowTotal;
                                            ?>
                                                <tr>
                                                    <td><img class="img-CO" src="../images/<?php echo $row_readCart['pd_img'] ?>" alt=""></td>
                                                    <td><?php echo $row_readCart['pd_name'] ?><strong class="mx-2">x</strong><?php echo $row_readCart['pd_qty'] ?></td>
                                                    <td class="ta-right"><?php echo '$' . number_format($rowTotal, 2) ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $tax = $subTotal * 0.1;
                                            $shipping = 5;
                                            $total = $subTotal + $tax + $shipping;
                                            ?>

                                            <tr>
                                                <td class="text-black font-weight-bold">Subtotal: </td>
                                                <td class="text-black font-weight-bold"></td>
                                                <td class="text-black font-weight-bold ta-right"><?php echo '$' . number_format($subTotal, 2) ?></td>
                                            </tr>

                                            <tr>
                                                <td class="text-black font-weight-bold">Tax(10%): </td>
                                                <td></td>
                                                <td class="text-black font-weight-bold ta-right"><?php echo '$' . number_format($tax, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"> Shipping:</td>
                                                <td></td>
                                                <td class="text-black font-weight-bold ta-right"><?php echo '$' . number_format($shipping, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold">Order total</td>
                                                <td></td>
                                                <td class="text-black font-weight-bold ta-right"><?php echo '$' . number_format($total, 2) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                    $sql_getCart = mysqli_query($conn, "SELECT * FROM cart ORDER BY cart_id DESC");
                                    while ($row_cart = mysqli_fetch_array($sql_getCart)) {
                                    ?>
                                        <input type="hidden" name="productID[]" value="<?php echo $row_cart['product_id'] ?>">
                                        <input type="hidden" name="productQTY[]" value="<?php echo $row_cart['pd_qty'] ?>">
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="hidden" name="totalPrice" value="<?php echo $total?>">
                                        <input type="submit" name="checkOut" value="PLACE ORDER" class="btn btn-primary btn-lg py-3 btn-block ">
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- </form> -->
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>