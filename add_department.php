<?php
ob_start();
session_start();
 include('header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>category</title>
</head>

<?php
include('config.php');
if (isset($_POST['submit']))
 {
    $name=$_POST['name'];
    // $desc=$_POST['description'];
    // $quantity=$_POST['quantity'];
    // $number=$_POST['number'];
    // $image = $_FILES['image']['name'];                                                                                                           
    // $target_dir = "image/";
    // // echo $target_dir;die();
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // echo $target_file;die();

    $error=array();
    if(empty($name))
    {
        $error['n'] = 'name requires';
    }
    
    // if(empty($desc)){
    //     $error['desc'] = 'description required';
    // }
    // if(empty($number)){
    //     $error['q'] = 'quantity requires';
    // }
    // // if(empty($password)){
    // //     $error['p'] = 'password requires';
    // // }
    // if(empty($image)){
    //     $error['img'] = 'image requires';
    // }

     if(count($error) == 0)
    {
    if (!empty($name)) 
    {
         $sql="insert into departments (name,active)
                values ('$name',1)";
       
         if ($con->query($sql) === true)
      {
        $_SESSION['add_success'] = "Department added successfully!";
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        // echo "yes";
        header('location:department.php');
        exit();
    }
    else
    {
        echo "no";
    }
}
}
    else {
        // $error_message = "Please select  product";

    }
   
    

    
}
 ?>

 <style type="text/css">
     p{
        background-color: red;
        color: white;
     }
 </style>
<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus fa-fw" style="margin-right: 0rem;"></i>
                Add Department
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="table-response">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="name" class="form-control">
                                         <p id="name-error"><?php if(isset($error['n'])) echo $error['n'];?></p>

                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th>Description
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <textarea type="text" name="description" class="form-control"></textarea>                
                                         <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p>
                                    </td>
                                </tr> -->
                            </tbody>

                            
                        </table>
                            
                        <div class="float-right">
                            <button class="btn btn-success" name="submit">Save</button>
                            <a href="department.php" class="btn btn-primary" >Cancel</a>
                            
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>      
    </div>
</body>
</html>
<?php include('footer.php'); ?>


