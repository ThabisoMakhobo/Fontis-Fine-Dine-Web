<?php
include 'DbConn.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if(isset($_POST['add_to_cart'])){
   if($user_id){
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
      if(mysqli_num_rows($check_cart) > 0){
         $message[] = 'Already in cart!';
      } else {
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) 
         VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
         $message[] = 'Added to cart!';
      }
   } else {
      $message[] = 'Please login to add items to your cart!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Our Shop</h3>
   <p><a href="home.php">home</a> / shop</p>
</div>

<section class="products">
   <h1 class="title">Latest Products</h1>
   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`");
         if(mysqli_num_rows($select_products) > 0){
            while($fetch = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch['image']; ?>" alt="">
         <div class="name"><?php echo $fetch['name']; ?></div>
         <div class="price">R<?php echo $fetch['price']; ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo $fetch['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch['image']; ?>">
         <?php if($user_id): ?>
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
         <?php else: ?>
            <a href="login.php" class="btn">Login to order</a>
         <?php endif; ?>
      </form>
      <?php
         }
      } else {
         echo '<p class="empty">No products available!</p>';
      }
      ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
