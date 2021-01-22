<?php

include("../database/connection.php");

$id = $_POST['id'];
// $goldPathorId = 50;

$sql = "SELECT * FROM custom_order_items WHERE id = $id";
// $sql = "SELECT * FROM rate_list WHERE id = 19";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>