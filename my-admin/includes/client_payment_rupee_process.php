<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = mysqli_real_escape_string($con, $_POST['paymentDate']);
        $invoiceId = mysqli_real_escape_string($con, $_POST['invoiceId']);
        $payment = mysqli_real_escape_string($con, $_POST['newPayment']);
        

        // Fetching balance and payments from sales record...
        $fetching_query = "SELECT * FROM `custom_orders` WHERE orderId = '$invoiceId'";
        $fetching_query_result = $con->query($fetching_query);
        $fetching_query_result_row = $fetching_query_result->fetch_array();
        $paid = $fetching_query_result_row[7];
        $balance = $fetching_query_result_row[8];

        $newPaidAmount = $paid + $payment;
        $newBalanceAmount = $balance - $payment;
        
        $sql = "INSERT INTO custom_order_advance (orderId,advanceRupee,date) VALUES ('$invoiceId','$payment','$date')";
        mysqli_query($con, $sql);

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