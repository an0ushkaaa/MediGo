<?php
session_start();
include 'db_connect.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "Checkout Failed: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Checkout Failed: Cart is empty.";
    exit();
}

$conn->begin_transaction(); 

try {
    
    $total_price = 0;
    foreach ($_SESSION['cart'] as $medicine_id => $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    
    $order_stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'pending')");
    $order_stmt->bind_param("id", $user_id, $total_price);
    $order_stmt->execute();
    $order_id = $conn->insert_id; 

    
    $order_item_stmt = $conn->prepare("INSERT INTO order_items (order_id, medicine_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stock_update_stmt = $conn->prepare("UPDATE medicines SET stock = stock - ? WHERE id = ?");

    foreach ($_SESSION['cart'] as $medicine_id => $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];

        
        $order_item_stmt->bind_param("iiid", $order_id, $medicine_id, $quantity, $price);
        $order_item_stmt->execute();

        
        $stock_update_stmt->bind_param("ii", $quantity, $medicine_id);
        $stock_update_stmt->execute();
    }

    $conn->commit(); 
    $_SESSION['cart'] = []; 

    echo "Checkout Successful! Order ID: " . $order_id;
} catch (Exception $e) {
    $conn->rollback(); 
    echo "Checkout Failed: " . $e->getMessage();
}

?>
