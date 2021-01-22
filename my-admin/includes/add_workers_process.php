<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $name = mysqli_real_escape_string($con, $_POST['w_name']);
        $address = mysqli_real_escape_string($con, $_POST['w_address']);
        $phone = mysqli_real_escape_string($con, $_POST['w_phone']);
        // $category = "pathor";
        
        // Fetching id...
        $fetch_query = "SELECT `id` FROM `workers` ORDER BY id DESC LIMIT 1";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $id = $fetch_query_result_row[0]+1;

        $new_worker_id = "856426".$id;

        // $new_investor_id = "35726726".$id;

        
        $sql = "INSERT INTO workers (workerId,name,address,phone) VALUES ('$new_worker_id','$name','$address','$phone')";
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