<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}

include('header.php');
include('config.php');

$success_message = "";

if (isset($_SESSION['add_success'])) {
    $success_message = $_SESSION['add_success'];
    unset($_SESSION['add_success']);
} elseif (isset($_SESSION['edit_success'])) {
    $success_message = $_SESSION['edit_success'];
    unset($_SESSION['edit_success']);
}

$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Define status condition
$status_condition = "";
switch($status_filter) {
    case 'pending':
        $status_condition = "AND leaves.status = 1"; // Pending
        break;
    case 'approved':
        $status_condition = "AND leaves.status = 0"; // Approved
        break;
    case 'rejected':
        $status_condition = "AND leaves.status = 2"; // Rejected
        break;
    case 'all':
    default:
        $status_condition = ""; // No filter
        break;
}
?>

<style type="text/css">
    .green {
        background-color: #199319;
        color: white;
    }

    .red {
        background-color: red;
        color: white;
    }
</style>

<body>
    <?php if (!empty($success_message)): ?>
    <div class="alert alert-success" role="alert" class="close" data-dismiss="alert" aria-label="Close">
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-list fa-fw" style="margin-right: 0rem;"></i>
                Leave List
            </h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a class="btn btn-primary btn-icon" href="apply_leave.php">
                    <span class="text">
                        <i class="fas fa-plus" style="margin-right: 0rem;"></i>
                    </span>
                    <span class="text">Add Leave</span>
                </a>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <a href="leave.php?status=all" class="btn btn-secondary">All</a>
                    <a href="leave.php?status=pending" class="btn btn-warning">Pending</a>
                    <a href="leave.php?status=approved" class="btn btn-success">Approved</a>
                    <a href="leave.php?status=rejected" class="btn btn-danger">Rejected</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>SrNo</td>
                            <td>Employee Name</td>
                            <td>Leave Type</td>
                            <td>Posting Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT leaves.*, employees.first_name, employees.last_name, leavetypes.typename 
                                FROM leaves 
                                LEFT JOIN employees ON leaves.empid = employees.id 
                                LEFT JOIN leavetypes ON leaves.leaveid = leavetypes.id 
                                WHERE leaves.active = 1 $status_condition";
                        $result = mysqli_query($con, $sql);

                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                            <td><?php echo $row['typename']; ?></td>
                            <td><?php echo $row['postdate']; ?></td>
                            <td>
                                <a href="details.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Details</a>
                            </td>
                        </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='5'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>
