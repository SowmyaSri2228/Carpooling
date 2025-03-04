<?php
session_start(); // Start session

$isLoggedIn = isset($_SESSION['user_id']);

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

// Fetch rides offered by the user
$rides_offered = [];
$stmt = $conn->prepare("SELECT id, start_location, end_location, ride_date FROM rides WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $rides_offered[] = $row;
}
$stmt->close();

// Fetch rides taken by the user
$rides_taken = [];
$stmt = $conn->prepare("SELECT r.id, r.start_location, r.end_location, r.ride_date FROM rides r JOIN bookings b ON r.id = b.ride_id WHERE b.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $rides_taken[] = $row;
}
$stmt->close();

// Fetch user reviews
$user_reviews = [];
$stmt = $conn->prepare("SELECT reviewer_name, review_text, rating FROM reviews WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $user_reviews[] = $row;
}
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
    <div class="navigation">
        <nav id="navigation-for-links">
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="howitworks.php">How-it-works</a></li>
                <li><a href="features.php">Features</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="takeride.html">BookRide</a></li>
                <li><a href="offerride.php">OfferRide</a></li>
            </ul>
        </nav>
    </div>
    <div class="user-account">
        <?php if($isLoggedIn): ?>
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

        <div class="rides-section">
            <h3>Rides Offered</h3>
            <?php if (count($rides_offered) > 0): ?>
                <ul>
                    <?php foreach ($rides_offered as $ride): ?>
                        <li>
                            <strong>From:</strong> <?php echo htmlspecialchars($ride['start_location']); ?> <br>
                            <strong>To:</strong> <?php echo htmlspecialchars($ride['end_location']); ?> <br>
                            <strong>Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No rides offered yet.</p>
            <?php endif; ?>
        </div>

        <div class="rides-section">
            <h3>Rides Taken</h3>
            <?php if (count($rides_taken) > 0): ?>
                <ul>
                    <?php foreach ($rides_taken as $ride): ?>
                        <li>
                            <strong>From:</strong> <?php echo htmlspecialchars($ride['start_location']); ?> <br>
                            <strong>To:</strong> <?php echo htmlspecialchars($ride['end_location']); ?> <br>
                            <strong>Date:</strong> <?php echo htmlspecialchars($ride['ride_date']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No rides taken yet.</p>
            <?php endif; ?>
        </div>

        <div class="reviews-section">
            <h3>User Reviews</h3>
            <?php if (count($user_reviews) > 0): ?>
                <ul>
                    <?php foreach ($user_reviews as $review): ?>
                        <li>
                            <strong>Reviewer:</strong> <?php echo htmlspecialchars($review['reviewer_name']); ?> <br>
                            <strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?> <br>
                            <strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
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
