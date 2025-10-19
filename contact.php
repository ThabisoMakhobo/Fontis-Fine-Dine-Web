<?php

include 'DbConn.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   // Insert message (user_id can be NULL for guests)
   $stmt = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?)");
   $stmt->bind_param("issss", $user_id, $name, $email, $number, $msg);
   
   if($stmt->execute()){
      $message[] = 'Your message has been sent successfully!';
   } else {
      $message[] = 'Failed to send message. Please try again!';
   }

   $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="contact">

   <h1 class="title">Contact Us</h1>

   <form action="" method="post">
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <input type="email" name="email" required placeholder="Enter your email" class="box">
      <input type="text" name="number" required placeholder="Enter your number" class="box">
      <textarea name="message" class="box" required placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" name="send" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

</body>
</html>
