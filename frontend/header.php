<?php
session_start();
ob_start(); // Start output buffering
$isLoggedIn = isset($_SESSION['user_id']);
?>
<header>
    <div class="logo">
        <img src="/images/logo.png" width="250" alt="icon">
    </div>
    <div class="navigation">
        <nav id="navigation-for-links">
            <ul class="links">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/howitworks.html">How-it-works</a></li>
                <li><a href="/features.html">Features</a></li>
                <li><a href="/about.html">About</a></li>
                <li><a href="/cars.html">BookRide</a></li>
                <li><a href="/offerride.html">OfferRide</a></li>
            </ul>
        </nav>
    </div>
    <div class="user-account">
        <?php if ($isLoggedIn): ?>
            <a href="/profile.php">User Profile</a>
            <a href="/logout.php">Logout</a> 
        <?php else: ?>
            <a href="/signin.html">Sign In</a>
        <?php endif; ?>
        <img src="https://cdn-thumbs.imagevenue.com/db/66/38/ME19YZ3O_t.png" alt="CARLOGO.png"/>
    </div>
</header>
<?php ob_end_flush(); // Flush the output buffer ?>
