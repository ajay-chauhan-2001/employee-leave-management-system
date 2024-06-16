<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = mysqli_real_escape_string($con, $_POST['number']);

    // $query_teacher = "SELECT * FROM teacher WHERE number='$number' ";
    // $result_teacher = mysqli_query($con, $query_teacher);

    $query_student = "SELECT * FROM employees WHERE number='$number'";
    $result_student = mysqli_query($con, $query_student);

    if ( mysqli_num_rows($result_student) > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
