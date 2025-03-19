<?php
session_start();
include "db_connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($name) && !empty($email) && !empty($password)) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Email already registered.";
        } else {
            
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION["user_id"] = $stmt->insert_id;
                $_SESSION["user_name"] = $name;
                header("Location: index.php"); 
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>
