<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
?>

<html>
<head>
<title>AboutPage Of RidelLine</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<style>
body {
    font-family:Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#ffffff;
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

  
     .footer-container{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
  }
   
    #about-intro {
        background-color: rgba(200,200,200,0.5);
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    #about-intro h1 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 20px;
        color:#333;
    }

    #about-intro p {
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 40px;
        max-width: 800px;
        margin: 0 auto;
    }

 
    section {
        padding: 60px 20px;
        text-align: center;
    }

    section h2 {
        font-size: 30px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }

    section p {
        font-size: 18px;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    section ul {
        list-style: none;
        margin-top: 20px;
        padding: 0;
    }

    section ul li {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    section ul li strong {
        font-weight: 600;
    }
section {
    padding: 60px 20px;
    text-align: center;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

section:hover {
    transform: scale(1.05); 
    opacity: 0.9;  
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
<section id="about-intro">
        <div class="container">
            <h1>Welcome to RIDELINE</h1>
            <p>Connecting drivers and passengers for a more affordable, sustainable, and community-oriented way to commute.</p>
        </div>
    </section>

    <section id="mission">
        <div class="container">
            <h2>Our Mission</h2>
            <p>Our mission is to make commuting more affordable, sustainable, and efficient by connecting drivers with passengers to share rides. We aim to help people reduce the costs of travel, minimize traffic congestion, and lower their environmental footprint.</p>
        </div>
    </section>

    <section id="why-carpool">
        <div class="container">
            <h2>Why Carpooling?</h2>
            <p>Carpooling not only helps you save money on fuel and parking, but also plays a crucial role in reducing traffic congestion and lowering carbon emissions. It’s a win-win for your wallet and the planet!</p>
            <ul>
                <li>Save on fuel and parking costs</li>
                <li>Help reduce traffic and air pollution</li>
                <li>Promote a sense of community and shared responsibility</li>
                <li>Enjoy a more relaxed commute</li>
            </ul>
        </div>
    </section>
 <section id="our-values">
        <div class="container">
            <h2>Our Values</h2>
            <p>We are driven by a commitment to sustainability, affordability, and safety. Our goal is to create a trustworthy platform where riders and drivers can share a safe, convenient, and enjoyable experience.</p>
            <ul>
                <li><strong>Sustainability</strong> - Reducing our carbon footprint one ride at a time.</li>
                <li><strong>Community</strong> - Building a network of connected individuals who care about their impact.</li>
                <li><strong>Safety</strong> - Ensuring that all rides are secure through background checks and reviews.</li>
                <li><strong>Convenience</strong> - Making commuting simpler and more accessible for everyone.</li>
            </ul>
        </div>
    </section>
<section id="safety">
        <div class="container">
            <h2>Safety & Trust</h2>
            <p>We prioritize your safety and security on our platform. Our key safety features include:</p>
            <ul>
                <li>Background checks for drivers</li>
                <li>In-app messaging and real-time updates</li>
                <li>Ratings and reviews for drivers and passengers</li>
                <li>Insurance coverage for all rides</li>
            </ul>
        </div>
    </section>

    <section id="who-can-benefit">
        <div class="container">
            <h2>Who Can Benefit?</h2>
            <p>Our platform is perfect for anyone who needs an affordable and eco-friendly way to commute:</p>
            <ul>
                <li>Commuters looking to save on transportation costs</li>
                <li>Students trying to cut down on travel expenses</li>
                <li>People who want to reduce their environmental impact</li>
                <li>Anyone looking for a more social and enjoyable ride</li>
            </ul>
        </div>
    </section>

   


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
