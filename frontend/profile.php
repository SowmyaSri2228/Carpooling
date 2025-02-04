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

// Establish database connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT mobile_number, name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($mobile_number, $name, $email);
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
    <link rel="stylesheet" href="profile.css"> 
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/logo.png" width="250" alt="icon">
        </div>
        <nav class="navigation">
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="howitworks.php">How-it-works</a></li>
                <li><a href="features.php">Features</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="../cars.html">BookRide</a></li>
                <li><a href="offerride.php">OfferRide</a></li>
            </ul>
        </nav>
        <div class="user-account">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="profile.php">User Profile</a>
                <a href="logout.php">Logout</a> 
            <?php else: ?>
                <a href="signin.html">Sign In</a>
            <?php endif; ?>
            <img src="https://cdn-thumbs.imagevenue.com/db/66/38/ME19YZ3O_t.png" alt="CARLOGO.png"/>
        </div>
    </header>

    <div class="profile-container">
        <h2>User Profile</h2>
        <p>Welcome, <strong><?php echo htmlspecialchars($name); ?></strong>!</p>

        <div class="profile-details">
            <label>Name:</label>
            <p><?php echo htmlspecialchars($name); ?></p>

            <label>Email:</label>
            <p><?php echo htmlspecialchars($email); ?></p>

            <label>Mobile Number:</label>
            <p><?php echo htmlspecialchars($mobile_number); ?></p>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <h3>RIDETIME</h3>
                <p>Drive together, save time and reduce emissions.</p>
            </div>
            <div class="footer-links">
                <div>
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="terms.html">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/help">Help Center</a></li>
                        <li><a href="/privacy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-social">
                <a href="https://facebook.com" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                </a>
                <a href="https://twitter.com" target="_blank">
                    <div class="twitter-icon-wrapper">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/X_logo_2023.svg" alt="Twitter">
                    </div>
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram">
                </a>
                <a href="https://linkedin.com" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/LinkedIn_icon.svg" alt="LinkedIn">
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
