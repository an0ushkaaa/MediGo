<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "medigo");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM prescriptions ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Prescriptions - Admin</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 40px; background: #f4f4f4; }
    h1 { color: navy; }
    table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    th, td { padding: 12px; border-bottom: 1px solid #ddd; }
    th { background: navy; color: white; }
    a { color: #0077cc; text-decoration: none; }
  </style>
</head>
<body>
  <h1>Uploaded Prescriptions</h1>
  <table>
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>File</th>
      <th>Uploaded At</th>
      <th>View</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php $i = 1; while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= htmlspecialchars($row['filename']) ?></td>
          <td><?= $row['uploaded_at'] ?></td>
          <td><a href="prescriptions/<?= $row['filename'] ?>" target="_blank">View</a></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No prescriptions uploaded yet.</td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
