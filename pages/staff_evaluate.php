<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_job_id = $_POST["txt_job_id"];
    $v_namekh = $_POST["txt_name_kh"];
    $v_nameen = $_POST["txt_name_kh"];
    $v_position_id = $_POST["txt_position"];
    $v_gender_id = $_POST["txt_gender"];
    $v_date = $_POST["txt_date"];
    $v_work = $_POST["txt_work_quality"];
    $v_productivity = $_POST["txt_productivity"];
    $v_communication = $_POST["txt_communication"];
    $v_collaboration = $_POST["txt_collaboration"];
    $v_initiative = $_POST["txt_initiative"];
    $v_punctuality = $_POST["txt_punctuality"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO emp_evaluation 
                        ( eeva_employee_id ,eeva_namekh, eeva_nameen, eeva_position,
                        eeva_gender, eeva_date, eeva_work_quality, eeva_productivity, 
                        eeva_communication, eeva_collboration, eeva_initiative, eeva_punctuality, 
                        eeva_note, created_at, eeva_user_id)
                  VALUES 
                    ('$v_job_id', '$v_namekh', '$v_nameen', '$v_position_id',
                    '$v_gender_id', '$v_date', '$v_work', '$v_productivity', 
                    '$v_communication', '$v_collaboration', '$v_initiative', '$v_punctuality', 
                    '$v_note','$datetime','$user_id')";
    $result = mysqli_query($connect, $sql);

    
    header('location:staff_evaluate.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["staff_evaluate_id"];
    $v_job_id = $_POST["edit_job_id"];
    $v_namekh = $_POST["edit_name_kh"];
    $v_nameen = $_POST["edit_name_en"];
    $v_position_id = $_POST["edit_position"];    
    $v_gender_id = $_POST["edit_gender"];
    $v_date = $_POST["edit_date"];
    $v_work = $_POST["edit_work_quality"];
    $v_productivity = $_POST["edit_productivity"];
    $v_communication = $_POST["edit_communication"];
    $v_collaboration = $_POST["edit_collaboration"];
    $v_initiative = $_POST["edit_initiative"];
    $v_punctuality = $_POST["edit_punctuality"];
    $v_note = $_POST["edit_note"];

    $sql = "UPDATE emp_evaluation SET 
    eeva_employee_id = '$v_job_id', 
    eeva_namekh = '$v_namekh',
    eeva_nameen = '$v_nameen', 
    eeva_position = '$v_position_id', 
    eeva_gender = '$v_gender_id', 
    eeva_date = '$v_date',
    eeva_work_quality = '$v_work',
    eeva_productivity = '$v_productivity',
    eeva_communication = '$v_communication',
    eeva_collboration = '$v_collaboration',
    eeva_initiative = '$v_initiative',
    eeva_punctuality = '$v_punctuality',
    eeva_note = '$v_note' WHERE eeva_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:staff_evaluate.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM emp_evaluation WHERE eeva_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: staff_evaluate.php?message=delete");
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
                    Employee Evaluation
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
                                                        <div class="form-group col-xs-12">
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
                                                            <label>Date:</label>
                                                            <input type="date" class="form-control" id="txt_date" name="txt_date" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Work Quality:</label>
                                                            <select class="form-control" id="txt_work_quality" name="txt_work_quality">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_staff_evaluate_work_quality';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['wq_name'] . '">' . $row['wq_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Productivity:</label>
                                                            <input type="text" class="form-control" id="txt_productivity" name="txt_productivity" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Communication:</label>
                                                            <input type="text" class="form-control" id="txt_communication" name="txt_communication" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Collaboration:</label>
                                                            <input type="text" class="form-control" id="txt_collaboration" name="txt_collaboration" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Initiative:</label>
                                                            <input type="text" class="form-control" id="txt_initiative" name="txt_initiative" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                            <label>Punctuality:</label>
                                                            <input type="text" class="form-control" id="txt_punctuality" name="txt_punctuality" required />
                                                        </div>
                                                        <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
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
                                                        <input type="hidden" id="staff_evaluate_id" name="staff_evaluate_id" />
                                                        <div class="form-group col-xs-12">
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
                                                            <label>Employee Name KH:</label>
                                                            <input type="text" class="form-control" id="edit_name_kh" name="edit_name_kh" readonly />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Employee Name EN:</label>
                                                            <input type="text" class="form-control" id="edit_name_en" name="edit_name_en" readonly />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Gender:</label>
                                                            <select class="form-control" id="edit_gender" name="edit_gender">
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
                                                            <select class="form-control" id="edit_position" name="edit_position">
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
                                                            <label>Date:</label>
                                                            <input type="date" class="form-control" id="edit_date" name="edit_date" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Work Quality:</label>
                                                            <select class="form-control" id="edit_work_quality" name="edit_work_quality">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_staff_evaluate_work_quality';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['wq_name'] . '">' . $row['wq_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Productivity:</label>
                                                            <input type="text" class="form-control" id="edit_productivity" name="edit_productivity" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Communication:</label>
                                                            <input type="text" class="form-control" id="edit_communication" name="edit_communication" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Collaboration:</label>
                                                            <input type="text" class="form-control" id="edit_collaboration" name="edit_collaboration" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Initiative:</label>
                                                            <input type="text" class="form-control" id="edit_initiative" name="edit_initiative" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Punctuality:</label>
                                                            <input type="text" class="form-control" id="edit_punctuality" name="edit_punctuality" required />
                                                        </div>
                                                        <div class="form-group col-xs-6">
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
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="margin-bottom: 2%;">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</button>

                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="info_data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Job ID</th>
                                                <th>Full Name</th>
                                                <th>Gender/Position</th>
                                                <th>Company</th>
                                                <th>Date</th>
                                                <th>Work Quality</th>
                                                <th>Productivity</th>
                                                <th>Communication</th>
                                                <th>Collaboration</th>
                                                <th>Initiative</th>
                                                <th>Punctuality</th>
                                                <th>Note</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM emp_evaluation 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = emp_evaluation.eeva_employee_id 
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = employee_registration.er_gender_id 
                                                                LEFT JOIN company ON company.c_id = employee_registration.er_company_id 
                                                                LEFT JOIN department ON department.de_id = employee_registration.er_department_id 
                                                                LEFT JOIN user_branch ON user_branch.ub_id = employee_registration.er_branch_id 
                                                                LEFT JOIN user ON user.id = emp_evaluation.eeva_user_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_er_job_id = $row["er_job_id"];
                                                $v_er_name_kh = $row["er_name_kh"];
                                                $v_er_name_en = $row["er_name_en"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_company_id = $row["c_name_kh"];
                                                $v_department_id = $row["de_name"];
                                                $v_branch_id = $row["ub_name"];
                                                $v_date = $row["eeva_date"];
                                                $v_workquality = $row["eeva_work_quality"];
                                                $v_productivity = $row["eeva_productivity"];
                                                $v_communication = $row["eeva_communication"];
                                                $v_collboration = $row["eeva_collboration"];
                                                $v_initiative = $row["eeva_initiative"];
                                                $v_punctuality = $row["eeva_punctuality"];
                                                $v_note = $row["eeva_note"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_er_job_id; ?></td>
                                                    <td><?php echo "<i>Name Kh: </i> " . $v_er_name_kh . "<br/><i>Name En: </i> " . $v_er_name_en; ?></td>
                                                    <td><?php echo "<i>Gender: </i> " . $v_gender_id . "<br/><i>Position: </i> " . $v_position_id; ?></td>
                                                    <td><?php echo "<i>Comapny: </i> " . $v_company_id . "<br/><i>Branch: </i> " . $v_branch_id . "<br/><i>Department: </i> " . $v_department_id; ?></td>
                                                    <td><?php echo $v_date; ?></td>
                                                    <td><?php echo $v_workquality; ?></td>
                                                    <td><?php echo $v_productivity; ?></td>
                                                    <td><?php echo $v_communication; ?></td>
                                                    <td><?php echo $v_collboration; ?></td>
                                                    <td><?php echo $v_initiative; ?></td>
                                                    <td><?php echo $v_punctuality; ?></td>
                                                    <td><?php echo $v_note; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_staff_evaluate.php?id=<?php echo $row['eeva_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['eeva_id']; ?>, 
                                                        '<?php echo $row['er_id']; ?>', 
                                                        '<?php echo $row['er_name_kh']; ?>' , 
                                                        '<?php echo $row['er_name_en']; ?>' , 
                                                        '<?php echo $row['eeva_gender']; ?>' , 
                                                        '<?php echo $row['eeva_position']; ?>' , 
                                                        '<?php echo $v_date; ?>' , 
                                                        '<?php echo $v_workquality; ?>' , 
                                                        '<?php echo $v_productivity; ?>' , 
                                                        '<?php echo $v_communication; ?>' , 
                                                        '<?php echo $v_collboration; ?>' , 
                                                        '<?php echo $v_initiative; ?>' , 
                                                        '<?php echo $v_punctuality; ?>' , 
                                                        '<?php echo $v_note; ?>' )" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="staff_evaluate.php?del_id=<?php echo $row['eeva_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, er_id, namekh, nameen, gender, position, date,
            workquality, productivity, communication, collboration, initiative, 
            punctuality, note) {

            $('#staff_evaluate_id').val(id);
            $('#edit_job_id').val(er_id).change();
            $('#edit_name_kh').val(namekh);
            $('#edit_name_en').val(nameen);
            $('#edit_gender').val(gender).change();
            $('#edit_position').val(position).change();
            $('#edit_date').val(date);
            $('#edit_work_quality').val(workquality);
            $('#edit_productivity').val(productivity);
            $('#edit_communication').val(communication);
            $('#edit_collaboration').val(collboration);
            $('#edit_initiative').val(initiative);
            $('#edit_punctuality').val(punctuality);
            $('#edit_note').val(note);
        }

        $('#txt_job_id').change(function() {
            $('.show_hid').css("visibility", "visible");
            var job_id = $("#txt_job_id").val();
            if (job_id) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_staff.php',
                    data: {
                        'staff_eva_job_id': job_id
                    },
                    success: function(html) {
                        $('#amount_data').html(html);
                    }
                });
            }
        })

        $(function() {
            $("select").selectpicker();
            $("#menu_staff_update").addClass("active");
            $("#evaluation").addClass("active");
            $("#evaluation").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>