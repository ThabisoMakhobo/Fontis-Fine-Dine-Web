<?php

include 'DbConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['order_btn'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = [];

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND method = '$method' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'order already placed!';
        } else {
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, method, total_products, total_price, placed_on) 
            VALUES('$user_id', '$name', '$number', '$method', '$total_products', '$cart_total', '$placed_on')") or die('Insert failed');

            // Fetch the most recent order
            $fetch_order = mysqli_query($conn, "SELECT * FROM `orders` 
            WHERE user_id = '$user_id' 
            ORDER BY id DESC LIMIT 1") or die('Order fetch failed');

            $order_data = mysqli_fetch_assoc($fetch_order);

            // Clean up cart
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Cart cleanup failed');

            // Prepare WhatsApp message
$admin_phone = '27793761586'; // International format without +
$whatsapp_message = "New Order Received%0A" .
                    "Name: " . urlencode($order_data['name']) . "%0A" .
                    "Phone: " . urlencode($order_data['number']) . "%0A" .
                    "Payment: " . urlencode($order_data['method']) . "%0A" .
                    "Items: " . urlencode($order_data['total_products']) . "%0A" .
                    "Total: R" . urlencode($order_data['total_price']) . "%0A" .
                    "Date: " . urlencode($order_data['placed_on']);

echo "<style>
/* Simple modal styles */
#orderModalOverlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.45);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}
#orderModal {
  background: #fff;
  padding: 20px;
  max-width: 420px;
  width: 90%;
  border-radius: 8px;
  box-shadow: 0 6px 24px rgba(0,0,0,0.2);
  font-family: Arial, sans-serif;
}
#orderModal h2 { margin: 0 0 8px 0; font-size: 18px; }
#orderModal p { margin: 0 0 16px 0; color: #444; }
.modalButtons { display:flex; gap:10px; justify-content:flex-end; }
.btnPrimary, .btnSecondary {
  padding: 8px 12px;
  border-radius:6px;
  border: none;
  cursor: pointer;
  font-size:14px;
}
.btnPrimary { background:#25D366; color:#fff; }     /* WhatsApp green */
.btnSecondary { background:#eee; color:#222; }
</style>

<div id='orderModalOverlay' style='display:none;'>
  <div id='orderModal' role='dialog' aria-modal='true' aria-labelledby='orderModalTitle'>
    <h2 id='orderModalTitle'>Order placed successfully!</h2>
    <p>Your order was recorded. Would you like to open WhatsApp to confirm the order with us?</p>
    <div class='modalButtons'>
      <button id='skipWhatsApp' class='btnSecondary'>Continue without WhatsApp</button>
      <button id='openWhatsApp' class='btnPrimary'>Open WhatsApp</button>
    </div>
  </div>
</div>

<script>
(function() {
  // Data from PHP
  var admin_phone = '" . $admin_phone . "';
  var whatsapp_message = '" . $whatsapp_message . "';

  // Build correct WhatsApp URL
  var isMobile = /iPhone|iPad|iPod|Android|Windows Phone|BlackBerry/i.test(navigator.userAgent);
  var whatsappBase = isMobile ? 'https://wa.me/' : 'https://web.whatsapp.com/send?phone=';
  var whatsappUrl = whatsappBase + admin_phone + '&text=' + whatsapp_message;

  // Show the modal
  var overlay = document.getElementById('orderModalOverlay');
  var btnOpen = document.getElementById('openWhatsApp');
  var btnSkip = document.getElementById('skipWhatsApp');

  // Safety: small delay to ensure DOM ready & user sees page
  overlay.style.display = 'flex';

  // Handler: open WhatsApp in a new tab via a real user click
  btnOpen.addEventListener('click', function(e) {
    // Create an anchor and click it — this is a true user gesture and won't be blocked
    var a = document.createElement('a');
    a.href = whatsappUrl;
    a.target = '_blank';
    a.rel = 'noopener noreferrer';
    a.style.display = 'none';
    document.body.appendChild(a);

    // programmatic click initiated inside a direct user click handler => allowed
    a.click();

    // cleanup anchor
    document.body.removeChild(a);

    // Optionally inform user if blocked (rare)
    setTimeout(function() {
      // If after opening WhatsApp the user is still on the page, go to home after a small delay
      window.location.href = 'home.php';
    }, 2500);
  });

  // Handler: skip WhatsApp, go back home
  btnSkip.addEventListener('click', function() {
    window.location.href = 'home.php';
  });

  // Optional: allow closing modal with Escape
  document.addEventListener('keydown', function(evt) {
    if (evt.key === 'Escape') {
      window.location.href = 'home.php';
    }
  });
})();
</script>";


exit;

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">
   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'R'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>R<?php echo $grand_total; ?></span> </div>
</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="tel" name="number" required placeholder="e.g. +27123456789" pattern="^\+?[0-9\s\-]{7,15}$">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on collection">cash on collection</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
