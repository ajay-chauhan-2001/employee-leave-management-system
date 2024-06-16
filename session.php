<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
   include('config.php');
   
 $user_check = $_SESSION['login_user'];

 $id = $_SESSION['user_id'];
 // $id = $_SESSION['emp_id'];

   

$ses_sql = mysqli_query($con,"select * from users where email = '$user_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   if(!isset($_SESSION['login_user'])){
    header("location:./login.php");
      die();
   }
?>