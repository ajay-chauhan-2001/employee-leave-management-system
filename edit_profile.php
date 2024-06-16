<?php
session_start();
include('config.php');
include('header.php');

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$existing_image = $row['image'];

$message = ""; 

if(isset($_POST['submit'])) { 
    $id = $_GET['id'];

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $number = $_POST['number'];
    $birth_date = $_POST['birth_date'];

    if($_FILES["image"]["name"]) {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "image/".$filename;
    } else {
        $filename = $existing_image;
    }

    $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `image`='$filename', `password`='$password', `number`='$number', `birth_date`='$birth_date' WHERE id='$id'";
    
    if(mysqli_query($con,$sql)) {
        $_SESSION['profile_update_success'] = "Profile updated successfully!";
        // No need to redirect here
    } else {
        $message = "Something went wrong. Please try again later.";
        $message_class = "alert-danger";
    }
}
?>

<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xl px-4 mt-4">
      <?php if(!empty($message)): ?>
                            <div class="alert <?php echo $message_class; ?>" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if(!empty($_SESSION['profile_update_success'])): ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['profile_update_success']; ?></div>
                            <?php unset($_SESSION['profile_update_success']); ?>
                        <?php endif; ?>
        <div class="row">

            <div class="col-xl-4">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <img class="rounded-circle mt-5" src="image/<?php echo $row['image'];?>">
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- Edit Profile Card -->
                <div class="card mb-4">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        
                        <form  action="edit_profile.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                           <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input type="name" class="form-control" name="name" placeholder="enter  your name" value="<?php echo $row['name'] ;?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Email Id</label>
                               <input type="email" class="form-control" name="email" placeholder="enter email id" value="<?php echo $row['email'] ;?>">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Password</label>
                                <input type="text" class="form-control"  name="password" placeholder="enter Password" value="<?php echo $row['password'];?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Phone Number</label>
                                <input type="text" class="form-control" name ="number" placeholder="enter Phoneno" value="<?php echo $row['number'];?>">
                            </div>

                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Birth Date</label>
                                <input type="date" class="form-control"  name="birth_date" placeholder="enter birth_date" value="<?php echo $row['birth_date'];?>">
                            </div>
                            
                            
                        </div>
                        
                         <input type="file" class="form-control" name="image" value="<?php echo $row['image'];?>"><br>
                        
                           <div class="float-right">
                               <button class="btn btn-success" name="submit">Save</button>
                               <a href="index.php" class="btn btn-secondary">Cancel</a>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

<?php include('footer.php'); ?>
