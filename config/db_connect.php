<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hr_winwin_db";
	
// creating the connection
$connect = new mysqli($servername, $username, $password, $dbname);

// checking the connection
if(!$connect->connect_error) {
	date_default_timezone_set("Asia/Bangkok");
	ob_start();
	session_start();
}
else {
	die("Connection Failed : " . $connect->connect_error);
}

?>