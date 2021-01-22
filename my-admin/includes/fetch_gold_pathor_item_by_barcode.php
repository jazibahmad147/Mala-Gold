<?php

include("../database/connection.php");

$key = $_POST['key'];
$category = "PATHOR";
$status = "1";
// $goldPathorId = 50;

$sql = "SELECT * FROM gold_pathor_stock WHERE barcode = '$key' AND status = '$status'";
// $sql = "SELECT * FROM rate_list WHERE id = 19";


$result = $con->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>