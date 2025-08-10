<?php

include 'DbConn.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="image/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>We offer new recommendations and specials on the latest books and we are in the process of getting new products to sell.</p>
         <p>we do free delivery on us, book returns.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>The customer service is top-notch. I had an issue with one of my orders and they handled it quickly and professionally. The clothes fit well and look just like the pictures online. My only complaint is that some items tend to be a bit pricier than I'd like.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John D.</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>I've been shopping here for a few months now and I'm really impressed with the quality of the clothes. The styles are trendy and the materials feel durable. The only downside is that the shipping can sometimes take a bit longer than expected. Overall, a great shopping experience!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sarah M.</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>I've ordered several items and have been pleased with most of them. The clothing is stylish and comfortable. Occasionally, the colors are slightly different from what I expected based on the pictures, but it's not a major issue. Will definitely continue shopping here.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Michael B.</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Love the variety of styles available on this site. I've found everything from casual wear to more formal outfits. The sizes are pretty accurate, which is always a plus. I would have given five stars if the returns process was a bit simpler. Still, highly recommend!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Emma L.</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>The website is easy to navigate and the product descriptions are thorough. The quality of the clothing is good and the fit is as expected. I've had a couple of instances where items were out of stock, which was disappointing, but overall my experiences have been positive.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>David R.</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Great selection of clothes for both men and women. I appreciate the detailed size guides which have helped me make better choices. The shipping is reasonably fast and the items are well-packaged. Just wish they had more frequent sales or discounts.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Olivia T.</h3>
      </div>

   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>