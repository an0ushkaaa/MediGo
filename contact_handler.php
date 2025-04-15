<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $user_id = $_SESSION['user_id'] ?? null;

    // Basic validation
    $errors = [];
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email)) $errors[] = 'Email is required';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
    if (empty($message)) $errors[] = 'Message is required';

    if (empty($errors)) {
        try {
            // Save to database
            $stmt = $conn->prepare("
                INSERT INTO contact_messages 
                (user_id, name, email, message, created_at) 
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->bind_param("isss", $user_id, $name, $email, $message);
            $stmt->execute();

            // SUCCESS MESSAGE SET HERE
            $_SESSION['contact_status'] = [
                'type' => 'success', 
                'message' => 'Message sent successfully!'
            ];
            
            header("Location: contact.php");
            exit();

        } catch (Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $_SESSION['contact_status'] = [
                'type' => 'error',
                'message' => 'Failed to send message. Please try again.'
            ];
            $_SESSION['form_data'] = compact('name', 'email', 'message');
            header("Location: contact.php");
            exit();
        }
    } else {
        // Validation errors
        $_SESSION['contact_status'] = [
            'type' => 'error',
            'message' => $errors
        ];
        $_SESSION['form_data'] = compact('name', 'email', 'message');
        header("Location: contact.php");
        exit();
    }
}

// If not POST request
header("Location: contact.php");
exit();