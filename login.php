<?php

include 'DbConn.php';
session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['password'];

   // Prepared statement to prevent SQL injection
   $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows > 0){

      $row = $result->fetch_assoc();

      // Verify the password using password_verify
      if(password_verify($pass, $row['password'])){

         // Regenerate session ID for security
         session_regenerate_id(true);

         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('Location: admin_page.php');
            exit;
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('Location: home.php');
            exit;
         }

      } else {
         $message[] = 'Incorrect email or password!';
      }

   } else {
      $message[] = 'Incorrect email or password!';
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
   <title>Login</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>

<div class="form-container">

   <form action="" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="submit" name="submit" value="Login Now" class="btn">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
   </form>

</div>

</body>
</html>
