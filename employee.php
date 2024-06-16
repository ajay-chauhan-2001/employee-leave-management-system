<?php
session_start();
if(!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}
?>

<?php 
include('header.php');
include('config.php');

$success_message = "";

if (isset($_SESSION['add_success'])) {
    $success_message = $_SESSION['add_success'];
    unset($_SESSION['add_success']); 
} 
elseif (isset($_SESSION['edit_success'])) {
    $success_message = $_SESSION['edit_success'];
    unset($_SESSION['edit_success']); 
}

 ?>
<style type="text/css">
  .green{ 
      background-color: #199319; 
      color: white;
    } 
    .red{ 
      background-color: red; 
      color: white;
    } 
</style>

<body>
  <?php if (!empty($success_message)): ?>
        <div class="alert alert-success" role="alert"  class="close" data-dismiss="alert" aria-label="Close">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-list fa-fw" style="margin-right: 0rem;"></i>
         employee List
      </h1>
    </div>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <a class="btn btn-primary btn-icon" href="add_employee.php" >
              <span class="text">
                <i class="fas fa-plus" style="margin-right: 0rem;"></i>
              </span>
              <span class="text">Add employees</span>
        </a>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%"   cellspacing="0">
            <thead>
              <tr>
                <td>SrNo</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Gender</td>
                <td>Birth Date</td>
                <td>Number</td>

                <td>Department</td>
                <td>Address</td>

                <td>City</td>
                <!-- <td>core Subject</td> -->
                <!-- <td>Subjects</td> -->
                <td>Image</td>

                <td>Status</td>
                <td>Action</td>

              </tr>
            </thead>
            <tbody>
                <?php

                          $sql="select * from employees where active=1 ";
                          $result = mysqli_query($con,$sql);
                          
                        
                              if ($result->num_rows > 0)
                               {
                                  $i=1;
                                  while ($row = $result->fetch_assoc()) 
                                  { 
                                        $ad_id=$row['department'];
                                        $ad="select * from departments where id= '$ad_id'";
                                        $ad_query=mysqli_query($con,$ad);


                                    ?>
                                      <tr>
                                          <td><?php echo $i++; ?></td>

                                          <td><?php echo $row['first_name']; ?></td>
                                          <td><?php echo $row['last_name']; ?></td>
                                          
                                          <td><?php echo $row['email']; ?></td>
                                          <td><?php echo $row['gender']; ?></td>
                                          <td><?php echo $row['birth_date']; ?></td>
                                          <td><?php echo $row['number']; ?></td>
                                         <td>
                                                <?php foreach ($ad_query as $ad_val) {echo $ad_val['name']; }  ?>
                                              </td>

                                          
                                          <td><?php echo $row['address']; ?></td>
                                          <td><?php echo $row['city']; ?></td>

                                          <td>
                                                  <img src="image/<?php echo $row['image']; ?>" width="80" height="80">
                                          </td>
                                          

                                          <td>
                                              <?php 
                                                  if($row['status'] == "1") {
                                                      echo "<a href='activate_student.php?id=".$row['id']."&status=0' class='btn btn-success '>Active </a>"; 
                                                  } else {
                                                      echo "<a href='activate_student.php?id=".$row['id']."&status=1' class='btn btn-danger'>Inactive</a>"; 
                                                  }
                                              ?> 
                                          </td>
                                           

                                          <td>
                                              <a href="edit_employee.php?id=<?php echo $row['id']; ?>"
                                                ><i class="fa fa-edit"></i></a>
                                              <a href="delete_employee.php?id=<?php echo $row['id']; ?>">
                                                <i class="fa fa-trash " aria-hidden="true"></i></a>
                                          </td>
                                      </tr>
                                  <?php }
                              } else {
                                  echo "<tr><td colspan='4'>No data found</td></tr>";
                              }
                              ?>        
            </tbody>
          </table>
        </div>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>
