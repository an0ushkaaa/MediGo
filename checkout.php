<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['checkout_error'] = 'User not logged in';
    header("Location: cart.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    $_SESSION['checkout_error'] = 'Cart is empty';
    header("Location: cart.php");
    exit();
}

$conn->begin_transaction();

try {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("id", $_SESSION['user_id'], $total);
    $stmt->execute();
    $order_id = $conn->insert_id;

    // Process order items...
    
    $conn->commit();
    unset($_SESSION['cart']);
    
    // Set success notification
    $_SESSION['order_success'] = [
        'order_id' => $order_id,
        'total' => $total
    ];
    
    header("Location: index.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['checkout_error'] = 'Checkout failed: ' . $e->getMessage();
    header("Location: cart.php");
    exit();
}
?>