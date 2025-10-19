<?php
include 'DbConn.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p><a href="home.php">Home</a> / About</p>
</div>

<section class="about">
   <div class="content">
      <h3>Welcome to Fontis Fine Dine</h3>
      <p>We deliver delicious dining experiences with quality and creativity. Whether you are a regular or visiting us for the first time, we aim to make your meal memorable.</p>
      <?php if(!$user_id): ?>
         <p style="margin-top:10px;">Want to order? <a href="login.php" style="color:blue;">Login</a> or <a href="register.php" style="color:blue;">Register</a>.</p>
      <?php endif; ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
