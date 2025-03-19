<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediGo - Your Health, Delivered</title>
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


.home-page {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    justify-content: center;
}


.frame {
    flex: 1;
    min-width: 300px;
    background-color: #cce5ff; 
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.frame img {
    max-width: 100%;
    border-radius: 8px;
    margin-bottom: 10px;
    height: 200px;
    object-fit: cover;
}

/* Footer */
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

<div class="home-page">
    <div class="frame">
        <img src="https://img.freepik.com/free-photo/minimalistic-science-banner-with-pills_23-2149431123.jpg" alt="Medicine">
        <h2><a href="about.php">About Us</a></h2>
        <p>We provide top-quality medicines and healthcare products, delivered to your doorstep.</p>
    </div>
    <div class="frame">
        <img src="https://www.shutterstock.com/image-vector/stethoscope-heartbeat-flat-icons-medicine-260nw-1009269724.jpg" alt="Medicines">
        <h2><a href="services.php">Our Services</a></h2>
        <p>Explore our range of medical services, including prescription delivery and online consultations.</p>
    </div>
    <div class="frame">
        <img src="https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?w=500&auto=format&fit=crop" alt="Doctor">
        <h2><a href="contact.php">Contact Us</a></h2>
        <p>Have questions? Get in touch with our support team for assistance.</p>
    </div>
</div>

<footer>
    <p>&copy; 2025 MediGo. All Rights Reserved.</p>
</footer>

</body>
</html>
