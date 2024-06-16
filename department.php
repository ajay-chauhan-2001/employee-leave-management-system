<?php 
session_start();
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

<body>
   <?php if (!empty($success_message)): ?>
        <div class="alert alert-success" role="alert" class="close"data-dismiss="alert" aria-label="Close">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

	<div class="container-fluid">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">
				<i class="fas fa-list fa-fw" style="margin-right: 0rem;"></i>
				 Departments List
			</h1>
		</div>
		<!-- <hr class="mt-0 mb-4"> -->
        <div class="card shadow mb-4">
        	<div class="card-header py-3">
        		<a class="btn btn-primary btn-icon" href="add_department.php" >
        			<span class="text">
        				<i class="fas fa-plus" style="margin-right: 0rem;"></i>
        			</span>
        			<span class="text">Add Department</span>
				</a>
        	</div>
        	<div class="card-body">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <td>SrNo</td>
                      <td>Name</td>
                      <!-- <td>Description</td> -->
                      <!-- <td>quantity</td> -->
                      <!-- <td>Image</td> -->
                      <td>Action</td>

                    </tr>
                  </thead>
                  <tbody>
                        <?php

                          $sql="select * from departments where active=1 ";
                          $result = mysqli_query($con,$sql);
                          
                        
                              if ($result->num_rows > 0)
                               {
                                  $i=1;
                                  while ($row = $result->fetch_assoc()) 
                                  { 
                                   
                                    ?>
                                      <tr>
                                          <td><?php echo $i++; ?></td>

                                          
                                          <td><?php echo $row['name']; ?></td>
                                          <!-- <td><?php echo $row['description']; ?></td> -->
                                          <!-- <td><?php echo $row['quantity']; ?></td> -->
                                         
                                          <!-- <td>
                                                  <img src="image/<?php echo $row['image']; ?>" width="80" height="80">
                                          </td> -->

                                          <td>
                                              <a href="edit_department.php?id=<?php echo $row['id']; ?>"
                                                style="color: #3260cb !important;"><i class="fa fa-edit"></i></a>
                                              <a style="color: #3260cb !important;" href="delete_department.php?id=<?php echo $row['id']; ?>">
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