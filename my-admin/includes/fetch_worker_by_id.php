<?php

include("../database/connection.php");

$workerId = $_POST['workerId'];
// $goldPathorId = 50;

$sql = "SELECT * FROM workers WHERE id = $workerId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>