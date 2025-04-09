<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: sign-in.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Online Consultation - MediGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
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
    .topnav-links a, .topnav-links span {
      margin-left: 20px;
      text-decoration: none;
      color: #004080;
      font-weight: bold;
    }
    .container {
      padding: 40px 60px;
    }
    .container h1 {
      font-size: 32px;
      margin-bottom: 20px;
    }
    .container p {
      font-size: 16px;
      color: #555;
      margin-bottom: 30px;
    }
    form {
      max-width: 600px;
      background: #fff;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      background-color: #004080;
      color: white;
      border: none;
      padding: 12px 20px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
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

<div class="sidebar" id="sidebar">
  <h2 onclick="toggleSidebar()">Menu</h2>
  <a href="index.php">Home</a>
  <a href="catalogue.php">Catalogue</a>
  <a href="upload-prescription.php">Upload Prescription</a>
  <a href="online-consultation.php">Online Consultation</a>
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

  <div class="container">
    <h1>Book an Online Consultation</h1>
    <p>Connect with a qualified medical professional from the comfort of your home.</p>
    <form action="submit-consultation.php" method="POST">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Phone Number</label>
      <input type="text" id="phone" name="phone" required>
      <label for="doctor">Select Doctor</label>
      <select id="doctor" name="doctor" required>
      <option value="">-- Select --</option>
      <option value="Dr. Aditi Sharma">Dr. Aditi Sharma</option>
      <option value="Dr. Rajiv Menon">Dr. Rajiv Menon</option>
      <option value="Dr. Priya Verma">Dr. Priya Verma</option>
      </select>

      <label for="datetime">Preferred Date & Time</label>
      <input type="datetime-local" id="datetime" name="datetime" required>

      <label for="symptoms">Symptoms / Notes</label>
      <textarea id="symptoms" name="symptoms" rows="4" required></textarea>

      <button type="submit">Book Consultation</button>
    </form>
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
