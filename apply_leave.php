<?php
ob_start();
session_start();
include('config.php');
include('sidebar.php');

if (!isset($_SESSION['emp_id'])) {
    header("Location: emp_login.php");
    exit;
}

$adminEmail = "chauhanajay1117@gmail.com";

function sendLeaveNotification($adminEmail, $leaveDetails, $employeeName, $leaveType) {
    $subject = 'Leave Application Notification';
    
    $message = 'An employee has applied for leave.' . PHP_EOL . PHP_EOL;
    $message .= 'Employee Name: ' . $employeeName . PHP_EOL; 
    $message .= 'Leave Type: ' . $leaveType . PHP_EOL; 
    $message .= 'Leave Details:' . PHP_EOL;
    $message .= 'From : ' . $leaveDetails['start_date'] . PHP_EOL;
    $message .= 'To : ' . $leaveDetails['end_date'] . PHP_EOL;
    $message .= 'Description: ' . $leaveDetails['description'] . PHP_EOL;
   
   

    $headers = 'From: firebase435@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($adminEmail, $subject, $message, $headers)) {
        echo "Mail sent successfully";
        return true;
    } else {
        echo "Failed to send email";
        error_log('Failed to send email: ' . error_get_last()['message']);
        return false;
    }

}

if (isset($_POST['submit'])) {
    $empid = $_POST['empid']; 
    $leaveid = $_POST['leaveid'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
$description = mysqli_real_escape_string($con, $_POST['description']); 

    $sql = "INSERT INTO `leaves`(`empid`, `leaveid`, `startdate`, `enddate`, `description`, `status`, `active`) 
            VALUES ('$empid', '$leaveid', '$start_date', '$end_date', '$description', 1, 1)";
if ($con->query($sql) === True) {
    $empid = $_POST['empid'];
    $leaveid = $_POST['leaveid'];
    
    $employeeQuery = "SELECT first_name, last_name FROM employees WHERE id = $empid";
    $employeeResult = mysqli_query($con, $employeeQuery);
    $employeeRow = mysqli_fetch_assoc($employeeResult);
    $employeeName = $employeeRow['first_name'] . ' ' . $employeeRow['last_name'];
    
    $leaveTypeQuery = "SELECT typename FROM leavetypes WHERE id = $leaveid";
    $leaveTypeResult = mysqli_query($con, $leaveTypeQuery);
    $leaveTypeRow = mysqli_fetch_assoc($leaveTypeResult);
    $leaveTypeName = $leaveTypeRow['typename'];

    if (sendLeaveNotification('chauhanajay1117@gmail.com', $_POST, $employeeName, $leaveTypeName)) {
        $_SESSION['add_success'] = "Leave applied successfully!";
    } else {
        $_SESSION['add_success'] = "Leave applied successfully, but failed to send email.";
    }
    header("location:emp_leave.php");
    exit();
} else {
    $error_message = "Error: " . $sql . "<br>" . $con->error;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

</head>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<body onload="">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus fa-fw" style="margin-right: 0rem;"></i>
                Apply For Leave
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
                                    <?php 
                                    $dpt = "select * from employees";
                                    $query = mysqli_query($con, $dpt);
                                    if (mysqli_num_rows($query) > 0) {
                                    ?>
                                    <th>Employee Name
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <select name="empid" class="form-control" id="department">
                                            <option value="">Select Employee</option>
                                            <?php foreach ($query as $val) { ?>
                                            <option value="<?php echo $val['id']; ?>"><?php echo $val['first_name'] . " " . $val['last_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <?php
                                    } else {
                                        echo "No data found";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <?php 
                                    $dpt = "select * from leavetypes";
                                    $query = mysqli_query($con, $dpt);
                                    if (mysqli_num_rows($query) > 0) {
                                    ?>
                                    <th>Leave Type
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <select name="leaveid" class="form-control" id="department">
                                            <option value="">Select Leave Type</option>
                                            <?php foreach ($query as $val) { ?>
                                            <option value="<?php echo $val['id']; ?>"><?php echo $val['typename']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <?php
                                    } else {
                                        echo "No data found";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <th>From Date
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="date" name="start_date" class="form-control" id="date" placeholder="Enter start date">
                                         <span class="error" id="date-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>End Date
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="date" name="end_date" class="form-control" id="date" placeholder="Enter end date">
                                         <span class="error" id="date-error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Leave Subject
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <textarea class="ckeditor form-control " name="description" id="desc" cols="60" rows="500"></textarea>

                                      <!--   <textarea name="description" class="form-control"></textarea> -->
                                        <p id="name-error"><?php if(isset($error['desc'])) echo $error['desc'];?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="float-right">
                            <button class="btn btn-success" type="submit" name="submit">Apply
                            <span id="submit-error"></span></button>
                            <a href="emp_leave.php" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>      
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        ClassicEditor
            .create( document.querySelector( '#desc' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script>
    function validateForm() {
        var isValid = true;
        $(".error").text("");
        $("#studentForm input[type='text'], #studentForm select").each(function() {
            if ($(this).val() === "") {
                var fieldName = $(this).attr("name");
                $("#" + fieldName + "-error").text(fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + " is required");
                isValid = false;
            }
        });
        return isValid;
    }

    $("#studentForm").submit(function(event) {
        var isValid = validateForm();
        if (isValid) {
            document.getElementById("studentForm").submit();
        }
        event.preventDefault();
    });

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

        $('#confirm_password').keyup(function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            if (password !== confirmPassword) {
                $('#confirm_password-error').text('Passwords do not match.');
            } else {
                $('#confirm_password-error').text('');
            }
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
