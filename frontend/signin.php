<?php
session_start(); // Start the session

$host = 'localhost';
$dbname = 'vehicle_pooling';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile_number = sanitizeInput($_POST['mobile_number']);
    $password = sanitizeInput($_POST['password']);

    // Check if mobile number exists
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE mobile_number = ?");
    $stmt->bind_param("s", $mobile_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Mobile number not found
        header("Location: signin.html?error=Mobile number not found");
        exit();
    }

    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        // Store user session
        $_SESSION['user_id'] = $user_id;

        // Redirect to homepage
        header("Location: index.php");
        exit();
    } else {
        // Incorrect password
        header("Location: signin.html?error=Incorrect password");
        exit();
    }
}

$conn->close();
?>
