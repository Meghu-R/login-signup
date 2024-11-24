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
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];

    // Check if the username already exists
    $check_user = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        $message = "Username already exists. Please choose a different username.";
        $message_class = "error";
    } else {
        $sql = "INSERT INTO users (username, mobile, password) VALUES ('$username', '$mobile', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful!";
            $message_class = "success";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
            $message_class = "error";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="message <?php echo $message_class; ?>">
            <p><?php echo $message; ?></p>
            <a href="login.html" class="back-link">Back to login</a>
        </div>
    </div>
</body>
</html>

