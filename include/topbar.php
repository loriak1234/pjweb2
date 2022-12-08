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
                    <li><a href="index.php" class="hova">Home</a></li>
                    <div class="dropdown">
                        <li><a href="?control=category&id=all" class="hova">Categories</a></li>
                        <div class="dropdown-content">
                            <?php
                            while ($row_category = mysqli_fetch_array($sql_category)) {
                            ?>
                                <a class="hova" href="?control=category&id=<?php echo $row_category['category_id']; ?>"><?php echo $row_category['category_name']; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <li><a href="?About" class="hova">About</a></li>
                    <li style="margin-right:5px;">
                        <form style="display:flex" action="index.php?control=search" id="searchForm" method="POST">
                            <input type="search" class="input-search" name="keyword" placeholder="Search product" required oninvalid="setCustomValidity('Please enter a keyword')" oninput="setCustomValidity('')">
                            <button type="submit" style="background: inherit;" name="search" class="button-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </li>
                    <!-- <li><a href="?control=login" class="hova">Login</a></li> -->
                    <?php
                    if (isset($_SESSION['userName'])) {
                    ?>
                        <div class="dropdown">
                            <li>
                                <svg width="512" viewBox="0 0 512 512" height="512" enable-background="new 0 0 512 512" id="Layer_1" xmlns="">
                                    <g>
                                        <g>
                                            <path d="m433 512c-11.046 0-20-8.954-20-20 0-78.299-63.701-142-142-142h-30c-78.299 0-142 63.701-142 142 0 11.046-8.954 20-20 20s-20-8.954-20-20c0-100.355 81.645-182 182-182h30c100.355 0 182 81.645 182 182 0 11.046-8.954 20-20 20z"></path>
                                        </g>
                                        <g>
                                            <path d="m254 270c-74.439 0-135-60.561-135-135s60.561-135 135-135 135 60.561 135 135-60.561 135-135 135zm0-230c-52.383 0-95 42.617-95 95s42.617 95 95 95 95-42.617 95-95-42.617-95-95-95z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </li>
                            <!-- &nbsp;|&nbsp; -->
                            <div class="dropdown-content">
                                <a class="hovUDL hova" href="?control=login">Account</a>
                                <a class="hovUDL hova" href="include/logout.php">Logout</a>
                            </div>

                        </div>
                    <?php
                    } else {
                    ?>
                        <li><a href="?control=login" class="hova">Login </a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <a href="?control=cart"><img src="images/cart.png" width="30px" height="30px"></a>
            <img src="images/menu.png" class="menu-icon">

        </div>

    </div>
    <div class="menu-mobile" style="display: none;">
        <nav class="ul-mobile" style="text-align: left;">
            <ul>
                <li><a href="index.php" class="hova">Home</a></li>
                <div class="dropdown">
                    <li class="cate-mobile">
                        <a href="?control=category&id=all" class="hova">Categories</a>
                        <i class="fa fa-angle-down cate-icon"></i>
                    </li>

                </div>
                <div class="dropdown-content-mobile">
                    <?php
                    $sql_category_mobile = mysqli_query($conn, 'SELECT * FROM category');
                    while ($row_category_mobile = mysqli_fetch_array($sql_category_mobile)) {
                    ?>
                        <a class="hova" href="?control=category&id=<?php echo $row_category_mobile['category_id']; ?>"><?php echo $row_category_mobile['category_name']; ?></a>
                    <?php
                    }
                    ?>
                </div>
                <li><a href="About.php" class="hova">About</a></li>
                <?php
                if (isset($_SESSION['userName'])) {
                ?>
                    <li><a class="hovUDL" href="?control=login">
                            <svg style="fill: white;" width="512" viewBox="0 0 512 512" height="512" enable-background="new 0 0 512 512" id="Layer_1" xmlns="">
                                <g>
                                    <g>
                                        <path d="m433 512c-11.046 0-20-8.954-20-20 0-78.299-63.701-142-142-142h-30c-78.299 0-142 63.701-142 142 0 11.046-8.954 20-20 20s-20-8.954-20-20c0-100.355 81.645-182 182-182h30c100.355 0 182 81.645 182 182 0 11.046-8.954 20-20 20z"></path>
                                    </g>
                                    <g>
                                        <path d="m254 270c-74.439 0-135-60.561-135-135s60.561-135 135-135 135 60.561 135 135-60.561 135-135 135zm0-230c-52.383 0-95 42.617-95 95s42.617 95 95 95 95-42.617 95-95-42.617-95-95-95z"></path>
                                    </g>
                                </g>
                            </svg> <?php echo $_SESSION['userName'] ?>
                            &nbsp;|&nbsp;
                            <a class="hovUDL" href="include/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li><a href="?control=login" class="hova">Login </a></li>
                <?php
                }
                ?>
                <li style="margin-right:5px;">
                    <form style="display:flex" action="index.php?control=search" method="POST">
                        <input type="search" class="input-search" name="keyword" placeholder="Search product" required oninvalid="setCustomValidity('Please enter a keyword')" oninput="setCustomValidity('')">
                        <button style="background-color: inherit;" type="submit" name="search" class="button-search"><i style="color:white;" class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>