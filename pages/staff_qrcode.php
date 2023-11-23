<?php
include '../config/db_connect.php';
include '../phpqrcode/qrlib.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


$v_empid = $_GET['empid'];
$v_branchid = $_GET['branchid'];
$location = '../img/upload/qrcode_img/empid=' . $v_empid . "&branchid=" . $v_branchid . '.png';
//$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$CurPageURL = 'https://hrwewinv1.newsoft15.com/pages/qr_attendance.php?empid=' . $v_empid . "&branchid=" . $v_branchid;

$qr = QRcode::png($CurPageURL, $location);
	
header("Content-Type: image/png");
header("Content-Transfer-Encoding: Binary");
// It will be called downloaded.pdf
header('Content-Disposition: attactment; filename = "empid=' . $v_empid . '&branchid=' . $v_branchid . '.png"');

// The PDF source is in original.pdf
file_get_contents($location);
readfile($location);

?>
