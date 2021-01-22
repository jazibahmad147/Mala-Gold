<?php

include("../database/connection.php");
    
    $valid['success'] = array('success' => false, 'messages' => array());

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $buying = mysqli_real_escape_string($con, $_POST['buying']);
        $selling = mysqli_real_escape_string($con, $_POST['selling']);
        $category = "PATHOR";

        
        // Checking date recurring...
        $check = "SELECT * FROM `rate_list` WHERE date = '$date' AND category = '$category'";
        $result = mysqli_query($con, $check);
        $num = mysqli_num_rows($result);

        if($num == 1){
            $valid['success'] = false;
            $valid['messages'] = "Your Data Already Inserted According to Date!";
            $valid['class'] = "bg-danger";
            $valid['title'] = "Error";
        }else{

            $sql = "INSERT INTO rate_list (date,buying,selling,category) VALUES ('$date','$buying','$selling','$category')";
            mysqli_query($con, $sql);

            $valid['success'] = true;
            $valid['messages'] = "Your Insertion Successfully Done!";
            $valid['class'] = "bg-success";
            $valid['title'] = "Done";
        }

        
    $con->close();
    echo json_encode($valid);


}

?>