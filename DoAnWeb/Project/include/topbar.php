<?php
$sql_category = mysqli_query($conn, 'SELECT * FROM category');
?>
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="images/12.png" width="300px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Home</a></li>
                    <div class="dropdown">
                        <li><a href="?control=category&id=all">Categories</a></li>
                        <div class="dropdown-content">
                            <?php
                            while ($row_category = mysqli_fetch_array($sql_category)) {
                            ?>
                                <a href="?control=category&id=<?php echo $row_category['category_id']; ?>"><?php echo $row_category['category_name']; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                    <li><a href="accounts.html">Account</a></li>
                </ul>
            </nav>
            <a href="?control=cart"><img src="images/cart.png" width="30px" height="30px"></a>
            <img src="images/menu.png" class="menu-icon">
        </div>
    </div>
    <div class="menu-mobile" style="display: none;">
        <nav class="ul-mobile" style="text-align: left;">
            <ul>
                <li><a href="index.php">Home</a></li>
                <div class="dropdown">
                    <li class="cate-mobile">
                        <a href="?control=category&id=all">Categories</a>
                        <i class="fa fa-angle-down cate-icon"></i>
                    </li>

                </div>
                <div class="dropdown-content-mobile">
                    <?php
                    $sql_category_mobile = mysqli_query($conn, 'SELECT * FROM category');
                    while ($row_category_mobile = mysqli_fetch_array($sql_category_mobile)) {
                    ?>
                        <a href="?control=category&id=<?php echo $row_category_mobile['category_id']; ?>"><?php echo $row_category_mobile['category_name']; ?></a>
                    <?php
                    }
                    ?>
                </div>
                <li><a href="About.html">About</a></li>
                <li><a href="Contact.html">Contact</a></li>
                <li><a href="accounts.html">Account</a></li>
            </ul>
        </nav>
    </div>