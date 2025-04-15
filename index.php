<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MediGo - Your Health, Delivered</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fdfdfd;
      display: flex;
      min-height: 100vh;
    }

    /* NOTIFICATION STYLES */
    #notification-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
      max-width: 350px;
    }
    .notification {
      padding: 16px;
      margin-bottom: 15px;
      color: white;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      animation: slideIn 0.5s, fadeOut 0.5s 4.5s forwards;
    }
    .notification.success {
      background-color: #4CAF50;
    }
    .notification.error {
      background-color: #f44336;
    }
    .close-btn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    @keyframes slideIn {
      from {transform: translateX(100%);}
      to {transform: translateX(0);}
    }
    @keyframes fadeOut {
      from {opacity: 1;}
      to {opacity: 0;}
    }

    .sidebar {
      width: 200px;
      background-color: #f2f2f2;
      padding: 20px;
      border-right: 1px solid #ddd;
      transition: transform 0.3s ease;
    }
    .sidebar.hidden {
      transform: translateX(-100%);
      position: absolute;
      z-index: 10;
    }
    .sidebar h2 {
      margin-bottom: 20px;
      font-size: 22px;
      cursor: pointer;
    }
    .sidebar a {
      display: block;
      margin: 10px 0;
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      border-bottom: 1px solid #ddd;
      background-color: #fff;
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      text-decoration: none;
    }
    .logo img {
      height: 30px;
    }
    .logo span {
      font-size: 24px;
      font-weight: 600;
      color: #004080;
    }
    .topnav-links {
      display: flex;
      align-items: center;
    }
    .topnav-links a {
      margin-left: 20px;
      text-decoration: none;
      color: #004080;
      font-weight: bold;
    }
    .topnav-links button {
      margin-left: 20px;
      padding: 5px 10px;
      border: none;
      background-color: #004080;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }

    .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 40px 60px;
      background-color: #e6f0ff;
      flex-wrap: wrap;
    }
    .hero-text {
      max-width: 50%;
    }
    .hero-text h1 {
      font-size: 36px;
      margin-bottom: 15px;
    }
    .hero-text p {
      font-size: 18px;
      margin-bottom: 25px;
      color: #444;
    }
    .hero-text .cta {
      display: flex;
      gap: 15px;
    }
    .hero-text .cta a {
      background-color: #4d94ff;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    .hero-img img {
      max-width: 300px;
      height: auto;
    }

    .services {
      padding: 40px 60px;
    }
    .services h2 {
      font-size: 28px;
      margin-bottom: 30px;
    }
    .service-items {
      display: flex;
      gap: 40px;
      flex-wrap: wrap;
    }
    .service {
      flex: 1;
      text-align: center;
      min-width: 200px;
    }
    .service img {
      width: 80px;
      height: 80px;
      margin-bottom: 10px;
    }
    .service p {
      margin-top: 10px;
      font-weight: bold;
    }

    #menuToggle {
      background-color: #004080;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
      margin-right: 15px;
    }

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
      }
      .hero-text {
        max-width: 100%;
        text-align: center;
      }
      .hero-img {
        margin-top: 20px;
      }
      #notification-container {
        left: 20px;
        right: 20px;
        max-width: none;
      }
    }
  </style>
</head>
<body>

  <!-- Notification Container -->
  <div id="notification-container">
    <?php if (isset($_SESSION['order_success'])): ?>
    <div class="notification success" id="order-notification">
      <div style="display: flex; align-items: center;">
        <span style="margin-right: 10px; font-size: 1.2em;">✓</span>
        <div>
          <strong>Order Confirmed!</strong><br>
          #<?= $_SESSION['order_success']['order_id'] ?> • ₹<?= $_SESSION['order_success']['total'] ?>
        </div>
      </div>
      <span class="close-btn" onclick="dismissNotification()">×</span>
    </div>
    <?php unset($_SESSION['order_success']); endif; ?>
  </div>

  <div class="sidebar hidden" id="sidebar">
    <h2 onclick="toggleSidebar()">Menu</h2>
    <a href="about.php">About Us</a>
    <a href="index.php">Home</a>
    <a href="catalogue.php">Catalogue</a>
    <a href="upload-prescription.php">Upload Prescription</a>
    <a href="consultation.php">Online Consultation</a>
    <a href="contact.php">Contact us</a>
  </div>

  <div class="main-content">

    <div class="topbar">
      <div style="display: flex; align-items: center;">
        <button id="menuToggle" onclick="toggleSidebar()">☰</button>
        <div onclick="window.location.href='index.php'" class="logo">
          <img src="https://cdn-icons-png.flaticon.com/512/9013/9013270.png" alt="MediGo Logo">
          <span>MediGo</span>
        </div>
      </div>
      <div class="topnav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span>Hello, <?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?></span>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="sign-in.php">Login</a>
          <a href="sign-up.php">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="hero">
      <div class="hero-text">
        <h1>Your Health, Delivered</h1>
        <p>Bringing quality healthcare to your doorstep with ease and care.</p>
        <div class="cta">
          <a href="upload-prescription.php">Upload Prescription</a>
          <a href="catalogue.php">View Catalogue</a>
        </div>
      </div>
      <div class="hero-img">
        <img src="https://cdn-icons-png.flaticon.com/512/4207/4207231.png" alt="Doctor Illustration">
      </div>
    </div>

    <div class="services">
      <h2>Our Services</h2>
      <div class="service-items">
        <div class="service">
          <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png" alt="Prescription Delivery">
          <p>Prescription Delivery</p>
        </div>
        <div class="service">
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Online Consultation">
          <p>Online Consultation</p>
        </div>
        <div class="service">
          <img src="https://cdn-icons-png.flaticon.com/512/2947/2947909.png" alt="Health Products">
          <p>Health Products</p>
        </div>
      </div>
    </div>

  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }

    // Notification functions
    function dismissNotification() {
      const notification = document.getElementById('order-notification');
      if (notification) notification.style.display = 'none';
    }

    // Auto-dismiss after 5 seconds
    setTimeout(() => {
      const notification = document.getElementById('order-notification');
      if (notification) notification.style.display = 'none';
    }, 5000);
  </script>
</body>
</html>