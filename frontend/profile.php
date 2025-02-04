<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the sign-in page if the user is not logged in
    header("Location: signin.php");
    exit();
}

// Retrieve user details from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <!-- Your header content here -->
    </header>

    <main>
        <h1>User Profile</h1>
        <div class="profile-details">
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>
        <a href="logout.php">Logout</a>
    </main>

    <footer>
        <!-- Your footer content here -->
    </footer>
</body>
</html>