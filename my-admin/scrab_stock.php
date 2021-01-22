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
            <h1 class="m-0 text-dark">Scrab</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Scrab</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- <div class="row"> -->
          <!-- left column -->
          <!-- <div class="col-md-4"> -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Scrab</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="add_scrab_stock" action="includes/add_scrab_stock_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="customer">Customer Name</label>
                                    <div class="input-group">
                                        <select class="form-control custom-select" name="customer" id="customer" required>
                                            <option value="">Select</option>
                                            <?php

                                                $query = "SELECT * FROM `customers` ORDER BY id DESC";
                                                $Result = $con->query($query);
                                                if($Result->num_rows > 0){
                                                    while($row = $Result->fetch_assoc()){
                                                        echo '<option value="'.$row['customerId'].'">'.$row['name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#edit_customer_modal"><li class="fas fa-user-plus"></li></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control form-control-sm" name="category" id="category" required>
                        <option value="">Select</option>
                        <option value="PATHOR" selected>GOLD PATHOR</option>
                        <option value="PIECE">GOLD PIECE</option>
                        <option value="SILVER">SILVER</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="p_name">Name</label>
                      <input type="text" class="form-control form-control-sm" id="p_name" name="p_name" placeholder="Enter Product Name" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Item Type</label>
                      <select class="form-control form-control-sm" name="productType" required>
                        <option value="">SELECT</option>
                        <option value="NECKLACE">NECKLACE</option>
                        <option value="CHORIAN">CHORIAN</option>
                        <option value="BARACELET">BARACELET</option>
                        <option value="RINGS">RINGS</option>
                        <option value="MEN GOLD RING">MEN GOLD RING</option>
                        <option value="CHILD GOLD RING">CHILD GOLD RING</option>
                        <option value="NOSEPIN">NOSEPIN</option>
                        <option value="NATHLIAN">NATHLIAN</option>
                        <option value="TOPS">TOPS</option>
                        <option value="EARING">EARING</option>
                        <option value="BALIAN">BALIAN</option>
                        <option value="CHAIN">CHAIN</option>
                        <option value="MALA SET">MALA SET</option>
                        <option value="DIAMOND JEWELLERY">DIAMOND JEWELLERY</option>
                        <option value="SILVER JEWELLERY">SILVER JEWELLERY</option>
                        <option value="GOLD JEWELLERY">GOLD JEWELLERY</option>
                        <option value="GEMSTONES">GEMSTONES</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Select Karats</label>
                      <select class="form-control form-control-sm" name="karat" id="karat" onchange="calPricing()">
                        <option value="">Select</option>
                        <option value="24">24.00 Karat</option>
                        <option value="23">23.00 Karat</option>
                        <option value="22">22.00 Karat</option>
                        <option value="21">21.00 Karat</option>
                        <option value="20">20.00 Karat</option>
                        <option value="19" selected>19.00 Karat</option>
                        <option value="18">18.00 Karat</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="weight">Weight (gram)</label>
                      <input type="text" class="form-control form-control-sm" id="weight" name="initial_weight" onchange="calPricing()" autofocus placeholder="Enter Weight in Gram" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="dust">Dust</label>
                      <input type="text" class="form-control form-control-sm" id="dust" name="dust" value="0" onchange="calPricing()" placeholder="Enter Dust in Gram" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col-md-1"></div> -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="ratiMashy">Rati Mashy (%)</label>
                      <input type="text" class="form-control form-control-sm" id="ratiMashy" name="ratiMashy" value="0" onchange="calPricing()" placeholder="Enter Rati Mashy Percent" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nag">Nag</label>
                      <input type="text" class="form-control form-control-sm" id="nag" name="nag" value="0" onchange="calPricing()" placeholder="Enter Nag Weight In Gram" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="labFee">Lab Fee</label>
                      <input type="text" class="form-control form-control-sm" id="labFee" name="labFee" value="0" onchange="calPricing()" placeholder="Enter Lab Fee" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="discount">Discount</label>
                      <input type="text" class="form-control form-control-sm" id="discount" name="discount" onchange="calPricing()" value="0" placeholder="Enter Discount">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="etc">ETC</label>
                      <input type="text" class="form-control form-control-sm" id="etc" name="etc" onchange="calPricing()" value="0" placeholder="Enter Discount">
                    </div></div>
                  <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputFile">Choose File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <!-- <input type="file" id="exampleInputFile" name="stock_image"> -->
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="karatSelected0"><input type="radio" id="karatSelected0" name="karatSelected" onchange="calPricing()"><span id="pure0"></span></label>
                      <input type="radio" id="priceSelected00" name="priceSelected" hidden>
                      <input type="radio" id="weightSelected0" name="weightSelected" hidden>
                      <input type="number" class="form-control form-control-sm" id="priceSelected0" name="purePrice" readonly>
                      <input type="text" class="form-control form-control-sm" id="pureWeight0" name="pureWeight0" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="purePrice"><input type="radio" id="karatSelected10" name="karatSelected" onchange="calPricing()"><span id="pure25"></span></label>
                      <input type="radio" id="priceSelected10" name="priceSelected" hidden>
                      <input type="radio" id="weightSelected10" name="weightSelected" hidden>
                      <input type="number" class="form-control form-control-sm" id="priceSelected1" name="purePrice" readonly>
                      <input type="text" class="form-control form-control-sm" id="pureWeight1" name="pureWeight1" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="purePrice"><input type="radio" id="karatSelected20" name="karatSelected" checked onchange="calPricing()"><span id="pure50"></span></label>
                      <input type="radio" id="priceSelected20" name="priceSelected" hidden>
                      <input type="radio" id="weightSelected20" name="weightSelected" hidden>
                      <input type="number" class="form-control form-control-sm" id="priceSelected2" name="purePrice" readonly>
                      <input type="text" class="form-control form-control-sm" id="pureWeight2" name="pureWeight2" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="purePrice"><input type="radio" id="karatSelected30" name="karatSelected" onchange="calPricing()"><span id="pure75"></span></label>
                      <input type="radio" id="priceSelected30" name="priceSelected" hidden>
                      <input type="radio" id="weightSelected30" name="weightSelected" hidden>
                      <input type="number" class="form-control form-control-sm" id="priceSelected3" name="purePrice" readonly>
                      <input type="text" class="form-control form-control-sm" id="pureWeight3" name="pureWeight3" readonly>
                    </div>
                  </div>
                </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="text-align: center;">
                  <button type="submit" style="width: 500px" class="btn btn-success"><i class="fas fa-box-open nav-icon"></i> Add Scrab</button>
                </div>
              </form>
            </div>
            
            <!-- /.card -->
          <!-- </div> -->
        <!-- 2nd column... -->
        <div class="col-md-12">
          
    <!-- DataTable... -->
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manage Scrab</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Name</th>
                  <th>Karat</th>
                  <th>Weight</th>
                  <th>ETC</th>
                  <th>Discount</th>
                  <th>Pure Price</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $query = mysqli_query($con,"SELECT * FROM scrab_stock WHERE status='1' ORDER BY date DESC");
                  

                  $x = 1;
                  include_once('database/connection.php');
                  // $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $custId = $result['customer'];
                    
                    $customerQuery = "SELECT `name` FROM `customers` WHERE customerId = '$custId'";
                    $cutomerResult = $con->query($customerQuery);
                    $result_row = $cutomerResult->fetch_array();
                    $custName = $result_row[0];

                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_scrab_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_scrab_item_modal"> <i class="fa fa-print"></i> Print Barcode </a>
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_scrab_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_scrab_item_modal"> <i class="fa fa-trash"></i> Delete Item </a>
                      </div>
                    </div>';
                    
                    // $addToPathor = '<a href="#?&id="'.$id.' type="button" class="btn btn-success" onclick="'.addToPathor($id).'"><i class="fa fa-plus-circle"></i></a>';
                    $addToPathor = '<form method="post">
                                      <input type="hidden" name="scrabId" value="'.$id.'">
                                      <input type="submit" name="addToCart" class="btn btn-success" value="+">
                                    </form> ';

                    // Rounding weight...
                    // $tola = $result['weight'] / 11.664;
                    // $roundWeight = number_format((float)$tola, 3, '.', '');
                    
                    $image_path = "media/stock/scrab_stock/".$result['image'];
                    $image_name = $result['image'];

                    echo "<tr>
                            <td>".$x."</td>
                            <td><img src='".$image_path."' width='50' onclick='view_scrab_item_image(".$id.")' data-toggle='modal' data-target='#view_scrab_item_image_modal'></td>
                            <td>".$result['date']."</td>
                            <td>".$custName."</td>
                            <td>".$result['name']."</td>
                            <td>".$result['karat']."</td>
                            <td>".$result['pure_weight']."</td>
                            <td>".$result['etc']."</td>
                            <td>".$result['discount']."</td>
                            <td>".$result['purePrice']."</td>
                            <td>".$button."</td>
                            <td>".$addToPathor."</td>
                    </tr>";
                    $x++;
                  }
                ?>
                </tbody>
              </table>
            </div>
        </div>
        <br>
    </div>
</div>
</section>

<?php
function addToPathor($id){
  include("database/connection.php");
  // Checking ids recurring...
  $check = "SELECT * FROM `cart` WHERE id = '$id'";
  $result = mysqli_query($con, $check);
  $num = mysqli_num_rows($result);

  if($num == 1){
      echo "<script>alert('This item is already in cart.')</script>";
  }else{
    $sql = "INSERT INTO cart (id) VALUES ('$id')";
    mysqli_query($con, $sql);
    echo "<script>alert('Added Successfully.')</script>";
  }
}

if(isset($_POST['addToCart'])){
  $id = $_POST['scrabId'];
  addToPathor($id);
}
?>



<!-- Add customer... -->
<div class="modal fade" id="edit_customer_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-user"></li> Add customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="customer_form" action="includes/add_customer_process.php" method="post" enctype="multipart/form-data">
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
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- Delete gold pathor modal... -->
<div class="modal fade" id="delete_scrab_item_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to delete this item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_scrab_item" action="includes/delete_scrab_item.php" method="post">
          <input type="hidden" id="delete_scrab_id" name="delete_scrab_id">
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

<!-- View Barcode OF Item Modal  -->
<div class="modal fade" id="barcode_scrab_item_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Barcode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="" action="" method="post">
        <input type="hidden" id="scrab_item_id" name="scrab_item_id">
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

<!-- View Stock Item Image Modal  -->
<div class="modal fade" id="view_scrab_item_image_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <img id="imageId" src="" alt="" width="auto">
        <!--/. modal body -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php
include_once("templates/footer.php");
?>