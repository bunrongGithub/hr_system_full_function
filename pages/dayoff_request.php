<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_dayoff_request_no = $_POST["txt_dcr_no"];
    $v_job_id = $_POST["txt_job_id"];
    $v_er_id = $_POST["txt_emp_id"];
    $v_gender = $_POST["txt_gender"];
    $v_position = $_POST["txt_position"];
    $v_dayoff = $_POST["txt_dayoff"];
    $v_new_dayoff = $_POST["txt_new_dayoff"];
    $v_ref_no = $_POST["txt_ref_no"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO dayoff_change_request 
                        ( dcr_no , dcr_er_id, dcr_job_id, dcr_gender,
                         dcr_position, dcr_default_dayoff, dcr_new_dayoff, 
                         dcr_ref_no, dcr_note, dcr_status)
                  VALUES 
                    ('$v_dayoff_request_no', '$v_er_id', '$v_job_id', '$v_gender',
                    '$v_position','$v_dayoff','$v_new_dayoff',
                    '$v_ref_no', '$v_note', 1)";
    $result = mysqli_query($connect, $sql);
    header('location:dayoff_request.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["dayoff_request_id"];
    $v_dcr_no = $_POST["edit_dcr_no"];
    $v_job_id = $_POST["edit_job_id"];
    $v_er_id = $_POST["edit_emp_id"];
    $v_gender = $_POST["edit_gender"];
    $v_position = $_POST["edit_position"];
    $v_dayoff = $_POST["edit_dayoff"];
    $v_new_dayoff = $_POST["edit_new_dayoff"];
    $v_ref_no = $_POST["edit_ref_no"];
    $v_note = $_POST["edit_note"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE dayoff_change_request SET 
    dcr_no = '$v_dcr_no', 
    dcr_er_id = '$v_er_id', 
    dcr_job_id = '$v_job_id', 
    dcr_gender = '$v_gender',
    dcr_position = '$v_position', 
    dcr_default_dayoff = '$v_dayoff', 
    dcr_new_dayoff = '$v_new_dayoff', 
    dcr_ref_no = '$v_ref_no',
    dcr_note = '$v_note', 
    dcr_status = '$v_status' WHERE dcr_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:dayoff_request.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM dayoff_change_request WHERE dcr_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: dayoff_request.php?message=delete");
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
                    Dayoff Change Request
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
                                                            <label>DCR No:</label>
                                                            <input class="form-control" id="txt_dcr_no" name="txt_dcr_no" type="text">
                                                        </div>
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

                                                        <p id="amount_data"></p>

                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Default Dayoff:</label>
                                                            <input class="form-control" id="txt_dayoff" name="txt_dayoff" type="date"  required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>New Dayoff:</label>
                                                            <input class="form-control" id="txt_new_dayoff" name="txt_new_dayoff" type="date" required>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Ref No:</label>
                                                            <input class="form-control" id="txt_ref_no" name="txt_ref_no" type="text" required>
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
                                                        <input type="hidden" id="dayoff_request_id" name="dayoff_request_id" />
                                                        <div class="form-group col-xs-12">
                                                            <label>DCR No:</label>
                                                            <input class="form-control" id="edit_dcr_no" name="edit_dcr_no" type="text">
                                                        </div>
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
                                                        <div class="form-group col-xs-6" >
                                                            <label>Default Dayoff:</label>
                                                            <input class="form-control" id="edit_dayoff" name="edit_dayoff" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6" >
                                                            <label>New Dayoff:</label>
                                                            <input class="form-control" id="edit_new_dayoff" name="edit_new_dayoff" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6" >
                                                            <label>Ref No:</label>
                                                            <input class="form-control" id="edit_ref_no" name="edit_ref_no" type="text" required>
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
                                                        <div class="form-group col-xs-12" >
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
                                                <th>DCR No</th>
                                                <th>Job ID</th>
                                                <th>Name KH</th>
                                                <th>Gender</th>
                                                <th>Position</th>
                                                <th>Dayoff Date</th>
                                                <th>New Dayoff</th>
                                                <th>Ref No</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM dayoff_change_request 
                                                                LEFT JOIN position ON position.position_id = dayoff_change_request.dcr_position 
                                                                LEFT JOIN gender ON gender.ge_id = dayoff_change_request.dcr_gender 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = dayoff_change_request.dcr_er_id 
                                                                LEFT JOIN text_petty_cash_status ON text_petty_cash_status.tpc_id = dayoff_change_request.dcr_status";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_dcr_ref = $row["dcr_no"];
                                                $v_dcr_job_id = $row["dcr_job_id"];
                                                $v_er_name_kh = $row["er_name_kh"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_dcr_dayoff = $row["dcr_default_dayoff"];
                                                $v_dcr_new_dayoff = $row["dcr_new_dayoff"];
                                                $v_ref_no = $row["dcr_ref_no"];
                                                $v_status = $row["tpc_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_dcr_ref; ?></td>
                                                    <td><?php echo $v_dcr_job_id; ?></td>
                                                    <td><?php echo $v_er_name_kh; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_position_id; ?></td>
                                                    <td><?php echo $v_dcr_dayoff;?></td>
                                                    <td><?php echo $v_dcr_new_dayoff; ?></td>
                                                    <td><?php echo $v_ref_no; ?></td>
                                                    <td><?php echo $v_status; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_dayoff_request.php?id=<?php echo $row['dcr_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['dcr_id']; ?>,
                                                        '<?php echo $v_dcr_ref; ?>',
                                                        '<?php echo $row['dcr_er_id']; ?>',
                                                        '<?php echo $v_dcr_job_id; ?>',
                                                        '<?php echo $row['dcr_gender']; ?>',
                                                        '<?php echo $row['dcr_position']; ?>',
                                                        '<?php echo $v_dcr_dayoff; ?>',
                                                        '<?php echo $v_dcr_new_dayoff; ?>',
                                                        '<?php echo $v_ref_no; ?>',
                                                        '<?php echo $row['dcr_note']; ?>',
                                                        '<?php echo $row['dcr_status']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="dayoff_request.php?del_id=<?php echo $row['dcr_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, ref, er_id, job_id, gender, position,
         dayoff, new_dayoff, ref_no, note, statusid) {

            $('#dayoff_request_id').val(id);
            $('#edit_dcr_no').val(ref);
            $('#edit_job_id').val(job_id).change();
            $('#edit_emp_id').val(er_id).change();
            $('#edit_gender').val(gender).change();
            $('#edit_position').val(position).change();
            $('#edit_dayoff').val(dayoff);
            $('#edit_new_dayoff').val(new_dayoff);
            $('#edit_ref_no').val(ref_no);
            $('#edit_note').val(note);
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
                        'dcr_job_id': job_id
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
            $("#dayoff").addClass("active");
            $("#dayoff").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>