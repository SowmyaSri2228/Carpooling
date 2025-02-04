<?php
$host = "localhost";
$user = "root"; // Default username in XAMPP
$pass = ""; // Default password in XAMPP is empty
$dbname = "rideline"; // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
