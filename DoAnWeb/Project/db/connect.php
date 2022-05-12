<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "gracefuldb");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to mySQL" + mysqli_connect_error();
}

?>