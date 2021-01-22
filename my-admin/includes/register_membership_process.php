<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $fullname = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $password = md5($password); // Password Encryption....
        $status = "PENDING";

        
        // Checking emails recurring...
        $check = "SELECT * FROM `admin_user` WHERE email = '$email'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $valid['success'] = false;
            $valid['messages'] = "User Already Registered!";
        }else{

            $sql = "INSERT INTO admin_user (name,email,password,status) VALUES ('$fullname','$email','$password','$status')";
            mysqli_query($con, $sql);

            $valid['success'] = true;
            $valid['messages'] = "User Registered Successfully!";
        }

        
    $con->close();
    echo json_encode($valid);


}

?>