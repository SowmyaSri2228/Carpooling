<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h2>Welcome, <?php echo $user['name']; ?></h2>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Department: <?php echo $user['department']; ?></p>
    <p>Year: <?php echo $user['year']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
