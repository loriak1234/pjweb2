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
$userPerPage = 10;

$pageNum = 1;
$adjacents = 2;
if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}

$offset = ($pageNum - 1) * $userPerPage;

$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
$prevPage = $pageNum - 1;
$nextPage = $pageNum + 1;

$maxPage = ceil($numrows / $userPerPage);
$lpm1 = $maxPage - 1;

$self = "users.php?";
$nav  = '';
?>


<body>
    <?php
    include('header.php');
    ?>

    <div style="padding:15px;">
        <table style="border:1px solid grey" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bor-white" scope="col">ID</th>
                    <th class="bor-white" scope="col">Name</th>
                    <th class="bor-white" scope="col">Phone</th>
                    <th class="bor-white" scope="col">Email</th>
                    <th class="bor-white" scope="col">Address</th>
                    <th class="bor-white" scope="col">Active</th>
                    <th class="bor-white" scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_selectUser = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id asc LIMIT $offset, $userPerPage");
                while ($row_selectUser = mysqli_fetch_array($sql_selectUser)) {
                ?>
                    <tr>
                        <th class="td1" scope="row"><?php echo $row_selectUser['user_id'] ?></th>
                        <td><?php echo $row_selectUser['username'] ?></td>
                        <td><?php echo $row_selectUser['phone'] ?></td>
                        <td><?php echo $row_selectUser['email'] ?></td>
                        <td><?php echo $row_selectUser['address'] ?></td>
                        <td><?php echo $row_selectUser['active'] ?></td>
                        <td class="w-10">
                            <form style="display:inline;" action="manageUser.php?manageUser=update&id=<?php echo $row_selectUser['user_id'] ?>" method="POST">
                                <button style="margin-right: 5px;" type="submit" class="btn btn-outline-success">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php
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