<?php
session_start(); // Start session

$isLoggedIn = isset($_SESSION['user_id']);
?>

<html>
<head>
<title>Feauters Page of RideLine</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<style>
body {
    font-family:Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#e2dede;
    box-sizing:border-box;
}
*,*:before,*:after{
box-sizing:inherit;
}
header {
    background:rgb(38,38,38);
    color:rgb(38,38,38);
    position: sticky;
    padding: 10px 20px;
    z-index:500;
    display: flex;
    align-items: center;
    justify-content: space-between;
   
}

.logo a {
    font-size: 20px;
    color: white;
    text-decoration: none;
    font-weight: bold;
  
}


.navigation {
    display:flex;
    gap: 20px;
}
.links {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
}
.links li a {
    color:rgb(187,187,187);
    text-decoration: none;
    font-size: 15px;
   
}
.links li a:hover {
    color:rgb(255,255,255);
   
}
.logged-in .links {
    display: flex !important;
}


.user-account {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-account a {
    display: inline-block;
    padding: 10px 15px;
    background-color: #007bff; 
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.user-account a:hover {
    background-color: #0056b3;
}

.logout-btn {
    background-color: #94bad3;
    margin-left: 10px;
}

.logout-btn:hover {
    background-color: #a71d2a;
}
    footer {
      color:rgb(255,255,255);
      padding: 30px 0;
      background-image: url('https://wallpapercave.com/w/wp11325348.jpg'); 
      background-size: cover;
      background-position: center;
      
      
    }
    .footer-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
    .footer-logo h3 {
      font-size: 24px;
      margin: 0;
    }
    .footer-logo p {
      font-size: 14px;
      color: #bbb;
    }
    .footer-links {
      display: flex;
      gap: 40px;
    }
    .footer-links div {
      font-size: 14px;
    }
    .footer-links h4 {
      font-size: 18px;
      color: #fff;
      margin-bottom: 10px;
    }
    .footer-links ul {
      list-style-type: none;
      padding: 0;
    }
    .footer-links a {
      color: #bbb;
      text-decoration: none;
      display: block;
      margin: 5px 0;
    }
    .footer-links a:hover {
      color: #fff;
    }
    .footer-social {
      display: flex;
      gap: 20px;
    }
    .footer-social a {
      color: #bbb;
      text-decoration: none;
    }
    .footer-social img {
      width: 30px;
      height: 30px;
    }
    .footer-social a:hover img {
      opacity: 0.8;
    }

    .twitter-icon-wrapper {
      background-color: white;
      border-radius: 50%; 
      padding: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .twitter-icon-wrapper img {
      width: 20px;
      height: 20px;
    }

   .user-account img{
     height:90px;
     width:90px;
     border-radius:50%;
    }

.offer-ride-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.offer-ride-container h1 {
    text-align: center;
    color: #007BFF;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}

.form-group textarea {
    resize: vertical;
    height: 100px;
}

.btn {
    background-color: #007BFF;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

#route-map {
    margin-top: 10px;
}

</style>
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
 <div class="offer-ride-container">
    <h1>Offer a Ride</h1>
    <form id="offer-ride-form" action="save_ride.php" method="POST">

        <!-- Vehicle Details -->
        <div class="form-group">
            <label for="vehicle-type">Vehicle Type</label>
            <select id="vehicle-type" name="vehicle-type" required>
                <option value="">Select Vehicle Type</option>
                <option value="car">Car</option>
                <option value="bike">Bike</option>
                <option value="suv">SUV</option>
                <option value="van">Van</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vehicle-number">Vehicle Number</label>
            <input type="text" id="vehicle-number" name="vehicle-number" placeholder="Enter Vehicle Number" required>
        </div>

        <!-- Location Details -->
        <div class="form-group">
            <label for="from-location">From Location</label>
            <input type="text" id="from-location" name="from-location" placeholder="Enter Starting Point" required>
        </div>

        <div class="form-group">
            <label for="to-location">To Location</label>
            <input type="text" id="to-location" name="to-location" placeholder="Enter Destination" required>
        </div>

        <!-- Route Map -->
        <div class="form-group">
            <label>Route Map</label>
            <div id="route-map" style="height: 200px; background-color: #f0f0f0; border-radius: 8px;"></div>
        </div>

        <!-- Date and Time -->
        <div class="form-group">
            <label for="ride-date">Date</label>
            <input type="date" id="ride-date" name="ride-date" required>
        </div>

        <div class="form-group">
            <label for="ride-time">Time</label>
            <input type="time" id="ride-time" name="ride-time" required>
        </div>

        <!-- Passenger and Cost Details -->
        <div class="form-group">
            <label for="passengers">Number of Passengers</label>
            <input type="number" id="passengers" name="passengers" min="1" max="10" placeholder="Enter Number of Passengers" required>
        </div>

        <div class="form-group">
            <label for="cost-per-passenger">Cost per Passenger (₹)</label>
            <input type="number" id="cost-per-passenger" name="cost-per-passenger" min="0" placeholder="Enter Cost per Passenger" required>
        </div>

        <!-- Additional Features -->
        <div class="form-group">
            <label for="additional-info">Additional Information</label>
            <textarea id="additional-info" name="additional-info" placeholder="Any additional details (e.g., luggage space, preferences)"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn">Submit Ride Details</button>
        </div>
    </form>
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



