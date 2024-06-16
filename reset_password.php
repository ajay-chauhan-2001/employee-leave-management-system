<?php
include("Config.php");

$error = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    // $empid = $_POST['empid'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify email and empid
    $sql = "SELECT * FROM employees WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Email and empid combination is valid
        $row = mysqli_fetch_assoc($result);
        
        // Generate a unique token
        $token = uniqid();

       
        $to = $email;
        $subject = "Password Reset";
        $message = "Click the link below to reset your password:\n";
        $message .= "http://yourwebsite.com/reset_password.php?token=$token";
        $headers = "From: your@example.com";

        if (mail($to, $subject, $message, $headers)) {
            $success_message = "Password reset link has been sent to your email.";
        } else {
            $error = "Failed to send password reset email. Please try again.";
        }
    } else {
        $error = "Invalid email or empid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Recovery</title>
</head>
<body>
    <h1>Password Recovery</h1>
    <?php if (!empty($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success_message)): ?>
        <div><?php echo $success_message; ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
       <!--  <label for="empid">Employee ID:</label>
        <input type="text" name="empid" required><br> -->
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
