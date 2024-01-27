<?php

/**
 * All this source code it just a some function to easily and faster working
 */

include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

function request($value)
{
   return isset($_POST[$value]);
}


class Validator
{
   public static function has_require($data = [], $required_fields = [])
   {
      foreach ($required_fields as $field) {
         if (!isset($data[$field]) || empty(trim($data[$field]))) {
            return false;
         }
      }
      return true;
   }
   public static function has_valid_mail($value)
   {
      return filter_var($value, FILTER_VALIDATE_EMAIL);
   }

}
function insert($data, $table, $connection)
{
   $query = "";
   $colums_key = implode(',', array_keys($data));
   $colums_value = "'" . implode("', '", $data) . "'";
   $query .= "INSERT INTO $table " . "(" . ($colums_key) . ") values (" . ($colums_value) . ")";
   $result = mysqli_query($connection, $query);
   return $result ? true : false;
}
function redirect($message, $redirecto)
{
   header("location: " . $redirecto . ".php?message=$message");
   exit();
}

function upload_img_only($params = [], $connect)
{
   $data_defualts = [
      'img_key' => 'default_img_key',
      'image_dir' => 'default_image_dir',
      'table_name' => 'default_uploadTableName',
      'set_column_name' => 'default_setColumn',
      'where_id_column_table' => 'default_whetIDcomlumn',
      'post_id' => 'post_id',
      'setRedictedErrorPage' => 'default_setRedictedErrorPage',
   ];
   $params = array_merge($data_defualts, $params);
   if (isset($_POST[$params['post_id']]) && !empty($_FILES[$params['img_key']])) {
      $txt_id = $_POST[$params['post_id']];
      $txt_img = date('Ymd') . "_" . basename($_FILES[$params['img_key']]['name']);
      $txt_image_fullName = $params['image_dir'] . DIRECTORY_SEPARATOR . $txt_img;
      if ($_FILES[$params['img_key']]['error'] !== UPLOAD_ERR_OK) {
         return redirect("validate_img", $params['setRedictedErrorPage']) . $_FILES[$params['img_key']]['error'];
      }
      if (!move_uploaded_file($_FILES[$params['img_key']]['tmp_name'], $txt_image_fullName)) {
         return "Failed to move the uploaded file.";
      }
      $query = "UPDATE {$params['table_name']} SET {$params['set_column_name']} = ? WHERE {$params['where_id_column_table']} = ?";
      $stmt = $connect->prepare($query);
      $stmt->bind_param("ss", $txt_img, $txt_id);
      return $stmt->execute() ? true : $stmt->error;
   }
}

/**
 * example usage
 *    $data_defualts = [
      'img_key' => 'txt_img',
      'image_dir' => '../img/upload/admin_stationary_transfer'
      'table_name' => 'admin_stationary_transfer',
      'set_column_name' => 'adsst_img',
      'where_id_column_table' => 'adsst_id',
      'post_id' => '$_POST['id]',
      'setRedictedErrorPage' => 'admin_stationary_transfer',
   ];
 * 
 * 
 */


/**
 *  delete function 
 */
$delete = fn ($_get_request_key, $delete_from_table, $where_column_name, $connect) =>  mysqli_query($connect, "DELETE FROM $delete_from_table WHERE $where_column_name =" . $_GET[$_get_request_key] . "");


/**
 * a get request
 */
function get_req($_get_req)
{
   return isset($_GET[$_get_req]);
}

function generateNewFileName()
{
   return date('Ymd') . "-" . rand(111, 9999) . ".pdf";
}
function moveUploadedFile($newName, $tmpName, $directoryMoveTheFile)
{
   $destination = $directoryMoveTheFile . $newName;

   if (!move_uploaded_file($tmpName, $destination)) {
      throw new Exception("Error moving uploaded file to $destination");
   }
}

function updateDatabaseTable($connection, $tableName, $setColumnName, $whereColumnName, $newValue, $whereValue)
{
   $query = "UPDATE $tableName SET $setColumnName = ? WHERE $whereColumnName = ?";
   $stmt = $connection->prepare($query);

   if (!$stmt) {
      throw new Exception("Error in preparing the SQL statement: " . $connection->error);
   }

   $stmt->bind_param("ss", $newValue, $whereValue);

   if (!$stmt->execute()) {
      throw new Exception("Error executing the SQL statement: " . $stmt->error);
   }

   $stmt->close();
}

function uploadPdfFiles($params, $currentPage, $connection)
{
   try {
      $txtId = $_POST[$params['id_from_form_request']];

      if (!empty($_FILES[$params['fileKeyName']]['name'])) {
         $_file = $_FILES[$params['fileKeyName']];
         $params['directoryForCheckedTypeOfFile'] .= basename($_file['name']);
         $_fileType = strtolower(pathinfo($params['directoryForCheckedTypeOfFile'], PATHINFO_EXTENSION));

         if ($_fileType == 'pdf') {
            $newName = generateNewFileName();
            moveUploadedFile($newName, $_file['tmp_name'], $params['directoryMoveTheFile']);
            updateDatabaseTable($connection, $params['database_table'], $params['setColumnName'], $params['wherePrimaryKeyColumnName'], $newName, $txtId);
            redirect("update", $currentPage);
         }
      }

      redirect("validate_img", $currentPage);
   } catch (Exception $e) {
      // Handle exceptions, log errors, or perform appropriate error handling here
      redirect("error", $currentPage);
   }
}

// Example usage:
// $params = [
//    'fileKeyName' => 'your_file_key_name',
//    'directoryForCheckedTypeOfFile' => 'your_directory_for_checked_type_of_file/',
//    'directoryMoveTheFile' => 'your_directory_move_the_file/',
//    'database_table' => 'your_db_table_name',
//    'setColumnName' => 'your_set_column_name',
//    'wherePrimaryKeyColumnName' => 'your_where_primary_key_column_name',
//    'id_from_form_request' => 'your_id_from_post_req',
// ];

// Call the function
//uploadPdfFiles($params, $your_current_page, $your_db_connection);




$update = function ($update_table, $update_data, $where_column_name, $where_column_value, $connect) {
   $set_clause = "";
   foreach ($update_data as $column => $value) {
      $set_clause .= "$column = '" . mysqli_real_escape_string($connect, $value) . "', ";
   }
   $set_clause = rtrim($set_clause, ', ');
   $query = "UPDATE $update_table SET $set_clause WHERE $where_column_name = '" . mysqli_real_escape_string($connect, $where_column_value) . "'";
   $result = mysqli_query($connect, $query);
   return $result ? true : false;
};

// Example usage

/**
 *  Example usage:
Assuming you have a MySQLi connection object named $mysqli
$table_name = 'your_table_name'; // Replace with your actual table name
$update_data = array(
   'column1' => 'new_value1',
   'column2' => 'new_value2',
Add more columns as needed
);
$where_column = 'id'; // Replace with your actual column name
$where_value = 1; // Replace with the value for the WHERE clause

$result = $update($table_name, $update_data, $where_column, $where_value, $mysqli);

if ($result) {
   echo "Update successful!";
} else {
   echo "Error updating record: " . mysqli_error($mysqli);
}

 */
