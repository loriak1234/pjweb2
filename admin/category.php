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

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql_delete = mysqli_query($conn, "DELETE FROM category WHERE category_id='$id'");
  header('location:category.php');
} elseif (isset($_GET['add'])) {
  $sql_resetAI = mysqli_query($conn, "ALTER TABLE category AUTO_INCREMENT = 1");
  $name = $_POST['cateName'];
  $sql_insert = mysqli_query($conn, "INSERT INTO category(category_name) values ('$name')");
  header('location:category.php');
}

$productPerPage = 6;

$pageNum = 1;
$adjacents = 2;
if (isset($_GET['page'])) {
  $pageNum = $_GET['page'];
}

$offset = ($pageNum - 1) * $productPerPage;

$sql = "SELECT * FROM category";

$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
$prevPage = $pageNum - 1;
$nextPage = $pageNum + 1;

$maxPage = ceil($numrows / $productPerPage);
$lpm1 = $maxPage - 1;

$self = "category.php?";
$nav  = '';
?>


<body>
  <?php
  include('header.php');
  ?>
  <?php
  $sql_cateAdmin = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id asc LIMIT $offset, $productPerPage");
  ?>
  <div style="padding:15px;">
    <table style="border:1px solid grey" class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th class="bor-white" scope="col">ID</th>

          <th class="bor-white" scope="col">Name</th>
          <th class="bor-white" scope="col">Manage</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row_cateAdmin = mysqli_fetch_array($sql_cateAdmin)) {
        ?>
          <tr>
            <th class="td1" scope="row"><?php echo $row_cateAdmin['category_id'] ?></th>
            <td class="td3"><?php echo $row_cateAdmin['category_name'] ?></td>
            <td class="td4">
              <form style="display:inline;" action="updateCategory.php?update=<?php echo $row_cateAdmin['category_id'] ?>" method="POST"><button style="margin-right: 5px;" type="submit" class="btn btn-outline-success">Update</button></form>
              <a id="confirmText" href="?delete=<?php echo $row_cateAdmin['category_id']; ?>"><button style="margin-left: 5px;" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button></a>
            </td>
          </tr>
        <?php
        }
        ?>
        </tr>
      </tbody>
    </table>
    <form action="?add" method="POST">
      <div class="row" style="margin:0;">
        <div class="col">
          Category Name<input type="text" name="cateName" class="form-control" placeholder=" Category Name" required oninvalid="setCustomValidity('Please enter the category name')" oninput="setCustomValidity('')">
          <button style="margin-top:15px;" name="addCategory" type="submit" class="btn btn-info">Add new category</button>
        </div>
      </div>
    </form>


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