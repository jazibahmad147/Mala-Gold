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
            <h1 class="m-0 text-dark">Pay To Workers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pay To Workers</li>
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
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><li class="fas fa-money-bill-wave"> </li> Pay To Worker In Rupee</h3>
                    </div>
                    <form id="pay_to_worker_in_rupee_process" action="includes/pay_to_worker_in_rupee_process.php" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="workerGoldDate">Date</label>
                            <input type="date" class="form-control" id="workerRupeeDate" name="workerRupeeDate" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <label for="customer">Worker Name</label>
                        <div class="form-group">
                            <select class="form-control custom-select" name="workerNameInRupee" id="workerNameInRupee" required>
                                <option value="">Select</option>
                                <?php
                                    $query = "SELECT * FROM `workers` ORDER BY id DESC";
                                    $Result = $con->query($query);
                                    if($Result->num_rows > 0){
                                        while($row = $Result->fetch_assoc()){
                                            echo '<option value="'.$row['workerId'].'">'.$row['name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="workerAmount">Amount</label>
                            <input type="number" class="form-control" id="workerAmount" name="workerAmount" required>
                        </div>
                        <button style="width: 100px;" type="submit" class="btn btn-success" name="payWorkerAmount">Pay</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><li class="fas fa-ring"> </li> Pay To Worker In Gold</h3>
                    </div>
                    <form id="pay_to_worker_in_gold_process" action="includes/pay_to_worker_in_gold_process.php" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="workerGoldDate">Date</label>
                            <input type="date" class="form-control" id="workerGoldDate" name="workerGoldDate" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <label for="customer">Worker Name</label>
                        <div class="form-group">
                            <select class="form-control custom-select" name="workerNameInGold" id="workerNameInGold" required>
                                <option value="">Select</option>
                                <?php
                                    $query = "SELECT * FROM `workers` ORDER BY id DESC";
                                    $Result = $con->query($query);
                                    if($Result->num_rows > 0){
                                        while($row = $Result->fetch_assoc()){
                                            echo '<option value="'.$row['workerId'].'">'.$row['name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (Gram)</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>
                        <button style="width: 100px;" type="submit" class="btn btn-success" name="payWorkerGold">Pay</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Tables...   -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><li class="fas fa-ring"> </li> Payments in Rupee</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Worker</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $x = 1;
                                include_once('database/connection.php');
                                $query = mysqli_query($con,"SELECT * FROM worker_payments WHERE payIn = 'Rupee' ORDER BY date DESC");
                                while($result = mysqli_fetch_array($query)){
                                    $id = $result['id'];
                                    $button = '<a href="#?&id='.$id.'" type="button" name="id" onclick="delete_worker_payment('.$id.')" class="btn btn-danger" data-toggle="modal" data-target="#delete_worker_payment_modal"> <i class="fa fa-trash"></i> Delete </a>';

                                    // Fecthing worker name 
                                    $workerId = $result['workerId'];
                                    $workerQuery = "SELECT `name` FROM `workers` WHERE workerId = '$workerId'";
                                    $workerArray = $con->query($workerQuery);
                                    $result_row = $workerArray->fetch_array();
                                    $name = $result_row[0];
                                    
                                    echo "<tr>
                                            <td>".$x."</td>
                                            <td>".$result['date']."</td>
                                            <td>".$name."</td>
                                            <td>".$result['amount']."</td>
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
            <!-- Table 2 -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><li class="fas fa-money-bill-wave"> </li> Payments in Gold</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Worker</th>
                                    <th>Weight</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $x = 1;
                                include_once('database/connection.php');
                                $query = mysqli_query($con,"SELECT * FROM worker_payments WHERE payIn = 'GOLD' ORDER BY date DESC");
                                while($result = mysqli_fetch_array($query)){
                                    $id = $result['id'];
                                    $button = '<a href="#?&id='.$id.'" type="button" name="id" onclick="delete_worker_payment('.$id.')" class="btn btn-danger" data-toggle="modal" data-target="#delete_worker_payment_modal"> <i class="fa fa-trash"></i> Delete </a>';

                                    // Fecthing worker name 
                                    $workerId = $result['workerId'];
                                    $workerQuery = "SELECT `name` FROM `workers` WHERE workerId = '$workerId'";
                                    $workerArray = $con->query($workerQuery);
                                    $result_row = $workerArray->fetch_array();
                                    $name = $result_row[0];
                                    
                                    echo "<tr>
                                            <td>".$x."</td>
                                            <td>".$result['date']."</td>
                                            <td>".$name."</td>
                                            <td>".$result['weight']."</td>
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


<!-- Delete gold pathor modal... -->
<div class="modal fade" id="delete_worker_payment_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure to delete investor record?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_payment" action="includes/delete_payment_process.php" method="post">
          <input type="hidden" id="delete_payment_id" name="delete_payment_id">
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