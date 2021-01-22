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
            <h1 class="m-0 text-dark">Pathor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pathor</li>
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
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><li class="fas fa-plus-circle"> </li> Add Pathor</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="add_pathor_stock_form" action="includes/add_pathor_stock_process.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                  <div class="form-group">
                      <label for="datePathor">Date</label>
                      <input type="date" class="form-control" id="datePathor" name="datePathor" value="<?php echo date("Y-m-d"); ?>" required>
                  </div>
                  <div class="form-group">
                      <label for="weightPathor">Weight</label>
                      <input type="text" class="form-control" id="weightPathor" name="weightPathor" placeholder="Enter Total Weight">
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" name="addToPathor" class="btn btn-primary" value="Add Pathor">
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-8"> 
          <!-- DataTable... -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Scrab Items</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form id="create_pathor_stock_form" action="includes/pathor_creation_process.php" method="post">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Karat</th>
                  <th>Weight</th>
                  <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                  
                <?php 

                    // $query = mysqli_query($con,"SELECT * FROM scrab_stock ORDER BY date DESC");
                    $query = mysqli_query($con,"SELECT * FROM cart ORDER BY id DESC");
                  

                  $x = 1;
                  $count = 0;
                  include_once('database/connection.php');
                  $previoustotalWeight = 0;
                  $previoustotalPrice = 0;
                  // $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                  while($idResult = mysqli_fetch_array($query)){
                    $id = $idResult['id'];
                    $fetchScrab = mysqli_query($con,"SELECT * FROM scrab_stock WHERE id='$id'");
                    while($result = mysqli_fetch_array($fetchScrab)){
                      $previoustotalWeight += $result['pure_weight'];
                      $previoustotalPrice += $result['purePrice'];

                      echo '<input type="text" name="scrabIds'.$count.'" value="'.$result['scrabId'].'" style="display:none;">';
                      $count++;
                      // $removeFromCart = '<form method="post">
                      //                   <input type="hidden" name="scrabId" value="'.$id.'">
                      //                   <input type="submit" name="removeFromCart" class="btn btn-danger" value="-">
                      //                 </form> ';

                      // Rounding weight...
                      // $tola = $result['weight'] / 11.664;
                      // $roundWeight = number_format((float)$tola, 3, '.', '');
                      
                      $image_path = "media/stock/scrab_stock/".$result['image'];
                      $image_name = $result['image'];

                      echo "<tr>
                              <td>".$x."</td>
                              <td><img src='".$image_path."' width='50' onclick='view_scrab_item_image(".$id.")' data-toggle='modal' data-target='#view_scrab_item_image_modal'></td>
                              <td>".$result['name']."</td>
                              <td>".$result['karat']."</td>
                              <td>".$result['pure_weight']."</td>
                      </tr>";
                    }
                    $x++;
                  }
                ?>
                </tbody>
              </table><br>
                  <input type="hidden" name="count" value="<?php echo $count; ?>">
                  <label for="totalPreviousWeight">Total Previous Weight:</label>
                  <input type="text" name="previoustotalWeight" class="form-control form-control-sm" value="<?php echo $previoustotalWeight; ?>" readonly><br>
                  <label for="totalPreviousWeight">Total Previous Price:</label>
                  <input type="text" name="previoustotalPrice" class="form-control form-control-sm" value="<?php echo $previoustotalPrice; ?>" readonly><br>
                  <label for="totalWeight">Total New Weight:</label>
                  <input type="text" name="totalWeight" class="form-control form-control-sm" placeholder="Total Weight" required><br>
                  <input type="submit" name="convertToPathor" class="btn btn-primary" value="Convert To Pathor">
              </form><br>
              <form id="remove_from_pathor_cart_form" action="includes/remove_from_pathor_cart.php" method="post">
                <input type="submit" name="removeFromCart" class="btn btn-danger" value="Clear Cart" >
              </form>
            </div>
        </div>
        </div>
        <br>
      </div>
      <div class="row">
        <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><li class="fas fa-users"> </li> Manage Pathor</h3>
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
                  $query = mysqli_query($con,"SELECT * FROM gold_pathor_stock ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];

                    // Fetching rate by date...
                    $category = "pathor";
                    $date = date("Y-m-d");
                    $fetch_query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$category'";
                    $fetch_query_result = $con->query($fetch_query);
                    $fetch_query_result_row = $fetch_query_result->fetch_array();
                    $price_fetched = $fetch_query_result_row[0];
                    // price generation 
                    if($result['weight'] == 0){
                      $weight = $result['previousTotalWeight'];
                    }else{
                      $weight = $result['weight'];
                    }
                    $previousPrice = $result['previousTotalPrice'];
                    $tola = $weight / 11.664;
                    $totalPrice = ($price_fetched * $tola);
                    $roundTotalPrice = round($totalPrice);
                    $profit = $roundTotalPrice - $previousPrice;



                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_gold_pathor_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_gold_pathor_stock_item_modal"> <i class="fa fa-print"></i> Print Barcode </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_pathor('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_pathor_modal"> <i class="fa fa-trash"></i> Return Record</a>
                      </div>
                    </div>';

                    echo "<tr>
                            <td>".$result['barcode']."</td>
                            <td>".$result['date']."</td>
                            <td>".$weight."</td>
                            <td>".$previousPrice."</td>
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
  </div>
</section>

<?php

  function addToPathor($id){
    include("database/connection.php");
    
    $sql = "DELETE FROM cart WHERE id='$id'";
    mysqli_query($con, $sql);
  }

  if(isset($_POST['removeFromCart'])){
    $id = $_POST['scrabId'];
    addToPathor($id);
  }

?>


<!-- View Barcode OF Item Modal  -->
<div class="modal fade" id="barcode_gold_pathor_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Barcode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="" action="" method="post">
        <input type="hidden" id="barcode_pathor_id" name="barcode_pathor_id">
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
<div class="modal fade" id="delete_pathor_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete investor record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_pathor" action="includes/delete_gold_pathor.php" method="post">
          <input type="hidden" id="delete_pathor_id" name="delete_pathor_id">
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





<?php
include_once("templates/footer.php");
?>