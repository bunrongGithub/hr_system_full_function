<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_candidate_name = $_POST["txt_cc_name"];
    $v_position = $_POST["txt_position"];
    $v_gender = $_POST["txt_gender"];
    $v_inter_date = $_POST["txt_inter_date"];
    $v_time = $_POST["txt_time"];
    $v_inter = $_POST["txt_interviewer"];
    $v_inter2 = $_POST["txt_interviewer2"];
    $v_inter3 = $_POST["txt_interviewer3"];
    $v_status = $_POST["txt_status"];

    $sql = "INSERT INTO inverview 
                        ( in_candi_name , in_gender_id, in_position_id, in_interview_date,
                         in_time,  in_interviewer, in_interviewer2, in_interviewer3,
                         in_status_id, created_at)
                  VALUES 
                    ('$v_candidate_name', '$v_gender', '$v_position', '$v_inter_date',
                    '$v_time','$v_inter','$v_inter2','$v_inter3',
                    '$v_status','$datetime')";
    $result = mysqli_query($connect, $sql);
    header('location:interview.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["interview_id"];
    $v_candidate_name = $_POST["edit_cc_name"];
    $v_position = $_POST["edit_position"];
    $v_gender = $_POST["edit_gender"];
    $v_inter_date = $_POST["edit_inter_date"];
    $v_time = $_POST["edit_time"];
    $v_inter = $_POST["edit_interviewer"];
    $v_inter2 = $_POST["edit_interviewer2"];
    $v_inter3 = $_POST["edit_interviewer3"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE inverview SET in_candi_name = '$v_candidate_name',
                                in_position_id = '$v_position', 
                                in_gender_id = '$v_gender',  
                                in_interview_date = '$v_inter_date', 
                                in_time = '$v_time', 
                                in_interviewer = '$v_inter', 
                                in_interviewer2 = '$v_inter2', 
                                in_interviewer3  = '$v_inter3', 
                                in_status_id = '$v_status' WHERE in_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:interview.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM inverview WHERE in_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: interview.php?message=delete");
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
                    Interview LIST
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
                                                            <label>Candidate Name:</label>
                                                            <input class="form-control" id="txt_cc_name" name="txt_cc_name" type="text">
                                                        </div>
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
                                                            <label>Interview Date:</label>
                                                            <input class="form-control" id="txt_inter_date" name="txt_inter_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Time:</label>
                                                            <input class="form-control" id="txt_time" name="txt_time" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer:</label>
                                                            <input class="form-control" id="txt_interviewer" name="txt_interviewer" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer 2:</label>
                                                            <input class="form-control" id="txt_interviewer2" name="txt_interviewer2" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer 3:</label>
                                                            <input class="form-control" id="txt_interviewer3" name="txt_interviewer3" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="txt_status" name="txt_status">
                                                                <?php
                                                                $sql = 'SELECT * FROM status_interview';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['si_id'] . '">' . $row['si_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
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
                                                        <input type="hidden" id="interview_id" name="interview_id" />
                                                        <div class="form-group col-xs-12">
                                                            <label>Candidate Name:</label>
                                                            <input class="form-control" id="edit_cc_name" name="edit_cc_name" type="text">
                                                        </div>
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
                                                            <label>Interview Date:</label>
                                                            <input class="form-control" id="edit_inter_date" name="edit_inter_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Time:</label>
                                                            <input class="form-control" id="edit_time" name="edit_time" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer:</label>
                                                            <input class="form-control" id="edit_interviewer" name="edit_interviewer" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer 2:</label>
                                                            <input class="form-control" id="edit_interviewer2" name="edit_interviewer2" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Interviewer 3:</label>
                                                            <input class="form-control" id="edit_interviewer3" name="edit_interviewer3" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status">
                                                                <?php
                                                                $sql = 'SELECT * FROM status_interview';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['si_id'] . '">' . $row['si_name'] . '</option>';
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
                                                <th>Candidate Name</th>
                                                <th>Gender</th>
                                                <th>Position</th>
                                                <th>Interview Date</th>
                                                <th>Time</th>
                                                <th>Interviewer</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM inverview 
                                                                LEFT JOIN position ON position.position_id = inverview.in_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = inverview.in_gender_id 
                                                                LEFT JOIN status_interview ON status_interview.si_id = inverview.in_status_id 
                                                                ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_candi_name = $row["in_candi_name"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_inter_date = $row["in_interview_date"];
                                                $v_time = $row["in_time"];
                                                $v_inter = $row["in_interviewer"];
                                                $v_status = $row["si_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_candi_name; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_position_id; ?></td>
                                                    <td><?php echo $v_inter_date; ?></td>
                                                    <td><?php echo $v_time; ?></td>
                                                    <td><?php echo $v_inter; ?></td>
                                                    <td><?php echo $v_status; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_interview.php?id=<?php echo $row['in_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['in_id']; ?>,
                                                        '<?php echo $row['in_candi_name']; ?>',
                                                        '<?php echo $row['in_position_id']; ?>',
                                                        '<?php echo $row['in_gender_id']; ?>',
                                                        '<?php echo $v_inter_date; ?>',
                                                        '<?php echo $v_time; ?>',
                                                        '<?php echo $v_inter; ?>',
                                                        '<?php echo $row['in_interviewer2']; ?>',
                                                        '<?php echo $row['in_interviewer3']; ?>',
                                                        '<?php echo $row['in_status_id']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="interview.php?del_id=<?php echo $row['in_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, cc_name, position, gender, inter_date, time, inter, inter2, inter3, statusid) {

            $('#interview_id').val(id);
            $('#edit_cc_name').val(cc_name);
            $('#edit_position').val(position).change();
            $('#edit_gender').val(gender).change();
            $('#edit_inter_date').val(inter_date);
            $('#edit_time').val(time);
            $('#edit_interviewer').val(inter);
            $('#edit_interviewer2').val(inter2);
            $('#edit_interviewer3').val(inter3);
            $('#edit_status').val(statusid).change();
        }

        $(function() {
            $("#menu_job").addClass("active");
            $("#interview").addClass("active");
            $("#interview").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>