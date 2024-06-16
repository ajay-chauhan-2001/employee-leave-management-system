<?php
session_start();
    include('config.php');
   include('header.php');
  
  
       $id = $_GET['id'];
       // echo $id;die();

  $sql = "SELECT * FROM site_settings WHERE id = '$id'";
  // echo $sql;die();
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $existing_image = $row['logo'];
  if(isset($_POST['submit']))
    { 
       $id = $_GET['id'];
       // echo $id;die();

        $title = $_POST['title']; 
        // echo $title;die();
        // $logo = $_POST['logo'];

        // echo $email;die();
        // $favicon = $_POST['favicon'];
        $email = $_POST['email']; 
        $mobile = $_POST['mobile'];
        $copyright = $_POST['copyright']; 
        $devby = $_POST['devby'];
        

        // echo $password;die();


        if($_FILES["logo"]["name"])
        {
          $filename = $_FILES["logo"]["name"];
          $tempname = $_FILES["logo"]["tmp_name"];
          $folder = "image/".$filename;
        // echo $folder;die();

        }
        else
        {
          $filename = $existing_image;
        }
        
        $sql = "update `site_settings` set `app_title`='$title',`logo`='$filename',
        `email`='$email',`mobile` = '$mobile',`copyright` = '$copyright',`developed_by`='$devby' where id = '$id'";
        // $sql = "update `site_settings` set `app_title`='$title',`logo`='$filename',
        // `favicon`='$favicon',
        // `email`='$email',`mobile` = '$mobile',`copyright` = '$copyright',`developed_by`='$devby' where id = '$id'";
        // echo $sql;die();

        
        if(mysqli_query($con,$sql))
        {
                 echo "<h3> Data Updated successfully!</h3>";

            if($_FILES["logo"]["name"])
            {
              move_uploaded_file($tempname,$filename);
            }
            
                 // echo "<h3> Image uploaded successfully!</h3>";
                 // header("location:dashboard.php");
               // echo "inserted";
               echo "<script>
                window.loacation('index.php');
               </script>";
        }
       else
        {
            echo "something went wrong. please try again later";
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
                <i class="fas fa-cogs fa-sm fa-fw " style="margin-right: 0rem;"></i>
                Site Settings
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
                <form action="site_settings.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                    <div class="table-response">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>App Title
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="title" class="form-control"value="<?php echo $row['app_title'] ;?>">
                                         <!-- <p id="name-error"><?php if(isset($error['n'])) echo $error['n'];?></p> -->

                                    </td>
                                </tr>
                                <tr>
                                    <th>Logo
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <img src="image/<?php echo $row['logo']; ?>" width="80" height="80"><br><br>

                                        <input type="file" name="logo" >
                                         <!-- <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p> -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>Favicon
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <img src="image/<?php echo $row['favicon']; ?>" width="80" height="80"><br><br>

                                        <input type="file" name="favicon">
                                        <!--  <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p> -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="email" class="form-control" value="<?php echo $row['email'] ;?>">
                                         <!-- <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p> -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mobile No
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile'] ;?>">
                                         <!-- <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p> -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>Copyright
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="copyright" class="form-control" value="<?php echo $row['copyright'] ;?>">
                                         <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p>
                                    </td>
                                </tr><tr>
                                    <th>Developed By
                                        <span class="asterisk" style="color: red;">*</span>
                                    </th>
                                    <td>
                                        <input type="text" name="devby" class="form-control" value="<?php echo $row['developed_by'] ;?>">
                                         <p id="name-error" ><?php if(isset($error['desc'])) echo $error['desc'];?></p>
                                    </td>
                                </tr>

                            </tbody>

                            
                        </table>
                            
                        <div class="float-right">
                            <button class="btn btn-success" name="submit">Save</button>
                            <a href="index.php" class="btn btn-primary" >Cancel</a>
                            
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>      
    </div>
</body>
</html>
<?php include('footer.php'); ?>


