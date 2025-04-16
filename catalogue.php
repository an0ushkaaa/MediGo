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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Catalogue - MediGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
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
      align-items: center;
      justify-content: space-between;
      padding: 15px 30px;
      border-bottom: 1px solid #ddd;
      background-color: #fff;
    }

    .top-left {
      display: flex;
      align-items: center;
      gap: 15px;
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
      gap: 15px;
    }

    .topnav-links a {
      text-decoration: none;
      color: #004080;
      font-weight: bold;
    }

    .topnav-links button {
      padding: 5px 10px;
      border: none;
      background-color: #004080;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }

    .catalogue-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 30px 60px 10px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .catalogue-header h2 {
      font-size: 28px;
      color: #004080;
    }

    .catalogue-header input {
      padding: 8px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .catalogue-header a {
      text-decoration: none;
      font-weight: bold;
      color: #004080;
      border: 1px solid #004080;
      padding: 6px 12px;
      border-radius: 6px;
    }

    .catalogue {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      padding: 20px 60px 40px;
      align-items: start;
    }

    .product {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }

    .product img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }

    .product h3 {
      margin: 10px 0 5px;
      font-size: 18px;
    }

    .product p {
      margin-bottom: 10px;
      color: #333;
      font-weight: bold;
    }

    .product button {
      background-color: #004080;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
    }

    .product button:hover {
      background-color: #003366;
    }

    #menuToggle {
      background-color: #004080;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="sidebar hidden" id="sidebar">
    <h2 onclick="toggleSidebar()">Menu</h2>
    <a href="index.php">Home</a>
    <a href="catalogue.php">Catalogue</a>
    <a href="upload-prescription.php">Upload Prescription</a>
    <a href="contact.php">Contact</a>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div class="top-left">
        <button id="menuToggle" onclick="toggleSidebar()">Menu</button>
        <div onclick="window.location.href='index.php'" class="logo">
          <img src="https://cdn-icons-png.flaticon.com/512/9013/9013270.png" alt="MediGo Logo">
          <span>MediGo</span>
        </div>
      </div>
      <div class="topnav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span><?php echo htmlspecialchars($_SESSION['name'] ?? $_SESSION['email'] ?? 'User'); ?></span>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="sign-in.html">Login</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="catalogue-header">
      <h2>Product Catalogue</h2>
      <input type="text" id="searchInput" placeholder="Search medicines...">
      <a href="cart.php">View Cart</a>
    </div>

    <div class="catalogue" id="productGrid">
      <?php foreach ($products as $id => $product): ?>
        <div class="product" data-name="<?php echo strtolower($product['name']); ?>">
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
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function () {
      const searchValue = this.value.toLowerCase();
      const products = document.querySelectorAll('.product');

      products.forEach(product => {
        const name = product.getAttribute('data-name');
        if (name.includes(searchValue)) {
          product.style.display = "flex";
        } else {
          product.style.display = "none";
        }
      });
    });
  </script>
</body>
</html>
