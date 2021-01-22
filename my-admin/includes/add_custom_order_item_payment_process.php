<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

       
        $workerPaymentDate = mysqli_real_escape_string($con, $_POST['workerPaymentDate']);
        // storing worker_payments...
        $count = count($_POST["orderItemCheckBox"]);
        for($i=0; $i<$count; $i++){


            $orderItemCheckBox = mysqli_real_escape_string($con, $_POST['orderItemCheckBox'][$i]);
            $selectedOption = mysqli_real_escape_string($con, $_POST['selectedOption'][$i]);
            $orderItemAmount = mysqli_real_escape_string($con, $_POST['orderItemAmount'][$i]);
            
            
            $orderItemsSql = "INSERT INTO worker_payments (date,itemId,workerId,rupee) 
            VALUES ('$workerPaymentDate','$orderItemCheckBox','$selectedOption','$orderItemAmount')";
            mysqli_query($con, $orderItemsSql);
            
            // fetching old paid pure amount 
            $query = "SELECT * FROM `custom_order_items` WHERE id = '$orderItemCheckBox'";
            $Result = $con->query($query);
            $result_row = $Result->fetch_array();
            $oldPurePaid = $result_row[20];

            $newPurePaid = $oldPurePaid + $orderItemAmount;


            $orderItemUpdateSql = "UPDATE `custom_order_items` SET `paidPurePrice`='$newPurePaid' WHERE id = '$orderItemCheckBox'";
            mysqli_query($con, $orderItemUpdateSql);


        }
      
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