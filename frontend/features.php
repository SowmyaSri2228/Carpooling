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
    background-color:#ffffff;
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

  .footer-baclground-text{
    position:absolute;
    top:50%;
    left:100%;
    font-size:150px;
    font-weight:bold;
    color:rgba(255,255,255,0.6);
    white-space:nowrap;
    }
.container{
  width:100%;
  overflow:hidden;
  background-color:rgba(237,227,228,0.8);
  padding:20px;
  justify-content:flex-start;
}
.features{
 display:flex;
 flex-wrap:wrap;
 gap:20px;
 justify-content:space-around;
 margin-top:20px;
}
.feature {
            background-color: #797777;
            color: white;
            padding: 20px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            overflow:hidden;
            white-space:normal;
            margin-bottom:20px;
        }

        .feature:hover {
            transform: scale(1.05); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @keyframes scroll {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
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
                <li><a href="takeride.php">BookRide</a></li>
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
       <h1 style="text-align:center;margin-top:20px;color:#007BFF;">Our features</h1>
        <div class="features">
         <div class="feature">
           <h3>Ride posting and ride searching</h3>
            <p> Easily post your available rides and search for rides from other users.Save time and connect with others who share similar routes</p>
             </h3>
          </div>
        <div class="feature">
           <h3>Allows multiple users</h3>
            <p>Whehter you are riding a car,van or bike our platform allows you to post rides with multiple vehicle types to soute your needs.</p> 

          </div>
         <div class="feature">
           <h3>GPS Integration</h3>
            <p>Our GPS Integration ensures accurate route navigation for drivers and passengers,providing real-time update status and arrival times.</p> 
          </div>
          <div class="feature">
           <h3>Google Maps Integration</h3>
            <p>Google Maps directly within the platform for route planning,real-time tracking,and detailed location info.</p> 
          </div>
          <div class="feature">
           <h3>User reviews</h3>
            <p>Read and leave reviews to help others make informed decisions about rides and drivers.Build trust and community.</p> 
          </div>
          <div class="feature">
           <h3>Emergency numbers</h3>
            <p>In case of emergency,easily access local emergency contact numbers directly from the app for immediate assistance.</p> 
          </div>
         <div class="feature">
           <h3>Filtering Rides</h3>
            <p>Filter rides by route,time, and vehicle type to find the perfect match for your travel needs,ensuring a convenient experience every time.</p> 
          </div>
          <div class="feature">
           <h3>Ride availability</h3>
            <p>Check the availability of rides in real-time,and ensure that your preferred ride option is available when you need it most.</p> 
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



