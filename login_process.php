<?php
session_start();

// Check if user is already logged in, if yes, redirect to index.php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Establish database connection
$servername = "localhost";
$username = "root"; // assuming your username is root
$password = ""; // assuming no password
$dbname = "silent"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT id, username FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // User found, redirect to homepage or wherever you want
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: index.php?success=true");
        exit();
    } else {
        // User not found, redirect back to login page with error message
        $_SESSION["login_error"] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
