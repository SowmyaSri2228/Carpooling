<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Carpooling";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)|| empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Email and password are required!']);
        exit();
    }
    $email = $conn->real_escape_string($email);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($row['email']);
        } else {
            echo "Invalid username/password.";
        }
    } else {
        echo " Invalid username";
    }
    $stmt->close();
}

$conn->close();
?>
