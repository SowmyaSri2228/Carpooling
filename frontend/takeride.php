<?php
session_start(); // Start session

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool Service</title>
    <link rel="stylesheet" href="takeride.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDVROE0bO7yMSpAB9ARPvZG0lrUOCWRMA&libraries=places&callback=initMap" 
            async 
            defer
            onerror="mapError()"></script>
    <script>
        function mapError() {
            alert('Failed to load Google Maps. Please check your internet connection and try again.');
        }
    </script>
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
    <div class="container">
        <h1>Find Your Ride</h1>
        <div class="booking-form">
            <form id="rideForm">
                <div class="form-group">
                    <label for="pickup">Pickup Location:</label>
                    <input type="text" id="pickup" required>
                </div>
                
                <div class="form-group">
                    <label for="destination">Destination:</label>
                    <input type="text" id="destination" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" required>
                </div>

                <div class="form-group">
                    <label for="passengers">Number of Passengers:</label>
                    <input type="number" id="passengers" min="1" max="10" required>
                </div>

                <div class="form-group">
                    <label>Preferred Vehicle Type:</label>
                    <div class="vehicle-options">
                        <label class="vehicle-option">
                            <input type="radio" name="vehicleType" value="any" checked>
                            <span>Any</span>
                        </label>
                        <label class="vehicle-option">
                            <input type="radio" name="vehicleType" value="car">
                            <span>Car Only</span>
                        </label>
                        <label class="vehicle-option">
                            <input type="radio" name="vehicleType" value="bike">
                            <span>Bike Only</span>
                        </label>
                    </div>
                </div>

                <button type="submit">Find Rides</button>
            </form>
        </div>

        <div id="bookingDetails" class="booking-details" style="display: none;">
            <h2>Booking Details</h2>
            <div class="details-content">
                <!-- Will be populated by JavaScript -->
            </div>
        </div>

        <div id="map"></div>

        <div id="results" class="results-container">
            <h2>Available Rides</h2>
            <div class="transport-options">
            </div>
        </div>
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
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.htmlt">Contact</a></li>
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

    <script src="takeride.js"></script>
</body>
</html>