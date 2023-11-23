<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_position = $_POST["txt_position"];
    $v_gender = $_POST["txt_gender"];
    $v_total_emp = $_POST["txt_totalemp"];
    $v_job_shift = $_POST["txt_job_shift"];
    $v_request_date = $_POST["txt_request_date"];
    $v_applied_date = $_POST["txt_applied_date"];
    $v_branch = $_POST["txt_branch"];
    $v_department = $_POST["txt_department"];
    $v_reason = $_POST["txt_reason"];
    $v_con = $_POST["txt_con_require"];

    $sql = "INSERT INTO recruiting 
                        ( rec_position_id , rec_gender_id, rec_total_employee, rec_job_shift,
                         rec_request_date,  rec_applied_date, rec_department_id, rec_branch_id,
                         rec_reason, rec_condi_required, rec_status_id, rec_user_id, created_at)
                  VALUES 
                    ('$v_position', '$v_gender', '$v_total_emp', '$v_job_shift',
                    '$v_request_date','$v_applied_date','$v_department','$v_branch',
                    '$v_reason','$v_con', 1,'$user_id', '$datetime')";
    $result = mysqli_query($connect, $sql);
    header('location:recruiting.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["recruiting_id"];
    $v_position = $_POST["edit_position"];
    $v_gender = $_POST["edit_gender"];
    $v_total_emp = $_POST["edit_totalemp"];
    $v_job_shift = $_POST["edit_job_shift"];
    $v_request_date = $_POST["edit_request_date"];
    $v_applied_date = $_POST["edit_applied_date"];
    $v_branch = $_POST["edit_branch"];
    $v_department = $_POST["edit_department"];
    $v_reason = $_POST["edit_reason"];
    $v_con = $_POST["edit_con_require"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE recruiting SET rec_position_id = '$v_position', 
                                rec_gender_id = '$v_gender', 
                                rec_total_employee = '$v_total_emp', 
                                rec_job_shift = '$v_job_shift', 
                                rec_request_date = '$v_request_date', 
                                rec_applied_date = '$v_applied_date', 
                                rec_department_id = '$v_department', 
                                rec_branch_id  = '$v_branch', 
                                rec_reason = '$v_reason', 
                                rec_condi_required = '$v_con', 
                                rec_status_id = '$v_status' WHERE rec_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:recruiting.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM recruiting WHERE rec_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: recruiting.php?message=delete");
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
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
                    Recruiting
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
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="txt_position" name="txt_position" required="required">
                                                                <option disabled selected>Please Select Position</option>
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
                                                            <label>Gender:</label>
                                                            <select class="form-control" id="txt_gender" name="txt_gender" required="required">
                                                                <option disabled selected>Please Select Gender</option>
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
                                                            <label>Total Employee:</label>
                                                            <input value="1" class="form-control" id="txt_totalemp" name="txt_totalemp" type="number" readonly>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Job Shift:</label>
                                                            <input class="form-control" id="txt_job_shift" name="txt_job_shift" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Request Date:</label>
                                                            <input class="form-control" id="txt_request_date" name="txt_request_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Applied Date:</label>
                                                            <input class="form-control" id="txt_applied_date" name="txt_applied_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Department Name:</label>
                                                            <select class="form-control" id="txt_department" name="txt_department" required="required">
                                                                <option disabled selected>Please Select Department</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM department';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Name:</label>
                                                            <select class="form-control" id="txt_branch" name="txt_branch" required="required">
                                                                <option disabled selected>Please Select Branch</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM user_branch';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <textarea class="form-control" rows="2" id="txt_reason" name="txt_reason"></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Condition Required:</label>
                                                            <textarea class="form-control" rows="2" id="txt_con_require" name="txt_con_require"></textarea>
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
                                                        <input type="hidden" id="recruiting_id" name="recruiting_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Position:</label>
                                                            <select class="form-control" id="edit_position" name="edit_position" required="required">
                                                                <option disabled selected>Please Select Position</option>
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
                                                            <label>Gender:</label>
                                                            <select class="form-control" id="edit_gender" name="edit_gender" required="required">
                                                                <option disabled selected>Please Select Gender</option>
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
                                                            <label>Total Employee:</label>
                                                            <input value="1" class="form-control" id="edit_totalemp" name="edit_totalemp" type="number" readonly>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Job Shift:</label>
                                                            <input class="form-control" id="edit_job_shift" name="edit_job_shift" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Request Date:</label>
                                                            <input class="form-control" id="edit_request_date" name="edit_request_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Applied Date:</label>
                                                            <input class="form-control" id="edit_applied_date" name="edit_applied_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Department Name:</label>
                                                            <select class="form-control" id="edit_department" name="edit_department" required="required">
                                                                <option disabled selected>Please Select Department</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM department';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['de_id'] . '">' . $row['de_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Branch Name:</label>
                                                            <select class="form-control" id="edit_branch" name="edit_branch" required="required">
                                                                <option disabled selected>Please Select Branch</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM user_branch';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ub_id'] . '">' . $row['ub_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <textarea class="form-control" rows="2" id="edit_reason" name="edit_reason"></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Condition Required:</label>
                                                            <textarea class="form-control" rows="2" id="edit_con_require" name="edit_con_require"></textarea>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status">
                                                                <?php
                                                                $sql = 'SELECT * FROM status_selection';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['ss_id'] . '">' . $row['ss_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
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
                                                <th>Position</th>
                                                <th>Gender</th>
                                                <th>Total Employee</th>
                                                <th>Job Shift</th>
                                                <th>Request Date</th>
                                                <th>Applied Date</th>
                                                <th>Department</th>
                                                <th>Branch</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM recruiting 
                                                                LEFT JOIN position ON position.position_id = recruiting.rec_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = recruiting.rec_gender_id 
                                                                LEFT JOIN department ON department.de_id = recruiting.rec_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = recruiting.rec_branch_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_position_id = $row["position"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_total_emp = $row["rec_total_employee"];
                                                $v_job_shift = $row["rec_job_shift"];
                                                $v_request_date = $row["rec_request_date"];
                                                $v_applied_date = $row["rec_applied_date"];
                                                $v_department_id = $row["de_name"];
                                                $v_branch_id = $row["ub_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_position_id; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_total_emp; ?></td>
                                                    <td><?php echo $v_job_shift; ?></td>
                                                    <td><?php echo $v_request_date; ?></td>
                                                    <td><?php echo $v_applied_date; ?></td>
                                                    <td><?php echo $v_department_id; ?></td>
                                                    <td><?php echo $v_branch_id; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_recruiting.php?id=<?php echo $row['rec_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['rec_id']; ?>,
                                                        '<?php echo $row['rec_position_id']; ?>',
                                                        '<?php echo $row['rec_gender_id']; ?>',
                                                        '<?php echo $v_total_emp; ?>',
                                                        '<?php echo $v_job_shift; ?>',
                                                        '<?php echo $v_request_date; ?>',
                                                        '<?php echo $v_applied_date; ?>',
                                                        '<?php echo $row['rec_department_id']; ?>',
                                                        '<?php echo $row['rec_branch_id']; ?>',
                                                        '<?php echo $row['rec_reason']; ?>',
                                                        '<?php echo $row['rec_condi_required']; ?>',
                                                        '<?php echo $row['rec_status_id']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="recruiting.php?del_id=<?php echo $row['rec_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
    <!-- AdminLTE App -->
    <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


    <script type="text/javascript">
        function doUpdate(id, position, gender, total_emp, job_shift, request_date, applied_date, department_id, branch_id, reason, condition, statusid) {

            $('#recruiting_id').val(id);
            $('#edit_position').val(position).change();
            $('#edit_gender').val(gender).change();
            $('#edit_totalemp').val(total_emp);
            $('#edit_job_shift').val(job_shift);
            $('#edit_request_date').val(request_date);
            $('#edit_applied_date').val(applied_date);
            $('#edit_department').val(department_id).change();
            $('#edit_branch').val(branch_id).change();
            $('#edit_reason').val(reason);
            $('#edit_con_require').val(condition);
            $('#edit_status').val(statusid).change();
        }

        $(function() {
            $("#menu_job").addClass("active");
            $("#recruiting").addClass("active");
            $("#recruiting").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>