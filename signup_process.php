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
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $hashed_password);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // User successfully registered, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Error occurred, redirect back to sign-up page with error message
        $_SESSION["signup_error"] = "Error occurred while registering. Please try again later.";
        header("Location: signup.php");
        exit();
    }
}

$conn->close();
?>
