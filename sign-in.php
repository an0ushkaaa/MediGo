<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In - MediGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f5f9fc;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .auth-container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    h1 {
      color: #0077cc;
      margin-bottom: 10px;
    }
    h2 {
      margin-bottom: 20px;
      font-weight: 600;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 16px;
    }
    button {
      background-color: #0077cc;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #005fa3;
    }
    p {
      margin-top: 15px;
      font-size: 14px;
    }
    a {
      color: #0077cc;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <h1>MediGo</h1>
    <h2>Sign In</h2>
    <?php if (isset($_GET['error'])): ?>
      <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <p style="color: green;">Successfully registered. Please log in.</p>
    <?php endif; ?>
    <form action="sign-in-handler.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
  </div>
</body>
</html>


