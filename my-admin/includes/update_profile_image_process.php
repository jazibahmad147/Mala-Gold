<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['profile_id']);
        
        // Checking emails recurring...
        $check = "SELECT * FROM `admin_user` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){

            // File...
            $files = $_FILES['fileToUpload'];
            $filename = $files['name'];
            $fileerror = $files['error'];
            $filetmp = $files['tmp_name'];

            $fileext = explode('.',$filename);
            $filecheck = strtolower(end($fileext));
            $fileextstored = array('png', 'jpg', 'jpeg');

            if(in_array($filecheck,$fileextstored)){
                $destinationfile = '../media/profiles/'.$id.'-'.$filename;
                $destinationForDatabase = $id."-".$filename;
                move_uploaded_file($filetmp,$destinationfile);
            }
            
            $sql = "UPDATE `admin_user` SET `image`='$destinationForDatabase' WHERE id = $id";
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