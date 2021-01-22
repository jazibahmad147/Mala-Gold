<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        // fetch Old id... 
        $query = "SELECT id FROM custom_orders ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $oldId = $result_row[0]+1;
        // New Id
        // goldPathorIdForInvoice = 176755-56226;
        $customOrderId = "176755-56226-".$oldId;

        $date = date("Y-m-d");

        // fetching today's rate 
        $rateQuery = "SELECT * FROM rate_list WHERE date = '$date'";
        $rateResult = $con->query($rateQuery);
        $rate_result_row = $rateResult->fetch_array();
        $buyingRate = $rate_result_row[2];
        $sellingRate = $rate_result_row[3];

        // Customer Detail...
        $customerId = mysqli_real_escape_string($con, $_POST['customer']);
        $subTotal = mysqli_real_escape_string($con, $_POST['subTotal']);
        $discount = mysqli_real_escape_string($con, $_POST['totalDiscount']);
        $grandTotal = mysqli_real_escape_string($con, $_POST['grandTotal']);
        $totalAdvance = mysqli_real_escape_string($con, $_POST['totalAdvance']);
        $totalBalance = mysqli_real_escape_string($con, $_POST['totalBalance']);
        $orderDeliveryDate = mysqli_real_escape_string($con, $_POST['orderDeliveryDate']);

        // Today's Rate
        $selling = mysqli_real_escape_string($con, $_POST['sellingPrice']);
        $buying = mysqli_real_escape_string($con, $_POST['buyingPrice']);


        $category = "PATHOR";
        $status = "PENDING";

        // storing sale...
        $orderSql = "INSERT INTO custom_orders (orderId,customerId,date,subTotal,totalDiscount,grandTotal,totalAdvance,totalBalance,deliveryDate,status) 
                    VALUES ('$customOrderId','$customerId','$date','$subTotal','$discount','$grandTotal','$totalAdvance','$totalBalance','$orderDeliveryDate','$status')";
        mysqli_query($con, $orderSql);

        // ****************************************
        // echo $subTotal."<br>".$discount."<br>".$grandTotal."<br>".$totalAdvance."<br>".$totalBalance."<br>".$orderDeliveryDate."<br>";
        // ****************************************

        // storing sales items...
        $count = count($_POST["pName"]);
        for($i=0; $i<$count; $i++){

            $pName = mysqli_real_escape_string($con, $_POST['pName'][$i]);
            $pDesc = mysqli_real_escape_string($con, $_POST['pDesc'][$i]);
            $pSize = mysqli_real_escape_string($con, $_POST['pSize'][$i]);
            $pKarat = mysqli_real_escape_string($con, $_POST['pKarat'][$i]);
            $pWeight = mysqli_real_escape_string($con, $_POST['pWeight'][$i]);
            $pPolish = mysqli_real_escape_string($con, $_POST['pPolish'][$i]);
            $pLabor = mysqli_real_escape_string($con, $_POST['pLabor'][$i]);
            $pBeats = mysqli_real_escape_string($con, $_POST['pBeats'][$i]);
            $pETC = mysqli_real_escape_string($con, $_POST['pETC'][$i]);
            $pTotal = mysqli_real_escape_string($con, $_POST['pTotal'][$i]);
            // $files = mysqli_real_escape_string($con, $_POST['fileToUpload'][$i]);
            // File...
            $files = $_FILES['fileToUpload'];
            $filename = $files['name'][$i];
            $fileerror = $files['error'][$i];
            $filetmp = $files['tmp_name'][$i];

            $fileext = explode('.',$filename);
            $filecheck = strtolower(end($fileext));
            $fileextstored = array('png', 'jpg', 'jpeg');

            if(in_array($filecheck,$fileextstored)){
                $destinationfile = '../media/custom_order_items/'.$oldId.'-'.$i.'-'.$filename;
                $destinationForDatabase = $oldId.'-'.$i."-".$filename;
                move_uploaded_file($filetmp,$destinationfile);
            }


            // Worker process...
            $workerKarat = mysqli_real_escape_string($con, $_POST['workerKarat'][$i]);
            // $rp = mysqli_real_escape_string($con, $_POST['rp'][$i]);
            // $moti = mysqli_real_escape_string($con, $_POST['moti'][$i]);
            $workerETC = mysqli_real_escape_string($con, $_POST['workerETC'][$i]);
            $pureWeight = mysqli_real_escape_string($con, $_POST['pureWeight'][$i]);
            $purePrice = mysqli_real_escape_string($con, $_POST['purePrice'][$i]);
            $selectedOption = mysqli_real_escape_string($con, $_POST['selectedOption'][$i]);
            
            
            if(isset($destinationForDatabase) == null){
                $orderItemsSql = "INSERT INTO custom_order_items (orderId,name,description,size,karat,weight,polish,labor,beats,etc,total,sendTo,workerKarat,workerETC,pureWeight,purePrice,todayRate,status) 
            VALUES ('$customOrderId','$pName','$pDesc','$pSize','$pKarat','$pWeight','$pPolish','$pLabor','$pBeats','$pETC','$pTotal','$selectedOption','$workerKarat','$workerETC','$pureWeight','$purePrice','$selling','$status')";
            }else{
                $orderItemsSql = "INSERT INTO custom_order_items (orderId,name,description,size,karat,weight,polish,labor,beats,etc,total,image,sendTo,workerKarat,workerETC,pureWeight,purePrice,todayRate,status) 
                VALUES ('$customOrderId','$pName','$pDesc','$pSize','$pKarat','$pWeight','$pPolish','$pLabor','$pBeats','$pETC','$pTotal','$destinationForDatabase','$selectedOption','$workerKarat','$workerETC','$pureWeight','$purePrice','$selling','$status')";
            }
            mysqli_query($con, $orderItemsSql);

            // **************************************
            // echo $pName.' <br> '.$pDesc.' <br> '.$pSize.' <br> '.$pKarat.' <br> '.$pWeight.' <br> '.$pPolish.' <br> '.$pLabor.' <br> '.$pBeats.' <br> '.$pTotal.' <br> '.$destinationForDatabase.' <br> '.$workerKarat.' <br> '.$rp.' <br> '.$moti.' <br> '.$workerETC.' <br> '.$pureWeight.' <br> '.$purePrice.' <br> '.$selectedOption.' <br> ';
            // **************************************

        }

        //advance collection
        $advanceRupee = mysqli_real_escape_string($con, $_POST['advanceRupee']);
        if($advanceRupee != 0){
            $advanceQuery = "INSERT INTO custom_order_advance (orderId,advanceRupee,date) VALUES ('$customOrderId','$advanceRupee','$date')";
            mysqli_query($con, $advanceQuery);
        }

        // stone sale saving 
        if(isset($_POST['stoneBarcode'])){
            // storing sales of stones...
            $count = count($_POST["stoneBarcode"]);
            for($i=0; $i<$count; $i++){

                $barcode = mysqli_real_escape_string($con, $_POST['stoneBarcode'][$i]);
                $weight = mysqli_real_escape_string($con, $_POST['stoneWeight'][$i]);
                $price = mysqli_real_escape_string($con, $_POST['stonePrice'][$i]);
                $total = $weight * $price;
                
                $saleStoneSql = "INSERT INTO sale_stones (date,saleId,stoneId,customer,total_weight,price,total) VALUES ('$date','$customOrderId','$barcode','$customerId','$weight','$price','$total')";
                mysqli_query($con, $saleStoneSql);

                $stoneWeightFetched = "SELECT * FROM `stones_stock` WHERE barcode = '$barcode'";
                $stoneResultWeight = $con->query($stoneWeightFetched);
                $stone_result_row_weight = $stoneResultWeight->fetch_array();
                $new_weight = $stone_result_row_weight[4]-$weight;

                $updateStock = "UPDATE `stones_stock` SET `total_weight`='$new_weight' WHERE barcode = '$barcode'";
                mysqli_query($con, $updateStock);
            }

        }

        // stone sale saving + stone add in stock 
        if(isset($_POST['customStoneName'])){
            $count = count($_POST["customStoneName"]);
            for($i=0; $i<$count; $i++){
                // fetch Old Key... 
                $stoneIdQuery = "SELECT id FROM stones_stock ORDER BY id DESC LIMIT 1";
                $stoneResult = $con->query($stoneIdQuery);
                $result_row_stone = $stoneResult->fetch_array();
                $key = $result_row_stone[0]+1;
                // barcode number...
                // stone = 7866
                $new_barcode = "7866".$key;

                $name = mysqli_real_escape_string($con, $_POST['customStoneName'][$i]);
                $weight = mysqli_real_escape_string($con, $_POST['customStoneWeight'][$i]);
                $purchasePrice = mysqli_real_escape_string($con, $_POST['customStonePriceBought'][$i]);
                $salePrice = mysqli_real_escape_string($con, $_POST['customStonePrice'][$i]);
                $total = mysqli_real_escape_string($con, $_POST['customStoneTotal'][$i]);

                // inserting in stock table
                $stockStoneSql = "INSERT INTO stones_stock (date,barcode,name,total_weight,price) VALUES ('$date','$new_barcode','$name','$weight','$purchasePrice')";
                mysqli_query($con, $stockStoneSql);
                // inserting in sale stone 
                $saleStoneSql = "INSERT INTO sale_stones (date,saleId,stoneId,customer,total_weight,price,total) VALUES ('$date','$customOrderId','$new_barcode','$customerId','$weight','$salePrice','$total')";
                mysqli_query($con, $saleStoneSql);

                $stoneWeightFetched = "SELECT * FROM `stones_stock` WHERE barcode = '$new_barcode'";
                $stoneResultWeight = $con->query($stoneWeightFetched);
                $stone_result_row_weight = $stoneResultWeight->fetch_array();
                $new_weight = $stone_result_row_weight[4]-$weight;

                $updateStock = "UPDATE `stones_stock` SET `total_weight`='$new_weight' WHERE barcode = '$new_barcode'";
                mysqli_query($con, $updateStock);
            }

        }

        if(isset($_POST["advPName"])){
            $advPCount = count($_POST["advPName"]);
            for($i=0; $i<$advPCount ; $i++){
                
                $advPName = mysqli_real_escape_string($con, $_POST['advPName'][$i]);
                $advProductType = mysqli_real_escape_string($con, $_POST['advProductType'][$i]);
                $advPKarat = mysqli_real_escape_string($con, $_POST['advPKarat'][$i]);
                $advPWeight = mysqli_real_escape_string($con, $_POST['advPWeight'][$i]);
                $advPDust = mysqli_real_escape_string($con, $_POST['advPDust'][$i]);
                $advPRatiMashy = mysqli_real_escape_string($con, $_POST['advPRatiMashy'][$i]);
                $advPNag = mysqli_real_escape_string($con, $_POST['advPNag'][$i]);
                $advPLabFee = mysqli_real_escape_string($con, $_POST['advPLabFee'][$i]);
                $advPETC = mysqli_real_escape_string($con, $_POST['advPETC'][$i]);
                $advPDiscount = mysqli_real_escape_string($con, $_POST['advPDiscount'][$i]);
                $advPTotal = mysqli_real_escape_string($con, $_POST['advPTotal'][$i]);
                $category = "PATHOR";

                // fetch Old Key... 
                $query = "SELECT id FROM scrab_stock ORDER BY id DESC LIMIT 1";
                $Result = $con->query($query);
                $result_row = $Result->fetch_array();
                $key = $result_row[0]+1;

                $pid = "72867".$key."61611";

                // File...
                $files = $_FILES['advFileToUpload'];
                $filename = $files['name'][$i];
                $fileerror = $files['error'][$i];
                $filetmp = $files['tmp_name'][$i];

                $fileext = explode('.',$filename);
                $filecheck = strtolower(end($fileext));
                $fileextstored = array('png', 'jpg', 'jpeg');

                if(in_array($filecheck,$fileextstored)){
                    $destinationfile = '../media/stock/scrab_stock/'.$key.'-'.$filename;
                    $destinationForDatabase = $key."-".$filename;
                    move_uploaded_file($filetmp,$destinationfile);
                }

                // if($advanceRupee != 0 && $advPWeight != 0){

                if(isset($destinationForDatabase) == null){
                    $sql = "INSERT INTO scrab_stock (scrabId,date,name,type,karat,weight,dust,ratiMashy,nag,labFee,etc,discount,purePrice,category) 
                    VALUES ('$pid','$date','$advPName','$advProductType','$advPKarat','$advPWeight','$advPDust','$advPRatiMashy','$advPNag','$advPLabFee','$advPETC','$advPDiscount','$advPTotal','$category')";
                }else{
                    $sql = "INSERT INTO scrab_stock (scrabId,date,name,type,karat,weight,dust,ratiMashy,nag,labFee,etc,discount,purePrice,category,image) 
                    VALUES ('$pid','$date','$advPName','$advProductType','$advPKarat','$advPWeight','$advPDust','$advPRatiMashy','$advPNag','$advPLabFee','$advPETC','$advPDiscount','$advPTotal','$category','$destinationForDatabase')";
                }
                mysqli_query($con, $sql);
                $advanceQuery = "INSERT INTO custom_order_advance (orderId,scrabId,date) VALUES ('$customOrderId','$pid','$date')";
                mysqli_query($con, $advanceQuery);

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