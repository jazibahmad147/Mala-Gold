<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = mysqli_real_escape_string($con, $_POST['paymentDate']);
        $invoiceId = mysqli_real_escape_string($con, $_POST['invoiceId']);
        $payment = mysqli_real_escape_string($con, $_POST['newPayment']);
        $notes = mysqli_real_escape_string($con, $_POST['extraNote']);
        
        // Fetching id...
        $fetch_query = "SELECT `id` FROM `payments` ORDER BY id DESC LIMIT 1";
        $fetch_query_result = $con->query($fetch_query);
        $fetch_query_result_row = $fetch_query_result->fetch_array();
        $id = $fetch_query_result_row[0]+1;
        $new_payment_id = "6185257".$id;

        // $payment = "6185257";

        // Fetching balance and payments from sales record...
        $fetching_query = "SELECT * FROM `sales` WHERE saleId = '$invoiceId'";
        $fetching_query_result = $con->query($fetching_query);
        $fetching_query_result_row = $fetching_query_result->fetch_array();
        $paid = $fetching_query_result_row[8];
        // $balance = $fetching_query_result_row[9];

        $newPaidAmount = $paid + $payment;
        // $newBalanceAmount = $balance - $payment;
        
        $sql = "INSERT INTO payments (paymentId,date,invoiceId,payment,extraNote) VALUES ('$new_payment_id','$date','$invoiceId','$payment','$notes')";
        mysqli_query($con, $sql);

        // $updateSql = "UPDATE `sales` SET `paid`='$newPaidAmount',`balance`='$newBalanceAmount' WHERE saleId = '$invoiceId'";
        // mysqli_query($con, $updateSql);


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