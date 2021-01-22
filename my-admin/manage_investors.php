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
            <h1 class="m-0 text-dark">Investors</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Investors</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><li class="fas fa-user-plus"> </li> Add Investor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="investor_form" action="includes/add_Investors_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="i_name">Investor Name</label>
                        <input type="text" class="form-control" id="i_name" name="i_name" placeholder="Enter Investor Name" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="form-group">
                        <label for="i_address">Investor Address</label>
                        <input type="text" class="form-control" id="i_address" name="i_address" placeholder="Enter Investor Address" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="form-group">
                        <label for="i_phone">Investor Phone</label>
                        <input type="text" class="form-control" id="i_phone" name="i_phone" placeholder="Enter Investor Phone" required>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </form>
            </div>
            
            <!-- /.card -->
        </div>
        <!-- 2nd column... -->
        <div class="col-md-8">
          
    <!-- DataTable... -->
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><li class="fas fa-users"> </li> Manage Investors</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  $query = mysqli_query($con,"SELECT * FROM investors ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_investor('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_investor_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_investor('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_investor_modal"> <i class="fa fa-trash"></i> Delete Record</a>
                      </div>
                    </div>';

                    echo "<tr>
                            <td>".$result['investorId']."</td>
                            <td>".$result['name']."</td>
                            <td>".$result['address']."</td>
                            <td>".$result['phone']."</td>
                            <td>".$button."</td>
                    </tr>";
                    $x++;
                  }
                ?>
                </tbody>
              </table>
            </div>
        </div>
        
    </div>
</div>
</section>


<!-- Delete gold pathor modal... -->
<div class="modal fade" id="delete_investor_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete investor record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_investor" action="includes/delete_investor.php" method="post">
          <input type="hidden" id="delete_investor_id" name="delete_investor_id">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" id="updateButton">Yes</button>
        
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- update investor... -->
<div class="modal fade" id="edit_investor_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-user"></li> Update Investor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_investor" action="includes/update_investor_process.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="edit_i_name">Investor Name</label>
                <input type="text" class="form-control" id="edit_i_name" name="edit_i_name" placeholder="Enter Investor Name" oninput="this.value = this.value.toUpperCase()" required>
                <input type="hidden" id="edit_i_id" name="edit_i_id">
            </div>
            <div class="form-group">
                <label for="edit_i_address">Investor Address</label>
                <input type="text" class="form-control" id="edit_i_address" name="edit_i_address" placeholder="Enter Investor Address" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group">
                <label for="edit_i_phone">Investor Phone</label>
                <input type="text" class="form-control" id="edit_i_phone" name="edit_i_phone" placeholder="Enter Investor Phone" required>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
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