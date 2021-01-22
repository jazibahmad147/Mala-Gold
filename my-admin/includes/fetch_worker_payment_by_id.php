<?php

include("../database/connection.php");

$id = $_POST['id'];
// $goldPathorId = 50;

$sql = "SELECT * FROM worker_payments WHERE id = $id";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>