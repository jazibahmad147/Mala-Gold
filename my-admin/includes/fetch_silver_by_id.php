<?php

include("../database/connection.php");

$silverId = $_POST['silverId'];
// $goldPathorId = 50;

$sql = "SELECT * FROM rate_list WHERE id = $silverId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>