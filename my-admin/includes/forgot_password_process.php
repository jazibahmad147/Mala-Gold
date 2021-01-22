<?php

session_start();
include("../database/connection.php");
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        // $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $key = mysqli_real_escape_string($con, $_POST['secretKey']);

        
        // Checking emails recurring.
        $check = "SELECT * FROM `admin_user` WHERE email = '$email'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);
        $result_row = $result->fetch_array();
        $status = $result_row[5];

        if($num == 1){
            if($status != "ACTIVE"){
                header("Location: ../forgot_password.php?error=1");
            }else if($key != "333555222"){
                header("Location: ../forgot_password.php?error=2");
            }else{
                $password = md5($password); // Password Encryption....
                $sql = "UPDATE `admin_user` SET `password`='$password' WHERE email = '$email'";
                $run = mysqli_query($con, $sql);
                if($run){
                    header("Location: ../index.php");
                }
            }
        }else{
            header("Location: ../forgot_password.php?error=3");
        }


}

?>