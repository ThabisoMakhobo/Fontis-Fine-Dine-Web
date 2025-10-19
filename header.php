<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <?php if(isset($_SESSION['user_id'])): ?>
            <p>Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong> | <a href="logout.php">logout</a></p>
         <?php else: ?>
            <p>New <a href="login.php">login</a> | <a href="register.php">register</a> | <a href="guest_home.php">continue as guest</a></p>
         <?php endif; ?>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <div class="logo">
            <img src="images/Logo-removebg-preview.png" style="height: 110px;">
         </div>
         <a href="home.php" class="logo">Fontis Fine Dine</a>

         <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
            <?php if(isset($_SESSION['user_id'])): ?>
               <a href="orders.php">orders</a>
            <?php endif; ?>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>

            <?php
               if(isset($_SESSION['user_id'])){
                  $user_id = $_SESSION['user_id'];
                  $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                  $cart_rows_number = mysqli_num_rows($select_cart_number);
               } else {
                  $cart_rows_number = 0;
               }
            ?>
            <a href="<?php echo isset($_SESSION['user_id']) ? 'cart.php' : 'login.php'; ?>"> 
               <i class="fas fa-shopping-cart"></i> 
               <span>(<?php echo $cart_rows_number; ?>)</span> 
            </a>
         </div>

         <?php if(isset($_SESSION['user_id'])): ?>
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
         <?php endif; ?>
      </div>
   </div>

</header>
