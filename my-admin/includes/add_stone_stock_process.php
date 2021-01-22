<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());


if($_SERVER['REQUEST_METHOD'] == "POST"){
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        $price = mysqli_real_escape_string($con, $_POST['price']);

        // fetch Old Key... 
        $query = "SELECT id FROM stones_stock ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $key = $result_row[0]+1;
        // barcode number...
        // stone = 7866
        $barcode = "7866".$key;

        $sql = "INSERT INTO stones_stock (date,barcode,name,total_weight,price) VALUES ('$date','$barcode','$name','$weight','$price')";
        mysqli_query($con, $sql);

        $valid['success'] = true;
        $valid['messages'] = "Your Data Inserted Successfully!";
        $valid['class'] = "bg-success";
        $valid['title'] = "Done";
    }
    else{
        $valid['success'] = false;
        $valid['messages'] = "Your Data Insertion Have Some Error!";
        $valid['class'] = "bg-danger";
        $valid['title'] = "Error";
    }

         
    $con->close();
    echo json_encode($valid);
    // echo $valid;

?>