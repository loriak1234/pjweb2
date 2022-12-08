<?php
include("include/baseName.php");
?>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <div class="dropdown">

    </div>
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="dropdown">
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="dashboard.php"><img src="../images/12.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="active">
                    <a href="dashboard.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                </li>

                <li class="menu">
                    <a href="../index.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa-solid fa-house"></i>Website</a>
                </li>

                <li class="menu">
                    <a href="category.php" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-tasks"></i>Categories</a>
                </li>

                <li class="menu">
                    <a href="product.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cube"></i>Products</a>
                </li>

                <li class="menu">
                    <a href="order.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>Orders</a>
                </li>

                <li class="menu">
                    <a href="users.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Users</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header" style="padding-right:14px;">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>

            <div class="col-sm-5">
                <div style="display:flex;" class="user-area dropdown float-right">
                    <svg width="512" viewBox="0 0 512 512" height="512" enable-background="new 0 0 512 512" id="Layer_1" xmlns="">
                        <g>
                            <g>
                                <path d="m433 512c-11.046 0-20-8.954-20-20 0-78.299-63.701-142-142-142h-30c-78.299 0-142 63.701-142 142 0 11.046-8.954 20-20 20s-20-8.954-20-20c0-100.355 81.645-182 182-182h30c100.355 0 182 81.645 182 182 0 11.046-8.954 20-20 20z"></path>
                            </g>
                            <g>
                                <path d="m254 270c-74.439 0-135-60.561-135-135s60.561-135 135-135 135 60.561 135 135-60.561 135-135 135zm0-230c-52.383 0-95 42.617-95 95s42.617 95 95 95 95-42.617 95-95-42.617-95-95-95z"></path>
                            </g>
                        </g>
                    </svg>&nbsp;
                    <p style="color:black; padding-right: 10px;"><?php echo $_SESSION['adminName']?></p>|&nbsp;
                    <a style="color:black; padding:0;" class="nav-link" href="include/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>



                    <!-- <div class="user-menu dropdown-menu"> -->
                    <!-- <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                        <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications</a>

                        <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a> -->

                    <!-- <a class="nav-link" href="../include/logout.php"><i class="fa fa-power-off"></i>Logout</a> -->
                    <!-- </div> -->
                </div>

                <div class="language-select dropdown" id="language-select">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true" aria-expanded="true">
                        <i class="flag-icon flag-icon-us"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="language">
                        <div class="dropdown-item">
                            <span class="flag-icon flag-icon-fr"></span>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-es"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-it"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4" style="max-width: 100%;">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1><?php echo $stringURL ?></h1>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div> -->
    </div>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/dashboard.js"></script>