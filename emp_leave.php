<?php
session_start();
if (!isset($_SESSION['login_emp'])) {
    header("Location: emp_login.php");
    exit;
}

include('sidebar.php');
include('config.php');

$emp_id = $_SESSION['emp_id']; 

$success_message = "";

if (isset($_SESSION['add_success'])) {
    $success_message = $_SESSION['add_success'];
    unset($_SESSION['add_success']); 
} 
elseif (isset($_SESSION['edit_success'])) {
    $success_message = $_SESSION['edit_success'];
    unset($_SESSION['edit_success']); 
}

// Get status filter from URL
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Define status condition
$status_condition = "";
switch($status_filter) {
    case 'pending':
        $status_condition = "AND l.status = 1"; // Pending
        break;
    case 'approved':
        $status_condition = "AND l.status = 0"; // Approved
        break;
    case 'rejected':
        $status_condition = "AND l.status = 2"; // Rejected
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
        Leave History
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
            <a href="emp_leave.php?status=all" class="btn btn-secondary">All</a>
            <a href="emp_leave.php?status=pending" class="btn btn-warning">Pending</a>
            <a href="emp_leave.php?status=approved" class="btn btn-success">Approved</a>
            <a href="emp_leave.php?status=rejected" class="btn btn-danger">Rejected</a>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <td>SrNo</td>
              <td>Employee Name</td>
              <td>Leave Type</td>
              <td>From</td>
              <td>To</td>
              <td>Leave Subject</td>
              <td>Posting Date</td>
              <td>Status</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT l.*, e.first_name, e.last_name, lt.typename 
                    FROM leaves l
                    JOIN employees e ON l.empid = e.id
                    JOIN leavetypes lt ON l.leaveid = lt.id
                    WHERE l.empid = ? AND l.active = 1 $status_condition";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $emp_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                      <td><?php echo $row['typename']; ?></td>
                      <td><?php echo $row['startdate']; ?></td>
                      <td><?php echo $row['enddate']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['postdate']; ?></td>
                      <td><?php 
                          switch ($row['status']) {
                              case 1:
                                  echo 'Pending';
                                  break;
                              case 0:
                                  echo 'Approved';
                                  break;
                              case 2:
                                  echo 'Rejected';
                                  break;
                              default:
                                  echo 'Unknown';
                                  break;
                          }
                      ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

<?php include('emp_footer.php'); ?>
