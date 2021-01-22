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
            <h1 class="m-0 text-dark">Sales Record</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Sales Record</li>
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
              <h3 class="card-title">Sales Record</h3>
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
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 

                  if(isset($_POST['filter'])){
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $query = mysqli_query($con,"SELECT * FROM sales WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY id DESC");
                  }else{
                    $query = mysqli_query($con,"SELECT * FROM sales ORDER BY id DESC");
                  }

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
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_sale_invoice('.$id.')" class="dropdown-item"> <i class="fa fa-print"></i> Print Invoice </a>
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="recieve_payment('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#recieve_payment_modal"> <i class="fa fa-money-check-alt"></i> Recieve Payment </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="return_sale_record('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#return_sale_record_modal"> <i class="fa fa-undo"></i> Return Sale </a> 
                      </div>
                    </div>';

                    // select cutomer name 
                    $customer = $result['customerId'];
                    $customerQuery = "SELECT `name` FROM `customers` WHERE customerId = '$customer'";
                    $fetchCustomer = $con->query($customerQuery);
                    $result_row = $fetchCustomer->fetch_array();
                    $name = $result_row[0];

                    // select payments 
                    $saleId = $result['saleId'];
                    $totalPayments = 0;
                    $paymentQuery = mysqli_query($con,"SELECT * FROM `payments` WHERE invoiceId = '$saleId'");
                    while($fetchPaymentsResult = mysqli_fetch_array($paymentQuery)){
                        $myPaymnents = $fetchPaymentsResult['payment'];
                        $totalPayments += $myPaymnents;
                    }
                    if($totalPayments == ""){
                        $totalPayments = 0;
                    }

                    $previousPayment = $result['paid'];
                    $finalPayment = $previousPayment + $totalPayments;

                    // Calculating balance 
                    $grandTotal = $result['grandTotal'];
                    $finalBalance = $grandTotal - $finalPayment;


                    echo "<tr>
                            <td>".$x."</td>
                            <td>".$result['date']."</td>
                            <td>".$result['saleId']."</td>
                            <td>".$name."</td>
                            <td>".$result['grandTotal']."</td>
                            <td>".$finalPayment."</td>
                            <td>".$finalBalance."</td>
                            <td>".$result['expDate']."</td>
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
  </div>
</section>


<!-- Delete sale record... -->
<div class="modal fade" id="delete_sale_record_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to delete this record?</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <form id="delete_sale_record" action="includes/delete_sale_record.php" method="post">
          <input type="hidden" id="delete_sale_record_id" name="delete_sale_record_id">
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


<!-- Return sale record... -->
<div class="modal fade" id="return_sale_record_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to return this record?</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <form id="return_sale_record" action="includes/return_sale_record.php" method="post">
          <input type="hidden" id="return_sale_record_id" name="return_sale_record_id">
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

<!-- Recieve Payment... -->
<div class="modal fade" id="recieve_payment_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><li class="fas fa-money-check-alt"></li> Add Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="recieve_payment" action="includes/recieve_payment_process.php" method="post" enctype="multipart/form-data">
      <!-- <form action="test.php" method="get"> -->
        <div class="card-body">
          <div class="form-group">
            <label for="paymentDate">Date</label>
            <input type="date" class="form-control" id="paymentDate" name="paymentDate" required>
            <input type="hidden" class="form-control" id="invoiceId" name="invoiceId">
          </div>
          <div class="form-group">
            <label for="newPayment">Payment</label>
            <input type="number" class="form-control" id="newPayment" name="newPayment" placeholder="Enter Recieved Payment" required>
          </div>
          <div class="form-group">
            <label for="extraNote">Extra Note</label>
            <input type="textarea" class="form-control" id="extraNote" name="extraNote" placeholder="Enter Extra Notes" required>
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




<?php
include_once("templates/footer.php");
?>