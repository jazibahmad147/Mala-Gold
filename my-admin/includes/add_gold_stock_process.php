<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $p_name = mysqli_real_escape_string($con, $_POST['p_name']);
        $group = mysqli_real_escape_string($con, $_POST['group']);
        $investorName = mysqli_real_escape_string($con, $_POST['investorName']);
        $productType = mysqli_real_escape_string($con, $_POST['productType']);
        $p_description = mysqli_real_escape_string($con, $_POST['p_description']);
        $karat = mysqli_real_escape_string($con, $_POST['karat']);
        $qty = mysqli_real_escape_string($con, $_POST['qty']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        // $extra_charges = mysqli_real_escape_string($con, $_POST['extra_charges']);
        $category = mysqli_real_escape_string($con, $_POST['gold_type']);
        // $category = mysqli_real_escape_string($con, $_POST['type_gold']);
        // $category = "pathor";

        // fetch Old Key... 
        $query = "SELECT id FROM gold_stock ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $key = $result_row[0]+1;

        // barcode number...
        // $barcode = $key."-".$p_name;
        // goldCode = 4653
        // pathorCode = 72867
        // pieceCode = 74323
        // silverCode = 745837
        
        // Fetching rate by date...
        $fetch_query = "SELECT `selling` FROM `rate_list` WHERE date = '$date' AND category = '$category'";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $price_fetched = $fetch_query_result_row[0];
        echo $category;

        if($category == "PATHOR"){
            // pathor means gold 
            $category = "GOLD";
            $pid = "4653-".$key;
        }else if($category == "PIECE"){
            // piece means silver 
            $category = "SILVER";
            $pid = "745837-".$key;
        }

        // Karat Calculation... 
        if($karat == 24){
          $new_price = $price_fetched;
        }else{
          $new_price = ($price_fetched / 24) * $karat;
        }
        $tola = $weight / 11.664;

        $totalPrice = ($new_price * $tola);
        $roundTotalPrice = round($totalPrice);
        // $roundTotalPrice = number_format((float)$totalPrice, 2, '.', '');

        


        // File...
        $files = $_FILES['fileToUpload'];
        $filename = $files['name'];
        $fileerror = $files['error'];
        $filetmp = $files['tmp_name'];

        $fileext = explode('.',$filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png', 'jpg', 'jpeg');

        if(in_array($filecheck,$fileextstored)){
            $destinationfile = '../media/stock/gold_stock/'.$key.'-'.$filename;
            $destinationForDatabase = $key."-".$filename;
            move_uploaded_file($filetmp,$destinationfile);
        }


        if($totalPrice == ""){
            $valid['success'] = false;
            $valid['messages'] = "Please Insert Today's Gold Rate First!";
            $valid['class'] = "bg-danger";
            $valid['title'] = "Error";
        }else{
            if($investorName == ""){
                $investorName = "null";
            }
            if(isset($destinationForDatabase) == null){
                $sql = "INSERT INTO gold_stock (p_key,date,name,productType,description,karat,quantity,weight,initial_price,category,stockGroup,investorName) VALUES ('$pid','$date','$p_name','$productType','$p_description','$karat','$qty','$weight','$roundTotalPrice','$category','$group','$investorName')";
            }else{
                $sql = "INSERT INTO gold_stock (p_key,date,name,productType,description,karat,quantity,weight,initial_price,image,category,stockGroup,investorName) VALUES ('$pid','$date','$p_name','$productType','$p_description','$karat','$qty','$weight','$roundTotalPrice','$destinationForDatabase','$category','$group','$investorName')";
            }
            
            mysqli_query($con, $sql);
    
            $valid['success'] = true;
            $valid['messages'] = "Your Data Inserted Successfully!";
            $valid['class'] = "bg-success";
            $valid['title'] = "Done";

        }

        

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