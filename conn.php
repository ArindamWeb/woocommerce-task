<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tester4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


    // Check conn
    if ($conn->connect_error) {
        die("conn failed: " . $conn->connect_error);
    }

?>

