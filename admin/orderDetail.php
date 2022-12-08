<?php
include("../db/connect.php");

include("include/head.php");

if(!isset($_SESSION['adminName'])){
?>
<script>
    alert("You can not access this page");
    window.location.replace("index.php");
</script>
<?php

} else {

if (isset($_POST['updateOrder'])) {
    $process = $_POST['process'];
    $code = $_POST['invoiceCode'];
    $sql_update_invoice = mysqli_query($conn, "UPDATE invoice SET status='$process' WHERE invoice_code='$code'");
    $sql_update_transaction = mysqli_query($conn, "UPDATE transaction SET status='$process' WHERE transaction_code='$code'");
    ?>
    <script>
        alert("Update Successfully");
        window.location.replace("order.php");
    </script>
    <?php
}
?>

<body>
    <?php
    include('header.php');
    ?>
    <div style="padding:15px;">
        <form action="" method="POST">
            <table style="border:1px solid grey" class="table table-bordered">
                <thead class="thead-dark">

                    <tr>
                        <th class="bor-white" scope="col">Ordinal</th>
                        <th class="bor-white" scope="col">Invoice Code</th>
                        <th class="bor-white" scope="col">Product Name</th>
                        <th class="bor-white" scope="col">Quantity</th>
                        <th class="bor-white" scope="col">Price</th>
                        <th class="bor-white" scope="col">Subtotal</th>
                        <th class="bor-white" scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['code'])) {
                        $code = $_GET['code'];
                    }
                    $i = 1;
                    $sql_selectInvoice = mysqli_query($conn, "SELECT * FROM invoice, product WHERE invoice.product_id = product.product_id AND invoice_code = '$code'");
                    while ($row_selectInvoice = mysqli_fetch_array($sql_selectInvoice)) {
                    ?>
                        <tr>
                            <th class="td1" scope="row"><?php echo $i ?></th>
                            <td><?php echo $row_selectInvoice['invoice_code'] ?></td>
                            <td><?php echo $row_selectInvoice['product_name'] ?></td>
                            <td><?php echo $row_selectInvoice['quantity'] ?></td>
                            <td><?php echo '$' . number_format($row_selectInvoice['product_price'], 2) ?></td>
                            <td><?php echo '$' . number_format($row_selectInvoice['quantity'] * $row_selectInvoice['product_price'], 2) ?></td>
                            <td><?php echo $row_selectInvoice['date'] ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <?php
            $sql_statusOrder = mysqli_query($conn, "SELECT * FROM invoice WHERE invoice_code = '$code' GROUP BY invoice_code");
            $fetch_statusOrder = mysqli_fetch_array($sql_statusOrder);
            if ($fetch_statusOrder['status'] == 0) {
            ?>
                <div>
                    <select style="width: 40% !important;" class="form-control" name="process">
                        <option value="1">Processed</option>
                        <option value="0" selected>Unprocessed</option>
                    </select>
                    <input style="margin-top: 10px;" type="submit" name="updateOrder" class="btn btn-success" value="Update Order">
                </div>
            <?php
            } else {
            ?>
                <div>
                    <select style="width: 40% !important;" class="form-control" name="process">
                        <option value="1" selected>Processed</option>
                        <option value="0">Unprocessed</option>
                    </select>
                    <input style="margin-top: 10px;" type="submit" name="updateOrder" class="btn btn-success" value="Update Order">
                </div>
            <?php
            }
            ?>
            <input type="hidden" name="invoiceCode" value="<?php echo $fetch_statusOrder['invoice_code'] ?>">
        </form>

    </div>
</body>
<?php
}
?>