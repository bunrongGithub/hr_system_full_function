<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_ot_request_no = $_POST["txt_otr_no"];
    $v_job_id = $_POST["txt_job_id"];
    $v_er_id = $_POST["txt_emp_id"];
    $v_gender = $_POST["txt_otr_gender"];
    $v_position = $_POST["txt_position"];
    $v_ot_date_start = $_POST["txt_ot_start"];
    $v_ot_date_end = $_POST["txt_ot_end"];
    $v_ot_hour_start = $_POST["txt_wt_start"];
    $v_ot_hour_end = $_POST["txt_wt_end"];
    $v_condition = $_POST["txt_ot_con"];
    $v_total_hour = $_POST["txt_hour"];
    $v_reason = $_POST["txt_reason"];

    $sql = "INSERT INTO ot_request 
                        ( otr_no , otr_er_id, otr_job_id, otr_gender,
                         otr_position,  otr_ot_date, otr_ot_date_end, otr_ot_time_start,
                         otr_ot_time_end, otr_total_ot, otr_ot_condition,otr_reason, otr_status)
                  VALUES 
                    ('$v_ot_request_no', '$v_er_id', '$v_job_id', '$v_gender',
                    '$v_position','$v_ot_date_start','$v_ot_date_end','$v_ot_hour_start',
                    '$v_ot_hour_end','$v_total_hour', '$v_condition','$v_reason', 1)";
    $result = mysqli_query($connect, $sql);
    header('location:ot_request.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["ot_request_id"];
    $v_ot_request_no = $_POST["edit_otr_no"];
    $v_job_id = $_POST["edit_job_id"];
    $v_er_id = $_POST["edit_emp_id"];
    $v_gender = $_POST["edit_otr_gender"];
    $v_position = $_POST["edit_position"];
    $v_ot_date_start = $_POST["edit_ot_start"];
    $v_ot_date_end = $_POST["edit_ot_end"];
    $v_ot_hour_start = $_POST["edit_wt_start"];
    $v_ot_hour_end = $_POST["edit_wt_end"];
    $v_condition = $_POST["edit_ot_con"];
    $v_total_hour = $_POST["edit_hour"];
    $v_reason = $_POST["edit_reason"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE ot_request SET otr_no = '$v_ot_request_no', 
    otr_er_id = '$v_er_id', 
    otr_job_id = '$v_job_id', 
    otr_gender = '$v_gender',
    otr_position = '$v_position', 
    otr_ot_date = '$v_ot_date_start', 
    otr_ot_date_end = '$v_ot_date_end', 
    otr_ot_time_start = '$v_ot_hour_start',
    otr_ot_time_end = '$v_ot_hour_end', 
    otr_total_ot = '$v_total_hour', 
    otr_ot_condition = '$v_condition', 
    otr_reason = '$v_reason', otr_status = '$v_status' WHERE otr_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:ot_request.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM ot_request WHERE otr_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: ot_request.php?message=delete");
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
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="../css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-black">
    <?php include('header.php') ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Include left Menu -->
        <?php include "left_menu.php" ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <div class="col-xs-12">
                <?php
                if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                    echo '<div class="alert alert-success">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Add Data</h4>';
                    echo '</div>';
                } else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                    echo '<div class="alert alert-info">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Update Data</h4>';
                    echo '</div>';
                } else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                    echo '<div class="alert alert-danger">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo '<h4>Success Delete Data</h4>';
                    echo '</div>';
                }
                ?>
            </div>
            <section class="content-header">
                <h1>
                    OT Request
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="row">

                    <div class="col-xs-12 connectedSortable">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <div class="form-group col-xs-12">
                                                            <label>OT Request No:</label>
                                                            <input class="form-control" id="txt_otr_no" name="txt_otr_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Job ID:</label>
                                                            <select class="form-control" id="txt_job_id" name="txt_job_id" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Job ID</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <p id="amount_data"></p>

                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>OT Date Start:</label>
                                                            <input class="form-control" id="txt_ot_start" name="txt_ot_start" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>OT Date End:</label>
                                                            <input class="form-control" id="txt_ot_end" name="txt_ot_end" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Working Time Start:</label>
                                                            <input class="form-control" id="txt_wt_start" name="txt_wt_start" type="time" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Working Time End:</label>
                                                            <input class="form-control" id="txt_wt_end" name="txt_wt_end" type="time" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>OT Condition:</label>
                                                            <select class="selectpicker form-control" id="txt_ot_con" name="txt_ot_con" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Condition</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM overtime';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ot_id'] . '">' . $row['ot_description'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Total OT(h):</label>
                                                            <input class="form-control" id="txt_hour" name="txt_hour" type="number" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                            <label>Reason:</label>
                                                            <textarea class="form-control" rows="2" id="txt_reason" name="txt_reason"></textarea>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Save</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <!-- Modal Update-->
                                <div class="modal fade" id="myModal_update" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="ot_request_id" name="ot_request_id" />
                                                        <div class="form-group col-xs-12">
                                                            <label>OT Request No:</label>
                                                            <input class="form-control" id="edit_otr_no" name="edit_otr_no" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Job ID:</label>
                                                            <select class="form-control" id="edit_job_id" name="edit_job_id" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Job ID</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Employee Name:</label>
                                                            <select class="form-control" id="edit_emp_id" name="edit_emp_id" data-live-search="true" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_id'] . '">' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Gender:</label>
                                                            <select class="form-control" id="edit_otr_gender" name="edit_otr_gender" data-live-search="true" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM gender';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ge_id'] . '">' . $row['ge_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="edit_position" name="edit_position" data-live-search="true" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM position';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>OT Date Start:</label>
                                                            <input class="form-control" id="edit_ot_start" name="edit_ot_start" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>OT Date End:</label>
                                                            <input class="form-control" id="edit_ot_end" name="edit_ot_end" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Working Time Start:</label>
                                                            <input class="form-control" id="edit_wt_start" name="edit_wt_start" type="time" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Working Time End:</label>
                                                            <input class="form-control" id="edit_wt_end" name="edit_wt_end" type="time" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>OT Condition:</label>
                                                            <select class="selectpicker form-control" id="edit_ot_con" name="edit_ot_con" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Condition</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM overtime';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ot_id'] . '">' . $row['ot_description'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status" data-live-search="true" required="required">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_petty_cash_status';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['tpc_id'] . '">' . $row['tpc_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Total OT(h):</label>
                                                            <input class="form-control" id="edit_hour" name="edit_hour" type="number" required>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <textarea class="form-control" rows="2" id="edit_reason" name="edit_reason"></textarea>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="btnupdate" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Update-->

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>OTR No</th>
                                                <th>Job ID</th>
                                                <th>Name KH</th>
                                                <th>Gender</th>
                                                <th>Position</th>
                                                <th>OT Date</th>
                                                <th>Total OT</th>
                                                <th>Request Date</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM ot_request 
                                                                LEFT JOIN position ON position.position_id = ot_request.otr_position 
                                                                LEFT JOIN gender ON gender.ge_id = ot_request.otr_gender 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = ot_request.otr_er_id 
                                                                LEFT JOIN text_petty_cash_status ON text_petty_cash_status.tpc_id = ot_request.otr_status";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_otr_ref = $row["otr_no"];
                                                $v_otr_job_id = $row["otr_job_id"];
                                                $v_er_name_kh = $row["er_name_kh"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_ot_date_start = $row["otr_ot_date"];
                                                $v_ot_date_end = $row["otr_ot_date_end"];
                                                $v_total_hour = $row["otr_total_ot"];
                                                $v_request_date = $row["otr_request_date"];
                                                $v_status = $row["tpc_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_otr_ref; ?></td>
                                                    <td><?php echo $v_otr_job_id; ?></td>
                                                    <td><?php echo $v_er_name_kh; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_position_id; ?></td>
                                                    <td>
                                                        <div>
                                                            <span style="font-style: italic;">Start Date: </span>
                                                            <?php echo $v_ot_date_start; ?>
                                                        </div>
                                                        <div>
                                                            <span style="font-style: italic;">End Date: </span>
                                                            <?php echo $v_ot_date_end; ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $v_total_hour; ?></td>
                                                    <td><?php echo $v_request_date; ?></td>
                                                    <td><?php echo $v_status; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_ot_request.php?id=<?php echo $row['otr_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['otr_id']; ?>,
                                                        '<?php echo $v_otr_ref; ?>',
                                                        '<?php echo $row['otr_er_id']; ?>',
                                                        '<?php echo $v_otr_job_id; ?>',
                                                        '<?php echo $row['otr_gender']; ?>',
                                                        '<?php echo $row['otr_position']; ?>',
                                                        '<?php echo $v_ot_date_start; ?>',
                                                        '<?php echo $v_ot_date_end; ?>',
                                                        '<?php echo $row['otr_ot_time_start']; ?>',
                                                        '<?php echo $row['otr_ot_time_end']; ?>',
                                                        '<?php echo $v_total_hour; ?>',
                                                        '<?php echo $row['otr_ot_condition']; ?>',
                                                        '<?php echo $row['otr_reason']; ?>',
                                                        '<?php echo $row['otr_status']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="ot_request.php?del_id=<?php echo $row['otr_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../js/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- fullCalendar -->
    <script src="../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


    <script type="text/javascript">
        function doUpdate(id, ref, er_id, job_id, gender, position, date_start, date_end,
            time_start, time_end, total_hour, ot_condition, reason, statusid) {

            $('#ot_request_id').val(id);
            $('#edit_otr_no').val(ref);
            $('#edit_job_id').val(job_id).change();
            $('#edit_emp_id').val(er_id).change();
            $('#edit_otr_gender').val(gender).change();
            $('#edit_position').val(position).change();
            $('#edit_ot_start').val(date_start);
            $('#edit_ot_end').val(date_end);
            $('#edit_wt_start').val(time_start);
            $('#edit_wt_end').val(time_end);
            $('#edit_ot_con').val(ot_condition).change();
            $('#edit_hour').val(total_hour);
            $('#edit_reason').val(reason);
            $('#edit_status').val(statusid).change();
        }


        $('#txt_job_id').change(function() {
            $('.show_hid').css("visibility", "visible");
            var job_id = $("#txt_job_id").val();
            if (job_id) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_data.php',
                    data: {
                        'ot_request_job_id': job_id
                    },
                    success: function(html) {
                        $('#amount_data').html(html);
                    }
                });
            }
        })

        $(function() {
            $("select").selectpicker();
            $("#menu_attendance").addClass("active");
            $("#ot_request").addClass("active");
            $("#ot_request").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>