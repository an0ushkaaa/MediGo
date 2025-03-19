<?php
session_start();

$products = [
    1 => ["name" => "Paracetamol", "price" => 41, "image" => "https://assets.sayacare.in/api/images/product_image/large_image/23/74/paracetamol-500-mg-10-tablet-23_1.webp"],
    2 => ["name" => "Aspirin", "price" => 58, "image" => "https://5.imimg.com/data5/SELLER/Default/2023/7/330506870/UM/GZ/QO/135658020/aspirin-dispersible-tablets.jpg"],
    3 => ["name" => "Amoxicillin", "price" => 83, "image" => "https://5.imimg.com/data5/SELLER/Default/2024/8/443996733/EP/HM/IX/85825727/product-jpeg-8.jpg"],
    4 => ["name" => "Ibuprofen", "price" => 66, "image" => "https://5.imimg.com/data5/SELLER/Default/2023/7/325863554/WI/JM/SY/135658020/ibuprofen-tablets-ip-200-mg-.jpg"],
    5 => ["name" => "Cetirizine", "price" => 49, "image" => "https://tiimg.tistatic.com/fp/1/007/645/cetirizine-tablets-317.jpg"],
    6 => ["name" => "Cough Syrup", "price" => 74, "image" => "https://5.imimg.com/data5/SELLER/Default/2023/3/296746171/EF/DH/BK/158493658/cough-expectorant-syrup.jpg"],
    7 => ["name" => "Vitamin C", "price" => 99, "image" => "https://5.imimg.com/data5/SELLER/Default/2022/11/EH/JE/NW/122957552/vitamin-c-chewable-limcee-tablet-500mg-500x500.jpg"],
    8 => ["name" => "Antiseptic Cream", "price" => 33, "image" => "https://himalayawellness.in/cdn/shop/products/antiseptic-cream.jpg?v=1622099573"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
        }
        h2 {
            text-align: center;
        }
        .catalogue {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
            border-radius: 8px;
            height: 150px;
            object-fit: cover;
        }
        .product button {
            background-color: navy;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }
        .product button:hover {
            background-color: darkblue;
        }
        .nav-links {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav-links a {
            margin: 0 10px;
            text-decoration: none;
            color: navy;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Product Catalogue</h2>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="cart.php">View Cart</a>
    </div>
    <div class="catalogue">
        <?php foreach ($products as $id => $product): ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>₹<?php echo $product['price']; ?></p>
                <form action="cart_handler.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="add">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>