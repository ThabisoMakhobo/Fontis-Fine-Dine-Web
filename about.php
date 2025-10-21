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
   <title>About Us | Fontis Fine Dine</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .about {
         display: flex;
         flex-wrap: wrap;
         align-items: center;
         justify-content: center;
         gap: 3rem;
         padding: 4rem 2rem;
         background-color: #fff8f0;
      }

      .about .image {
         flex: 1 1 35rem;
         text-align: center;
      }

      .about .image img {
         width: 100%;
         max-width: 500px;
         border-radius: 1.2rem;
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      }

      .about .content {
         flex: 1 1 40rem;
         background-color: #ffffff;
         padding: 2.5rem;
         border-radius: 1rem;
         box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
      }

      .about .content h3 {
         font-size: 2.8rem;
         color: #2c2c2c;
         text-transform: uppercase;
         letter-spacing: 1.5px;
         margin-bottom: 1.5rem;
         border-bottom: 2px solid #d4af37;
         display: inline-block;
         padding-bottom: 0.5rem;
      }

      .about .content p {
         font-size: 1.6rem;
         line-height: 1.9;
         color: #555;
         margin-bottom: 1.5rem;
         text-align: justify;
      }

      .about .content .cta {
         margin-top: 1.5rem;
      }

      .about .content .cta a {
         display: inline-block;
         padding: 1rem 2rem;
         background-color: #d4af37;
         color: #fff;
         border-radius: 5px;
         font-size: 1.5rem;
         transition: 0.3s ease;
         text-decoration: none;
      }

      .about .content .cta a:hover {
         background-color: #c19b2d;
      }

      @media (max-width: 768px) {
         .about {
            flex-direction: column;
            padding: 2rem 1rem;
         }
         .about .content h3 {
            font-size: 2.2rem;
         }
         .about .content p {
            font-size: 1.4rem;
         }
      }
   </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p><a href="home.php">Home</a> / About</p>
</div>

<section class="about">
   <div class="image">
      <img src="images/Slogan.jpg" alt="Fontis Fine Dine Restaurant">
   </div>

   <div class="content">
      <h3>Welcome to Fontis Fine Dine</h3>
      <p>
         At <strong>Fontis Fine Dine</strong>, we believe that great food is more than a meal — it's an experience. 
         Since our founding, we’ve been committed to blending fine dining elegance with a welcoming atmosphere that makes every guest feel at home.
      </p>

      <p>
         Our chefs craft each dish with creativity, passion, and the finest ingredients, delivering meals that delight both the eyes and the palate. 
         Whether you’re here for a quiet dinner, a family gathering, or a celebration, every plate is made to satisfy and impress.
      </p>

      <p>
         We take pride in being part of our community — serving local flavors, supporting regional farmers, and offering a dining experience that celebrates South African warmth and hospitality.
      </p>

      <?php if(!$user_id): ?>
         <div class="cta">
            <p style="margin-bottom:1rem;">Want to enjoy our signature dishes?</p>
            <a href="login.php">Login</a>
            <a href="register.php" style="background-color:#2c2c2c; margin-left:10px;">Register</a>
         </div>
      <?php else: ?>
         <div class="cta">
            <a href="shop.php">Explore Our Menu</a>
         </div>
      <?php endif; ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
