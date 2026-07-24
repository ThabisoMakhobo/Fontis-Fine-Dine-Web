<?php
session_start();

// Set guest session
$_SESSION['guest'] = true;

// Redirect to home page
header('Location: index.php');
exit;
?>
