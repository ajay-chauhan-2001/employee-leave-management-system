<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);

  

    $query_student = "SELECT * FROM employees WHERE email='$email'";
    $result_student = mysqli_query($con, $query_student);

    if ( mysqli_num_rows($result_student) > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
