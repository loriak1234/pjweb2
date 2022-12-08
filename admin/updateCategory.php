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

if (isset($_GET['update'])) {
  $id = $_GET['update'];
  $sql_updateForm = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$id'");
}

if (isset($_POST['updateCategory']) && isset($_POST['name']) && isset($_POST['id'])) {
  $name = $_POST['name'];
  $id = $_POST['id'];

  $sql_updateForm = mysqli_query($conn, "UPDATE category SET category_name = '$name'
  WHERE category_id = '$id'");
  echo '<script type="text/javascript">alert("Update Successfully!")</script>';
  echo '<script type="text/javascript">window.location.replace(\'category.php\');</script>';
}
?>

<body>
  <?php
  include("header.php");
  $row_updateForm = mysqli_fetch_array($sql_updateForm);
  ?>
  <div style="padding:15px;">
    <form action="" method="post">
      <table style="border:1px solid grey" class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th class="bor-white" scope="col">Ordinal</th>
            <th class="bor-white" scope="col">Name</th>
            <th class="bor-white" scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <input type="hidden" name="id" value="<?php echo $row_updateForm['category_id']; ?>">
            <th class="td1" scope="row"><?php echo $row_updateForm['category_id']; ?></th>
            <td class="td3"><input class="form-control" type="text" required name="name" value="<?php echo $row_updateForm['category_name'] ?>"></td>

            <td class="td4">
              <button type="submit" name="updateCategory" class="btn btn-outline-success">Update</button>
              <input type="reset" value="Reset" class="btn btn-outline-danger">
            </td>

          </tr>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</body>

<?php
}
?>
</html>