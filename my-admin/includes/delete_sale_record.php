<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['delete_sale_record_id']);

        
        // Checking emails recurring...
        $check = "SELECT * FROM `sales` WHERE id = '$id'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        $result_row = $result->fetch_array();

        $invoiceId = $result_row[2];

        if($num == 1){

            $salesSql = "DELETE FROM `sales` WHERE id = '$id'";
            mysqli_query($con, $salesSql);

            $salesItemSql = "DELETE FROM `sale_items` WHERE saleId = '$invoiceId'";
            mysqli_query($con, $salesItemSql);

            $paymentSql = "DELETE FROM `payments` WHERE invoiceId = '$invoiceId'";
            mysqli_query($con, $paymentSql);

            $valid['success'] = true;
            $valid['messages'] = "Your Data Deleted Successfully!";
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