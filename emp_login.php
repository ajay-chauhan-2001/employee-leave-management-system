<?php
include("./Config.php");

session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM employees WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the entered password using password_verify
            if (password_verify($password, $row['password'])) {
                $_SESSION['login_emp'] = $row['first_name'] . " " . $row['last_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_img'] = $row['image'];
                $_SESSION['emp_id'] = $row['id'];
                $_SESSION['add_success'] = "Login successfully!";
                header('Location: emp_index.php');
                exit();
            } else {
                $errors['password'] = "Incorrect password";
            }
        } else {
            $errors['email'] = "No email found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Login</title>
    <!-- logo -->
    <link rel="icon" type="image/fav" href="../elms/image/fav.png" />

</head>
<style type="text/css">
  #email-error{
    background-color: red;
    color: white;
  }
   #pass-error{
    background-color: red;
    color: white;
  }
</style>
<body>
    <section class="form-01-main">
        <div class="form-cover">

            <div class="container">

                <div class="row">
                    <div class="form-sub-main">

                        <div class="_main_head_as">

                            <a href="#">
                               
                                <!-- <img src="assets/images/vector.png"> -->
                            </a>
                        </div>
                        <form id="loginForm" name="myForm" action="" method="post" onsubmit="return validateForm()">
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php foreach ($errors as $error): ?>
                                        <?php echo $error . "<br>"; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group" >
                                <!-- <label >Email</label> -->
                                <input type="email" class="form-control" placeholder="enter your email" name="email"   id="content-email" onkeyup="validateEmail()">                    
                                <span id="email-error"></span>
                            </div> 
                            <h6 id="emailError" class="error">
                                    <?php if(isset($errors['email'])) echo $errors['email'];?>
                                </h6>
                            <div class="form-group">
                                <!-- <label >Password</label> -->
                                <input type="password" class="form-control" placeholder="enter your password" name="password"   id="content-pass" onkeyup="validatePass()">
                                <span id="pass-error"></span>
                            </div> 
                             <h6 id="passwordError" class="error">
                                    <?php if(isset($errors['password'])) echo $errors['password'];?>
                                </h6>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" name="submit" onsubmit="validateForm()">Login</button>
                <span  id="submit-error"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
      function validateForm() {
    var isValid = true;

    var email = $("#email").val();
    var password = $("#password").val();

    $("#emailError").text("");
    $("#passwordError").text("");

    if (email === "") {
        $("#emailError").text("Email is required");
        isValid = false;
    } else if (!validateEmail(email)) {
        $("#emailError").text("Invalid email format");
        isValid = false;
    }

    if (password === "") {
        $("#passwordError").text("Password is required");
        isValid = false;
    } else if (password.length < 8) {
        $("#passwordError").text("Password must be at least 8 characters long");
        isValid = false;
    }

    return isValid;
}
</script>
<script src="script_login.js"></script>
</body>

</html>
