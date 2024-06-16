<?php
session_start();
session_destroy();
header('location:emp_login.php');
// echo '<script>alert("Logged out successfully"); window.location.href = "login.php";</script>';

exit;
?>
