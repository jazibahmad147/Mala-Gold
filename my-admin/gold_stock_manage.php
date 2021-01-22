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
            <h1 class="m-0 text-dark">Gold Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Gold stock</li>
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
                <h3 class="card-title">Add Stock</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start add_gold_stock-->
              <form id="add_gold_stock" action="includes/add_gold_stock_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Select Group</label>
                    <select class="form-control" name="group" id="group" onchange="showDiv()"required >
                      <option value="">Select</option>
                      <option value="MAIN" selected>MAIN</option>
                      <option value="FAMILY">FAMILY</option>
                      <option value="INVESTOR">INVESTOR</option>
                    </select>
                  </div>
                  <div class="form-group" id="investorSelectionDiv" style="display:none">
                    <label for="investorName">Select Investor Name</label>
                    <select class="form-control" name="investorName" id="investorName">
                    <option value="">Select</option>
                    <?php

                        $query = "SELECT * FROM `investors` ORDER BY id DESC";
                        $Result = $con->query($query);
                        if($Result->num_rows > 0){
                            while($row = $Result->fetch_assoc()){
                                echo '<option value="'.$row['investorId'].'">'.$row['name'].'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                  <div class="form-group">
                    <label>Select Type</label>
                    <select class="form-control" name="gold_type" required>
                      <option value="">Select</option>
                      <option value="PATHOR" selected>GOLD</option>
                      <option value="PIECE">SILVER</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="p_name">Product Name</label>
                    <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter Product Name" oninput="this.value = this.value.toUpperCase()" required>
                  </div>
                  <div class="form-group">
                    <label>Select Product Type</label>
                    <select class="form-control" name="productType">
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
                  <div class="form-group">
                    <label for="p_description">Product Description</label>
                    <input type="text" class="form-control" id="p_description" name="p_description" placeholder="Enter Product Description" oninput="this.value = this.value.toUpperCase()" required>
                  </div>
                  <div class="form-group">
                    <label>Select Karats</label>
                    <select class="form-control" name="karat">
                      <option value="">Select</option>
                      <option value="24">24 Karat</option>
                      <option value="23">23 Karat</option>
                      <option value="22">22 Karat</option>
                      <option value="21" selected>21 Karat</option>
                      <option value="20">20 Karat</option>
                      <option value="19">19 Karat</option>
                      <option value="18">18 Karat</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="1" placeholder="Enter Quantity" required>
                  </div>
                  <div class="form-group">
                    <label for="weight">Weight (gram)</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight in Gram" required>
                  </div>
                  <!-- <div class="form-group">
                    <label for="extra_charges">Extra Charges (Pkr)</label>
                    <input type="text" class="form-control" id="extra_charges" name="extra_charges" placeholder="Enter Extra Charges in Pkr" required>
                  </div> -->
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
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
              <h3 class="card-title">Manage Stock</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="POST">
              <div class="row">
                <div class="col-md-3">
                  <label for="category">Select Category</label>
                  <select name="type" class="form-control form-control-sm">
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
                  </select><br>
                </div>
                <div class="col-md-3">
                  <label for="category">Select Type</label>
                  <select name="category" class="form-control form-control-sm">
                    <option value="">SELECT</option>
                    <option value="GOLD">GOLD</option>
                    <option value="SILVER">SILVER</option>
                  </select><br>
                </div>
                <div class="col-md-3">
                  <label for="investorName">Select Investor Name</label>
                  <select class="form-control form-control-sm" name="investorName">
                    <option value="">Select</option>
                    <?php

                        $query = "SELECT * FROM `investors` ORDER BY id DESC";
                        $Result = $con->query($query);
                        if($Result->num_rows > 0){
                            while($row = $Result->fetch_assoc()){
                                echo '<option value="'.$row['investorId'].'">'.$row['name'].'</option>';
                            }
                        }
                    ?>
                  </select><br>
                </div>
                <div class="col-md-3"><br>
                  <input type="submit" name="filter" class="btn btn-success" value="FILTER" style="width: 100%;">
                </div>
              </div>
              </form>

              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Weight</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 

                  if(isset($_POST['filter'])){
                    $category = $_POST['category'];
                    $type = $_POST['type'];
                    $investor = $_POST['investorName'];
                    // echo $category." ".$type." ".$investor;
                    if($category != "" && $type == "" && $investor == ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE category = '$category' ORDER BY date DESC");
                    }else if($category == "" && $type != "" && $investor == ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE productType = '$type' ORDER BY date DESC");
                    }else if($category == "" && $type == "" && $investor != ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE investorName = '$investor' ORDER BY date DESC");
                    }else if($category != "" && $type != "" && $investor == ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE category = '$category' AND productType = '$type' ORDER BY date DESC");
                    }else if($category != "" && $type == "" && $investor != ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE category = '$category' AND investorName = '$investor' ORDER BY date DESC");
                    }else if($category == "" && $type != "" && $investor != ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE productType = '$type' AND investorName = '$investor' ORDER BY date DESC");
                    }else if($category != "" && $type != "" && $investor != ""){
                      $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE category = '$category' AND productType = '$type' AND investorName = '$investor' ORDER BY date DESC");
                    }else{
                      $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                    }
                  }else{
                    $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                  }

                  // if(isset($_POST['typeSubmit'])){
                  //   $selectedCategory = $_POST['type'];
                  //   $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE category = '$selectedCategory' ORDER BY date DESC");
                  // }else if(isset($_POST['categorySubmit'])){
                  //   $selectedCategory = $_POST['category'];
                  //   $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE productType = '$selectedCategory' ORDER BY date DESC");
                  // }else if(isset($_POST['investorSubmit'])){
                  //   $selectedCategory = $_POST['investorName'];
                  //   $query = mysqli_query($con,"SELECT * FROM gold_stock WHERE investorName = '$selectedCategory' ORDER BY date DESC");
                  // }else{
                  //   $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                  // }

                  $x = 1;
                  include_once('database/connection.php');
                  // $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_gold_pathor_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_gold_pathor_stock_item_modal"> <i class="fa fa-print"></i> Print Barcode </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="view_gold_pathor_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#view_gold_pathor_stock_item_modal"> <i class="fa fa-info-circle"></i> Detail Preview </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_gold_pathor_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_gold_pathor_stock_item_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_gold_pathor_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_gold_pathor_stock_item_modal"> <i class="fa fa-trash"></i> Delete Item </a>
                      </div>
                    </div>';

                    // Rounding weight...
                    // $tola = $result['weight'] / 11.664;
                    // $roundWeight = number_format((float)$tola, 3, '.', '');
                    
                    $image_path = "media/stock/gold_stock/".$result['image'];
                    $image_name = $result['image'];

                    echo "<tr>
                            <td>".$x."</td>
                            <td><img src='".$image_path."' width='50' onclick='view_gold_pathor_stock_item_image(".$id.")' data-toggle='modal' data-target='#view_gold_pathor_stock_item_image_modal'></td>
                            <td>".$result['name']."</td>
                            <td>".$result['category']."</td>
                            <td>".$result['weight']."</td>
                            <td>".$result['initial_price']."</td>
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
<div class="modal fade" id="delete_gold_pathor_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to delete this item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_gold_pathor_stock_item" action="includes/delete_gold_pathor_stock_item.php" method="post">
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

<!-- View Barcode OF Item Modal  -->
<div class="modal fade" id="barcode_gold_pathor_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content"><div class="modal-header">
      <h5 class="modal-title"> Barcode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <form id="" action="" method="post">
        <input type="hidden" id="delete_pathor_id" name="delete_pathor_id">
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
<div class="modal fade" id="view_gold_pathor_stock_item_image_modal">
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


<!-- View Stock Item Modal  -->
<div class="modal fade" id="view_gold_pathor_stock_item_modal" style="text-align:center;">
  <div class="modal-dialog">
          
          <table class="table table-bordered table-striped" style="background-color:white; width:900px; text-align:center;">
            <tr>
              <th colspan="7"><h3 style="text-align:center;" class="modal-title" id="stock_item_name"></h3></th>
            </tr>
            <tr>
              <th>ID</th>
              <th>Reg. Date</th>
              <th>Description</th>
              <th>Karat</th>
              <th>Quantity</th>
              <th>Weight (Gram)</th>
              <!-- <th>ETC</th> -->
              <th>Type</th>
            </tr>
            <tr>
              <td id="stock_item_id"></td>
              <td id="stock_item_date"></td>
              <td id="stock_item_desc"></td>
              <td id="stock_item_karat"></td>
              <td id="stock_item_quantity"></td>
              <td id="stock_item_weight"></td>
              <!-- <td id="stock_item_etc"></td> -->
              <td id="stock_item_type"></td>
            </tr>
          </table>
        <!-- </div> -->
        <!--/. modal body -->
    </div>
    <!-- /.modal-content -->
  <!-- </div> -->
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- update gold stock item... -->
<div class="modal fade" id="edit_gold_pathor_stock_item_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Stock Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_gold_pathor_stock_item" action="includes/update_gold_pathor_stock_item.php" method="post" enctype="multipart/form-data">
      <!-- <form action="test.php" method="get"> -->
        <div class="card-body">
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="edit_date" name="edit_date" required>
            <input type="hidden" class="form-control" id="edit_id" name="edit_id">
          </div>
          <div class="form-group">
            <label>Select Type</label>
            <select class="form-control" name="edit_gold_type" id="edit_gold_type">
              <option value="GOLD">GOLD</option>
              <option value="SILVER">SILVER</option>
            </select>
          </div>
          <div class="form-group">
            <label for="p_name">Product Name</label>
            <input type="text" class="form-control" id="edit_p_name" name="edit_p_name" placeholder="Enter Product Name" oninput="this.value = this.value.toUpperCase()" required>
          </div>
          <div class="form-group">
            <label>Select Product Type</label>
            <select class="form-control" name="edit_productType" id="edit_productType">
              <option value="NECKLACE">NECKLACE</option>
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
          <div class="form-group">
            <label for="p_description">Product Description</label>
            <input type="text" class="form-control" id="edit_p_description" name="edit_p_description" placeholder="Enter Product Description" oninput="this.value = this.value.toUpperCase()" required>
          </div>
          <div class="form-group">
            <label>Select</label>
            <select class="form-control" name="edit_karat" id="edit_karat">
              <option value="24">24 Karat</option>
              <option value="23">23 Karat</option>
              <option value="22">22 Karat</option>
              <option value="21">21 Karat</option>
              <option value="20">20 Karat</option>
              <option value="19">19 Karat</option>
              <option value="18">18 Karat</option>
            </select>
          </div>
          <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control" id="edit_qty" name="edit_qty" placeholder="Enter Quantity" required>
          </div>
          <div class="form-group">
            <label for="weight">Weight (gram)</label>
            <input type="text" class="form-control" id="edit_weight" name="edit_weight" placeholder="Enter Weight in Gram" required>
          </div>
          <!-- <div class="form-group">
            <label for="extra_charges">Extra Charges (Pkr)</label>
            <input type="text" class="form-control" id="edit_extra_charges" name="edit_extra_charges" placeholder="Enter Extra Charges in Pkr" required>
          </div> -->
          <div class="form-group">
            <label for="exampleInputFile">Choose File</label>
            <div class="input-group">
              <div class="custom-file">
                <!-- <input type="file" id="exampleInputFile" name="stock_image"> -->
                <input type="file" name="edit_fileToUpload" id="edit_fileToUpload">
                <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
              </div>
            </div>
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