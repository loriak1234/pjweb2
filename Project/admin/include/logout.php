<?php
session_start();
if(isset($_SESSION['adminName'])) {
    unset($_SESSION['adminName']);
}
header("Location: ../index.php");
?>