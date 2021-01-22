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
            <h1 class="m-0 text-dark">Gold Rate Sheet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Gold Rate Sheet</li>
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
                <h3 class="card-title">Add Gold Pathor Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="gold_pathor_rate_add_validation" action="includes/gold_pathor_rate_add_process.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <?php $date = date("Y-m-d"); ?>
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="buying">Buying (Pkr)</label>
                    <input type="number" class="form-control" id="buying" name="buying" placeholder="Enter Buying Rate">
                  </div>
                  <div class="form-group">
                    <label for="selling">Selling (Pkr)</label>
                    <input type="number" class="form-control" id="selling" name="selling" placeholder="Enter Selling Rate">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- DataTable -->
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Gold Pathor Rate Sheet</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Buying</th>
                  <th>Selling</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  $query = mysqli_query($con,"SELECT * FROM rate_list WHERE category = 'pathor' ORDER BY date DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div class="dropdown">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_gold_pathor_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_pathor_modal"> <i class="fa fa-edit"></i> Edit </a> 
                        <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_gold_pathor_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_gold_pathor_modal"> <i class="fa fa-trash"></i> Delete </a>
                      </div>
                    </div>';
                    
                    echo "<tr>
                            <td>".$x."</td>
                            <td>".$result['date']."</td>
                            <td>".$result['buying']."</td>
                            <td>".$result['selling']."</td>
                            <td>".$button."</td>
                    </tr>";
                    $x++;
                  }

                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
          
          <!-- 2nd row  -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Gold Piece Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="gold_piece_rate_add_validation" action="includes/gold_piece_rate_add_process.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <?php $date = date("Y-m-d"); ?>
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="buying">Buying (Pkr)</label>
                    <input type="number" class="form-control" id="buying" name="buying" placeholder="Enter Buying Rate">
                  </div>
                  <div class="form-group">
                    <label for="selling">Selling (Pkr)</label>
                    <input type="number" class="form-control" id="selling" name="selling" placeholder="Enter Selling Rate">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- DataTable -->
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Gold Piece Rate Sheet</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Buying</th>
                  <th>Selling</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  $query = mysqli_query($con,"SELECT * FROM rate_list WHERE category = 'piece' ORDER BY date DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_gold_piece_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_piece_modal"> <i class="fa fa-edit"></i> Edit </a>
                          <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_gold_piece_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_gold_piece_modal"> <i class="fa fa-trash"></i> Delete </a>
                      </div>
                    </div>';
                     
                    echo "<tr>
                            <td>".$x."</td>
                            <td id='date'>".$result['date']."</td>
                            <td id='buying'>".$result['buying']."</td>
                            <td id='selling'>".$result['selling']."</td>
                            <td>".$button."</td>
                    </tr>";
                    $x++;
                  }

                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            </div>
          </div>

          <!-- 3rd row  -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Silver Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="silver_rate_add_validation" action="includes/silver_rate_add_process.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <?php $date = date("Y-m-d"); ?>
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="buying">Buying (Pkr)</label>
                    <input type="number" class="form-control" id="buying" name="buying" placeholder="Enter Buying Rate">
                  </div>
                  <div class="form-group">
                    <label for="selling">Selling (Pkr)</label>
                    <input type="number" class="form-control" id="selling" name="selling" placeholder="Enter Selling Rate">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- DataTable -->
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Silver Rate Sheet</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Buying</th>
                  <th>Selling</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $x = 1;
                  include_once('database/connection.php');
                  $query = mysqli_query($con,"SELECT * FROM rate_list WHERE category = 'silver' ORDER BY date DESC");
                  while($result = mysqli_fetch_array($query)){
                    $id = $result['id'];
                    $button = '<div>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action 
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a href="#?&id='.$id.'" type="button" name="id" onclick="edit_silver_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#edit_silver_modal"> <i class="fa fa-edit"></i> Edit </a>
                          <a href="#?&id='.$id.'" type="button" name="id" onclick="delete_silver_rate('.$id.')" class="dropdown-item" data-toggle="modal" data-target="#delete_silver_modal"> <i class="fa fa-trash"></i> Delete </a>
                      </div>
                    </div>';
                     
                    echo "<tr>
                            <td>".$x."</td>
                            <td id='date'>".$result['date']."</td>
                            <td id='buying'>".$result['buying']."</td>
                            <td id='selling'>".$result['selling']."</td>
                            <td>".$button."</td>
                    </tr>";
                    $x++;
                  }

                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            </div>
          </div>
      </div>
  </div>
  </div>
  </div>
</section>


<!-- update gold pathor modal... -->
<div class="modal fade" id="edit_pathor_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Gold Pathor Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_gold_pathor_rate" action="includes/update_gold_pathor_rate_process.php" method="post">
        <div class="card-body">
          <div class="form-group">
            <?php $date = date("Y-m-d"); ?>
            <label for="date">Date</label>
            <input type="date" class="form-control" id="edit_pathor_date" name="edit_pathor_date">
            <input type="hidden" id="edit_pathor_id" name="edit_pathor_id">
          </div>
          <div class="form-group">
            <label for="buying">Buying (Pkr)</label>
            <input type="number" class="form-control" id="edit_pathor_buying" name="edit_pathor_buying" placeholder="Enter Buying Rate">
          </div>
          <div class="form-group">
            <label for="selling">Selling (Pkr)</label>
            <input type="number" class="form-control" id="edit_pathor_selling" name="edit_pathor_selling" placeholder="Enter Selling Rate">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <!-- <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button> -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
        
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- update silver modal... -->
<div class="modal fade" id="edit_silver_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Gold Pathor Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_silver_rate" action="includes/update_silver_rate_process.php" method="post">
        <div class="card-body">
          <div class="form-group">
            <?php $date = date("Y-m-d"); ?>
            <label for="date">Date</label>
            <input type="date" class="form-control" id="edit_silver_date" name="edit_silver_date">
            <input type="hidden" id="edit_silver_id" name="edit_silver_id">
          </div>
          <div class="form-group">
            <label for="buying">Buying (Pkr)</label>
            <input type="number" class="form-control" id="edit_silver_buying" name="edit_silver_buying" placeholder="Enter Buying Rate">
          </div>
          <div class="form-group">
            <label for="selling">Selling (Pkr)</label>
            <input type="number" class="form-control" id="edit_silver_selling" name="edit_silver_selling" placeholder="Enter Selling Rate">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <!-- <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button> -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
        
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- Delete gold pathor modal... -->
<div class="modal fade" id="delete_gold_pathor_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to delete this item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_gold_pathor_rate" action="includes/delete_pathor_rate.php" method="post">
          <input type="hidden" id="delete_pathor_id" name="delete_pathor_id">
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
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


<!-- Delete silver modal... -->
<div class="modal fade" id="delete_silver_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><li class="fas fa-times-circle"></li> Are you sure you want to delete this item?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form id="delete_silver_rate" action="includes/delete_silver_rate.php" method="post">
          <input type="hidden" id="delete_silver_id" name="delete_silver_id">
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
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


<!-- update gold piece modal... -->
<div class="modal fade" id="edit_piece_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Gold Piece Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="update_gold_piece_rate" action="includes/update_gold_piece_rate_process.php" method="post">
        <div class="card-body">
          <div class="form-group">
            <?php $date = date("Y-m-d"); ?>
            <label for="date">Date</label>
            <input type="date" class="form-control" id="edit_date" name="edit_date">
            <input type="hidden" id="edit_id" name="edit_id">
          </div>
          <div class="form-group">
            <label for="buying">Buying (Pkr)</label>
            <input type="number" class="form-control" id="edit_buying" name="edit_buying" placeholder="Enter Buying Rate">
          </div>
          <div class="form-group">
            <label for="selling">Selling (Pkr)</label>
            <input type="number" class="form-control" id="edit_selling" name="edit_selling" placeholder="Enter Selling Rate">
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <!-- <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Reset</button> -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
        
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