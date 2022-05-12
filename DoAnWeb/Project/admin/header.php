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
            <a class="navbar-brand" href="admin.php"><img src="../images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="admin.php"><img src="../images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                
                <li class="active">
                    <a href="admin.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
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
                    <a href="#" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>Orders</a>
                </li>

                <li class="menu">
                    <a href="#" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Users</a>
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
                    <p style="color:black; padding-right: 10px;">Hi Khang</p>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-angle-down"></i>
                        <!-- <img class="user-avatar rounded-circle" src="../images/admin.jpg" alt="User Avatar"> -->
                    </a>


                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                        <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications</a>

                        <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                        <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
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