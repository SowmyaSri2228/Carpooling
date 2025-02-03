<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carpooling Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    footer {
      color: #fff;
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

  </style>
</head>
<body>

  <footer>
    <div class="footer-container">
      
      <div class="footer-logo">
        <h3>Carpool Connect</h3>
        <p>Drive together, save time and reduce emissions.</p>
      </div>

      <div class="footer-links">
        <div>
          <h4>Quick Links</h4>
          <ul>
            <li><a href="/home">Home</a></li>
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
    </div>
  </footer>

</body>
</html>
