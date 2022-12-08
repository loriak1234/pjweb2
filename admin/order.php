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

$orderPerPage = 10;
$pageNum = 1;
$adjacents = 2;
if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}
$offset = ($pageNum - 1) * $orderPerPage;

if (isset($_POST['Filter'])) {
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];

    $dateFromAfter = date('Y-m-d', strtotime($dateFrom.' - 5 days'));
    $dateToAfter = date('Y-m-d', strtotime($dateTo.' - 5 days'));

    if (empty($dateTo)) {
        $sql_selectInvoice = mysqli_query($conn, "SELECT * FROM invoice, users 
    WHERE invoice.user_id = users.user_id AND date >= '$dateFromAfter 00:00:00'
    GROUP BY invoice_code ORDER BY invoice_id asc LIMIT $offset, $orderPerPage");
        $sql = "SELECT * FROM invoice WHERE date >= '$dateFromAfter 00:00:00' GROUP BY invoice_code";
    } elseif (empty($dateFrom)) {
        $sql_selectInvoice = mysqli_query($conn, "SELECT * FROM invoice, users 
    WHERE invoice.user_id = users.user_id AND date <= '$dateToAfter 23:59:59'
    GROUP BY invoice_code ORDER BY invoice_id asc LIMIT $offset, $orderPerPage");
        $sql = "SELECT * FROM invoice WHERE date <= '$dateToAfter 23:59:59' GROUP BY invoice_code";
    } else {
        $sql_selectInvoice = mysqli_query($conn, "SELECT * FROM invoice, users 
    WHERE invoice.user_id = users.user_id AND date BETWEEN '$dateFromAfter 00:00:00' AND '$dateToAfter 23:59:59'
    GROUP BY invoice_code ORDER BY invoice_id asc LIMIT $offset, $orderPerPage");
        $sql = "SELECT * FROM invoice WHERE date BETWEEN '$dateFromAfter 00:00:00' AND '$dateToAfter 23:59:59' GROUP BY invoice_code";
    }
} else {
    $sql_selectInvoice = mysqli_query($conn, "SELECT * FROM invoice, users 
    WHERE invoice.user_id = users.user_id GROUP BY invoice_code ORDER BY invoice_id asc LIMIT $offset, $orderPerPage");
    $sql = "SELECT * FROM invoice GROUP BY invoice_code";
}

$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
$prevPage = $pageNum - 1;
$nextPage = $pageNum + 1;

$maxPage = ceil($numrows / $orderPerPage);
$lpm1 = $maxPage - 1;

$self = "order.php?";
$nav  = '';
?>

<body>
    <?php
    include('header.php');
    ?>

    <div style="padding:15px;">
        <div style="margin-bottom:15px;">
            <form action="" method="POST">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label>Date from</label>
                        <input style="width: 100% !important;" type="date" class="form-control" name="dateFrom"
                        value="<?php if(isset($dateFrom)){echo $dateFrom;}?>">
                    </div>
                    <div class="col-auto">
                        <label>Date to</label>
                        <input style="width: 100% !important;" type="date" class="form-control" name="dateTo" 
                        value="<?php if(isset($dateTo)){echo $dateTo;}?>">
                    </div>
                    <div class="col-auto">
                        <button style="position: absolute;" type="submit" name="Filter" class="btn btn-primary mb-2">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <table style="border:1px solid grey" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bor-white" scope="col">Ordinal</th>
                    <th class="bor-white" scope="col">Invoice Code</th>
                    <th class="bor-white" scope="col">Customer</th>
                    <!-- <th class="bor-white" scope="col">Total Price</th> -->
                    <th class="bor-white" scope="col">Note</th>
                    <th class="bor-white" scope="col">Date</th>
                    <th class="bor-white" scope="col">EDD</th>
                    <th class="bor-white" scope="col">Status</th>
                    <th class="bor-white" scope="col">Manage</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if ($pageNum != 1) {
                    $i = ($orderPerPage * ($pageNum - 1)) + 1;
                } else $i = 1;
                while ($row_selectInvoice = mysqli_fetch_array($sql_selectInvoice)) {
                ?>
                    <tr>
                        <th class="td1" style="width: 5%;" scope="row"><?php echo $i ?></th>
                        <td><?php echo $row_selectInvoice['invoice_code'] ?></td>
                        <td><?php echo $row_selectInvoice['username'] ?></td>
                        <!-- <td><?php echo '$' . number_format($row_selectInvoice['total_price'], 2) ?></td> -->
                        <td><?php echo $row_selectInvoice['note'] ?></td>
                        <td><?php echo $row_selectInvoice['date'] ?></td>
                        <?php
                        $status = "";
                        if ($row_selectInvoice['status'] == '0') {
                            $status = 'Unprocessed';
                        } else {
                            $status = 'Processed';
                        }
                        ?>
                        <td><?php echo date('Y-m-d', strtotime($row_selectInvoice['date'].' + 5 days'))?></td>
                        <td><?php echo $status ?></td>

                        <td class="w-10">
                            <form style="display:inline;" action="orderDetail.php?code=<?php echo $row_selectInvoice['invoice_code'] ?>" method="POST">
                                <button style="margin-right: 5px;" type="submit" class="btn btn-outline-success">View Detail</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $i++;
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
                    // $nav .= " <a href=\"$self&page=2\"><span> 2 </span></a> ";
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
            echo "<div style='text-align:center;'>$prev $nav $next </div>";
        }
        ?>

    </div>
</body>
<?php
}
?>

</html>