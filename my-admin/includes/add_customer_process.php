<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $name = mysqli_real_escape_string($con, $_POST['c_name']);
        $cnic = mysqli_real_escape_string($con, $_POST['c_cnic']);
        $address = mysqli_real_escape_string($con, $_POST['c_address']);
        $phone = mysqli_real_escape_string($con, $_POST['c_phone']);
        // $category = "pathor";
        
        // Fetching id...
        $fetch_query = "SELECT `id` FROM `customers` ORDER BY id DESC LIMIT 1";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $id = $fetch_query_result_row[0];
        if($id == ""){
            $new_customer_id = "176755260";
        }
        else{
            $new_customer_id = "17675526".$id;
        }

        
        $sql = "INSERT INTO customers (customerId,name,cnic,address,phone) VALUES ('$new_customer_id','$name','$cnic','$address','$phone')";
        mysqli_query($con, $sql);

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