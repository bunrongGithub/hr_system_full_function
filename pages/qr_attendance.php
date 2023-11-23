<?php
include '../config/db_connect.php';
include '../phpqrcode/qrlib.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$currenttime = date('H:i:00');

$v_empid = $_GET['empid'];
$v_branchid = $_GET['branchid'];
$location = '../img/upload/qrcode_img/empid=' . $v_empid . "&branchid=" . $v_branchid . '.png';

$v_updatedate = '';
$v_ae_id = '';
$v_job_id = '';
$v_er_id = '';
$v_gender = '';
$v_timein_morning = '';
$v_timeout_morning = '';
$v_timein_afternoon = '';
$v_timeout_afternoon = '';

if (isset($_POST["btnsubmit"])) {
    $sqlr = "SELECT * FROM employee_registration 
                        LEFT JOIN attendance_entry ON attendance_entry.ae_er_id = employee_registration.er_id 
                        WHERE employee_registration.er_id = $v_empid AND employee_registration.er_branch_id = $v_branchid order by attendance_entry.ae_id DESC 
                        LIMIT 1";

    $resultr = $connect->query($sqlr);
    while ($rows = $resultr->fetch_assoc()) {
        $v_updatedate = $rows['ae_date'];
        $v_ae_id = $rows['ae_id'];
        $v_job_id = $rows['er_job_id'];
        $v_er_id = $rows['ae_er_id'];
        $v_gender = $rows['er_gender_id'];
        $v_timein_morning = $rows['ae_time_in_morning'];
        $v_timeout_morning = $rows['ae_time_out_morning'];
        $v_timein_afternoon = $rows['ae_time_in_afternoon'];
        $v_timeout_afternoon = $rows['ae_time_out_afternoon'];
    }

    if ($v_updatedate == $yeardate) {
        $sql = "UPDATE attendance_entry set ";
        if ($currenttime >= '09:30:00' && $currenttime <= '12:30:00') {
            $sql .= "ae_time_out_morning = '$currenttime' ";
        } else if ($currenttime >= '13:00:00' && $currenttime <= '14:00:00') {
            $sql .= "ae_time_in_afternoon = '$currenttime' ";
        } else if ($currenttime >= '17:00:00' && $currenttime <= '19:00:00') {
            $sql .= "ae_time_out_afternoon = '$currenttime' ";
        } else {
            echo ('<script>alert(" You are not allow to CHECK IN \n Please Contact Admin");
            window.location.href="qr_attendance.php?empid=' . $v_empid . '&branchid=' . $v_branchid . '&message=failure";</script>');
        }
        $sql .= "WHERE ae_id = $v_ae_id ";
    } else {
        $sql = 'INSERT INTO attendance_entry ( 
    `ae_er_id`, 
    `ae_date`, 
    `ae_job_id`, 
    `ae_gender`, ';
        if ($currenttime >= '07:00:00' && $currenttime <= '08:30:00') {
            $sql .= "ae_time_in_morning ) VALUE ('$v_empid','$yeardate','$v_job_id','$v_gender','$currenttime') ";
        } else if ($currenttime >= '11:30:00' && $currenttime <= '12:30:00') {
            $sql .= "ae_time_out_morning ) VALUE ('$v_empid','$yeardate','$v_job_id','$v_gender','$currenttime') ";
        } else if ($currenttime >= '13:00:00' && $currenttime <= '14:00:00') {
            $sql .= "ae_time_in_afternoon ) VALUE ('$v_empid','$yeardate','$v_job_id','$v_gender','$currenttime') ";
        } else if ($currenttime >= '17:00:00' && $currenttime <= '19:00:00') {
            $sql .= "ae_time_out_afternoon ) VALUE ('$v_empid','$yeardate','$v_job_id','$v_gender','$currenttime') ";
        } else {
            echo ('<script>alert(" You are not allow to CHECK IN \n Please Contact Admin");
            window.location.href="qr_attendance.php?empid=' . $v_empid . '&branchid=' . $v_branchid . '&message=failure";</script>');
        }
    }
    if ($result = mysqli_query($connect, $sql)) {
        header('location:qr_attendance.php?empid=' . $v_empid . '&branchid=' . $v_branchid . '&message=success');
    }
    
    // $sql = "INSERT INTO attendance_entry 
    //                     ( ae_er_id, ae_job_id, ae_gender,
    //                      ae_date, ae_time_in, ae_time_out, 
    //                      ae_late, ae_deduct, ae_off, ae_note)
    //               VALUES 
    //                 ('$v_er_id', '$v_job_id', '$v_gender',
    //                 '$v_date','$v_timein','$v_timeout',
    //                 '$v_late', '$v_deduct', '$v_off', '$v_note')";
    // $result = mysqli_query($connect, $sql);
    // header('location:attendance_entry.php?message=success');
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <?php
    include "title_icon.php";
    ?>
    <!-- <title>HR System | Dashboard</title>
        <link rel = "icon" href = "../img/login_logo.png" 
        type = "image/x-icon"> -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 4.6 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <style>
        label {
            font-size: 25px;
            font-weight: bold;
            font-family: 'Source Sans Pro', 'Khmer OS Battambang' !important;
        }

        div .image {
            text-align: center;
        }

        div .border {
            padding-top: 10px;
            border: solid 2px;
        }
    </style>
</head>

<body class="skin-black">
    <div class="col-lg-12">
        <?php
        if (!empty($_GET['message']) && $_GET['message'] == 'success') {
            $image = 'https://static.vecteezy.com/system/resources/previews/017/177/791/original/round-check-mark-symbol-with-transparent-background-free-png.png';
            $imageData = base64_encode(file_get_contents($image));
            echo '<div class="alert alert-success">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4>Success Checking</h4>';
            echo '</div>';
            echo '<div class="image"><img class="img-fluid" width="200px" height="200px" src="data:image/jpeg;base64,'.$imageData.'"></div>';
            echo '<div style=" color: green; text-align: center;"><label>SUCCESSFULLY!</label></div>';
        } else if (!empty($_GET['message']) && $_GET['message'] == 'failure') {
            $image = 'https://static.vecteezy.com/system/resources/previews/017/178/222/original/round-cross-mark-symbol-with-transparent-background-free-png.png';
            $imageData = base64_encode(file_get_contents($image));
            echo '<div class="alert alert-danger">';
            echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            echo '<h4>Failure To Checking</h4>';
            echo '</div>';
            echo '<div class="image"><img class="img-fluid" width="200px" height="200px" src="data:image/jpeg;base64,'.$imageData.'"></div>';
            echo '<div style=" color: red; text-align: center;"><label>INPUT ATTENDANCE ERROR!</label></div>';
        }
        ?>
    </div>
    <?php
    if (empty($_GET['message'])) {
        echo '<div class="box-body table-responsive">';

        $sql = "SELECT * FROM employee_registration 
                                                            LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                            LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                            LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                            LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                            LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                            LEFT JOIN text_family_status ON text_family_status.fs_id = employee_registration.er_family_status_id 
                                                            WHERE employee_registration.er_id = $v_empid AND employee_registration.er_branch_id = $v_branchid ";

        $result = $connect->query($sql);
        if (mysqli_num_rows($result) >= 1) {
            while ($row = $result->fetch_assoc()) {
                echo '
            <form method="post" enctype="multipart/form-data" action="">
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="col-md-4"></div>
                    <div class="border col-md-4">
                        <div class="image col-md-12">
                            <img class="img-fluid" width="200px" height="200px" src="../img/upload/staff_register_img/' . $row['er_photo'] . '" />
                        </div>
                        <!-- <div class="image col-md-6">
                        <img class="img-fluid" width="200px" height="200px" src="' . $location . '" />
                    </div> -->
                        <br />
                        <div class="col-md-12">
                            <label>អត្តលេខ ៖ ' . $row['er_job_id'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>ឈ្មោះ ៖ ' . $row['er_name_kh'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>Name ៖ ' . $row['er_name_en'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>ភេទ ៖ ' . $row['ge_name'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>តួនាទី ៖ ' . $row['position'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>ក្រុមហ៊ុន ៖ ' . $row['c_name_kh'] . '</label>
                        </div>
                        <div class="col-md-12">
                            <label>សាខា ៖ ' . $row['de_name'] . '</label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div><!-- /.box-body -->
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" name="btnsubmit" class="btn btn-lg btn-success"><i class="fa fa-user"></i> Submit </button>
                </div>
            </form>';
            }
        } else {
            echo 'No Record Found';
        }
        echo '</div>';
    }
    ?>

    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</body>

</html>