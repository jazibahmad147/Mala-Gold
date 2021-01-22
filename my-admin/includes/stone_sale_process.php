<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $customer = mysqli_real_escape_string($con, $_POST['customer']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $total = $price * $weight;
        // $category = "pathor";
        
        // Fetching id...
        $fetch_query = "SELECT `id` FROM `sale_stones` ORDER BY id DESC LIMIT 1";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $id = $fetch_query_result_row[0];
        // stone = 78663
        // sale = 7253
        if($id == ""){
            $new_saleId = "7253-78663-1";
        }
        else{
            $new_saleId = "7253-78663-".$id;
        }

        
        $sql = "INSERT INTO sale_stones (date,saleId,stoneId,customer,total_weight,price,total) VALUES ('$date','$new_saleId','$name','$customer','$weight','$price','$total')";
        mysqli_query($con, $sql);

        // fetch weight and update ... 
        $stoneWeightFetched = "SELECT * FROM `stones_stock` WHERE barcode = '$name'";
        $stoneResultWeight = $con->query($stoneWeightFetched);
        $stone_result_row_weight = $stoneResultWeight->fetch_array();
        $new_weight = $stone_result_row_weight[4]-$weight;

        $updateStock = "UPDATE `stones_stock` SET `total_weight`='$new_weight' WHERE barcode = '$name'";
        mysqli_query($con, $updateStock);



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