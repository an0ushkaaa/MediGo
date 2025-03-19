<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - MediGo</title>
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e6f2ff; 
}


header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #004080; 
    color: white;
}
header .logo {
    font-size: 24px;
    font-weight: bold;
}


nav {
    display: flex;
    gap: 15px;
}
nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
nav a:hover {
    text-decoration: underline;
}


.contact-form {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background: #cce5ff; 
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.contact-form h2 {
    text-align: center;
}
.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #004080;
    border-radius: 5px;
}
.contact-form button {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background: #004080; 
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}
.contact-form button:hover {
    background: #002a5c; 
}


footer {
    text-align: center;
    padding: 10px;
    background-color: #004080; 
    color: white;
    margin-top: 20px;
}
</style>
</head>
<body>

<header>
    <div class="logo">MediGo</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="upload-prescription.php">Upload Prescription</a>
        <a href="contact.php">Contact</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'User'; ?></span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="sign-in.html">Login</a>
            <a href="sign-up.html">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

<div class="contact-form">
    <h2>Contact Us</h2>
    <form action="contact-handler.php" method="post">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    <p>&copy; 2025 MediGo. All Rights Reserved.</p>
</footer>

</body>
</html>
