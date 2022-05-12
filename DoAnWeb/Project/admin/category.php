<?php
include("../db/connect.php");

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql_delete = mysqli_query($conn,"DELETE FROM category WHERE category_id='$id'");
  header('location:category.php');
} elseif (isset($_GET['add'])) {
  $sql_resetAI = mysqli_query($conn,"ALTER TABLE category AUTO_INCREMENT = 1");
  $name = $_POST['cateName'];
  $sql_insert = mysqli_query($conn, "INSERT INTO category(category_name) values ('$name')");
  header('location:category.php');
} 
?>

<?php
include("include/head.php");
?>

<body>
  <?php
  include('header.php');
  ?>
  <?php
  $sql_cateAdmin = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id asc");
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
              <form style="display:inline;" action="updateForm.php?update=<?php echo $row_cateAdmin['category_id']?>" method="POST"><button style="margin-right: 5px;" type="submit" class="btn btn-outline-success">Update</button></form>
              <a href="?delete=<?php echo $row_cateAdmin['category_id'];?>"><button style="margin-left: 5px;" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button></a>
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
          Category Name<input type="text" name="cateName" class="form-control" placeholder=" Category Name" required oninvalid="setCustomValidity('Please enter the category name')">
          <button style="margin-top:15px;" name="addCategory" type="submit" class="btn btn-info">Add new category</button>
        </div>
      </div>
    </form>
    

  </div>
</body>

</html>