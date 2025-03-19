<?php
session_start();


$products = [
    1 => ["name" => "Paracetamol", "price" => 5],
    2 => ["name" => "Aspirin", "price" => 7],
    3 => ["name" => "Amoxicillin", "price" => 10],
    4 => ["name" => "Ibuprofen", "price" => 8]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            if (isset($products[$product_id])) {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] += 1;
                } else {
                    $_SESSION['cart'][$product_id] = $products[$product_id];
                    $_SESSION['cart'][$product_id]['quantity'] = 1;
                }
            }
            break;

        case 'remove':
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
            break;
    }
}

header("Location: cart.php");
exit();
