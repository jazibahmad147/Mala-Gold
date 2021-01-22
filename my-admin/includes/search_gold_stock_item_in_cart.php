<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['p_key']);


        // $query = "SELECT `p_key` FROM `gold_stock` WHERE id = '$id'";
        $query = "SELECT * FROM `gold_stock` WHERE id = '$id'";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();

        // $karat = $result_row[5];
        $qty = $result_row[7];

        $valid['success'] = true;
        $valid['messages'] = "Your Data Inserted Successfully!";
        // $valid['karat'] = $karat;
        $valid['qty'] = $qty;

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