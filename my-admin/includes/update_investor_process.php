<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['edit_i_id']);
        $name = mysqli_real_escape_string($con, $_POST['edit_i_name']);
        $address = mysqli_real_escape_string($con, $_POST['edit_i_address']);
        $phone = mysqli_real_escape_string($con, $_POST['edit_i_phone']);

        
        // Checking emails recurring...
        $check = "SELECT * FROM `investors` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $sql = "UPDATE `investors` SET `name`='$name',`address`='$address',`phone`='$phone' WHERE id = $id";
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