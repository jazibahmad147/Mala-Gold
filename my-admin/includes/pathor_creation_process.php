<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = date("Y-m-d");
        $totalPreviousWeight = mysqli_real_escape_string($con, $_POST['previoustotalWeight']);
        $previoustotalPrice = mysqli_real_escape_string($con, $_POST['previoustotalPrice']);
        $totalNewWeight = mysqli_real_escape_string($con, $_POST['totalWeight']);
        
       
        // fetch Old Key... 
        $query = "SELECT id FROM gold_pathor_stock ORDER BY id DESC LIMIT 1";
        $Result = $con->query($query);
        $result_row = $Result->fetch_array();
        $key = $result_row[0]+1;

        // barcode number...
        // $barcode = $key."-".$p_name;
        // scrabCode = 61611
        // pathorCode = 72867
        // pieceCode = 74323
        // silverCode = 634726

        $barcode = "4653".$key."72867";


        $sql = "INSERT INTO gold_pathor_stock (barcode,date,weight,previousTotalWeight,previousTotalPrice,status) VALUES ('$barcode','$date','$totalNewWeight','$totalPreviousWeight','$previoustotalPrice','1')";
        mysqli_query($con, $sql);

        $count = $_POST["count"];
        for($i=0; $i<$count; $i++){
            $scrabId = mysqli_real_escape_string($con, $_POST['scrabIds'.$i]);
            $sql = "INSERT INTO converted_scrab (pathorId,scrabId) VALUES ('$barcode','$scrabId')";
            mysqli_query($con, $sql);

            // status changer of scrab items 
            $sqlStatusChanger = "UPDATE `scrab_stock` SET `status`='0' WHERE scrabId='$scrabId'";
            mysqli_query($con, $sqlStatusChanger);
        }

        $sql = "DELETE FROM cart";
        mysqli_query($con, $sql);


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