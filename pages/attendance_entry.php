<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_job_id = $_POST["txt_job_id"];
    $v_er_id = $_POST["txt_emp_id"];
    $v_gender = $_POST["txt_gender"];
    $v_timein = $_POST["txt_timein"];
    $v_timeout = $_POST["txt_timeout"];
    $v_timein_a = $_POST["txt_timein_a"];
    $v_timeout_a = $_POST["txt_timeout_a"];
    $v_date = $_POST["txt_date"];
    $v_late = $_POST["txt_late"];
    $v_deduct = $_POST["txt_deduct"];
    $v_off = $_POST["txt_off"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO attendance_entry 
                        ( ae_er_id, ae_job_id, ae_gender,
                         ae_date, ae_time_in_morning, ae_time_out_morning, 
                         ae_time_in_afternoon, ae_time_out_afternoon, 
                         ae_late, ae_deduct, ae_off, ae_note)
                  VALUES 
                    ('$v_er_id', '$v_job_id', '$v_gender',
                    '$v_date','$v_timein','$v_timeout',
                    '$v_timein_a','$v_timeout_a',
                    '$v_late', '$v_deduct', '$v_off', '$v_note')";
    $result = mysqli_query($connect, $sql);
    header('location:attendance_entry.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["atten_entry_id"];
    $v_job_id = $_POST["edit_job_id"];
    $v_er_id = $_POST["edit_emp_id"];
    $v_gender = $_POST["edit_gender"];
    $v_timein = $_POST["edit_timein"];
    $v_timeout = $_POST["edit_timeout"];
    $v_timein_a = $_POST["edit_timein_a"];
    $v_timeout_a = $_POST["edit_timeout_a"];
    $v_date = $_POST["edit_date"];
    $v_late = $_POST["edit_late"];
    $v_deduct = $_POST["edit_deduct"];
    $v_off = $_POST["edit_off"];
    $v_note = $_POST["edit_note"];

    $sql = "UPDATE attendance_entry SET 
    ae_er_id = '$v_er_id', 
    ae_job_id = '$v_job_id', 
    ae_gender = '$v_gender',
    ae_date = '$v_date', 
    ae_time_in_morning = '$v_timein', 
    ae_time_out_morning = '$v_timeout', 
    ae_time_in_afternoon = '$v_timein_a', 
    ae_time_out_afternoon = '$v_timeout_a', 
    ae_late = '$v_late',
    ae_deduct = '$v_deduct', 
    ae_off = '$v_off', 
    ae_note = '$v_note' WHERE ae_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:attendance_entry.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM attendance_entry WHERE ae_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: attendance_entry.php?message=delete");
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
                    Attendance Entry
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
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                                </button>
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
                                                            <label>Time IN Morning:</label>
                                                            <input class="form-control" id="txt_timein" name="txt_timein" type="time">
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Time OUT Morning:</label>
                                                            <input class="form-control" id="txt_timeout" name="txt_timeout" type="time" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Time IN Afternoon:</label>
                                                            <input class="form-control" id="txt_timein_a" name="txt_timein_a" type="time" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Time OUT Afternoon:</label>
                                                            <input class="form-control" id="txt_timeout_a" name="txt_timeout_a" type="time" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Date:</label>
                                                            <input class="form-control" id="txt_date" name="txt_date" type="date" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Late:</label>
                                                            <input class="form-control" id="txt_late" name="txt_late" type="number" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Deduct:</label>
                                                            <input class="form-control" id="txt_deduct" name="txt_deduct" type="number" >
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>OFF:</label>
                                                            <select class="form-control" id="txt_off" name="txt_off" data-live-search="true" >
                                                                <option disabled selected>Please Select Dayoff</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM text_attendance_entry_off';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['tae_id'] . '">' . $row['tae_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" rows="2" id="txt_note" name="txt_note"></textarea>
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
                                                        <input type="hidden" id="atten_entry_id" name="atten_entry_id" />
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
                                                            <select class="form-control" id="edit_gender" name="edit_gender" data-live-search="true" required="required">
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
                                                            <label>Time IN Morning:</label>
                                                            <input class="form-control" id="edit_timein" name="edit_timein" type="time" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Time OUT Morning:</label>
                                                            <input class="form-control" id="edit_timeout" name="edit_timeout" type="time" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Time IN Afternoon:</label>
                                                            <input class="form-control" id="edit_timein_a" name="edit_timein_a" type="time" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Time OUT Afternoon:</label>
                                                            <input class="form-control" id="edit_timeout_a" name="edit_timeout_a" type="time" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Date:</label>
                                                            <input class="form-control" id="edit_date" name="edit_date" type="date" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Late:</label>
                                                            <input class="form-control" id="edit_late" name="edit_late" type="number" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Deduct:</label>
                                                            <input class="form-control" id="edit_deduct" name="edit_deduct" type="number" >
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>OFF:</label>
                                                            <select class="form-control" id="edit_off" name="edit_off" data-live-search="true" style="visibility: hidden;" >
                                                                <option disabled selected>Please Select Job ID</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM text_attendance_entry_off';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['tae_id'] . '">' . $row['tae_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" rows="2" id="edit_note" name="edit_note"></textarea>
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
                                                <th>Job ID</th>
                                                <th>Name KH</th>
                                                <th>Gender</th>
                                                <th>Time In Morning</th>
                                                <th>Time Out Morning</th>
                                                <th>Time In Afternoon</th>
                                                <th>Time Out Afternoon</th>
                                                <th>Late</th>
                                                <th>Deduct</th>
                                                <th>OFF</th>
                                                <th>Count</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM attendance_entry
                                                                LEFT JOIN gender ON gender.ge_id = attendance_entry.ae_gender 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = attendance_entry.ae_er_id 
                                                                LEFT JOIN text_attendance_entry_off ON text_attendance_entry_off.tae_id = attendance_entry.ae_off";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_ae_job_id = $row["ae_job_id"];
                                                $v_er_name_kh = $row["er_name_kh"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_ae_time_in_m = $row["ae_time_in_morning"];
                                                $v_ae_time_out_m = $row["ae_time_out_morning"];
                                                $v_ae_time_in_a = $row["ae_time_in_afternoon"];
                                                $v_ae_time_out_a = $row["ae_time_out_afternoon"];
                                                $v_late = $row["ae_late"];
                                                $v_deduct = $row["ae_deduct"];
                                                $v_off = $row["tae_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_ae_job_id; ?></td>
                                                    <td><?php echo $v_er_name_kh; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_ae_time_in_m; ?></td>
                                                    <td><?php echo $v_ae_time_out_m; ?></td>
                                                    <td><?php echo $v_ae_time_in_a; ?></td>
                                                    <td><?php echo $v_ae_time_out_a; ?></td>
                                                    <td><?php echo $v_late; ?></td>
                                                    <td><?php echo $v_deduct; ?></td>
                                                    <td><?php echo $v_off; ?></td>
                                                    <td><?php echo 1; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_attendance_entry.php?id=<?php echo $row['ae_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['ae_id']; ?>,
                                                        '<?php echo $row['ae_er_id']; ?>',
                                                        '<?php echo $v_ae_job_id; ?>',
                                                        '<?php echo $row['ae_gender']; ?>',
                                                        '<?php echo $v_ae_time_in_m; ?>',
                                                        '<?php echo $v_ae_time_out_m; ?>',
                                                        '<?php echo $v_ae_time_in_a; ?>',
                                                        '<?php echo $v_ae_time_out_a; ?>',
                                                        '<?php echo $row['ae_date']; ?>',
                                                        '<?php echo $v_late; ?>',
                                                        '<?php echo $v_deduct; ?>',
                                                        '<?php echo $row['ae_off']; ?>',
                                                        '<?php echo $row['ae_note']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="attendance_entry.php?del_id=<?php echo $row['ae_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, er_id, job_id, gender,
            timein_m, timeout_m, timein_a, timeout_a, date, late, deduct, off, note) {

            $('#atten_entry_id').val(id);
            $('#edit_job_id').val(job_id).change();
            $('#edit_emp_id').val(er_id).change();
            $('#edit_gender').val(gender).change();
            $('#edit_timein').val(timein_m);
            $('#edit_timeout').val(timeout_m);
            $('#edit_timein_a').val(timein_a);
            $('#edit_timeout_a').val(timeout_a);
            $('#edit_date').val(date);
            $('#edit_late').val(late);
            $('#edit_deduct').val(deduct);
            $('#edit_off').val(off).change();
            $('#edit_note').val(note);
        }

        $(function() {
            $("select").selectpicker();
            $("#menu_attendance").addClass("active");
            $("#atten_entry").addClass("active");
            $("#atten_entry").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>