<?php
session_start();
// session_destroy();
if (isset($_SESSION['userName'])) {
    unset($_SESSION['userName']);
}
header("Location: ../index.php");
?>