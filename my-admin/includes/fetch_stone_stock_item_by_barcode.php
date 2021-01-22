<?php

include("../database/connection.php");

$key = $_POST['barcode'];
// $category = "pathor";
// $goldPathorId = 50;

$sql = "SELECT * FROM stones_stock WHERE barcode = '$key'";


$result = $con->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>