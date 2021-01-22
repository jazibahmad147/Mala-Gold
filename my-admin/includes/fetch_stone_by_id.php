<?php

include("../database/connection.php");

$stoneId = $_POST['stoneId'];

$sql = "SELECT * FROM stones_stock WHERE id = $stoneId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>