<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        
        $workerRupeeDate = mysqli_real_escape_string($con, $_POST['workerRupeeDate']);
        $worker = mysqli_real_escape_string($con, $_POST['workerNameInRupee']);
        $amount = mysqli_real_escape_string($con, $_POST['workerAmount']);
        
        // storing worker_payments...
        $payIn = "Rupee";
        $orderItemsSql = "INSERT INTO worker_payments (date,workerId,amount,payIn) VALUES ('$workerRupeeDate','$worker','$amount','$payIn')";
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