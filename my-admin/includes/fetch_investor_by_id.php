<?php

include("../database/connection.php");

$investorId = $_POST['investorId'];
// $goldPathorId = 50;

$sql = "SELECT * FROM investors WHERE id = $investorId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>