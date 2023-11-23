<?php 
include '../config/db_connect.php';
if(isset($_POST['asset_code']) && !empty($_POST['asset_code'])){
   $sql = 'SELECT * FROM admin_asset_broken';
}
?>