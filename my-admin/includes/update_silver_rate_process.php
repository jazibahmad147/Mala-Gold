<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['edit_silver_id']);
        $date = mysqli_real_escape_string($con, $_POST['edit_silver_date']);
        $buying = mysqli_real_escape_string($con, $_POST['edit_silver_buying']);
        $selling = mysqli_real_escape_string($con, $_POST['edit_silver_selling']);
        // $category = "piece";

        
        // Checking emails recurring...
        $check = "SELECT * FROM `rate_list` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $sql = "UPDATE `rate_list` SET `date`='$date',`buying`='$buying',`selling`='$selling' WHERE id = $id";
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