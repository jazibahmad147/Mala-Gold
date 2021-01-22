<?php

include("../database/connection.php");


$date = date("Y-m-d");
$cat = "pathor";

$sql = "SELECT * FROM rate_list WHERE date = '$date' AND category = '$cat'";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);



?>


