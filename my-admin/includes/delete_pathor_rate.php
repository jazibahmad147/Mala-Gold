<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['delete_pathor_id']);
        // $date = mysqli_real_escape_string($con, $_POST['edit_pathor_date']);
        // $buying = mysqli_real_escape_string($con, $_POST['edit_pathor_buying']);
        // $selling = mysqli_real_escape_string($con, $_POST['edit_pathor_selling']);
        // $category = "piece";

        
        // Checking emails recurring...
        $check = "SELECT * FROM `rate_list` WHERE id = '$id'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            $sql = "DELETE FROM `rate_list` WHERE id = '$id'";
            mysqli_query($con, $sql);

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