<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['edit_stone_id']);
        $date = mysqli_real_escape_string($con, $_POST['edit_date']);
        $name = mysqli_real_escape_string($con, $_POST['edit_name']);
        $weight = mysqli_real_escape_string($con, $_POST['edit_weight']);
        $price = mysqli_real_escape_string($con, $_POST['edit_price']);

        
        // Checking stone recurring...
        $check = "SELECT * FROM `stones_stock` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $sql = "UPDATE `stones_stock` SET `date`='$date',`name`='$name',`total_weight`='$weight',`price`='$price' WHERE id = $id";
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