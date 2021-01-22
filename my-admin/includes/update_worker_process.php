<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['edit_w_id']);
        $name = mysqli_real_escape_string($con, $_POST['edit_w_name']);
        $address = mysqli_real_escape_string($con, $_POST['edit_w_address']);
        $phone = mysqli_real_escape_string($con, $_POST['edit_w_phone']);

        
        // Checking emails recurring...
        $check = "SELECT * FROM `workers` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $sql = "UPDATE `workers` SET `name`='$name',`address`='$address',`phone`='$phone' WHERE id = $id";
            mysqli_query($con, $sql);

            $valid['success'] = true;
            $valid['messages'] = "Your Updation Successfully Done!";
            $valid['class'] = "bg-success";
            $valid['title'] = "Done";
        }else{
            $valid['success'] = false;
            $valid['messages'] = "Your Updation Have Some Error!";
            $valid['class'] = "bg-danger";
            $valid['title'] = "Error";
        }

    $con->close();
    echo json_encode($valid);


}

?>