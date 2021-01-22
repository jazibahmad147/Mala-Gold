<?php
include_once("templates/header.php");

$id = $_GET['id'];

$query = "SELECT * FROM `custom_orders` WHERE id = '$id'";
$Result = $con->query($query);
$result_row = $Result->fetch_array();
$orderId = $result_row['orderId'];


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
              <form id="add_scrab_stock" action="includes/add_scrab_stock_of_order_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="date">Date</label>
                      <input type="hidden" class="form-control form-control-sm" id="orderId" name="orderId" value="<?php echo $orderId; ?>">
                      <input type="date" class="form-control form-control-sm" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
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
                </div>
                <div class="row">
                  <!-- <div class="col-md-1"></div> -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="dust">Dust</label>
                      <input type="text" class="form-control form-control-sm" id="dust" name="dust" value="0" onchange="calPricing()" placeholder="Enter Dust in Gram" required>
                    </div>
                  </div>
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
          <!-- </div> -->
        <!-- 2nd column... -->
        
</div>
</section>




<?php
include_once("templates/footer.php");
?>