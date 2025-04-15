<?php
session_start();
$status = $_SESSION['contact_status'] ?? null;
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['contact_status'], $_SESSION['form_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - MediGo</title>
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

    .contact-section {
      padding: 60px;
      background-color: #e6f0ff;
      flex-grow: 1;
    }

    .contact-container {
      background: #fff;
      max-width: 600px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .contact-container h2 {
      font-size: 28px;
      color: #004080;
      margin-bottom: 20px;
      text-align: center;
    }

    .contact-container input,
    .contact-container textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      font-family: inherit;
    }

    .contact-container button {
      background-color: #4d94ff;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
    }

    .contact-container button:hover {
      background-color: #3a7dd8;
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

    /* NEW ALERT STYLES */
    .success-alert {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #4CAF50;
      color: white;
      padding: 12px 24px;
      border-radius: 4px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      z-index: 1000;
      animation: fadeInOut 3s ease-in-out;
      opacity: 0;
    }
    @keyframes fadeInOut {
      0% { opacity: 0; top: 10px; }
      10% { opacity: 1; top: 20px; }
      90% { opacity: 1; top: 20px; }
      100% { opacity: 0; top: 10px; }
    }

    @media (max-width: 768px) {
      .contact-section {
        padding: 30px;
      }
      .success-alert {
        width: 90%;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <!-- Success Alert (added) -->
  <?php if ($status && $status['type'] === 'success'): ?>
  <div class="success-alert" id="successAlert">
    Message sent successfully!
  </div>
  <script>
    setTimeout(() => {
      const alert = document.getElementById('successAlert');
      if (alert) alert.remove();
    }, 3000);
  </script>
  <?php endif; ?>

  <div class="sidebar hidden" id="sidebar">
    <h2 onclick="toggleSidebar()">Menu</h2>
    <a href="about.php">About Us</a>
    <a href="index.php">Home</a>
    <a href="catalogue.php">Catalogue</a>
    <a href="upload-prescription.php">Upload Prescription</a>
    <a href="consultation.php">Online Consultation</a>
    <a href="contact.php">Contact</a>
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

    <div class="contact-section">
      <div class="contact-container">
        <h2>Contact Us</h2>
        <form action="contact_handler.php" method="POST">
          <input type="text" name="name" placeholder="Your Name" required
                 value="<?= htmlspecialchars($form_data['name'] ?? '') ?>">
          <input type="email" name="email" placeholder="Your Email" required
                 value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">
          <textarea name="message" rows="6" placeholder="Your Message" required><?= 
              htmlspecialchars($form_data['message'] ?? '') 
          ?></textarea>
          <button type="submit">Send Message</button>
        </form>
      </div>
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
