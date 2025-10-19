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
   <title>Your Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Your Orders</h3>
   <p><a href="home.php">Home</a> / Orders</p>
</div>

<section class="placed-orders">
   <h1 class="title">Placed Orders</h1>
   <div class="box-container">
      <?php
         if ($user_id) {
            $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($order_query) > 0){
               while($fetch_orders = mysqli_fetch_assoc($order_query)){
                  echo '<div class="box">
                     <p>Placed on: <span>'.$fetch_orders['placed_on'].'</span></p>
                     <p>Name: <span>'.$fetch_orders['name'].'</span></p>
                     <p>Total: <span>R'.$fetch_orders['total_price'].'/-</span></p>
                     <p>Status: <span style="color:'.($fetch_orders['payment_status']=='pending'?'red':'green').'">'.$fetch_orders['payment_status'].'</span></p>
                  </div>';
               }
            } else {
               echo '<p class="empty">No orders placed yet!</p>';
            }
         } else {
            echo '<p class="empty">You are browsing as a guest. Please <a href="login.php" style="color:blue;">login</a> or <a href="register.php" style="color:blue;">register</a> to view your orders.</p>';
         }
      ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
