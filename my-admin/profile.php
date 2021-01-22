<?php
include_once("templates/header.php");
?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Fetching user details from database... -->
<?php

$query = "SELECT * FROM `admin_user` WHERE email = '$email'";
$Result = $con->query($query);
$result_row = $Result->fetch_array();

$id = $result_row[0];
$name = $result_row[1];
$email = $result_row[2];
$image = $result_row[4];

if($image == ""){
    $image = "default-image.png";
}


?>


<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- <div class="row"> -->
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><li class="fas fa-user"> </li> Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="profile_form" action="includes/update_profile_process.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div style="text-align:center">
                        <img src="media/profiles/<?php echo $image; ?>" alt="Profile Image" style="width:40%;"><br><br>
                        <button type="button" class="btn btn-info" onclick="update_profile_image()" data-toggle="modal" data-target="#update_profile_image_modal">Change Image</button>
                    </div>
                    <hr>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Your Name" value="<?php echo $name; ?>" required>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>
                        <div class="col" style="text-align: right;">
                            <button type="button" class="btn btn-danger" onclick="update_profile_password()" data-toggle="modal" data-target="#update_profile_password_modal">Change Password</button>
                        </div>
                    </div>
                </div>
              </form>
            </div>
            <br>
            
            <!-- /.card -->
        </div>
        <!-- 2nd column... -->
            <!-- </div> -->
        </div>
        
    </div>
<!-- </div> -->
</section>


<!-- update profile image  -->
<div class="modal fade" id="update_profile_image_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Change Image</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="update_profile_image" action="includes/update_profile_image_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="profile_id" value="<?php echo $id; ?>">
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputFile">Choose File</label>
            <div class="input-group">
                <div class="custom-file">
                <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
        </div>
    </div>
    <!--/. modal body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success"> Update </button>
    </form>
    </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- update profile image  -->
<div class="modal fade" id="update_profile_password_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Change Password</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="update_profile_password" action="includes/update_profile_password_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="profile_id" value="<?php echo $id; ?>">
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="currentPassword">Current Password</label>
            <input type="password" class="form-control form-control-sm" id="currentPassword" name="currentPassword" placeholder="Enter Your Current Password">
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword" placeholder="Enter Your New Password">
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control form-control-sm" id="confirmPassword" name="confirmPassword" placeholder="Confirm Your New Password">
        </div>
    </div>
    <!--/. modal body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-success"> Update Password </button>
    </form>
    </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<?php
include_once("templates/footer.php");
?>