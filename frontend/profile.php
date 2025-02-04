<?php
session_start(); // Start the session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to signin page
    header("Location: signin.html");
    exit();
}

$host = 'localhost';
$dbname = 'vehicle_pooling';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT mobile_number, name, email, year, department, section, roll_number FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($mobile_number, $name, $email, $year, $department, $section, $roll_number);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>User Profile</h2>
    <p>Welcome, <?php echo htmlspecialchars($name); ?>!</p>

    <h3>Your Details</h3>
    <form method="POST" action="update_profile.php">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" name="mobile_number" value="<?php echo htmlspecialchars($mobile_number); ?>" required><br>

        <label for="year">Year:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year); ?>"><br>

        <label for="department">Department:</label>
        <input type="text" name="department" value="<?php echo htmlspecialchars($department); ?>"><br>

        <label for="section">Section:</label>
        <input type="text" name="section" value="<?php echo htmlspecialchars($section); ?>"><br>

        <label for="roll_number">Roll Number:</label>
        <input type="text" name="roll_number" value="<?php echo htmlspecialchars($roll_number); ?>"><br>

        <button type="submit">Update Profile</button>
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
