<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $orderId = mysqli_real_escape_string($con, $_POST['orderId']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $name = mysqli_real_escape_string($con, $_POST['p_name']);
        $type = mysqli_real_escape_string($con, $_POST['productType']);
        // $desc = mysqli_real_escape_string($con, $_POST['p_description']);
        $karat = mysqli_real_escape_string($con, $_POST['karatSelected']);
        // $qty = mysqli_real_escape_string($con, $_POST['qty']);
        $initial_weight = mysqli_real_escape_string($con, $_POST['initial_weight']);
        $pure_weight = mysqli_real_escape_string($con, $_POST['weightSelected']);
        $dust = mysqli_real_escape_string($con, $_POST['dust']);
        $ratiMashy = mysqli_real_escape_string($con, $_POST['ratiMashy']);
        $nag = mysqli_real_escape_string($con, $_POST['nag']);
        $labFee = mysqli_real_escape_string($con, $_POST['labFee']);
        $etc = mysqli_real_escape_string($con, $_POST['etc']);
        $discount = mysqli_real_escape_string($con, $_POST['discount']);
        // $scrabPrice = mysqli_real_escape_string($con, $_POST['scrabPrice']);
        $purePrice = mysqli_real_escape_string($con, $_POST['priceSelected']);
        $category = mysqli_real_escape_string($con, $_POST['category']);
        

        // fetch Old Key... 
        $query = "SELECT id FROM scrab_stock ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $key = $result_row[0]+1;

        // barcode number...
        // $barcode = $key."-".$p_name;
        // scrabCode = 61611
        // pathorCode = 72867
        // pieceCode = 74323
        // silverCode = 634726

        if($category == "PATHOR"){
            $pid = "72867".$key."61611";
        }else if($category == "PIECE"){
            $pid = "74323".$key."61611";
        }else if($category == "silver"){
            $pid = "634726".$key."61611";
        }


        // rate fetching 
        $query = "SELECT * FROM `rate_list` WHERE date = '$date'";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $rate = $result_row['buying'];


        // File...
        $files = $_FILES['fileToUpload'];
        $filename = $files['name'];
        $fileerror = $files['error'];
        $filetmp = $files['tmp_name'];

        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png', 'jpg', 'jpeg');

        if(in_array($filecheck,$fileextstored)){
            $destinationfile = '../media/stock/scrab_stock/'.$key.'-'.$filename;
            $destinationForDatabase = $key."-".$filename;
            move_uploaded_file($filetmp,$destinationfile);
        }

        if($filename == ""){
            $sql = "INSERT INTO scrab_stock (scrabId,date,name,type,karat,initial_weight,pure_weight,dust,ratiMashy,nag,labFee,etc,discount,purePrice,category,rate) VALUES ('$pid','$date','$name','$type','$karat','$initial_weight','$pure_weight','$dust','$ratiMashy','$nag','$labFee','$etc','$discount','$purePrice','$category','$rate')";
        }else{
            $sql = "INSERT INTO scrab_stock (scrabId,date,name,type,karat,initial_weight,pure_weight,dust,ratiMashy,nag,labFee,etc,discount,purePrice,category,rate,image) VALUES ('$pid','$date','$name','$type','$karat','$initial_weight','$pure_weight','$dust','$ratiMashy','$nag','$labFee','$etc','$discount','$purePrice','$category','$rate','$destinationForDatabase')";
        }
        
        mysqli_query($con, $sql);

        $advanceQuery = "INSERT INTO custom_order_advance (orderId,scrabId,date) VALUES ('$orderId','$pid','$date')";
        mysqli_query($con, $advanceQuery);


        // Fetching balance and payments from sales record...
        $fetching_query = "SELECT * FROM `custom_orders` WHERE orderId = '$orderId'";
        $fetching_query_result = $con->query($fetching_query);
        $fetching_query_result_row = $fetching_query_result->fetch_array();
        $paid = $fetching_query_result_row[7];
        $balance = $fetching_query_result_row[8];
        
        $newPaidAmount = $paid + $payment;
        $newBalanceAmount = $balance - $payment;
        
        $updateSql = "UPDATE `custom_orders` SET `totalAdvance`='$newPaidAmount',`totalBalance`='$newBalanceAmount' WHERE orderId = '$invoiceId'";
        mysqli_query($con, $updateSql);


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