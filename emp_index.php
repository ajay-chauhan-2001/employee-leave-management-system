<?php
ob_start();
session_start();
if(!isset($_SESSION['emp_id'])) {
    header("Location: emp_login.php");
    exit;
}

include('sidebar.php');
$success_message = "";
if (isset($_SESSION['add_success'])) {
    $success_message = $_SESSION['add_success'];
    unset($_SESSION['add_success']);
}

require_once('config.php');
$user_id = $_SESSION['emp_id'];

// Total number of leaves applied by the user
$total_leave_query = "SELECT COUNT(id) AS total_leave FROM leaves WHERE empid = $user_id";
$total_leave_result = mysqli_query($con, $total_leave_query);
$total_leave_row = mysqli_fetch_assoc($total_leave_result);
$total_leave = $total_leave_row['total_leave'];

// Number of pending leaves
$pending_leave_query = "SELECT COUNT(id) AS pending_leave FROM leaves WHERE empid = $user_id AND status = 1";
$pending_leave_result = mysqli_query($con, $pending_leave_query);
$pending_leave_row = mysqli_fetch_assoc($pending_leave_result);
$pending_leave = $pending_leave_row['pending_leave'];

// Number of approved leaves
$approved_leave_query = "SELECT COUNT(id) AS approved_leave FROM leaves WHERE empid = $user_id AND status = 0";
$approved_leave_result = mysqli_query($con, $approved_leave_query);
$approved_leave_row = mysqli_fetch_assoc($approved_leave_result);
$approved_leave = $approved_leave_row['approved_leave'];

// Number of rejected leaves
$rejected_leave_query = "SELECT COUNT(id) AS rejected_leave FROM leaves WHERE empid = $user_id AND status = 2";
$rejected_leave_result = mysqli_query($con, $rejected_leave_query);
$rejected_leave_row = mysqli_fetch_assoc($rejected_leave_result);
$rejected_leave = $rejected_leave_row['rejected_leave'];

?>
<style type="text/css">
 .text-white {
    color: #fff !important;
    text-align: center;
}
</style>
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success" role="alert" class="close" data-dismiss="alert" aria-label="Close">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<div class="row">

    <div class="col-lg-3 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <a class="text-white" href="emp_leave.php">Total Leave</a>
                <div class="text-white">
                    <?php echo " " . $total_leave; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <a class="text-white" href="emp_leave.php?status=pending">Pending Leave</a>
                <div class="text-white">
                    <?php echo " " . $pending_leave; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <a class="text-white" href="emp_leave.php?status=approved">Approved Leaves</a>
                <div class="text-white">
                    <?php echo " " . $approved_leave; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <a class="text-white" href="emp_leave.php?status=rejected">Rejected Leaves</a>
                <div class="text-white">
                    <?php echo "" . $rejected_leave; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('emp_footer.php'); ?>
