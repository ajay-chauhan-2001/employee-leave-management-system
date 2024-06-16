<?php 
ob_start();
session_start();
include('header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>category</title>
</head>

<?php
include('config.php');
$id=$_GET["id"];
// echo $id;die();
$sql="select * from employees where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
    $fname = $row["first_name"];
    $lname = $row['last_name'];
    $email = $row['email'];
    // $password = $row['password'];
    // $cpassword = $row['confirm_password'];
    $address = $row['address'];
    $city = $row['city'];

    $gender = $row['gender'];
    $dept = $row['department'];
    $number = $row['number'];
    $birth_date = $row['birth_date'];


if (isset($_POST["submit"]))
{
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    // $password = $_POST['password'];
    // $cpassword = $_POST['confirm_password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $dept = $_POST['department'];
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

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus fa-fw" style="margin-right: 0rem;"></i>
                Edit Student
            </h1>
        </div>
        <hr class="mt-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="table-response">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>first Name
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="first_name" class="form-control"value="<?php echo $fname?>">
                                         <p id="name-error" ><?php if(isset($error['n'])) echo $error['n'];?></p>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Last Name
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="last_name" class="form-control"value="<?php echo $lname?>">
                                         <p id="name-error" ><?php if(isset($error['n'])) echo $error['n'];?></p>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Email
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="email" class="form-control" value="<?php echo $email?>">
                                         <p id="name-error" ><?php if(isset($error['p'])) echo $error['p'];?></p>
                                    </td>
                                </tr>
                               <tr>
                                    <th>Gender
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <select  type="text" name="gender" class="form-control" id="content-gender"  onkeyup="validateEmail()" >
                                             <option value="">Select a Gender</option>
                                             <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
                                            <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
                                            <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>



                                        </select>
                                        <p id="gender-error" ><?php if(isset($error['gender'])) echo $error['gender'];?></p>
                                       
                                         
                                    </td>
                                </tr>
                                <tr>
                                    <th>birth_date
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="date" name="birth_date" class="form-control" value="<?php echo $birth_date?>">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Department
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="department" class="form-control" id="number"  placeholder="enter your department" onkeyup="validateMobile()" value="<?php echo $dept?>">
                                         <span class="error" id="number-error"></span>
                                </tr>
                                <tr>
                                    <th>Address
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="address" class="form-control" value="<?php echo $address?>">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>City
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="city" class="form-control" value="<?php echo $city?>">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Number
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="number" class="form-control" value="<?php echo $number?>">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Image
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="file" name="image" class="form-control">
                                         <p id="name-error" ><?php if(isset($error['img'])) echo $error['img'];?></p>
                                    </td>
                                </tr>
                                 
                            </tbody>

                            
                        </table>
                            
                        <div class="float-right">
                            <button class="btn btn-success" name="submit">Save</button>
                            <a href="teacher.php" class="btn btn-primary" >Cancel</a>
                            
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>      
    </div>
</body>



</html>
<?php include('footer.php'); ?>



