<?php
// Change these credentials according to your MySQL server
$host = "localhost";
$username = "root";
$password = "";
$database = "silent";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
