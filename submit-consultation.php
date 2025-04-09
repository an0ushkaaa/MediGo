<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $datetime = htmlspecialchars($_POST['datetime']);
  $symptoms = htmlspecialchars($_POST['symptoms']);

  // Save to a file
  $entry = "Name: $name\nEmail: $email\nPhone: $phone\nDate/Time: $datetime\nSymptoms: $symptoms\n------------------\n";
  file_put_contents("consultation_requests.txt", $entry, FILE_APPEND | LOCK_EX);

  // Send email to Admin
  $to_admin = "yourgmail@gmail.com"; // REPLACE with your actual Gmail
  $subject_admin = "New Online Consultation Booking";
  $message_admin = "A new consultation has been booked:\n\nName: $name\nEmail: $email\nPhone: $phone\nDate/Time: $datetime\nSymptoms: $symptoms";
  $headers_admin = "From: no-reply@medigo.com";

  

  // Send confirmation to Patient
  $to_patient = $email;
  $subject_patient = "Your Consultation Booking with MediGo";
  $message_patient = "Hi $name,\n\nThank you for booking an online consultation with MediGo!\n\nDetails:\nDate/Time: $datetime\nSymptoms: $symptoms\n\nWe will contact you soon.\n\n- MediGo Team";
  $headers_patient = "From: reachmedigo@gmail.com";

  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Consultation Confirmed - MediGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f6f9fc;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      padding: 20px;
    }
    .confirmation-box {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 100%;
    }
    .confirmation-box h1 {
      color: #004080;
      margin-bottom: 15px;
    }
    .confirmation-box p {
      color: #333;
      margin-bottom: 20px;
    }
    .confirmation-box a {
      background-color: #004080;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="confirmation-box">
    <h1>Thank you, <?php echo $name; ?>!</h1>
    <p>Your online consultation has been successfully booked for:</p>
    <p><strong><?php echo date("F j, Y \a\\t g:i A", strtotime($datetime)); ?></strong></p>
    <p>We’ll contact you shortly at <strong><?php echo $email; ?></strong>.</p>
    <a href="index.php">Back to Home</a>
  </div>
</body>
</html>

