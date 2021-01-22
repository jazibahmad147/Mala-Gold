<?php

include("../database/connection.php");

$customerId = $_POST['customerId'];
// $goldPathorId = 50;

$sql = "SELECT * FROM customers WHERE id = $customerId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>