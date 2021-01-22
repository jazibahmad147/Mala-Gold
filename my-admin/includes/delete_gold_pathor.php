<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['delete_pathor_id']);
        echo "ID:".$id;

        
        // Checking emails recurring...
        $check = "SELECT * FROM `gold_pathor_stock` WHERE barcode = '$id'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        


        if($num == 1){

            // fetching scrabID
            $checkScrabItemQuery = "SELECT * FROM converted_scrab WHERE pathorId='$id'";
            $result = mysqli_query($con, $check);
            $num = mysqli_num_rows($result);
            echo "num: ".$num;

            if($num > 0){
                $query = mysqli_query($con,"SELECT * FROM converted_scrab WHERE pathorId='$id'");
                while($queryResult = mysqli_fetch_array($query)){
                    $scrabId = $queryResult['scrabId'];

                    $updateQuery = "UPDATE `scrab_stock` SET `status`='1' WHERE scrabId='$scrabId'";
                    mysqli_query($con, $updateQuery);

                    $deleteFromConvertedSql = "DELETE FROM `converted_scrab` WHERE pathorId = '$id'";
                    mysqli_query($con, $deleteFromConvertedSql);
                }
            }


            $sql = "DELETE FROM `gold_pathor_stock` WHERE barcode = '$id'";
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