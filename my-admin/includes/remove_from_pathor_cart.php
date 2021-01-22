<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $sql = "DELETE FROM cart";
        mysqli_query($con, $sql);


        $valid['success'] = true;
        $valid['messages'] = "Cart Clear Successfully!";
        $valid['class'] = "bg-success";
        $valid['title'] = "Done";


        

    }else{
        $valid['success'] = false;
        $valid['messages'] = "Cart Clearing Have Some Error!";
        $valid['class'] = "bg-danger";
        $valid['title'] = "Error";
    }

    

        
    $con->close();
    echo json_encode($valid);
    // echo $valid;

?>