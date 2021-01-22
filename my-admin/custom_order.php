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
            <h1 class="m-0 text-dark">Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
        // fetching price according to date now 
        $date = date("Y-m-d");
        $category = "pathor";
        $query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$category'";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $price = $result_row[0];

        if($price == ""){
            $price = 0;
        }

        // Tola 
        $karat23 = round(($price / 24) * 23);
        $karat22 = round(($price / 24) * 22);
        $karat21 = round(($price / 24) * 21);
        $karat20 = round(($price / 24) * 20);
        $karat19 = round(($price / 24) * 19);
        $karat18 = round(($price / 24) * 18);
        // Gram
        $gram24 = round($price / 11.664);
        $gram22 = round($karat22 / 11.664);
        $gram21 = round($karat21 / 11.664);
        $gram20 = round($karat20 / 11.664);
        $gram19 = round($karat19 / 11.664);
        $gram18 = round($karat18 / 11.664);

    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Order</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form id="add_order" action="includes/custom_order_process.php" method="post" enctype="multipart/form-data">
                <div class="col-md-12"><br>
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

                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <!-- <th scope="col">ID</th> -->
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Karat</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Polish(%)</th>
                                            <th scope="col">Labor</th>
                                            <!-- <th scope="col">Beats</th> -->
                                            <th scope="col">ETC</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Image</th>
                                        </tr>
                                        </thead>
                                        <tbody id="orderTable"></tbody>
                                        <input type="hidden" value="0" id="sellingPrice" name="sellingPrice">
                                        <input type="hidden" value="0" id="buyingPrice" name="buyingPrice">
                                    </table><br>
                                
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <button type="button" class="btn btn-block btn-danger btn-sm" onclick="deleteOrderRow()" style="width:200px; margin:auto;">Delete</button>
                                        </div> -->
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-block btn-success btn-sm" onclick="addNewOrderRow()" style="width:200px; margin:auto;">Add Row</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    
                                </div> -->
                            </div>

                            <!-- stone Row  --><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title"><li class="fas fa-cart-plus"> </li> Add Stones</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-primary collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">From Stone Stock</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="">
                                                                <div class="form-group">
                                                                    <input type="text" id="searchStoneId" class="form-control form-control-sm" placeholder="Search Stones" aria-label="" aria-describedby="basic-addon1">
                                                                </div>
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-outline-secondary" onclick="search_stone()" type="submit" hidden><li class="fas fa-search"></li></button>
                                                                </div>
                                                            </form>
                                                            <table class="table">
                                                                <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Weight</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="stoneTable"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card card-primary collapsed-card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Custom Stone</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Weight</th>
                                                                    <th scope="col">Bought In</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="addCustomStones"></tbody>
                                                            </table><br>
                                                            <button type="button" class="btn btn-block btn-success btn-sm" onclick="addNewStoneRow()" style="width:200px; margin:auto;">Add Row</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="advanceRupee">Rupee Advance</label>
                                                <input type="text" class="form-control form-control-sm" id="advanceRupee" name="advanceRupee" onchange="advanceAddingInGrands()" placeholder="Enter Advance in Rupee">
                                            </div>
                                            <div class="card card-primary collapsed-card" id="workerCard" >
                                                <div class="card-header">
                                                    <h3 class="card-title">Advance Gold</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <!-- <div class="card card-primary"> -->
                                                            <div class="card-body" style="padding:0">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <table class="table">
                                                                            <thead class="thead-dark">
                                                                                <tr>
                                                                                    <th>Name</th>
                                                                                    <th>Type</th>
                                                                                    <th>Karat</th>
                                                                                    <th>Weight</th>
                                                                                    <th>Dust</th>
                                                                                    <th>RatiMashy(%)</th>
                                                                                    <th>Nag</th>
                                                                                    <th>Lab Fee</th>
                                                                                    <th>ETC</th>
                                                                                    <th>Discount</th>
                                                                                    <th>Total</th>
                                                                                    <th>Image</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="advanceTable"></tbody>
                                                                        </table><br>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <button type="button" class="btn btn-block btn-success btn-sm" onclick="addNewAdvanceRow()" style="width:200px; margin:auto;">Add Row</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldKarat">Karat</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldKarat" name="advanceGoldKarat" onchange="addAdvance()" value="19.5" placeholder="Karat">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldWeight">Weight</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldWeight" name="advanceGoldWeight" onchange="addAdvance()" placeholder="Weight">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldDust">Dust</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldDust" name="advanceGoldDust" onchange="addAdvance()" value="0" placeholder="Dust">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldRatiMashy">Rati Mashy(%)</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldRatiMashy" name="advanceGoldRatiMashy" onchange="addAdvance()" value="0" placeholder="Rati Mashy">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldNag">Nag</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldNag" name="advanceGoldNag" onchange="addAdvance()" value="0" placeholder="Nag">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldETC">ETC</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldETC" name="advanceGoldETC" onchange="addAdvance()" value="0">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldDiscount">Discount</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldDiscount" name="advanceGoldDiscount" onchange="addAdvance()" value="0">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="advanceGoldPrice">Price</label>
                                                                        <input type="text" class="form-control form-control-sm" id="advanceGoldPrice" name="advanceGoldPrice" value="0" readonly>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="subTotal">Sub Total</label>
                                            <input type="text" class="form-control form-control-sm" id="subTotal" name="subTotal" value="0" readonly>
                                        </div>
                                        <!-- <div class="col-md-2">
                                            <label for="polish">Polish(%)</label>
                                            <input type="text" class="form-control form-control-sm" id="polish" name="polish" value="0" onchange="calPL()">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="labor">Labor(Gram)</label>
                                            <input type="text" class="form-control form-control-sm" id="labor" name="labor" value="0" onchange="calPL()">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="beats">Beats</label>
                                            <input type="text" class="form-control form-control-sm" id="beats" name="beats" value="0" onchange="calBeats()">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="etc">ETC</label>
                                            <input type="text" class="form-control form-control-sm" id="etc" name="etc" value="0" onchange="calETC()">
                                        </div> -->
                                        <div class="col-md-2">
                                            <label for="totalDiscount">Total Discount</label>
                                            <input type="text" class="form-control form-control-sm" id="totalDiscount" name="totalDiscount" value="0" onchange="addDiscount()">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="grandTotal">Grand Total</label>
                                            <input type="text" class="form-control form-control-sm" id="grandTotal" name="grandTotal" value="0" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalAdvance">Total Advance</label>
                                            <input type="text" class="form-control form-control-sm" id="totalAdvance" name="totalAdvance" value="0" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalBalance">Total Balance</label>
                                            <input type="text" class="form-control form-control-sm" id="totalBalance" name="totalBalance" value="0" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="orderDeliveryDate">Delivery Date</label>
                                            <input type="date" class="form-control form-control-sm" id="orderDeliveryDate" name="orderDeliveryDate" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary collapsed-card" id="workerCard" >
                                <div class="card-header">
                                    <!-- <h3 class="card-title">Send To (<input type="radio" name="sendingOption" id="workerRadio" value="workerChecked" checked> Worker | <input type="radio" name="sendingOption" id="selfRadio" value="selfChecked"> Self)</h3> -->
                                    <h3 class="card-title">Send To</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Karat</th>
                                                <!-- <th>RP</th> -->
                                                <!-- <th>Moti</th> -->
                                                <th>ETC</th>
                                                <th>Pure Weight</th>
                                                <th>Pure Price</th>
                                                <th>Send To</th>
                                            </tr>
                                            </thead>
                                            <tbody id="workerTable"></tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="row" id="workerForm">
                                        <div class="col-md-2">
                                            <label for="customer">Worker / Self</label>
                                            <div class="input-group">
                                                <select class="form-control form-control-sm" name="customer" id="customer" required>
                                                    <option value="self">Self</option>
                                                    <?php

                                                        // $query = "SELECT * FROM `workers` ORDER BY id DESC";
                                                        // $Result = $con->query($query);
                                                        // if($Result->num_rows > 0){
                                                        //     while($row = $Result->fetch_assoc()){
                                                        //         echo '<option value="'.$row['customerId'].'">'.$row['name'].'</option>';
                                                        //     }
                                                        // }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="karatForWorker">Karat</label>
                                            <input type="text" class="form-control form-control-sm" id="karatForWorker" name="karatForWorker" onchange="karatChangeForWorker()" value="24">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="rpPriceForWorker">RP</label>
                                            <input type="text" class="form-control form-control-sm" id="rpPriceForWorker" name="rpPriceForWorker" onchange="karatChangeForWorker()" value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="motiPriceForWorker">Moti</label>
                                            <input type="text" class="form-control form-control-sm" id="motiPriceForWorker" name="motiPriceForWorker" onchange="karatChangeForWorker()" value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="etcForWorker">ETC</label>
                                            <input type="text" class="form-control form-control-sm" id="etcForWorker" name="etcForWorker" onchange="karatChangeForWorker()" value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalWeightForWorker">Pure Weight & Price</label>
                                            <input type="text" class="form-control form-control-sm" id="totalWeightForWorker" name="totalWeightForWorker" value="0" onchange="karatChangeForWorker()" readonly>
                                            <input type="text" class="form-control form-control-sm" id="payableAmountForWorker" name="payableAmountForWorker" value="0" readonly>
                                        </div>
                                    </div> -->
                                    <!-- ...........................  -->
                                    <!-- Row End -->
                                    
                                    <!-- <div class="row" id="selfForm">
                                        <div class="col-md-2">
                                            <label for="karatForSelf">Karat</label>
                                            <input type="text" class="form-control form-control-sm" id="karatForSelf" name="karatForSelf" value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="totalWeightForSelf">Pure Weight</label>
                                            <input type="text" class="form-control form-control-sm" id="totalWeightForSelf" name="totalWeightForSelf" value="0" readonly>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- card body end -->
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Confirm" style="float:right; width:100px">
                </form>
                </div>
            </div>
        </div>
    </section>



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



<?php
include_once("templates/footer.php");
?>