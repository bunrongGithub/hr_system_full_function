<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


///fetch last index of id table  number ;
$invoice = "SELECT max(paym_id),paym_invoice_no FROM payment";
$result = $connect->query($invoice);
if ($result->num_rows > 0) {
   $row = $result->fetch_row();
   $last_row = $row[0];
}
if ($last_row) {
   $get_invoce = "SELECT paym_id,paym_invoice_no FROM payment WHERE  paym_id = $last_row";

   $get_result = $connect->query($get_invoce);
   $get_row_invoice = $get_result->fetch_assoc();
   $respone = [
      'inv_no' =>$get_row_invoice['paym_invoice_no'],
   ];
   header('Content-Type: application/json');
   echo json_encode($respone);
}

