<?php
include_once("templates/header.php");

$id = $_GET['id'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Order Detail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Order Detail</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<?php
// Fetching orders detail 
$order = "SELECT * FROM `custom_orders` WHERE id = '$id'";
$orderResult = $con->query($order);
$order_result_row = $orderResult->fetch_array();

$orderId = $order_result_row['orderId'];
$customerId = $order_result_row['customerId'];
$date = $order_result_row['date'];
$subTotal = $order_result_row['subTotal'];
$totalDiscount = $order_result_row['totalDiscount'];
$grandTotal = $order_result_row['grandTotal'];
$totalAdvance = $order_result_row['totalAdvance'];
$totalBalance = $order_result_row['totalBalance'];
$deliveryDate = $order_result_row['deliveryDate'];
$status = $order_result_row['status'];


// Fetching Customer Details 
$customer = "SELECT * FROM `customers` WHERE customerId = '$customerId'";
$customerResult = $con->query($customer);
$customer_result_row = $customerResult->fetch_array();

$custName = $customer_result_row['name'];
$custAddress = $customer_result_row['address'];
$custPhone = $customer_result_row['phone'];



?>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <!-- DataTable... -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Order Detail</h3>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-4">
                      <h5>Order Id: <b><?php echo $orderId; ?></b></h5>
                      <h5>Date: <b><?php echo $date; ?></b></h5>
                      <h5>Status: <b><?php echo $status; ?></b></h5>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                      <h5>Customer Name: <b><?php echo $custName; ?></b></h5>
                      <h5>Address: <b><?php echo $custAddress; ?></b></h5>
                      <h5>Phone: <b><?php echo $custPhone; ?></b></h5>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12"><br>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ٰImage</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Size</th>
                                <th>Karat</th>
                                <th>Weight</th>
                                <th>polish</th>
                                <th>Labor</th>
                                <th>Beats</th>
                                <th>ETC</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                $query = mysqli_query($con,"SELECT * FROM custom_order_items WHERE orderId = '$orderId' ORDER BY id DESC");

                                $x = 1;
                                include_once('database/connection.php');
                                // $query = mysqli_query($con,"SELECT * FROM gold_stock ORDER BY date DESC");
                                while($result = mysqli_fetch_array($query)){
                                    $id = $result['id'];

                                    $image_name = $result['image'];
                                    $image_path = "media/custom_order_items/".$image_name;


                                    echo "<tr>
                                            <td><img src='".$image_path."' width='50' onclick='view_order_item_image(".$id.")' data-toggle='modal' data-target='#view_order_item_image_modal'></td>
                                            <td>".$result['name']."</td>
                                            <td>".$result['description']."</td>
                                            <td>".$result['size']."</td>
                                            <td>".$result['karat']."</td>
                                            <td>".$result['weight']."</td>
                                            <td>".$result['polish']."</td>
                                            <td>".$result['labor']."</td>
                                            <td>".$result['beats']."</td>
                                            <td>".$result['etc']."</td>
                                            <td>".$result['total']."</td>
                                    </tr>";
                                    $x++;
                                }
                                ?>
                        </tbody>
                    </table>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                      <h5>Sub Total: <b><?php echo $subTotal; ?> Rs</b></h5>
                      <h5>Grand Total: <b><?php echo $grandTotal; ?> Rs</b></h5>
                      <h5>Total Discount: <b><?php echo $totalDiscount; ?> Rs</b></h5>
                        <?php 
                            $sql = "SELECT * FROM custom_order_advance WHERE orderId = '$orderId'";
                            $query = mysqli_query($con,$sql);

                            while($result = mysqli_fetch_array($query)){
                                $advRupee = $result['advanceRupee'];
                                $scrabId = $result['scrabId'];
                                if($advRupee == 0){
                                    $newSql = "SELECT * FROM scrab_stock WHERE scrabId = '$scrabId'";
                                    $resultSql = $con->query($newSql);
                                    $resultSql_row = mysqli_fetch_array($resultSql);
                                    echo "<h5>Paid: <b>".$resultSql_row['purePrice']." Rs</b> | Date: <b>".$result['date']."</b></h5>";
                                }else{
                                    echo "<h5>Paid: <b>".$result['advanceRupee']." Rs</b> | Date: <b>".$result['date']."</b></h5>";
                                }
                            }

                        ?>
                       <h5>Total Paid: <b><?php echo $totalAdvance; ?> Rs</b></h5>
                       <h5>Total Balance: <b><?php echo $totalBalance; ?> Rs</b></h5>
                  </div>
              </div>
          </div>
        </div>
    </div>
  </section><br>






<!-- View Stock Item Image Modal  -->
<div class="modal fade" id="view_order_item_image_modal">
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