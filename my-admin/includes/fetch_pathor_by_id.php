<?php

include("../database/connection.php");

$pathorId = $_POST['pathorId'];
// $goldPathorId = 50;

$sql = "SELECT * FROM gold_pathor_stock WHERE id = $pathorId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>