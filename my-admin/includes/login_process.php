<?php

session_start();
include("../database/connection.php");
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        // $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $password = md5($password); // Password Encryption....

        
        // Checking emails recurring.
        $check = "SELECT * FROM `admin_user` WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);
        $result_row = $result->fetch_array();
        $status = $result_row[5];

        if($num == 1){
            if($status != "ACTIVE"){
                header("Location: ../index.php?error=1");
            }else{
                $_SESSION['email'] = $email;
                header("Location: ../dashboard.php");
            }
        }else{
            header("Location: ../index.php?error=2");

        }


}

?>