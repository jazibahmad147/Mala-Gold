<?php

include("../database/connection.php");

$orderId = $_POST['id'];
// $goldPathorId = 50;

$sql = "SELECT * FROM custom_orders WHERE id = $orderId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>