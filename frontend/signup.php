<?php
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
    $name = sanitizeInput($_POST['name']);
    $mobile_number = sanitizeInput($_POST['mobile_number']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        header("Location: signup.html?error=Passwords do not match");
        exit();
    }

    // Check if email or mobile number already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR mobile_number = ?");
    $stmt->bind_param("ss", $email, $mobile_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: signup.html?error=Email or mobile number already registered");
        exit();
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (name, mobile_number, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $mobile_number, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: signup.html?success=Registration successful!");
    } else {
        header("Location: signup.html?error=Something went wrong. Try again.");
    }

    $stmt->close();
}

$conn->close();
?>
