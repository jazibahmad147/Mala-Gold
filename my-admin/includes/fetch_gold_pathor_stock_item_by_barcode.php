<?php

include("../database/connection.php");

$key = $_POST['key'];
// $category = "pathor";
// $goldPathorId = 50;

$sql = "SELECT * FROM gold_stock WHERE p_key = '$key'";
// $sql = "SELECT * FROM rate_list WHERE id = 19";


$result = $con->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>