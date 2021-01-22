<?php

include_once('./database/connection.php');
session_start();
$email = $_SESSION['email'];
if(!isset($_SESSION["email"])){
  header("location: index.php");
}
$query = "SELECT `name` FROM `admin_user` WHERE email = '$email'";
$Result = $con->query($query);
$result_row = $Result->fetch_array();

$name = $result_row[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Mala Gold</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body onload="preloaderRemover()" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">

<div id="preoader" style="position: fixed;
	width: 100%;
	height: 100vh;
	background: #fff
	url('dist/img/preloader.gif')
	 no-repeat center center;	
  z-index: 99999;"></div>
  
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-primary navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Options -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-arrow-circle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="profile.php" class="dropdown-item">
            <i class="fas fa-user-circle"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="./includes/backup.php" class="dropdown-item">
            <i class="fas fa-window-restore"></i> Backup
          </a>
          <div class="dropdown-divider"></div>
          <a href="./includes/signout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Sign out
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Mala Gold Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MALA GOLD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="rate_sheet.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Rate List
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="gold_stock_manage.php" class="nav-link">
                  <i class="fas fa-ring nav-icon"></i>
                  <p>Main Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="gold_pathor_stock.php" class="nav-link">
                  <i class="fas fa-cubes nav-icon"></i>
                  <p>Pathor Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="gold_piece_stock.php" class="nav-link">
                  <i class="fas fa-cubes nav-icon"></i>
                  <p>Piece Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stone_stock_manage.php" class="nav-link">
                  <i class="fas fa-gem nav-icon"></i>
                  <p>Stone Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="scrab_stock.php" class="nav-link">
                  <i class="fas fa-box-open nav-icon"></i>
                  <p>Scrab Stock</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-luggage-cart"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="new_pathor_sale_form.php" class="nav-link">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Gold & Silver</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="new_piece_sale_form.php" class="nav-link">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Gold Piece</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sale_stones.php" class="nav-link">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Stone</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="sales_record.php" class="nav-link">
              <i class="fas fa-book-open nav-icon"></i>
              <p>Sales Record</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Custom Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="custom_order.php" class="nav-link">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>New  Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="custom_orders_record.php" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Manage Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pay_to_workers.php" class="nav-link">
              <i class="fas fa-money-bill-wave nav-icon"></i>
              <p>
                Pay To Workers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="manage_investors.php" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>
                Investors
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="manage_workers.php" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>
                Workers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

