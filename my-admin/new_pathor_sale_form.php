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
            <h1 class="m-0 text-dark">New Sale</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">New Sale</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<?php
    // fetching price according to date now 
    $date = date("Y-m-d");
    $pathor = "pathor";
    $silver = "silver";
    $query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$pathor'";
    $Result = $con->query($query);
    $result_row = $Result->fetch_array();
    $price = $result_row[0];
    // fectching silver rate 
    $silverQuery = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$silver'";
    $silverResult = $con->query($silverQuery);
    $silver_result_row = $silverResult->fetch_array();
    $silverPrice = $silver_result_row[0];

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
    // Tola silver
    $silverkarat23 = round(($silverPrice / 24) * 23);
    $silverkarat22 = round(($silverPrice / 24) * 22);
    $silverkarat21 = round(($silverPrice / 24) * 21);
    $silverkarat20 = round(($silverPrice / 24) * 20);
    $silverkarat19 = round(($silverPrice / 24) * 19);
    $silverkarat18 = round(($silverPrice / 24) * 18);
    // Gram silver
    $silvergram24 = round($silverPrice / 11.664);
    $silvergram22 = round($silverkarat22 / 11.664);
    $silvergram21 = round($silverkarat21 / 11.664);
    $silvergram20 = round($silverkarat20 / 11.664);
    $silvergram19 = round($silverkarat19 / 11.664);
    $silvergram18 = round($silverkarat18 / 11.664);

?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <form id="order_form" action="includes/add_gold_pathor_sale_process.php" method="post">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><li class="fas fa-cart-plus"> </li> Add Sale</h3>
                    </div>
                    <div class="card-body">
                        <!-- customer card  -->
                        <div class="card">
                            <div class="card-body">
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
                            </div>
                        </div>
                        <!-- customer card end  -->
                        <!-- row  -->
                        <div class="row">
                            <!-- col-1  -->
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <label for="">Today's Tola & Gram Rate</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">24-K</label>
                                                    <input type="text" value="<?php echo $price; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram24; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverPrice; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram24; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">22-K</label>
                                                    <input type="text" value="<?php echo $karat22; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram22; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverkarat22; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram22; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">21-K</label>
                                                    <input type="text" value="<?php echo $karat21; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram21; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverkarat21; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram21; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">20-K</label>
                                                    <input type="text" value="<?php echo $karat20; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram20; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverkarat20; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram20; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">19-K</label>
                                                    <input type="text" value="<?php echo $karat19; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram19; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverkarat19; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram19; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">18-K</label>
                                                    <input type="text" value="<?php echo $karat18; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $gram18; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silverkarat18; ?>" class="form-control form-control-sm" disabled>
                                                    <input type="text" value="<?php echo $silvergram18; ?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- cart table start  -->
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="price24k" id="price24k" value="<?php echo $price; ?>">
                                        <input type="hidden" name="silverprice24k" id="silverprice24k" value="<?php echo $silverPrice; ?>">
                                        <form action="">
                                            <div class="form-group">
                                                <input type="text" id="searchId" class="form-control form-control-sm" placeholder="Search Product" aria-label="" aria-describedby="basic-addon1" autofocus>
                                            </div>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" onclick="search_gold_stock_item()" type="submit" hidden><li class="fas fa-search"></li></button>
                                            </div>
                                        </form>
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Karat</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Labor</th>
                                                <th scope="col">Polish</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="cartTable"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- col-1-end  -->
                            <!-- col-2  -->
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="regDate">Registered Date</label>
                                            <input type="text" name="regDate" id="regDate" class="form-control form-control-sm" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="productName">Name</label>
                                                    <input type="text" name="productName" id="productName" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="productCategory">Category</label>
                                                    <input type="text" name="productCategory" id="productCategory" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="productDesc">Product Description</label>
                                            <input type="text" name="productDesc" id="productDesc" class="form-control form-control-sm" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="productKarat">Karat</label>
                                                    <input type="text" name="productKarat" id="productKarat" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="productWeight">Weight</label>
                                                    <input type="text" name="productWeight" id="productWeight" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="productPrice">Price</label>
                                                    <input type="text" name="productPrice" id="productPrice" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- col-2-end  -->
                        </div>
                        <!-- row end  -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"><li class="fas fa-cart-plus"> </li> Add Stones</h3>
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
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Sub Total</label>
                                                    <input type="text" class="form-control form-control-sm" id="subTotalSale" name="subTotal" value="0" readonly>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Polish (%)</label>
                                                    <input type="text" class="form-control form-control-sm" id="polish" name="polish" value="0" onchange="calPolishAndLabor()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Labor (Gram)</label>
                                                    <input type="text" class="form-control form-control-sm" id="labor" name="labor" value="0" onchange="calPolishAndLabor()">
                                                </div>
                                            </div> -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Beats</label>
                                                    <input type="text" class="form-control form-control-sm" id="beats" name="beats" value="0" onchange="calBeats()" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">ETC</label>
                                                    <input type="text" class="form-control form-control-sm" id="etc" value="0" name="etc" onchange="calETC()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Discount</label>
                                                    <input type="text" class="form-control form-control-sm" id="discount" value="0" name="discount" onchange="calDiscount()">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Grand Total</label>
                                                    <input type="text" class="form-control form-control-sm" id="grandTotal" name="grandTotal" value="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Paid</label>
                                                    <input type="text" class="form-control form-control-sm" id="paid" name="paid" value="0" onchange="calPaid()" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Balance</label>
                                                    <input type="text" class="form-control form-control-sm" id="balance" name="balance" value="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Expiry Date</label>
                                                    <input type="date" class="form-control form-control-sm" id="expDate" name="expDate">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group"><br>
                                                    <button type="submit" class="form-control form-control-sm btn btn-success" style="height:auto"><li class="fas fa-save"></li> Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    

    

<?php
include_once("templates/footer.php");
?>