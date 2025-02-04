<?php
session_start(); 

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

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE mobile_number = ?");
    $stmt->bind_param("s", $mobile_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        header("Location: signin.html?error=Mobile number not found");
        exit();
    }

    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['mobile_number'] = $mobile_number;

        
        header("Location: index.php");
        exit();
    } else {
        header("Location: signin.html?error=Incorrect password");
        exit();
    }
}

$conn->close();
?>
