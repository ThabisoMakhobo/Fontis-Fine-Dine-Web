<?php

include 'DbConn.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

// Delete user
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

// Add user
if (isset($_POST['add_user'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $user_type = $_POST['user_type'];

   // Check for duplicate email
   $check_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($check_user) > 0){
      echo "<script>alert('User with this email already exists.');</script>";
   } else {
      mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES('$name', '$email', '$password', '$user_type')") or die('query failed');
      echo "<script>alert('New user created successfully.'); window.location.href='admin_users.php';</script>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      .add-user-form {
         margin: 2rem auto;
         padding: 1.5rem;
         border: 1px solid #ccc;
         border-radius: 10px;
         background-color: #f9f9f9;
         display: flex;
         flex-direction: column;
         gap: 1rem;
         max-width: 400px;
      }

      .add-user-form input,
      .add-user-form select {
         padding: 0.8rem;
         border: 1px solid #ddd;
         border-radius: 5px;
         width: 100%;
      }

      .add-user-form .btn {
         background-color: var(--orange);
         color: white;
         border: none;
         cursor: pointer;
         transition: 0.3s;
      }

      .add-user-form .btn:hover {
         background-color: darkorange;
      }
   </style>

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">User Accounts</h1>

   <!-- Add User Form -->
   <h2 class="title">Create New User</h2>
   <form action="" method="post" class="add-user-form">
      <input type="text" name="name" placeholder="Enter username" required>
      <input type="email" name="email" placeholder="Enter email" required>
      <input type="password" name="password" placeholder="Enter password" required>
      <select name="user_type" required>
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="add_user" value="Add User" class="btn">
   </form>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> User ID: <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Username: <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> Email: <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> User Type: 
            <span style="color:<?php echo ($fetch_users['user_type'] == 'admin') ? 'var(--orange)' : '#333'; ?>">
               <?php echo $fetch_users['user_type']; ?>
            </span> 
         </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>

<!-- custom admin js file link -->
<script src="js/admin_script.js"></script>

</body>
</html>
