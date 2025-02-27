<?php
session_start(); // Start session

$isLoggedIn = isset($_SESSION['user_id']);
?>

<html>
<head>
<title>How-it-works Page Of Carpooling</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<style>
body {
    font-family:Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#ffffff;
    min-height:100vh;
    
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
  .how-it-works{
    padding:20px 20px;
    text-align:center;
    display: flex;
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
    flex: 1;
   }
  .how-it-works h1{
   font-size:36px;
   color:#007BFF;
   margin-bottom:20px;
   background-color:#f7f7f7;
   animation:scroll 15s linear infinite;  
  }
  @keyframes scroll {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
  .steps-containter{
    display:flex;
    justify-content:space-around;
    flex-wrap:wrap;
    gap:40px;
    margin-top:30px;
    align-items:center;
     
  }
 .step{
   background-color:#f5f5f5;
   padding:20px;
   border-radius:8px;
   box-shadow:0 4px 6px rgba(0,0,0,0.1);
   width:300px;
   transition:transform 0.3s ease,box-shadow 0.3s;
   margin:20px;
   
  
  }
 .step:hover{
    transform:scale(1.1);
    box-shadow:0 6px 10px rgba(0,0,0,0.2);
 }
.step p{
   font-size:16px;
   color:#666;
 }
.step h2{
   font-size:24px;
   color:#007BFF;
   margin-bottom:15px;
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

   
     <section class="how-it-works">
       <h1>How it works</h1>
        <div class="step-container">
         <div class="step">
          <h2>Step1:Sign Up</h2>
           <p>Create an account with RIDELINE to start using our services.It's quick and easy!</p>
          </div>
           <div class="step">
                <h2>Step 2: Choose Your Role</h2>
                <p>Decide whether you want to offer a ride or take a ride. Select the option that suits you best.</p>
            </div>
            <div class="step">
                <h2>Step 3: Post or Search</h2>
                <p>If you're offering a ride, post your ride details. If you're taking a ride, search for available rides.</p>
            </div>
            <div class="step">
                <h2>Step 4: Confirm & Ride</h2>
                <p>Once you find a match, confirm the ride and enjoy your journey with RIDELINE!</p>
            </div>
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
    
</body>
</html>



