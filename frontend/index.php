
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>IndexPage Of RIDELINE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="https://raw.githubusercontent.com/SowmyaSri2228/Carpooling/Temporary/images/logo.png" width="250" alt="icon">
    </div>
    <div class="navigation">
        <nav id="navigation-for-links">
            <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="howitworks.html">How-it-works</a></li>
                <li><a href="features.php">Features</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="takearide.php">BookRide</a></li>
                <li><a href="offerride.php">OfferRide</a></li>
            </ul>
        </nav>
    </div>
    <div class="user-account">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="profile.php">User Profile</a>
        <?php else: ?>
            <a href="signin.html">Sign In</a>
        <?php endif; ?>
        <img src="https://cdn-thumbs.imagevenue.com/db/66/38/ME19YZ3O_t.png" alt="CARLOGO.png"/>
    </div>
</header>

<div  class="image-container">
    <div class="container">
        <div class="features">
            <div class="feature">Ride posting and ride searching</div>
            <div class="feature">Allows multiple vehicles</div>
            <div class="feature">GPS Integration</div>
            <div class="feature">Google Maps Integration</div>
            <div class="feature">User review</div>
            <div class="feature">Ride booking and ride scheduling</div>
            <div class="feature">Emergency numbers</div>
            <div class="feature">Filtering rides</div>
            <div class="feature">Ride availability</div>
        </div>
    </div>

    <div class="options-container">
        <div class="option-box">
            <h2>Take a Ride</h2>
            <p>Need a ride? Click below to book a ride.</p>
            <a href="ride.html" class="btn">Ride Option</a>
        </div>
        <div class="option-box">
            <h2>Offer a Ride</h2>
            <p>Have a ride to offer? Click below to offer a ride.</p>
            <a href="offer-ride.html" class="btn">Offer Ride Option</a>
        </div>
    </div>
 <section class="testimonials">
     <h2>Why choose RIDELINE?</h2> 
     <div class="testimonials-container">
        <div class="testimonial-card">
           
            <h3>Easy Ride Posting</h3>
            <p>"Post your ride details in seconds,set your route,time and preference effortlessly."</p>
        </div>
        <div class="testimonial-card">
           
            <h3>GPS Integration</h3>
            <p>"Our advanced GPS Integration ensures accurate routes and real-time updates for every ride."</p>
        </div>
        <div class="testimonial-card">
            
            <h3>Safe&Reliable</h3>
            <p>"With verified users and emergency support,your safety is our top priority."</p>
        </div>
    </div>
  </section>
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
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/terms">Terms & Conditions</a></li>
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
</footer>
</body>
</html>
