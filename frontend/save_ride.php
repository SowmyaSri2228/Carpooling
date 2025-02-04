<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "localhost";
$username = "root"; 
$password = "";
$database = "vehicle_pooling";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_type = $_POST['vehicle-type'];
    $vehicle_number = $_POST['vehicle-number'];
    $from_location = $_POST['from-location'];
    $to_location = $_POST['to-location'];
    $ride_date = $_POST['ride-date'];
    $ride_time = $_POST['ride-time'];
    $passengers = $_POST['passengers'];
    $cost_per_passenger = $_POST['cost-per-passenger'];
    $additional_info = $_POST['additional-info'];
    
   
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO rides (user_id, vehicle_type, vehicle_number, from_location, to_location, ride_date, ride_time, passengers, cost_per_passenger, additional_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssis", $user_id, $vehicle_type, $vehicle_number, $from_location, $to_location, $ride_date, $ride_time, $passengers, $cost_per_passenger, $additional_info);
    
    if ($stmt->execute()) {
        echo "Ride successfully offered!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
