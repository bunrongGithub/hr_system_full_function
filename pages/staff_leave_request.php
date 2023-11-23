<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_job_id = $_POST["txt_job_id"];
    $v_date = $_POST["txt_date"];
    $v_qty = $_POST["txt_qty"];
    $v_from_date = $_POST["txt_from_date"];
    $v_to_date = $_POST["txt_to_date"];
    $v_l_condition = $_POST["txt_condition"];
    $v_reason = $_POST["txt_reason"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO leave_request (
                         le_job_id,
                         le_leave_date,                         
                         le_qty_day,
                         le_date_from,                         
                         le_date_to,
                         le_leave_condition_id,
                         le_reason,
                         le_status_id,
                         le_note)
                  VALUES 
                    ('$v_job_id','$v_date','$v_qty',
                    '$v_from_date','$v_to_date','$v_l_condition','$v_reason',
                    1,'$v_note')";
    $result = mysqli_query($connect, $sql);
    header('location:staff_leave_request.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["staff_leave_req_id"];
    $v_job_id = $_POST["edit_job_id"];
    $v_date = $_POST["edit_date"];
    $v_qty = $_POST["edit_qty"];
    $v_from_date = $_POST["edit_from_date"];
    $v_to_date = $_POST["edit_to_date"];
    $v_l_condition = $_POST["edit_condition"];
    $v_reason = $_POST["edit_reason"];
    $v_note = $_POST["edit_note"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE leave_request SET 
    le_job_id = '$v_job_id',
    le_leave_date = '$v_date', 
    le_qty_day ='$v_qty',
    le_date_from = '$v_from_date', 
    le_date_to ='$v_to_date',
    le_leave_condition_id = '$v_l_condition',
    le_reason = '$v_reason',
    le_note = '$v_note',
    le_status_id = '$v_status' WHERE le_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:staff_leave_request.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM leave_request WHERE le_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: staff_leave_request.php?message=delete");
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
                    Leave Request
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- top row -->
                <div class="row">
                    <div class="col-xs-12 connectedSortable">
                        <div class="box">
                            <div class="box-header">
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
                                                                    echo '<option value="' . $row['er_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Leave Date:</label>
                                                            <input class="form-control" id="txt_date" name="txt_date" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Qty Day:</label>
                                                            <input class="form-control" id="txt_qty" name="txt_qty" type="number" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>From Date:</label>
                                                            <input class="form-control" id="txt_from_date" name="txt_from_date" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>To Date:</label>
                                                            <input class="form-control" id="txt_to_date" name="txt_to_date" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Leave Condition:</label>
                                                            <input class="form-control" id="txt_condition" name="txt_condition" type="number" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="txt_reason" name="txt_reason" type="text" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" id="txt_note" name="txt_note" rows="2"></textarea>
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
                                                        <input type="hidden" id="staff_leave_req_id" name="staff_leave_req_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Job ID:</label>
                                                            <select class="form-control" id="edit_job_id" name="edit_job_id" data-live-search="true" required="required">
                                                                <option disabled selected>Please Select Job ID</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM employee_registration';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['er_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Leave Date:</label>
                                                            <input class="form-control" id="edit_date" name="edit_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Qty Day:</label>
                                                            <input class="form-control" id="edit_qty" name="edit_qty" type="number" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>From Date:</label>
                                                            <input class="form-control" id="edit_from_date" name="edit_from_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>To Date:</label>
                                                            <input class="form-control" id="edit_to_date" name="edit_to_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Leave Condition:</label>
                                                            <input class="form-control" id="edit_condition" name="edit_condition" type="number" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="edit_reason" name="edit_reason" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status" required>
                                                                <?php
                                                                $sql = 'SELECT * FROM text_termination_status';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['tts_id'] . '"> ' . $row['tts_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Note:</label>
                                                            <textarea class="form-control" id="edit_note" name="edit_note" rows="2"></textarea>
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
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Full Name</th>
                                                <th>Gender/Position</th>
                                                <th>Company</th>
                                                <th>Branch</th>
                                                <th>Department</th>
                                                <th>Leave Date</th>
                                                <th>QTY Day</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Leave Condition</th>
                                                <th>Reason</th>
                                                <th>Note</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM leave_request 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = leave_request.le_job_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN text_termination_status ON text_termination_status.tts_id = leave_request.le_status_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_date = $row["le_leave_date"];
                                                $v_er_job_id = $row["er_job_id"];
                                                $v_er_name_kh = $row["er_name_kh"];
                                                $v_er_name_en = $row["er_name_en"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_company_id = $row["c_name_kh"];
                                                $v_department_id = $row["de_name"];
                                                $v_branch_id = $row["ub_name"];
                                                $v_qty_date = $row["le_qty_day"];
                                                $v_date_from = $row["le_date_from"];
                                                $v_date_to = $row["le_date_to"];
                                                $v_l_condition = $row["le_leave_condition_id"];
                                                $v_reason = $row["le_reason"];
                                                $v_note = $row["le_note"];
                                                $v_status_id = $row["tts_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo "<i>Job_id: </i> " . $v_er_job_id . "<br/><i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en; ?></td>
                                                    <td><?php echo "<i>Gender: </i> " . $v_gender_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                                    <td><?php echo $v_company_id; ?></td>
                                                    <td><?php echo $v_branch_id; ?></td>
                                                    <td><?php echo $v_department_id; ?></td>
                                                    <td><?php echo $v_date; ?></td>
                                                    <td><?php echo $v_qty_date; ?></td>
                                                    <td><?php echo $v_date_from; ?></td>
                                                    <td><?php echo $v_date_to; ?></td>
                                                    <td><?php echo $v_l_condition; ?></td>
                                                    <td><?php echo $v_reason; ?></td>
                                                    <td><?php echo $v_note; ?></td>
                                                    <td><?php echo $v_status_id; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_staff_leave_request.php?id=<?php echo $row['le_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['le_id']; ?>,
                                                        '<?php echo $row['le_job_id']; ?>',
                                                        '<?php echo $v_date; ?>',
                                                        '<?php echo $v_qty_date; ?>',
                                                        '<?php echo $v_date_from; ?>',
                                                        '<?php echo $v_date_to; ?>',
                                                        '<?php echo $v_l_condition; ?>',
                                                        '<?php echo $v_reason; ?>',
                                                        '<?php echo $v_note; ?>',
                                                        '<?php echo $row['le_status_id']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="staff_leave_request.php?del_id=<?php echo $row['le_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, er_id, date, qty_date, date_from, date_to,
        l_con,reason,note, status) {

            $('#staff_leave_req_id').val(id);
            $('#edit_job_id').val(er_id).change();
            $('#edit_date').val(date);
            $('#edit_qty').val(qty_date);
            $('#edit_from_date').val(date_from);
            $('#edit_to_date').val(date_to);
            $('#edit_condition').val(l_con);
            $('#edit_reason').val(reason);
            $('#edit_note').val(note);
            $('#edit_status').val(status).change();
        }


        $('#txt_job_id').change(function() {
            $('.show_hid').css("visibility", "visible");
        })

        $(function() {
            $("select").selectpicker();
            $("#menu_attendance").addClass("active");
            $("#leave_request").addClass("active");
            $("#leave_request").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>