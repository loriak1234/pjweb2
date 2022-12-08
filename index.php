<?php
session_start();
include("db/connect.php");
$title = "Graceful";
if (isset($_GET['control'])) {
    if ($_GET['control'] == 'category') {
        $title = 'Products';
    } elseif ($_GET['control'] == 'cart') {
        $title = 'Cart';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/DoAnWeb\Project\css\style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/ed211a9bdb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>


    <script src="/DoAnWeb\Project\js\menu.js" defer></script>

</head>

<body>
    <?php
    include('include/topbar.php');

    if (isset($_GET['control'])) {
        $temp = $_GET['control'];
    } else {
        $temp = '';
    }
    if ($temp == 'category') {
        include('include/cateProduct.php');
    } elseif ($temp == 'detail') {
        include('include/productDetail.php');
    } elseif ($temp == 'cart') {
        include('include/cart.php');
    } elseif ($temp == 'search') {
        include('include/search.php');
    }
    elseif($temp == 'login' || $temp =='register') {
        include('include/account.php');
    }
    elseif(isset($_GET['About'])) {
        include('include/About.php');
    }
    else {
        include('include/home.php');
    }

    include('include/footer.php');
    ?>


</body>

</html>