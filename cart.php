<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .cart-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item button {
            background-color: #c57171;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .cart-item button:hover {
            background-color: #a14f4f;
        }
        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .checkout-btn:hover {
            background-color: #45a049;
        }
        .empty-cart {
            color: #777;
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-bottom: 10px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <a href="catalogue.php">&#8592; Back to Catalogue</a>
        
        <?php if (empty($cart)): ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php else: ?>
            <?php foreach ($cart as $id => $item): ?>
                <div class="cart-item">
                    <span><?php echo $item['name']; ?> - ₹<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?></span>
                    <form action="cart_handler.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <form action="checkout.php" method="post">
                <button type="submit" class="checkout-btn">Proceed to Checkout</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

