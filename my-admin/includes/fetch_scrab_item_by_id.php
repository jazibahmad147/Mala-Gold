<?php

include("../database/connection.php");

$scrabId = $_POST['scrabId'];

$sql = "SELECT * FROM scrab_stock WHERE id = $scrabId";


$result = $con->query($sql);

if($result->num_rows > 0) { 
    $row = $result->fetch_array();
   } // if num_rows
   
$con->close();
   
echo json_encode($row);


?>