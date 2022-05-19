<?php
include("../db/connect.php");

if (isset($_POST['updateUser'])) {
    $id = $_POST['userID'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $active = $_POST['active'];

    $sql_update = mysqli_query($conn, "UPDATE users SET username = '$username', phone = '$phone', address ='$address',
    active = '$active' WHERE user_id ='$id'");
    if ($sql_update) {
?>
        <script type="text/javascript">
            alert('Update Successfully');
            window.location.replace("users.php");
        </script>
<?php
    }
}

include("include/head.php");
?>

<body>
    <?php
    include("header.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_GET['manageUser'])) {
        $manageUser = $_GET['manageUser'];
    }
    if ($manageUser == 'update') {
    $sql_UdateUser = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
    $row_UpdateUser = mysqli_fetch_array($sql_UdateUser);
    
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="inputPDN" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" placeholder="Name" id="inputPDN" required value="<?php echo $row_UpdateUser['username']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPDP" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" placeholder="Phone number" readonly id="inputPDP" required value="<?php echo $row_UpdateUser['phone']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputQTY" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Email address" readonly value="<?php echo $row_UpdateUser['email']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputMate" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" placeholder="Your address" readonly value="<?php echo $row_UpdateUser['address']; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputMate" class="col-sm-2 col-form-label">Active</label>
                <div class="col-sm-10">
                    <select name="active" class="form-control" required>
                        <option value="">----- Active -----</option>
                        <?php
                        if ($row_UpdateUser['active'] == 1) {
                        ?>
                            <option value="0">0 - Not Active</option>
                            <option value="1" selected>1 - Active</option>
                        <?php
                        } else {
                        ?>
                            <option value="0" selected>0 - Not Active</option>
                            <option value="1">1 - Active</option>
                        <?php
                        }
                        ?>
                    </select>
                    <div>
                        <input type="hidden" name="userID" value="<?php echo $row_UpdateUser['user_id']?>">
                        <button style="margin-top:15px;" type="submit" name="updateUser" class="btn btn-info">Update User</button>
                        <input style="margin-top:15px; margin-left:5px;" type="reset" value="Reset" class="btn btn-danger">
                    </div>
                </div>

            </div>
        </form>
    <?php
    } 
    ?>
</body>