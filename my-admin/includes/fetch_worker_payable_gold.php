<?php

include("../database/connection.php");

$id = $_POST['key'];
// $goldPathorId = 50;

$query = "SELECT * FROM custom_orders WHERE customerId = $id";
$Result = $con->query($query);
$result_row = $Result->fetch_array();
$orderId = $result_row[1];

$workers_arr = array();
$sql = "SELECT pureWeight FROM custom_order_items WHERE orderId = $orderId";
$result = $con->query($sql);

$amt = 0;
while( $row = mysqli_fetch_array($result) ){
    $amt += $row['pureWeight'];

    // $workers_arr[] = array("id" => $workersId, "name" => $workersName);
 }
$con->close();
   
echo json_encode($amt);


?>