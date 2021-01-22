<?php 

include("../database/connection.php");

// $departid = 0;

// if(isset($_POST['depart'])){
//    $departid = mysqli_real_escape_string($con,$_POST['depart']); // department id
// }

$workers_arr = array();

// if($departid > 0){
   $sql = "SELECT workerId,name FROM workers";

   $result = mysqli_query($con,$sql);

   while( $row = mysqli_fetch_array($result) ){
      $workersId = $row['workerId'];
      $workersName = $row['name'];

      $workers_arr[] = array("id" => $workersId, "name" => $workersName);
   }
// }

$con->close();
// encoding array to json format
echo json_encode($workers_arr);

?>