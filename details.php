<?php 
session_start();
include('header.php'); 
include('config.php');

$id = $_GET["id"];

$sql = "SELECT * FROM leaves WHERE active = 1 AND id = $id";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $empid = $row['empid'];
    $leaveid = $row['leaveid'];
    $deptid = $row['dept_id'];

    $emp_query = mysqli_query($con, "SELECT * FROM employees WHERE id = '$empid'");
    $lev_query = mysqli_query($con, "SELECT * FROM leavetypes WHERE id = '$leaveid'");
    $dpt_query = mysqli_query($con, "SELECT * FROM departments WHERE id = '$deptid'");
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
  .yellow {
      background-color: #ffc107;
      color: white;
  }
  .details-label {
      font-weight: bold;
  }
  .details-container {
      margin-bottom: 1rem;
  }
  .details-content {
      background-color: #f8f9fc;
      padding: 1rem;
      border-radius: 5px;
      border: 1px solid #e3e6f0;
  }
  .details-content-description {
      white-space: pre-wrap; /* Preserve whitespace and newlines */
      max-height: 400px; /* Limit the max height for large content */
      overflow-y: auto; /* Enable vertical scrolling if content exceeds max height */
  }
  .action-buttons {
      margin-top: 1rem;
  }
  .danger {
      margin-left: 7px; 
  }
</style>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>

<body>
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-list fa-fw" style="margin-right: 0.5rem;"></i>
                Leave Details
            </h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
              <div class="row">
                <?php if (!empty($emp_query) && !empty($lev_query) && !empty($dpt_query)): ?>
                    <div class="col-md-6 details-container">
                        <label class="details-label">Employee Name:</label>
                        <div class="details-content">
                            <?php while ($ad_val = mysqli_fetch_array($emp_query)) { echo $ad_val['first_name'] . " " . $ad_val['last_name']; } ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Department:</label>
                        <div class="details-content">
                            <?php while ($ad_val = mysqli_fetch_array($dpt_query)) { echo $ad_val['name']; } ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Email id:</label>
                        <div class="details-content">
                            <?php mysqli_data_seek($emp_query, 0); while ($ad_val = mysqli_fetch_array($emp_query)) { echo $ad_val['email']; } ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Contact No.:</label>
                        <div class="details-content">
                            <?php mysqli_data_seek($emp_query, 0); while ($ad_val = mysqli_fetch_array($emp_query)) { echo $ad_val['number']; } ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Leave Type:</label>
                        <div class="details-content">
                            <?php while ($ad_val = mysqli_fetch_array($lev_query)) { echo $ad_val['typename']; } ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Post Date:</label>
                        <div class="details-content">
                            <?php echo $row['postdate']; ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Leave Date:</label>
                        <div class="details-content">
                            <?php echo "From " . $row['startdate'] . " To " . $row['enddate']; ?>
                        </div>
                    </div>

                    <div class="col-md-6 details-container">
                        <label class="details-label">Leave Status:</label>
                        <div class="details-content">
                            <?php 
                                if($row['status'] == 1) {
                                    echo '<span class="yellow">Pending</span>';
                                } elseif($row['status'] == 0) {
                                    echo '<span class="green">Approved</span>';
                                } else {
                                    echo '<span class="red">Rejected</span>';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-12 details-container">
                      <textarea class="ckeditor form-control " name="description" id="desc">Description</textarea>
                      <script>
        ClassicEditor
            .create( document.querySelector( '#desc' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
                        <!-- <label class="details-label">:</label> -->

                        <div class="details-content details-content-description">
                            <?php echo nl2br($row['description']); ?>
                        </div>
                    </div>

                    <div class="col-md-12 details-container action-buttons">
                        <label class="details-label">Action:</label>
                        <div class="details-content">
                            <?php 
                                if($row['status'] != 0) {
                                    echo "<a href='activate_leave.php?id=".$row['id']."&status=0' class='btn btn-success'>Approve</a>"; 
                                }
                                if($row['status'] != 1) {
                                    echo "<a href='activate_leave.php?id=".$row['id']."&status=1' class='btn btn-warning'>Pending</a>"; 
                                }
                                if($row['status'] != 2) {
                                    echo "<a href='activate_leave.php?id=".$row['id']."&status=2' class='btn btn-danger'>Reject</a>"; 
                                }
                            ?>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="col-md-12">No data found</div>
                <?php endif; ?>
            </div>

            <div class="float-right">
                <a href="leave.php" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>
