<?php
session_start();
session_destroy();
header('location:login.php');
// echo '<script>alert("Logged out successfully"); window.location.href = "login.php";</script>';

exit;
?>
