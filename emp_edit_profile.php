<?php
session_start();
include('config.php');
include('sidebar.php');

$id = $_GET['id'];
// echo $id;die();
$sql="select * from employees where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
    $fname = $row["first_name"];
    $lname = $row['last_name'];
    $email = $row['email'];
    $password = $row['password'];
    // $cpassword = $row['confirm_password'];
    $address = $row['address'];
    $city = $row['city'];

    $gender = $row['gender'];
    // $dept = $row['department'];
    $number = $row['number'];
    $birth_date = $row['birth_date'];


if (isset($_POST["submit"]))
{
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $cpassword = $_POST['confirm_password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    // $dept = $_POST['department'];
    $number = $_POST['number'];
    $birth_date = $_POST['birth_date'];

    if ($_FILES["image"]["name"]) {
        $targetDir = "image/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);

        $sql="UPDATE `employees` SET `id`='$id',`first_name`='$fname',`last_name`='$lname',`email`='$email',`gender`='$gender',`birth_date`='$birth_date',`department`='$dept',`address`='$address',`city`='$city',`number`='$number',`image`='$fileName' WHERE  id=$id";
    } else {
         $sql="UPDATE `employees` SET `id`='$id',`first_name`='$fname',`last_name`='$lname',`email`='$email',`gender`='$gender',`birth_date`='$birth_date',`department`='$dept',`address`='$address',`city`='$city',`number`='$number'WHERE id=$id";
    }


   
    
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['edit_success'] = "Employee updated successfully!";
        header("Location: employee.php");
        exit();
    } else {
        die(mysqli_error($con));
    }
}
?>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xl px-4 mt-4">
      <?php if(!empty($message)): ?>
                            <div class="alert <?php echo $message_class; ?>" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if(!empty($_SESSION['profile_update_success'])): ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['profile_update_success']; ?></div>
                            <?php unset($_SESSION['profile_update_success']); ?>
                        <?php endif; ?>
        <div class="row">

            <div class="col-xl-4">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <img class="rounded-circle mt-5" src="image/<?php echo $row['image'];?>">
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- Edit Profile Card -->
                <div class="card mb-4">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        
                        <form  action="edit_profile_emp.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                           <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">first Name</label>
                                <input type="name" class="form-control" name="first_name" placeholder="enter  your name" value="<?php echo $row['first_name'] ;?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">last Name</label>
                                <input type="name" class="form-control" name="last_name" placeholder="enter  your name" value="<?php echo $row['last_name'] ;?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Email Id</label>
                               <input type="email" class="form-control" name="email" placeholder="enter email id" value="<?php echo $row['email'] ;?>">
                            </div>
                             <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Password</label>
                                <input type="text" class="form-control"  name="password" placeholder="enter Password" value="<?php echo $row['password'];?>">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                           
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Phone Number</label>
                                <input type="text" class="form-control" name ="number" placeholder="enter Phoneno" value="<?php echo $row['number'];?>">
                            </div>
                             <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Gender</label>
                                <input type="text" class="form-control"  name="gender" placeholder="enter Password" value="<?php echo $row['gender'];?>">
                            </div>
                             <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Address</label>
                                <input type="text" class="form-control" name ="address" placeholder="enter Phoneno" value="<?php echo $row['address'];?>">
                            </div>
                             <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">City</label>
                                <input type="text" class="form-control"  name="city" placeholder="enter Password" value="<?php echo $row['city'];?>">
                            </div>

                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Birth Date</label>
                                <input type="date" class="form-control"  name="birth_date" placeholder="enter birth_date" value="<?php echo $row['birth_date'];?>">
                            </div>
                            
                            
                        </div>
                        
                         <input type="file" class="form-control" name="image" value="<?php echo $row['image'];?>"><br>
                        
                           <div class="float-right">
                               <button class="btn btn-success" name="submit">Save</button>
                               <a href="emp_index.php" class="btn btn-secondary">Cancel</a>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

<?php include('emp_footer.php'); ?>
