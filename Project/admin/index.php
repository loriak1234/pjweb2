<?php
include('../db/connect.php');
session_start();
if(!isset($_SESSION['adminName'])){
if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql_select_admin = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
    $count = mysqli_num_rows($sql_select_admin);
    $row_dangnhap = mysqli_fetch_array($sql_select_admin);
    if ($count > 0) {
        $_SESSION['adminName'] = $row_dangnhap['name'];
        $_SESSION['adminID'] = $row_dangnhap['id'];
    ?>
        <script>
            // alert("Login successfully");
            window.location.replace("dashboard.php");
        </script>
    <?php
    } else {
        $alert = '<p class="account-p">Your email or password was entered incorrectly.</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .account-p {
        color: red;
        font-size: 12px;
        }
    </style>
</head>

<body class="text-center">

    <form class="form-signin" action="" method="POST">
        <!-- <img class="mb-4" src="../images/12.png" alt="" width="72" height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>
        <?php
        if(isset($alert)){
            echo $alert;
        }
        ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required oninvalid="setCustomValidity('Please enter a valid email')" oninput="setCustomValidity('')">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required oninvalid="setCustomValidity('Please enter your password')" oninput="setCustomValidity('')">
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
    </form>

</body>

</html>
<?php
}
else {
    header("Location: dashboard.php");
}
?>