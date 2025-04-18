<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us | MediGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Keeping styles consistent with index.php */
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

    .about-section {
      padding: 40px 60px;
    }
    .about-section h1 {
      font-size: 32px;
      color: #004080;
      margin-bottom: 20px;
    }
    .about-section h2 {
      font-size: 24px;
      color: #004080;
      margin-top: 30px;
      margin-bottom: 15px;
    }
    .about-section p {
      font-size: 16px;
      color: #333;
      line-height: 1.6;
    }
    .about-section ul {
      margin-top: 10px;
      padding-left: 20px;
    }
    .about-section ul li {
      margin-bottom: 8px;
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
  </style>
</head>
<body>

<div class="sidebar hidden" id="sidebar">
  <h2 onclick="toggleSidebar()">Menu</h2>
  <a href="index.php">Home</a>
  <a href="catalogue.php">Catalogue</a>
  <a href="upload-prescription.php">Upload Prescription</a>
  <a href="consultation.php">Online Consultation</a>
  <a href="contact.php">Contact</a>
  <a href="about.php">About Us</a>
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

  <div class="about-section">
    <h1>About MediGo</h1>
    <p><strong>MediGo</strong> is your reliable online destination for prescription medicines, wellness products, and everyday health essentials. While we may not be the first in the game, we’re here to make your experience better, easier, and more personal.</p>

    <h2>What We Do</h2>
    <p>At MediGo, we combine the ease of online shopping with the care of your neighborhood pharmacy. Whether you're managing chronic meds, looking for health supplements, or uploading a prescription — we make it smooth and stress-free.</p>
    <ul>
      <li>📦 Order medicines & OTC products from home</li>
      <li>📤 Upload prescriptions quickly & securely</li>
      <li>🔍 Discover curated health & wellness items</li>
      <li>🚚 Get reliable doorstep delivery</li>
      <li>💬 Get help from real humans when you need it</li>
    </ul>

    <h2>Our Mission</h2>
    <p>To make access to medicines and healthcare essentials simple, safe, and stress-free — for everyone, everywhere.</p>

    <h2>Why MediGo?</h2>
    <ul>
      <li>✅ Authentic medicines from trusted suppliers</li>
      <li>📲 Easy-to-use platform with fast checkouts</li>
      <li>🔐 100% secure prescription uploads & privacy</li>
      <li>🛒 Wide range of wellness & daily care products</li>
      <li>🤝 Consistent, reliable delivery every time</li>
      <li>💡 Real support when you need guidance or info</li>
    </ul>

    <h2>The MediGo Team</h2>
    <p>We’re a group of passionate pharmacists, developers, designers, and support staff working behind the scenes to ensure you get the healthcare support you deserve, when you need it most.</p>
  </div>

</div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
  }
</script>

</body>
</html>

