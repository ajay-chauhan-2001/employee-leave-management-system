<?php
ob_start();
include('header.php');

$errors = [];

include('config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $gender = $_POST['gender'];
    $dept = $_POST['department'];
    $number = $_POST['number'];
    $birth_date = $_POST['birth_date'];
    $image = $_FILES['image']['name'];
    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    $query = "SELECT * FROM employees WHERE email='$email' OR number ='$number'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['email'] === $email) {
                $errors['email'] = "Email already exists.";
            }
            if ($row['number'] === $number) {
                $errors['number'] = "Number already exists.";
            }
        }
    } else {
        if ($password !== $cpassword) {
            $errors['password'] = "Passwords do not match.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `employees` (`first_name`, `last_name`, `email`, `password`, `gender`, `birth_date`, `department`, `address`, `city`, `number`, `status`, `image`, `active`) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$gender', '$birth_date', '$dept', '$address', '$city', '$number', 1, '$image', 1)";

            if ($con->query($sql) === True) {
                $_SESSION['add_success'] = "Employee added successfully!";
                header("location:employee.php");
                exit();
            } else {
                $error_message = "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }
}
 ?>

 <style type="text/css">
    .error{
        background-color: red;
        color: white;
        font-size: large;
    }
</style>
<body onload="toggleStreamsAndSubjects()">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus fa-fw" style="margin-right: 0rem;"></i>
                Add Leave
            </h1>
        </div>
        <hr class="mt-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert" class="close" data-dismiss="alert" aria-label="Close">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
<form id="studentForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                   
                    <div class="table-response">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>first name
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="first_name" class="form-control" id="name" placeholder="enter your first name" onkeyup="validateName()">
                                         <span class="error" id="name-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Last name
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="last_name" class="form-control" id="name" placeholder="enter your last name" onkeyup="validateName()">
                                         <span class="error" id="name-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="enter your email"  onkeyup="validateEmail()">
                                         <span class="error" id="email-error"><?php if(isset($errors['email'])) echo $errors['email'];?></span>
                                         <!-- <?php echo $error; ?> -->


                                         
                                    </td>
                                </tr>
                                <tr>
                                    <th>Password
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="enter your password"  onkeyup="validateEmail()">
                                         <span class="error" id="email-error"><?php if(isset($errors['email'])) echo $errors['email'];?></span>
                                         <!-- <?php echo $error; ?> -->


                                         
                                    </td>
                                </tr>
                                <tr>
                                    <th>Comfirm Password
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="enter your Comfirm password"  onkeyup="validateEmail()">
                                         <span class="error" id="confirm_password-error"><?php if(isset($errors['email'])) echo $errors['email'];?></span>
                                         <!-- <?php echo $error; ?> -->


                                         
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gender
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <select  type="text" name="gender" class="form-control" id="gender"  onkeyup="validateEmail()" >
                                             <option value="">Select a Gender</option>
                                             <option value="male">Male</option>
                                             <option value="female">Female</option>
                                             <option value="other">Other</option>


                                        </select>
                                       <span class="error" id="gender-error"></span>
                                         
                                    </td>
                                </tr>
                                <tr>
                                    <th>Birth date
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="date" name="birth_date" class="form-control" id="date" placeholder="enter your birth_date" onkeyup="validateDate()">
                                         <span class="error" id="date-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Number
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="tel" name="number" class="form-control" id="number"  placeholder="enter your number" onkeyup="validateMobile()">
                                         <span class="error" id="number-error"></span>
                                </tr>
                                <tr>
                                    <th>Address
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        
                                        <textarea type="text" name="address" class="form-control" id="address" placeholder="enter your address"  onkeyup="validateAdd()"></textarea>
                                         <span class="error" id="address-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>City
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="city" class="form-control" placeholder="enter your city">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <?php 
                                  $dpt="select * from departments";
                                  $query=mysqli_query($con,$dpt);
                                  if (mysqli_num_rows($query) >0)
                                   {
                                        ?>
                                    <th>Department
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <select name="department" class="form-control" id="department">
                                            <option value="">select to department </option>

                                            <?php
                                                foreach ($query as $val)
                                                    {
                                            ?>
                                     
                                            <option value="<?php echo  $val['id']; ?>"><?php echo  $val['name'];  ?>
                                            </option>
                                            <?php } ?>

                                        </select>

                                           
                                           <?php
                                      }
                                      else
                                      {
                                        echo "no data found";
                                      }
                                      
                                       ?>
                                </tr>
                                 
                            <div class="form-group">
                                <label>Project Name :</label>
                                
                                <tr>
                                    <th>Image
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="file" name="image" id="image" class="form-control" onkeyup="validateImage()">
                                        <span class="error" id="image-error"></span>
                                    </td>
                                </tr>
                                 
                           
                                
                            </tbody>

                            
                        </table>
                            
                        <div class="float-right">
                            <button class="btn btn-success" type="submit" name="submit" onsubmit="validateForm()">Save
                            <span  id="submit-error" ></span></button>

                            <a href="employee.php" class="btn btn-primary" >Cancel</a>
                            
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>      
    </div>
    

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    function validateForm() {
        var isValid = true;

        // Reset all error messages
        $(".error").text("");

        // Validate each field
        $("#studentForm input[type='text'], #studentForm select").each(function() {
            if ($(this).val() === "") {
                var fieldName = $(this).attr("name");
                $("#" + fieldName + "-error").text(fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + " is required");
                isValid = false;
            }
        });

        var studentClass = $("#class").val();
        if (studentClass === "") {
            $("#class-error").text("Class is required");
            isValid = false;
        }

        return isValid;
    }

    // $("#studentForm").submit(function(event) {
    //     event.preventDefault();

    //     var isValid = validateForm();

    //     if (isValid) {
    //         this.submit();
    //     }
    // });

    $("#studentForm").submit(function(event) {
    var isValid = validateForm();

    if (isValid) {
        document.getElementById("studentForm").submit();
    }

    event.preventDefault();
});

</script>
<script>
   
    $(document).ready(function() {
        $('#email').keyup(function() {
            var email = $(this).val();
            if (email !== '') {
                $.ajax({
                    url: 'check_email.php',
                    type: 'POST',
                    data: {email: email},
                    success: function(response) {
                        if (response === 'exists') {
                            $('#email-error').text('Email already exists.');
                        } else {
                            $('#email-error').text('');
                        }
                    }
                });
            }
        });
          $(document).ready(function() {
    $('#confirm_password').keyup(function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        
        if (password !== confirmPassword) {
            $('#confirm_password-error').text('Passwords do not match.');
        } else {
            $('#confirm_password-error').text('');
        }
    });
});
        $('#number').keyup(function() {
            var number = $(this).val();
            if (number !== '') {
                $.ajax({
                    url: 'check_number.php', 
                    type: 'POST',
                    data: {number: number},
                    success: function(response) {
                        if (response === 'exists') {
                            $('#number-error').text('Number already exists.');
                        } else {
                            $('#number-error').text('');
                        }
                    }
                });
            }
        });
    });
</script>

</body>
</html>
<?php include('footer.php'); ?>

