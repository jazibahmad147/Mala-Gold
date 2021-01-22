<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['edit_id']);
        $date = mysqli_real_escape_string($con, $_POST['edit_date']);
        $p_name = mysqli_real_escape_string($con, $_POST['edit_p_name']);
        $productType = mysqli_real_escape_string($con, $_POST['edit_productType']);
        $p_description = mysqli_real_escape_string($con, $_POST['edit_p_description']);
        $karat = mysqli_real_escape_string($con, $_POST['edit_karat']);
        $qty = mysqli_real_escape_string($con, $_POST['edit_qty']);
        $weight = mysqli_real_escape_string($con, $_POST['edit_weight']);
        // $extra_charges = mysqli_real_escape_string($con, $_POST['edit_extra_charges']);
        $category = mysqli_real_escape_string($con, $_POST['edit_gold_type']);

        
        // Checking emails recurring...
        $check = "SELECT * FROM `gold_stock` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            // File...
            $files = $_FILES['edit_fileToUpload'];
            $filename = $files['name'];
            $fileerror = $files['error'];
            $filetmp = $files['tmp_name'];

            $fileext = explode('.',$filename);
            $filecheck = strtolower(end($fileext));
            $fileextstored = array('png', 'jpg', 'jpeg');

            if(in_array($filecheck,$fileextstored)){
                $destinationfile = '../media/stock/gold_stock/'.$id.'-'.$filename;
                $destinationForDatabase = $id."-".$filename;
                move_uploaded_file($filetmp,$destinationfile);
            }
            
            if($filename == ""){
                $sql = "UPDATE `gold_stock` SET `date`='$date',`name`='$p_name',`productType`='$productType',`description`='$p_description',`karat`='$karat',`quantity`='$qty',`weight`='$weight',`category`='$category' WHERE id = $id";
                mysqli_query($con, $sql);
            }else{
                $sql = "UPDATE `gold_stock` SET `date`='$date',`name`='$p_name',`productType`='$productType',`description`='$p_description',`karat`='$karat',`quantity`='$qty',`weight`='$weight',`image`='$destinationForDatabase',`category`='$category' WHERE id = $id";
                mysqli_query($con, $sql);
            }

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