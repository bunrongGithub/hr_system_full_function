<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_candidate_name = $_POST["txt_cc_name"];
    $v_gender = $_POST["txt_gender"];
    $v_position = $_POST["txt_position"];
    $v_department_id = $_POST["txt_department"];
    $v_branch_id = $_POST["txt_branch"];
    $v_applied_date = $_POST["txt_appiled_date"];
    $v_score = $_POST["txt_score"];
    $v_salary_amount = $_POST["txt_salary_amount"];
    $v_salary_type = $_POST["txt_salary_type"];
    $v_manager = $_POST["txt_manager"];
    $v_director = $_POST["txt_director"];
    $v_status = $_POST["txt_status"];

    $sql = "INSERT INTO selection 
                        ( se_candi_name , se_gender_id, se_position_id, se_department_id, se_branch_id, 
                         se_applied_date, se_score, se_salary, se_salary_type, se_manager_confirm, 
                         se_director_approved, se_status_id, created_at)
                  VALUES 
                    ('$v_candidate_name', '$v_gender', '$v_position', '$v_department_id', '$v_branch_id', 
                    '$v_applied_date','$v_score','$v_salary_amount','$v_salary_type','$v_manager',
                    '$v_director','$v_status','$yeardate')";
    $result = mysqli_query($connect, $sql);
    header('location:selection.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["selection_id"];
    $v_candidate_name = $_POST["txt_cc_name"];
    $v_gender = $_POST["txt_gender"];
    $v_position = $_POST["txt_position"];
    $v_department_id = $_POST["txt_department"];
    $v_branch_id = $_POST["txt_branch"];
    $v_applied_date = $_POST["txt_appiled_date"];
    $v_score = $_POST["txt_score"];
    $v_salary_amount = $_POST["txt_salary_amount"];
    $v_salary_type = $_POST["txt_salary_type"];
    $v_manager = $_POST["txt_manager"];
    $v_director = $_POST["txt_director"];
    $v_status = $_POST["txt_status"];

    $sql = "UPDATE selection SET se_candi_name = '$v_candidate_name', 
                                se_gender_id = '$v_gender', 
                                se_position_id = '$v_position', 
                                se_department_id = '$v_department_id', 
                                se_branch_id = '$v_department_id', 
                                se_applied_date = '$v_applied_date', 
                                se_score = '$v_score', 
                                se_salary  = '$v_salary_amount', 
                                se_salary_type  = '$v_salary_type', 
                                se_manager_confirm  = '$v_manager', 
                                se_director_approved  = '$v_director', 
                                se_status_id = '$v_status' WHERE se_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:selection.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM selection WHERE se_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: selection.php?message=delete");
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
                    Selection LIST
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
                                                            <label>Candidate Name:</label>
                                                            <select class="form-control" id="txt_cc_name" name="txt_cc_name" required="required">
                                                                <option disabled selected>Please Select Candidate Name</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM inverview WHERE in_status_id = 2';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['in_id'] . '">' . $row['in_candi_name'] . '</option>';
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
                                                        <div class="form-group col-xs-6">
                                                            <label>Applied Date:</label>
                                                            <input class="form-control" id="txt_appiled_date" name="txt_appiled_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Score:</label>
                                                            <input class="form-control" id="txt_score" name="txt_score" type="number" step="0.01" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Salary Amount:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">$</div>
                                                                <input type="number" class="form-control" id="txt_salary_amount" name="txt_salary_amount" type="number" step="0.01" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Salary Type:</label>
                                                            <select class="form-control" id="txt_salary_type" name="txt_salary_type" required="required">
                                                                <option disabled selected>Please Select Salary Type</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM salary_type';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['st_id'] . '">' . $row['st_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Manager Confirm:</label>
                                                            <input class="form-control" id="txt_manager" name="txt_manager" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Director Approved:</label>
                                                            <input class="form-control" id="txt_director" name="txt_director" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="txt_status" name="txt_status">
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
                                                        <input type="hidden" id="selection_id" name="selection_id" />
                                                        <div class="form-group col-xs-6">
                                                            <label>Candidate Name:</label>
                                                            <select class="form-control" id="edit_cc_name" name="edit_cc_name" required="required">
                                                                <option disabled selected>Please Select Candidate Name</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM inverview WHERE in_status_id = 3';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['in_id'] . '">' . $row['in_candi_name'] . '</option>';
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
                                                        <div class="form-group col-xs-6">
                                                            <label>Applied Date:</label>
                                                            <input class="form-control" id="edit_appiled_date" name="edit_appiled_date" type="date" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Score:</label>
                                                            <input class="form-control" id="edit_score" name="edit_score" type="number" step="0.01" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Salary Amount:</label>
                                                            <input class="form-control" id="edit_salary_amount" name="edit_salary_amount" type="number" step="0.01" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Salary Type:</label>
                                                            <select class="form-control" id="edit_salary_type" name="edit_salary_type" required="required">
                                                                <option disabled selected>Please Select Salary Type</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM salary_type';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['st_id'] . '">' . $row['st_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Manager Confirm:</label>
                                                            <input class="form-control" id="edit_manager" name="edit_manager" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Director Approved:</label>
                                                            <input class="form-control" id="edit_director" name="edit_director" type="text" required>
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
                                                <th>Candidate Name</th>
                                                <th>Gender</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Branch</th>
                                                <th>Applied Date</th>
                                                <th>Status</th>
                                                <th>Score</th>
                                                <th>Salary Amount</th>
                                                <th>Salary Type</th>
                                                <th>Manager Confirm</th>
                                                <th>Director Approved</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM selection 
                                                                LEFT JOIN position ON position.position_id = selection.se_position_id 
                                                                LEFT JOIN gender ON gender.ge_id = selection.se_gender_id 
                                                                LEFT JOIN status_selection ON status_selection.ss_id = selection.se_status_id 
                                                                LEFT JOIN department on department.de_id = selection.se_department_id 
                                                                LEFT JOIN user_branch on user_branch.ub_id = selection.se_branch_id 
                                                                LEFT JOIN salary_type ON salary_type.st_id = selection.se_salary_type  
                                                                LEFT JOIN recruiting ON recruiting.rec_id = selection.se_candi_name ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_candi_name = $row["se_candi_name"];
                                                $v_gender_id = $row["ge_name"];
                                                $v_position_id = $row["position"];
                                                $v_department_id = $row["de_name"];
                                                $v_branch_id = $row["ub_name"];
                                                $v_applied_date = $row["se_applied_date"];
                                                $v_status = $row["ss_name"];
                                                $v_score = $row["se_score"];
                                                $v_salary_amount = $row["se_salary_amount"];
                                                $v_salary_type = $row["st_id"];
                                                $v_manager = $row["se_manager_confirm"];
                                                $v_director = $row["se_director_apporved"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_candi_name; ?></td>
                                                    <td><?php echo $v_gender_id; ?></td>
                                                    <td><?php echo $v_position_id; ?></td>
                                                    <td><?php echo $v_department_id; ?></td>
                                                    <td><?php echo $v_branch_id; ?></td>
                                                    <td><?php echo $v_applied_date; ?></td>
                                                    <td><?php echo $v_status; ?></td>
                                                    <td><?php echo $v_score; ?></td>
                                                    <td><?php echo $v_salary_amount; ?></td>
                                                    <td><?php echo $v_salary_type; ?></td>
                                                    <td><?php echo $v_manager; ?></td>
                                                    <td><?php echo $v_director; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_selection.php?id=<?php echo $row['se_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['se_id']; ?>,
                                                        '<?php echo $row['se_candi_name']; ?>',
                                                        '<?php echo $row['se_gender_id']; ?>',
                                                        '<?php echo $row['se_position_id']; ?>',
                                                        '<?php echo $row['se_department_id']; ?>',
                                                        '<?php echo $row['se_branch_id']; ?>',
                                                        '<?php echo $v_applied_date; ?>',
                                                        '<?php echo $row['se_status_id']; ?>',
                                                        '<?php echo $v_score; ?>',
                                                        '<?php echo $v_salary_amount; ?>',
                                                        '<?php echo $row['se_salary_type']; ?>',
                                                        '<?php echo $v_manager; ?>',
                                                        '<?php echo $v_director; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="selection.php?del_id=<?php echo $row['se_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, cc_name, gender, position, depart_id, branch_id, applied_date, statusid, score, salary, salary_type, manager, director) {

            $('#selection_id').val(id);
            $('#edit_cc_name').val(cc_name).change();
            $('#edit_gender').val(gender).change();
            $('#edit_position').val(position).change();
            $('#edit_department').val(depart_id).change();
            $('#edit_branch').val(branch_id).change();
            $('#edit_applied_date').val(applied_date);
            $('#edit_status').val(statusid).change();
            $('#edit_score').val(score);
            $('#edit_salary_amount').val(salary);
            $('#edit_salary_type').val(salary_type).change();
            $('#edit_manager').val(manager);
            $('#edit_director').val(director);
        }

        $(function() {
            $("#menu_job").addClass("active");
            $("#selection").addClass("active");
            $("#selection").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>