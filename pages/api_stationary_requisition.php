<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
////////////////  stationary_requisition ///////////////////////////

$sql_stations = "select max(sr_id) as max_id,sr_ps_no from stationary_requisition";
$result_station = $connect->query($sql_stations);
$data = $result_station->fetch_assoc();
$number_rows = $data['max_id'];
if($number_rows == NULL){
   $responses = [
      'ps' => '1000',
   ];
   echo json_encode($responses);
}else{
   $sql_station = "select sr_id ,sr_ps_no from stationary_requisition where sr_id = ?";
   $stmt = $connect->prepare($sql_station);
   $stmt->bind_param("i",$number_rows);
   if($stmt->execute()){
      $last_number = $stmt->get_result();
      $rows = $last_number->fetch_assoc();
      $responses= [
         'ps' => $rows['sr_ps_no'],
      ];
      echo json_encode($responses);
   }
   $stmt->close();
}

