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
    echo "SQL Query: " . $sql . "<br>"; // Debugging: echo out the SQL query

    $result = $conn->query($sql);
    if (!$result) {
        die("Error: " . $conn->error);
    }
    
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Your custom styles -->
    <style>
        /* Custom styles */
        .btn-transparent {
            background-color: rgba(0, 0, 0, 0);
            border-color: #007bff;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Display login error message if any
                        if(isset($_SESSION["login_error"])) {
                            echo '<p class="text-danger">' . $_SESSION["login_error"] . '</p>';
                            unset($_SESSION["login_error"]);
                        }
                        ?>
                        <form action="login_process.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-transparent btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Sign Up</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Check if there is a success message in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const successMsg = urlParams.get('success');
        if (successMsg === 'true') {
            // Display a success message using JavaScript alert
            alert("Login successful!");
            // Redirect to index.php after 2 seconds
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 2000);
        }
    </script>
</body>
</html>
