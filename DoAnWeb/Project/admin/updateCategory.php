<?php
include("../db/connect.php");
include("baseName.php");

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];

    $sql_updateForm = mysqli_query($conn, "UPDATE category SET category_name = '$name'
    WHERE category_id = '$id'");
    echo '<script type="text/javascript">alert("Update Successfully!")</script>';
    echo '<script type="text/javascript">window.location.replace(\'category.php\');</script>';

}
