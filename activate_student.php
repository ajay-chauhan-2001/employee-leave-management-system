<?php
session_start();
include('config.php');

if(isset($_GET['id']) && isset($_GET['status'])) {
    $st_id = $_GET['id'];
    $status = $_GET['status'];

    $sql = "UPDATE employees SET status = '$status' WHERE id = '$st_id'";

    if(mysqli_query($con, $sql)) {
        $_SESSION['edit_success'] = "student status changed successfully";
    } else {
        $_SESSION['edit_success'] = "Error changing order status";
    }
} else {
    $_SESSION['edit_success'] = "Invalid request";
}

header("Location: employee.php");
exit();
?>
