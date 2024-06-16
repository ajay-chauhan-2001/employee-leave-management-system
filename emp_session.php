<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
   include('config.php');
   
 $user_check = $_SESSION['login_emp'];

 $id = $_SESSION['emp_id'];
 // $id = $_SESSION['emp_id'];

   

$ses_sql = mysqli_query($con,"select * from employees where email = '$user_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
// $login_session = $row['email'];


   
   if(!isset($_SESSION['login_emp'])){
    header("location:./emp_login.php");
      die();
   }
?>