<?php
include("include/head.php");
?>

<body>
    <?php
    include('include/topbar.php');
    
    
    if(isset($_GET['control'])){
        $temp = $_GET['control'];
    }
    else {
        $temp = '';
    }

    if($temp == 'category'){
        include('include/cateProduct.php');
    }

    elseif($temp == 'detail'){
        include('include/productDetail.php');
    }

    elseif($temp == 'cart') {
        include('include/cart.php');
    }

    else {
        include('include/home.php');
    }

    include('include/footer.php');
    ?>

    
    <script>
        runClock();
        setInterval("runClock()", 1000);

        function runClock() {
            var currentDay = new Date();
            var exDate = new Date("May 30, 2022");
            var daysLeft = (exDate - currentDay) / (1000 * 60 * 60 * 24);

            var hrsLeft = (daysLeft - Math.floor(daysLeft)) * 24;
            var minsLeft = (hrsLeft - Math.floor(hrsLeft)) * 60;
            var secsLeft = (minsLeft - Math.floor(minsLeft)) * 60;
            document.getElementById("days").textContent = Math.floor(daysLeft);
            document.getElementById("hours").textContent = Math.floor(hrsLeft);
            document.getElementById("minutes").textContent = Math.floor(minsLeft);
            document.getElementById("seconds").textContent = Math.floor(secsLeft);

        }
    </script>

</body>

</html>