<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = mysqli_real_escape_string($con, $_POST['profile_id']);
        $currentPassword = mysqli_real_escape_string($con, $_POST['currentPassword']);
        $currentPassword = md5($currentPassword);
        $newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);
        $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
        
        // Checking emails recurring...
        $check = "SELECT * FROM `admin_user` WHERE id = $id";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($newPassword == "" && $confirmPassword == ""){
            $newPassword = $currentPassword;
            $confirmPassword = $currentPassword;
        }

        if($num == 1){

            // fetching old password
            $query = "SELECT `password` FROM `admin_user` WHERE id = '$id'";
            $Result = $con->query($query);
            $result_row = $Result->fetch_array();
            $oldPassword = $result_row[0];

            if($oldPassword == $currentPassword){
                if($newPassword == $confirmPassword){
                    $newPassword = md5($newPassword);
                    $sql = "UPDATE `admin_user` SET `password`='$newPassword' WHERE id = $id";
                    mysqli_query($con, $sql);

                    $valid['success'] = true;
                    $valid['messages'] = "Your Password Successfully Cahnged!";
                    $valid['class'] = "bg-success";
                    $valid['title'] = "Done";
                }
                else{
                    $valid['success'] = false;
                    $valid['messages'] = "New Passwords Are Not Matched";
                    $valid['class'] = "bg-danger";
                    $valid['title'] = "Error";
                }
            }else{
                $valid['success'] = false;
                $valid['messages'] = "Current Password Dose Not Matched";
                $valid['class'] = "bg-danger";
                $valid['title'] = "Error";
            }

            
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