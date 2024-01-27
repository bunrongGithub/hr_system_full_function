<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

//////////////////  asset_requisitions //////////////////


$pano = "SELECT max(as_id) AS max_id, as_pa_no FROM asset_requisiton";
$result = $connect->query($pano);
$rows_empty = $result->fetch_assoc();
$numer_rows = $rows_empty["max_id"];

if ($numer_rows == NULL) {
   $response = [
      'pano' => '1000',
   ];
   echo json_encode($response);
} else {
   $sql = "SELECT as_id, as_pa_no FROM asset_requisiton WHERE as_id = ?";
   $stmt = $connect->prepare($sql);
   $stmt->bind_param("i", $numer_rows); 

   if ($stmt->execute()) {
      $last_result = $stmt->get_result();
      $rows = $last_result->fetch_assoc();

      $response = [
         'pano' => $rows['as_pa_no'],
      ];

      echo json_encode($response);
   } else {
      $response = [
         'error' => 'Unable to fetch data',
      ];
      echo json_encode($response);
   }

   $stmt->close(); 
}
