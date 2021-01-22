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
            <h1 class="m-0 text-dark">Piece</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Piece</li>
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
                <h3 class="card-title"><li class="fas fa-plus-circle"> </li> Add Piece</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add_piece_stock_form" action="includes/add_piece_stock_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="datePiece">Date</label>
                        <input type="date" class="form-control" id="datePiece" name="datePiece" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="weightPiece">Weight</label>
                        <input type="text" class="form-control" id="weightPiece" name="weightPiece" placeholder="Enter Total Weight">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="submit" name="addToPiece" class="btn btn-primary" value="Add Piece">
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
              <h3 class="card-title"><li class="fas fa-users"> </li> Manage Pieces</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Weight</th>
                  <th>Price</th>
                  <th>Today's Price</th>
                  <th>Profit</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  // Price fetching 
                    $today = date("Y-m-d");
                    $query = "SELECT * FROM `rate_list` WHERE category = 'piece' AND date = '$today'";
                    $Result = $con->query($query);
                    $result_row = $Result->fetch_array();
                    $rate = $result_row['buying'];

                  $query = mysqli_query($con,"SELECT * FROM gold_piece_stock ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];

                    // Fetching rate by date...
                    $category = "piece";
                    $date = date("Y-m-d");
                    $fetch_query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$category'";
                    $fetch_query_result = $con->query($fetch_query);
                    $fetch_query_result_row = $fetch_query_result->fetch_array();
                    $price_fetched = $fetch_query_result_row[0];
                    // price generation
                    $weight = $result['weight'];
                    $previousPrice = $result['initial_price'];
                    $tola = $weight / 11.664;
                    $totalPrice = ($price_fetched * $tola);
                    $roundTotalPrice = round($totalPrice);
                    $profit = $roundTotalPrice - $previousPrice;

                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_gold_piece_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_gold_piece_stock_item_modal"> <i class="fa fa-print"></i> Print Barcode </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_piece('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_piece_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_piece('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_piece_modal"> <i class="fa fa-trash"></i> Delete Record</a>
                      </div>
                    </div>';

                    echo "<tr>
                            <td>".$result['barcode']."</td>
                            <td>".$result['date']."</td>
                            <td>".$result['weight']."</td>
                            <td>".$result['initial_price']."</td>
                            <td>".$roundTotalPrice."</td>
                            <td>".$profit."</td>
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
<div class="modal fade" id="barcode_gold_piece_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Barcode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="" action="" method="post">
        <input type="hidden" id="barcode_piece_id" name="barcode_piece_id">
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
<div class="modal fade" id="delete_piece_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete investor record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_piece" action="includes/delete_gold_pathor.php" method="post">
          <input type="hidden" id="delete_piece_id" name="delete_piece_id">
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



<!-- update piece... -->
<div class="modal fade" id="edit_piece_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-user"></li> Update Piece Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_piece" action="includes/update_piece_process.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="edit_piece_date">Date</label>
                <input type="date" class="form-control" id="edit_piece_date" name="edit_piece_date" required>
                <input type="hidden" id="edit_piece_id" name="edit_piece_id">
            </div>
            <div class="form-group">
                <label for="edit_piece_weight">Piece Weight</label>
                <input type="text" class="form-control" id="edit_piece_weight" name="edit_piece_weight" required>
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