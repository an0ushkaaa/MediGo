<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediGo - Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
        }
        .topbar {
            background-color: #ffffff;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .topbar h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: navy;
        }
        .topbar .auth-links a {
            text-decoration: none;
            color: navy;
            margin-left: 16px;
            font-weight: 500;
        }
        .container {
            display: flex;
            height: calc(100vh - 60px);
        }
        .sidebar {
            width: 220px;
            background-color: #ffffff;
            padding: 24px 16px;
            box-shadow: 2px 0 6px rgba(0,0,0,0.05);
        }
        .sidebar a {
            display: block;
            color: #333;
            text-decoration: none;
            margin-bottom: 16px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: navy;
            color: white;
        }
        .main {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .cart-box {
            background-color: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            max-width: 700px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item span {
            font-size: 16px;
        }
        .cart-item button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }
        .cart-item button:hover {
            background-color: #c0392b;
        }
        .checkout-btn {
            background-color: navy;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 500;
        }
        .checkout-btn:hover {
            background-color: #001f4d;
        }
        .empty-cart {
            color: #777;
            font-size: 18px;
            padding: 20px 0;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
            font-size: 18px;
            color: #222;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <h1>MediGo</h1>
        <div class="auth-links">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="index.php">Home</a>
            <a href="catalogue.php">Catalogue</a>
            <a href="upload.php">Upload Prescription</a>
            <a href="consultation.php">Online Consultation</a>
            <a href="cart.php" class="active">Cart</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="main">
            <h2>Your Cart</h2>
            <div class="cart-box">
                <?php if (empty($cart)): ?>
                    <p class="empty-cart">Your cart is empty.</p>
                <?php else: ?>
                    <?php
                        $total = 0;
                        foreach ($cart as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                    ?>
                    <?php foreach ($cart as $id => $item): ?>
                        <div class="cart-item">
                            <span><?php echo $item['name']; ?> - ₹<?php echo $item['price']; ?> × <?php echo $item['quantity']; ?></span>
                            <form action="cart_handler.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="action" value="remove">
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                    <p class="total">Total: ₹<?php echo $total; ?></p>
                    <form action="checkout.php" method="post">
                        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
