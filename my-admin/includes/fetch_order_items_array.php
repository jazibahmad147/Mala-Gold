<?php 

include("../database/connection.php");

$id = $_POST['id'];

$query = "SELECT `orderId` FROM `custom_orders` WHERE id = '$id'";
$Result = $con->query($query);
$result_row = $Result->fetch_array();
$orderId = $result_row[0];



$custom_order_items_arr = array();

// if($departid > 0){
   $sql = "SELECT * FROM custom_order_items WHERE orderId = '$orderId'";

   $result = mysqli_query($con,$sql);

   while( $row = mysqli_fetch_array($result) ){
      $id = $row['id'];
      $name = $row['name'];
      $sendTo = $row['sendTo'];
      $purePrice = $row['purePrice'];
      $paidPurePrice = $row['paidPurePrice'];

      // fetch customer name according id
      if($sendTo != "SELF"){
         
         $customer = "SELECT * FROM `workers` WHERE workerId = '$sendTo'";
         $customerResult = $con->query($customer);
         $customer_result_row = $customerResult->fetch_array();
         $cust_name = $customer_result_row['name'];

      }else{
         $cust_name = $sendTo;
      }
      


      $custom_order_items_arr[] = array("id" => $id, "name" => $name, "cust_name" => $cust_name, "purePrice" => $purePrice, "paidPurePrice" => $paidPurePrice);
   }
// }

$con->close();
// encoding array to json format
echo json_encode($custom_order_items_arr);

?>