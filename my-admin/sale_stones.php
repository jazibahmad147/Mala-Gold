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
            <h1 class="m-0 text-dark">Stone Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Stone Sale</li>
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
                <h3 class="card-title"><li class="fas fa-plus-circle"> </li> Add Sale</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="stone_sale_form" action="includes/stone_sale_process.php" method="post" enctype="multipart/form-data">
              <!-- <form action="test.php" method="post" enctype="multipart/form-data"> -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="customer">Customer Name</label>
                        <select class="form-control" name="customer" id="customer" required>
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
                    </div>
                    <div class="form-group">
                        <label for="stoneName">Select Stone</label>
                        <select class="form-control" name="name" id="stoneName" onchange="showInitialPrice()" required>
                            <option value="">Select</option>
                            <?php

                                $query = "SELECT * FROM `stones_stock` ORDER BY id DESC";
                                $Result = $con->query($query);
                                if($Result->num_rows > 0){
                                    while($row = $Result->fetch_assoc()){
                                        echo '<option value="'.$row['barcode'].'">'.$row['name'].' | '.$row['barcode'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <small style="color: green">You bought it in: <span id="stoneInitialPrice">___</span> per gram.</small>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Total Weight" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price Per Gram</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price Of A Single Stone" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align:center">
                    <input type="submit" style="width: 200px" class="btn btn-success" value="Sale">
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
              <h3 class="card-title"><li class="fas fa-gem"> </li> Manage Stones</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Weight</th>
                  <th>Total Cost</th>
                  <th>Profit</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');

                  $query = mysqli_query($con,"SELECT * FROM sale_stones ORDER BY id DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $date = date("Y-m-d");
                    $stoneId = $result['stoneId'];
                    // Fecthing stone data
                    $stoneQuery = "SELECT * FROM `stones_stock` WHERE barcode = '$stoneId'";
                    $stoneArray = $con->query($stoneQuery);
                    $stone_result_row = $stoneArray->fetch_array();
                    $stoneName = $stone_result_row[3];
                    $weight = $result['total_weight'];
                    $stonePrice = $stone_result_row[5] * $weight;
                    $soldIn = $result['price'] * $weight;
                    $profit = $soldIn - $stonePrice;

                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="print_barcode_stone_stock_item('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#barcode_stone_stock_item_modal"> <i class="fa fa-print"></i> Print Barcode </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_stone('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_stone_modal"> <i class="fa fa-edit"></i> Edit Detail </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_stone('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_stone_modal"> <i class="fa fa-trash"></i> Delete Record</a>
                      </div>
                    </div>';
                    $printBtn = '<a href="#?&id='.$id.'" type="button" name="id" class="btn btn-success"> <i class="fa fa-print"></i> Print Invoice </a> ';

                    echo "<tr>
                            <td>".$x."</td>
                            <td>".$result['date']."</td>
                            <td>".$stoneName."</td>
                            <td>".$result['total_weight']."</td>
                            <td>".$result['price']."</td>
                            <td>".$profit."</td>
                            <td>".$printBtn."</td>
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




<?php
include_once("templates/footer.php");
?>