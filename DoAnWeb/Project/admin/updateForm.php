<?php
include("../db/connect.php");

if (isset($_GET['update'])) {
  $id = $_GET['update'];
  $sql_updateForm = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$id'");
}
?>

<?php
include("include/head.php");
?>

<body>
  <?php
  include("header.php");
  $row_updateForm = mysqli_fetch_array($sql_updateForm);
  ?>
  <div style="padding:15px;">
    <form action="updateCategory.php" method="post">
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
            <td class="td3"><input class="form-control" type="text" name="name" value="<?php echo $row_updateForm['category_name'] ?>"></td>

            <td class="td4">
              <button type="submit" class="btn btn-outline-success">Update</button>
              <input type="reset" value="Reset" class="btn btn-outline-danger">
            </td>

          </tr>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</body>


</html>