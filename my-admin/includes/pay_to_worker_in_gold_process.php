<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        
        $workerGoldDate = mysqli_real_escape_string($con, $_POST['workerGoldDate']);
        $worker = mysqli_real_escape_string($con, $_POST['workerNameInGold']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        
        // storing worker_payments...
        $payIn = "GOLD";
        $orderItemsSql = "INSERT INTO worker_payments (date,workerId,weight,payIn) VALUES ('$workerGoldDate','$worker','$weight','$payIn')";
        mysqli_query($con, $orderItemsSql);
            


      
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