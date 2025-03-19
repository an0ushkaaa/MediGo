<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    if (isset($_SESSION["cart"][$product_id])) {
        unset($_SESSION["cart"][$product_id]);
    }
}

header("Location: cart.php");
exit();
