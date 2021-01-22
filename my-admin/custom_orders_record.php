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
          <h1 class="m-0 text-dark">Orders Record</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Orders Record</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <!-- DataTable... -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Orders Record</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="type">From</label>
                        <input type="date" class="form-control form-control-sm" name="startDate">
                      </div>
                      <div class="col-md-6">
                        <label for="type">To</label>
                        <input type="date" class="form-control form-control-sm" name="endDate">
                      </div>
                    </div>
                    <br>
                    <input type="submit" name="filter" class="btn btn-primary" value="Filter">
                  </form>
                </div>
              </div>


            </div>

            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Invoice ID</th>
                  <th>Customer</th>
                  <th>Grand Total</th>
                  <th>Paid</th>
                  <th>Balance</th>
                  <th>Expiry</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_POST['filter'])) {
                  $startDate = $_POST['startDate'];
                  $endDate = $_POST['endDate'];
                  $query = mysqli_query($con, "SELECT * FROM custom_orders WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY id DESC");
                } else {
                  $query = mysqli_query($con, "SELECT * FROM custom_orders ORDER BY id DESC");
                }

                $x = 1;
                include_once('database/connection.php');
                // $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                while ($result = mysqli_fetch_array($query)) {
                  $id = $result['id'];
                  $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      
                        <a href="view_custom_order_detail.php?&id=' . $id . '" type="button" name="id" class="dropdown-item"> <i class="fa fa-eye"></i> View Order </a>
                        <a href="#?&id=' . $id . '" type="button" name="id" onclick="print_order_invoice(' . $id . ')" class="dropdown-item" data-toggle="modal" data-target="#print_order_detail_modal"> <i class="fa fa-print"></i> Print Invoice </a>

                        <a href="#?&id=' . $id . '" type="button" name="id" onclick="client_payment_rupee(' . $id . ')" class="dropdown-item" data-toggle="modal" data-target="#client_payment_rupee_modal"> <i class="fa fa-money-bill-alt"></i> Recieve Payment </a>
                        <a href="receive_gold_from_client.php?&id=' . $id . '" type="button" name="id" class="dropdown-item"> <i class="fa fa-ring"></i> Recieve Gold </a>
                        

                        <a href="#?&id=' . $id . '" type="button" name="id" onclick="change_order_status(' . $id . ')" class="dropdown-item" data-toggle="modal" data-target="#change_order_status_modal"> <i class="fa fa-unlock-alt"></i> Change Status </a> 
                        <a href="#?&id=' . $id . '" type="button" name="id" onclick="return_order_record(' . $id . ')" class="dropdown-item" data-toggle="modal" data-target="#return_order_record_modal"> <i class="fa fa-trash"></i> Delete Record </a> 

                        
                      
                    

                      </div>
                    </div>';

                  // select cutomer name 
                  $customer = $result['customerId'];
                  $customerQuery = "SELECT `name` FROM `customers` WHERE customerId = '$customer'";
                  $fetchCustomer = $con->query($customerQuery);
                  $result_row = $fetchCustomer->fetch_array();
                  $name = $result_row[0];

                  // select payments 
                  // $saleId = $result['orderId'];
                  // // $totalPayments = 0;
                  // // $paymentQuery = mysqli_query($con, "SELECT * FROM `custom_order_advance` WHERE orderId = '$saleId'");
                  // // while ($fetchPaymentsResult = mysqli_fetch_array($paymentQuery)) {
                  // //   $scrabId = $fetchPaymentsResult['scrabId'];
                  // //   $purePriceAdvance = 0;
                  // //   if ($scrabId != 0) {
                  // //     $scrabQuery = "SELECT * FROM `scrab_stock` WHERE scrabId = '$scrabId'";
                  // //     $fetchScrab = $con->query($scrabQuery);
                  // //     $result_row = $fetchScrab->fetch_array();
                  // //     $purePriceAdvance = $result_row['purePrice'];
                  // //   }

                  // //   $myPaymnents = $fetchPaymentsResult['advanceRupee'];
                  // //   $totalPayments += $myPaymnents + $purePriceAdvance;
                  // // }
                  // // if ($totalPayments == "") {
                  // //   $totalPayments = 0;
                  // // }

                  // // // Calculating balance 
                  // // $grandTotal = $result['grandTotal'];
                  // // $finalBalance = $grandTotal - $totalPayments;


                  echo "<tr>
                            <td>" . $x . "</td>
                            <td>" . $result['date'] . "</td>
                            <td>" . $result['orderId'] . "</td>
                            <td>" . $name . "</td>
                            <td>" . $result['grandTotal'] . "</td>
                            <td>" . $result['totalAdvance'] . "</td>
                            <td>" . $result['totalBalance'] . "</td>
                            <td>" . $result['deliveryDate'] . "</td>
                            <td>" . $result['status'] . "</td>
                            <td>" . $button . "</td>
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
</div>
</section>



<!-- Return sale record... -->
<div class="modal fade" id="return_order_record_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <li class="fas fa-times-circle"></li> Are you sure you want to return this record?
        </h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <form id="return_order_record" action="includes/return_order_record.php" method="post">
          <input type="hidden" id="return_order_record_id" name="return_order_record_id">
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


<!-- change_order_status_modal... -->
<div class="modal fade" id="change_order_status_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fas fa-unlock-alt"></li> Change Status
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="change_order_status" action="includes/change_order_status_process.php" method="post" enctype="multipart/form-data">
          <!-- <form action="test.php" method="get"> -->
          <div class="card-body">
            <input type="hidden" id="change_order_status_id" name="change_order_status_id">
            <div class="form-group">
              <label for="order_status">Select Status</label>
              <select id="order_status" class="form-control form-control-sm" name="order_status" required>
                <option value="">SELECT</option>
                <option value="PENDING">PENDING</option>
                <option value="SENT">SENT</option>
                <option value="COMPLETED">COMPLETED</option>
                <option value="RECIEVED">RECIEVED</option>
                <option value="DELIVERED-1">DELIVERED WITH RECIEPT</option>
                <option value="DELIVERED-0">DELIVERED WITHOUT RECIEPT</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Change</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<!-- Recieve Payment... -->
<div class="modal fade" id="client_payment_rupee_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fas fa-money-check-alt"></li> Add Payment
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="client_payment_rupee" action="includes/client_payment_rupee_process.php" method="post" enctype="multipart/form-data">
          <!-- <form action="test.php" method="get"> -->
          <div class="card-body">
            <div class="form-group">
              <label for="paymentDate">Date</label>
              <input type="date" class="form-control" id="paymentDate" name="paymentDate" value="<?php echo date("Y-m-d"); ?>" required>
              <input type="hidden" class="form-control" id="invoiceId" name="invoiceId">
            </div>
            <div class="form-group">
              <label for="newPayment">Payment</label>
              <input type="number" class="form-control" id="newPayment" name="newPayment" placeholder="Enter Recieved Payment" required>
              <small style="color:red;">Order balance is <span id="balanceamount"></span> Pkr.</small>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Recieve</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Send Payment... -->
<div class="modal fade" id="worker_payment_rupee_modal">
  <div class="modal-dialog" style="transform: translate(-150px, 10px);">
    <div class="modal-content" style="width:800px;">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fas fa-money-check-alt"></li> Send Payment
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="worker_payment_rupee" action="includes/add_custom_order_item_payment_process.php" method="post" enctype="multipart/form-data">
          <!-- <form action="test.php" method="get"> -->
          <div class="card-body">
          <div class="form-group">
              <label for="workerPaymentDate">Date</label>
              <input type="date" class="form-control" id="workerPaymentDate" name="workerPaymentDate" value="<?php echo date("Y-m-d"); ?>" required>
              <input type="hidden" class="form-control" id="workerInvoiceId" name="invoiceId">
          </div>

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Check</th>
                <th>Name</th>
                <th>Send To</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Worker</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody id="customeOrderItemTable"></tbody>
          </table>


          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" id="sendWorkerPayment" class="btn btn-success">Send</button>
            </form>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- Send Gold... -->
<div class="modal fade" id="worker_payment_gold_modal">
  <div class="modal-dialog" style="transform: translate(-150px, 10px);">
    <div class="modal-content" style="width:800px;">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fas fa-money-check-alt"></li> Send Gold
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="worker_payment_gold" action="includes/add_custom_order_item_gold_process.php" method="post" enctype="multipart/form-data">
          <div class="card-body">
          <div class="form-group">
              <label for="workerGoldDate">Date</label>
              <input type="date" class="form-control" id="workerGoldDate" name="workerGoldDate" value="<?php echo date("Y-m-d"); ?>" required>
              <input type="hidden" class="form-control" id="workerGoldInvoiceId" name="invoiceId">
          </div>

          <?php
            // fetching price according to date now 
            $date = date("Y-m-d");
            $category = "pathor";
            $query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$category'";
            $Result = $con->query($query);
            $result_row = $Result->fetch_array();
            $price = $result_row[0];

            // Tola 
            $karat23 = round(($price / 24) * 23);
            $karat22 = round(($price / 24) * 22);
            $karat21 = round(($price / 24) * 21);
            $karat20 = round(($price / 24) * 20);
            $karat19 = round(($price / 24) * 19);
            $karat18 = round(($price / 24) * 18);
          
          ?>

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan="7" style="text-align: center;">Rate (<span><?php echo date("d-M-Y"); ?></span>)</th>
              </tr>
              <tr>
                <th>24K</th>
                <th>23K</th>
                <th>22K</th>
                <th>21K</th>
                <th>20K</th>
                <th>19K</th>
                <th>18K</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $price; ?>" id="workerGoldPaymentRate24K" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat23; ?>" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat22; ?>" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat21; ?>" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat20; ?>" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat19; ?>" readonly></td>
                <td><input type="text" class="form-control form-control-sm" value="<?php echo $karat18; ?>" readonly></td>
              </tr>
            </tbody>
          </table><br>

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Weight</th>
                <th>Karat</th>
                <th>Pure Weight</th>
                <th>Pure Price</th>
              </tr>
            </thead>
            <tbody id="customeOrderScrabTable">
              <div class="form-group">
                <input type="text" id="scrabItemCode" class="form-control form-control-sm" placeholder="Search Scrab Item" aria-label="" aria-describedby="basic-addon1" autofocus>
                <!-- <span id="scrabItemCodeErr"></span> -->
              </div>
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" onclick="search_gold_scrab_item()" type="submit" hidden><li class="fas fa-search"></li></button>
              </div>

              <!-- <div class="form-group">
                <label for="scrabItemCode">Scan Scrab Item</label>
                  <input type="text" class="form-control form-control-sm" id="scrabItemCode" name="scrabItemCode" placeholder="Scan your scrab item..." autofocus>
              </div> -->
              
            </tbody>
          </table>


          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Send</button>
            </form>
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