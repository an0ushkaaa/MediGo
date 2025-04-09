<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
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
</style>

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
