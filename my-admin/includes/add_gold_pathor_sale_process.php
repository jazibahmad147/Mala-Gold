<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // fetch Old id... 
        $query = "SELECT id FROM sales ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $oldId = $result_row[0]+1;
        // New Id
        // goldPathorIdForInvoice = 3542-617356;
        $saleId = "3542-617356-".$oldId;

        $date = date("Y-m-d");

        // Customer Detail...
        $customerId = mysqli_real_escape_string($con, $_POST['customer']);
        // $customerName = mysqli_real_escape_string($con, $_POST['customerName']);
        // $cutomerAddress = mysqli_real_escape_string($con, $_POST['customerAddress']);
        // $cutomerPhone = mysqli_real_escape_string($con, $_POST['customerPhone']);


        $subTotal = mysqli_real_escape_string($con, $_POST['subTotal']);
        // $labor = mysqli_real_escape_string($con, $_POST['labor']);
        // $polish = mysqli_real_escape_string($con, $_POST['polish']);
        $beats = mysqli_real_escape_string($con, $_POST['beats']);
        $etc = mysqli_real_escape_string($con, $_POST['etc']);
        $discount = mysqli_real_escape_string($con, $_POST['discount']);
        $grandTotal = mysqli_real_escape_string($con, $_POST['grandTotal']);
        $paid = mysqli_real_escape_string($con, $_POST['paid']);
        $balance = mysqli_real_escape_string($con, $_POST['balance']);
        $expDate = mysqli_real_escape_string($con, $_POST['expDate']);


        $category = "pathor";

        // storing sale...
        $saleSql = "INSERT INTO sales (date,saleId,customerId,subTotal,beats,etc,discount,grandTotal,category,paid,expDate) VALUES ('$date','$saleId','$customerId','$subTotal','$beats','$etc','$discount','$grandTotal','$category','$paid','$expDate')";
        mysqli_query($con, $saleSql);


        // storing sales items...
        $count = count($_POST["pKey"]);
        for($i=0; $i<$count; $i++){

            $pId = mysqli_real_escape_string($con, $_POST['pKey'][$i]);
            $karat = mysqli_real_escape_string($con, $_POST['pKarat'][$i]);
            $weight = mysqli_real_escape_string($con, $_POST['pWeight'][$i]);
            $polish = mysqli_real_escape_string($con, $_POST['pPolish'][$i]);
            $labor = mysqli_real_escape_string($con, $_POST['pLabor'][$i]);
            $qty = mysqli_real_escape_string($con, $_POST['pQty'][$i]);
            $price = mysqli_real_escape_string($con, $_POST['pPrice'][$i]);
            $total = mysqli_real_escape_string($con, $_POST['pTotal'][$i]);
            
            $saleItemsSql = "INSERT INTO sale_items (saleId,pId,karat,weight,polish,labor,qty,price,total) VALUES ('$saleId','$pId','$karat','$weight','$polish','$labor','$qty','$price','$total')";
            mysqli_query($con, $saleItemsSql);

            // fetch quantity ... 
            $qtyFetched = "SELECT * FROM `gold_stock` WHERE p_key = '$pId'";
            $resultQty = $con->query($qtyFetched);
            $result_row_qty = $resultQty->fetch_array();
            $quantity = $result_row_qty[7]-$qty;
            // minus quantity from stock...
            // if($quantity <= 0){
            //     $updateStock = "DELETE FROM `gold_stock` WHERE p_key = '$pId'";
            // }else{
                $updateStock = "UPDATE `gold_stock` SET `quantity`='$quantity' WHERE p_key = '$pId'";
            // }
            
            mysqli_query($con, $updateStock);
        }

        if(isset($_POST['stoneBarcode'])){
            // storing sales of stones...
            $count = count($_POST["stoneBarcode"]);
            for($i=0; $i<$count; $i++){

                $barcode = mysqli_real_escape_string($con, $_POST['stoneBarcode'][$i]);
                $weight = mysqli_real_escape_string($con, $_POST['stoneWeight'][$i]);
                $price = mysqli_real_escape_string($con, $_POST['stonePrice'][$i]);
                $total = $weight * $price;
                
                $saleStoneSql = "INSERT INTO sale_stones (date,saleId,stoneId,customer,total_weight,price,total) VALUES ('$date','$saleId','$barcode','$customerId','$weight','$price','$total')";
                mysqli_query($con, $saleStoneSql);

                // fetch quantity ... 
                $stoneWeightFetched = "SELECT * FROM `stones_stock` WHERE barcode = '$barcode'";
                $stoneResultWeight = $con->query($stoneWeightFetched);
                $stone_result_row_weight = $stoneResultWeight->fetch_array();
                $new_weight = $stone_result_row_weight[4]-$weight;

                $updateStock = "UPDATE `stones_stock` SET `total_weight`='$new_weight' WHERE barcode = '$barcode'";
                mysqli_query($con, $updateStock);
            }

        }
      
        $valid['success'] = true;
        $valid['messages'] = "Your Data Inserted Successfully!";
        $valid['class'] = "bg-success";
        $valid['title'] = "Done";

    }else{
        $valid['success'] = false;
        $valid['messages'] = "Your Data Insertion Have Some Error!";
        $valid['class'] = "bg-danger";
        $valid['title'] = "Error";
    }

        
    $con->close();
    echo json_encode($valid);
    // echo $valid;

?>