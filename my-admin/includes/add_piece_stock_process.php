<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());


if($_SERVER['REQUEST_METHOD'] == "POST"){
        $datePiece = mysqli_real_escape_string($con, $_POST['datePiece']);
        $weightPiece = mysqli_real_escape_string($con, $_POST['weightPiece']);

        // Fetching rate by date...
        $category = "piece";
        $fetch_query = "SELECT `selling` FROM `rate_list` WHERE date = '$datePiece' AND category = '$category'";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $price_fetched = $fetch_query_result_row[0];

        // price generation 
        $tola = $weightPiece / 11.664;
        $totalPrice = ($price_fetched * $tola);
        $roundTotalPrice = round($totalPrice);

        // fetch Old Key... 
        $query = "SELECT id FROM gold_piece_stock ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $key = $result_row[0]+1;

        // barcode number...
        // $barcode = $key."-".$p_name;
        // scrabCode = 61611
        // pathorCode = 72867
        // pieceCode = 74323
        // silverCode = 634726

        $barcodePathor = "4653".$key."74323";

        $sql = "INSERT INTO gold_piece_stock (barcode,date,weight,initial_price,status) VALUES ('$barcodePathor','$datePiece','$weightPiece','$roundTotalPrice','1')";
        mysqli_query($con, $sql);

        $valid['success'] = true;
        $valid['messages'] = "Your Data Inserted Successfully!";
        $valid['class'] = "bg-success";
        $valid['title'] = "Done";
    }
    else{
        $valid['success'] = false;
        $valid['messages'] = "Your Data Insertion Have Some Error!";
        $valid['class'] = "bg-danger";
        $valid['title'] = "Error";
    }

         
    $con->close();
    echo json_encode($valid);
    // echo $valid;

?>