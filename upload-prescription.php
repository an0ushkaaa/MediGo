<?php
session_start();
$uploadMessage = '';

$mysqli = new mysqli("localhost", "root", "", "medigo");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = "prescriptions/";
    $fileName = basename($_FILES["prescription"]["name"]);
    $uniqueFileName = time() . "_" . $fileName;
    $targetFile = $targetDir . $uniqueFileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["prescription"]["tmp_name"], $targetFile)) {
            // Store filename and username into database
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
            $stmt = $mysqli->prepare("INSERT INTO prescriptions (username, filename, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $username, $uniqueFileName);
            $stmt->execute();
            $stmt->close();

            $uploadMessage = "Prescription uploaded successfully!";
        } else {
            $uploadMessage = "Sorry, there was an error uploading your file.";
        }
    } else {
        $uploadMessage = "Only JPG, JPEG, PNG, and PDF files are allowed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Prescription - MediGo</title>
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
        .form-box {
            background-color: #fff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            max-width: 600px;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: navy;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }
        input[type="submit"]:hover {
            background-color: #001f4d;
        }
        .message {
            margin-top: 20px;
            font-weight: 600;
            color: green;
        }
        .error {
            color: red;
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
            <a href="upload-prescription.php" class="active">Upload Prescription</a>
            <a href="cart.php">Cart</a>
            <a href="consultation.php">Online Consultation</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="main">
            <h2>Upload Your Prescription</h2>
            <div class="form-box">
                <form action="upload-prescription.php" method="POST" enctype="multipart/form-data">
                    <label for="prescription">Choose a prescription file:</label>
                    <input type="file" name="prescription" required>
                    <input type="submit" value="Upload">
                </form>
                <?php if ($uploadMessage): ?>
                    <div class="message"><?php echo htmlspecialchars($uploadMessage); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
