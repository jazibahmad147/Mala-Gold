<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['return_order_record_id']);

        
        // finding invoice id from sales...
        $check = "SELECT * FROM `custom_orders` WHERE id = '$id'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);
        $result_row = $result->fetch_array();
        $invoiceId = $result_row[1];


        

        if($num == 1){
            // fetch scrab id 
            $fetching = "SELECT * FROM `custom_order_advance` WHERE orderId = '$invoiceId'";
            $resultfetched = $con->query($fetching);
            $result_row = $resultfetched->fetch_array();
            $scrabId = $result_row[3];

            $orderSql = "DELETE FROM `custom_orders` WHERE id = '$id'";
            mysqli_query($con, $orderSql);

            $orderItemSql = "DELETE FROM `custom_order_items` WHERE orderId = '$invoiceId'";
            mysqli_query($con, $orderItemSql);

            $orderStonesSql = "DELETE FROM `sale_stones` WHERE saleId = '$invoiceId'";
            mysqli_query($con, $orderStonesSql);

            $orderStonesSql = "DELETE FROM `sale_stones` WHERE saleId = '$invoiceId'";
            mysqli_query($con, $orderStonesSql);

            $paymentSql = "DELETE FROM `scrab_stock` WHERE scrabId = '$scrabId'";
            mysqli_query($con, $paymentSql);

            $valid['success'] = true;
            $valid['messages'] = "Your Data Returned Successfully!";
            $valid['class'] = "bg-success";
            $valid['title'] = "Done";

            }else{
                $valid['success'] = false;
                $valid['messages'] = "Your Data Not Exist!";
                $valid['class'] = "bg-danger";
                $valid['title'] = "Error";
            }

    $con->close();
    echo json_encode($valid);


}

?>