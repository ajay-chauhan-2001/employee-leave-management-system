<?php
ob_start();
session_start();
include('header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>department</title>
</head>

<?php
include('config.php');
$id=$_GET["id"];
$sql="select * from departments where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$name=$row["name"];
// $price=$row["price"];
// $desc=$row["description"];
// $mobile=$row["number"];

if (isset($_POST["submit"]))
{
  $name = $_POST["name"];
  // $price = $_POST["price"];
  // $desc = $_POST["description"];
  // $cid = $_POST["cat_id"];
  // echo $cid;die();

   
          $sql="update departments set id=$id,name='$name' where id=$id";
         
        $result = mysqli_query($con,$sql);
        if($result){
      //   echo "data  updated successfully ";
        $_SESSION['edit_success'] = "department updated successfully!";
          header("Location:department.php"); 
        }
  else
  {
    die(mysqli_error($con));
  }

}
?>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-plus fa-fw" style="margin-right: 0rem;"></i>
                Edit Category
            </h1>
        </div>
        <hr class="mt-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="table-response">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name
                                        <!-- <span class="asterisk" style="color: red;">*</span> -->
                                    </th>
                                    <td>
                                        <input type="text" name="name" class="form-control"value="<?php echo $name?>">
                                         <p id="name-error" ><?php if(isset($error['n'])) echo $error['n'];?></p>

                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th>Description
                                         --><!-- <span class="asterisk" style="color: red;">*</span> -->
                                    <!-- </th>
                                    <td>
                                        <input type="text" name="description" class="form-control" value="<?php echo $desc?>">
                                         <p id="name-error" ><?php if(isset($error['p'])) echo $error['p'];?></p>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <th>quantity
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="quantity" class="form-control" value="<?php echo $quantity?>">
                                         <p id="name-error" ><?php if(isset($error['q'])) echo $error['q'];?></p>
                                    </td>
                                </tr> -->
                               <!--  <tr>
                                    <th>Image
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="file" name="image" class="form-control">
                                         <p id="name-error" ><?php if(isset($error['img'])) echo $error['img'];?></p>
                                    </td>
                                </tr> -->
                                
                            </tbody>

                            
                        </table>
                            
                        <div class="float-right">
                            <button class="btn btn-success" name="submit">Save</button>
                            <a href="product.php" class="btn btn-primary" >Cancel</a>
                            
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>      
    </div>
</body>
</html>
<?php include('footer.php'); ?>


