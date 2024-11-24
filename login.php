<?php
$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = "root"; // Update with your MySQL password
$dbname = "user_auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Login successful!";
        $message_class = "success";
    } else {
        $message = "Invalid username or password.";
        $message_class = "error";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="message <?php echo $message_class; ?>">
            <p><?php echo $message; ?></p>
            <a href="login.html" class="back-link">Back to Login</a>
        </div>
    </div>
</body>
</html>
