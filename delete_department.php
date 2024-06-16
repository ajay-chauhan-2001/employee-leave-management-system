<?php
include('config.php');
$id = $_GET['id'];
$sql = "update departments set active=0  WHERE id=$id";

if ($con->query($sql) === TRUE) {
    header("Location: department.php");
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

 ?>