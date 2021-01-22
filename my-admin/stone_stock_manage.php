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
            <h1 class="m-0 text-dark">Stone Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Stone Stock</li>
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
                <h3 class="card-title"><li class="fas fa-plus-circle"> </li> Add Stone</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add_stone_stock_form" action="includes/add_stone_stock_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Stone Name" oninput="this.value = this.value.toUpperCase()" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Total Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Total Weight" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price Per Gram</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price Of A Single Stone" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="submit" name="addToPiece" class="btn btn-primary" value="Add Stone">
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
              <h3 class="card-title"><li class="fas fa-gem"> </li> Manage Stones</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Weight</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');

                  $query = mysqli_query($con,"SELECT * FROM stones_stock WHERE total_weight>0 ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $date = date("Y-m-d");

                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_stone_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_stone_stock_item_modal"> <i class="fa fa-print"></i> Print Barcode </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_stone('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_stone_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_stone('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_stone_modal"> <i class="fa fa-trash"></i> Delete Record</a>
                      </div>
                    </div>';

                    echo "<tr>
                            <td>".$x."</td>
                            <td>".$result['date']."</td>
                            <td>".$result['name']."</td>
                            <td>".$result['total_weight']."</td>
                            <td>".$result['price']."</td>
                            <td>".$result['total_weight'] * $result['price']."</td>
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


<!-- View Barcode OF Item Modal  -->
<div class="modal fade" id="barcode_stone_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Barcode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="" action="" method="post">
        <input type="hidden" id="barcode_stone_id" name="barcode_stone_id">
    </div>
    <div class="modal-body">
      <center><img id="barcodeId" src="" alt="barcode" width="150" height="100px"></center>
    </div>
    <!--/. modal body -->
    <div class="card-footer">
    <center><button type="button" id="printButton" onlick="location.href=''" class="btn btn-success"><li class="fas fa-print"> </li> Print </button></center>
    </form>
    </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- Delete gold pathor modal... -->
<div class="modal fade" id="delete_stone_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete investor record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_stone" action="includes/delete_stone.php" method="post">
          <input type="hidden" id="delete_stone_id" name="delete_stone_id">
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



<!-- update stone... -->
<div class="modal fade" id="edit_stone_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-user"></li> Update Piece Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_stone_stock" action="includes/update_stone_process.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
            <label for="edit_date">Date</label>
                <input type="date" class="form-control" id="edit_date" name="edit_date" value="<?php echo date("Y-m-d"); ?>" required>
                <input type="hidden" id="edit_stone_id" name="edit_stone_id">
            </div>
            <div class="form-group">
                <label for="edit_name">Name</label>
                <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter Stone Name" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group">
                <label for="edit_weight">Weight</label>
                <input type="text" class="form-control" id="edit_weight" name="edit_weight" placeholder="Enter Total Weight" required>
            </div>
            <div class="form-group">
                <label for="edit_price">Price Per Gram</label>
                <input type="number" class="form-control" id="edit_price" name="edit_price" placeholder="Enter Price Of A Single Stone" required>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-success">Update</button>
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