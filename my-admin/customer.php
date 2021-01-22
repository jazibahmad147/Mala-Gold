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
            <h1 class="m-0 text-dark">Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
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
                <h3 class="card-title"><li class="fas fa-user-plus"> </li> Add Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="customer_form" action="includes/add_customer_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="c_name">Customer Name</label>
                        <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter Customer Name" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                    <div class="form-group">
                        <label for="c_cnic">Customer CNIC</label>
                        <input type="text" class="form-control" id="c_cnic" name="c_cnic" placeholder="Enter Customer CNIC Number">
                    </div>
                    <div class="form-group">
                        <label for="c_address">Customer Address</label>
                        <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Enter Customer Address" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="c_phone">Customer Phone</label>
                        <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Enter Customer Phone">
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
                  <th>No</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>CNIC</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  $query = mysqli_query($con,"SELECT * FROM customers ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_customer('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_customer_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_customer('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_customer_modal"> <i class="fa fa-trash"></i> Delete Record</a>
                      </div>
                    </div>';

                    echo "<tr>
                            <td>".$x."</td>
                            <td>".$result['customerId']."</td>
                            <td>".$result['name']."</td>
                            <td>".$result['cnic']."</td>
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


<!-- Delete customer modal... -->
<div class="modal fade" id="delete_customer_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete customer record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_customer" action="includes/delete_customer.php" method="post">
          <input type="hidden" id="delete_customer_id" name="delete_customer_id">
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



<!-- update customer... -->
<div class="modal fade" id="edit_customer_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-user"></li> Update customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_customer" action="includes/update_customer_process.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="edit_c_name">Customer Name</label>
                <input type="text" class="form-control" id="edit_c_name" name="edit_c_name" placeholder="Enter Customer Name" oninput="this.value = this.value.toUpperCase()" required>
                <input type="hidden" id="edit_c_id" name="edit_c_id">
            </div>
            <div class="form-group">
                <label for="edit_c_cnic">Customer CNIC</label>
                <input type="text" class="form-control" id="edit_c_cnic" name="edit_c_cnic" placeholder="Enter Customer CNIC">
            </div>
            <div class="form-group">
                <label for="edit_c_address">Customer Address</label>
                <input type="text" class="form-control" id="edit_c_address" name="edit_c_address" placeholder="Enter Customer Address" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="form-group">
                <label for="edit_c_phone">Customer Phone</label>
                <input type="text" class="form-control" id="edit_c_phone" name="edit_c_phone" placeholder="Enter Customer Phone">
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