<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_pcr_no = $_POST["txt_pcr_no"];
    $v_reason = $_POST["txt_reason"];
    $v_amount_usd = $_POST["txt_amount_usd"];
    $v_amount_khr = $_POST["txt_amount_khr"];
    $v_company = $_POST["txt_company"];
    $v_branch = $_POST["txt_branch"];
    $v_department = $_POST["txt_department"];

    $sql = "INSERT INTO pettycash_request 
                        ( pc_pcr_no , pc_reason, pc_amount_usd, pc_amount_khr,
                         pc_request_date, pc_company_id, pc_branch_id, pc_department_id,
                         pc_status_id, pc_user_id, created_at)
                  VALUES 
                    ('$v_pcr_no', '$v_reason', '$v_amount_usd', '$v_amount_khr',
                    '$yeardate','$v_company','$v_branch','$v_department', 1,'$user_id', '$datetime')";
    $result = mysqli_query($connect, $sql);
    header('location:pettycash_request.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["pcr_id"];
    $v_pcr_no = $_POST["edit_pcr_no"];
    $v_reason = $_POST["edit_reason"];
    $v_amount_usd = $_POST["edit_amount_usd"];
    $v_amount_khr = $_POST["edit_amount_khr"];
    $v_app_date = $_POST["edit_app_date"];
    $v_company = $_POST["edit_company"];
    $v_branch = $_POST["edit_branch"];
    $v_department = $_POST["edit_department"];
    $v_status = $_POST["edit_status"];

    $sql = "UPDATE pettycash_request SET pc_pcr_no = '$v_pcr_no', 
                                pc_reason = '$v_reason', 
                                pc_amount_usd = '$v_amount_usd', 
                                pc_amount_khr = '$v_amount_khr', 
                                pc_approved_date = '$v_app_date', 
                                pc_company_id = '$v_company', 
                                pc_branch_id = '$v_branch', 
                                pc_department_id = '$v_department', 
                                pc_status_id = '$v_status' WHERE pc_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:pettycash_request.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM pettycash_request WHERE pc_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: pettycash_request.php?message=delete");
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
                    Petty Cash Request
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
                                                            <label>PCR No:</label>
                                                            <input class="form-control" id="txt_pcr_no" name="txt_pcr_no" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="txt_reason" name="txt_reason" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount USD:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">$</div>
                                                                <input class="form-control" id="txt_amount_usd" name="txt_amount_usd" type="number" step="0.01" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount KHR:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">៛</div>
                                                                <input class="form-control" id="txt_amount_khr" name="txt_amount_khr" type="number" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Company Name:</label>
                                                            <select class="form-control" id="txt_company" name="txt_company" required="required">
                                                                <option disabled selected>Please Select Company</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
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
                                                        <input type="hidden" id="pcr_id" name="pcr_id" />
                                                        <div class="form-group col-xs-12">
                                                            <label>PCR No:</label>
                                                            <input class="form-control" id="edit_pcr_no" name="edit_pcr_no" type="text" required>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="edit_reason" name="edit_reason" type="text">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount USD:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">$</div>
                                                                <input class="form-control" id="edit_amount_usd" name="edit_amount_usd" type="number" step="0.01" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Amount KHR:</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">៛</div>
                                                                <input class="form-control" id="edit_amount_khr" name="edit_amount_khr" type="number" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Company Name:</label>
                                                            <select class="form-control" id="edit_company" name="edit_company" required="required">
                                                                <option disabled selected>Please Select Company</option>
                                                                <?php
                                                                $sql = 'SELECT * FROM company';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['c_id'] . '">' . $row['c_name_kh'] . '</option>';
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
                                                            <label>Approved Date:</label>
                                                            <input class="form-control" id="edit_app_date" name="edit_app_date" type="date">
                                                        </div>
                                                        <div class="form-group col-xs-6">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="edit_status" name="edit_status">
                                                                <?php
                                                                $sql = 'SELECT * FROM text_petty_cash_status';
                                                                $result = mysqli_query($connect, $sql);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    echo '<option value="' . $row['tpc_id'] . '">' . $row['tpc_name'] . '</option>';
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
                                                <th>PCR No</th>
                                                <th>Reason</th>
                                                <th>Amount USD</th>
                                                <th>Amount KHR</th>
                                                <th>Request Date</th>
                                                <th>Approved Date</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM pettycash_request 
                                                    LEFT JOIN text_petty_cash_status 
                                                    ON text_petty_cash_status.tpc_id = pettycash_request.pc_status_id";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_pcr_no = $row["pc_pcr_no"];
                                                $v_reason = $row["pc_reason"];
                                                $v_amount_usd = $row["pc_amount_usd"];
                                                $v_amount_khr = $row["pc_amount_khr"];
                                                $v_request_date = $row["pc_request_date"];
                                                $v_approved_date = $row["pc_approved_date"];
                                                $v_status_id = $row["tpc_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_pcr_no; ?></td>
                                                    <td><?php echo $v_reason; ?></td>
                                                    <td><?php echo $v_amount_usd; ?></td>
                                                    <td><?php echo $v_amount_khr; ?></td>
                                                    <td><?php echo $v_request_date; ?></td>
                                                    <td><?php echo $v_approved_date; ?></td>
                                                    <td><?php echo $v_status_id; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_pettycash_request.php?id=<?php echo $row['pc_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(<?php echo $row['pc_id']; ?>,
                                                        '<?php echo $v_pcr_no; ?>',
                                                        '<?php echo $v_reason; ?>',
                                                        '<?php echo $v_amount_usd; ?>',
                                                        '<?php echo $v_amount_khr; ?>',
                                                        '<?php echo $v_approved_date; ?>',
                                                        '<?php echo $row['pc_company_id']; ?>',
                                                        '<?php echo $row['pc_branch_id']; ?>',
                                                        '<?php echo $row['pc_department_id']; ?>',
                                                        '<?php echo $row['pc_status_id']; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="pettycash_request.php?del_id=<?php echo $row['pc_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function doUpdate(id, pcr_no, reason, amount_usd, amount_khr, approve_date, company_id, branch_id, department_id, statusid) {

            $('#pcr_id').val(id);
            $('#edit_pcr_no').val(pcr_no);
            $('#edit_reason').val(reason);
            $('#edit_amount_usd').val(amount_usd);
            $('#edit_amount_khr').val(amount_khr);
            $('#edit_app_date').val(approve_date);
            $('#edit_company').val(company_id).change();
            $('#edit_branch').val(branch_id).change();
            $('#edit_department').val(department_id).change();
            $('#edit_status').val(statusid).change();
        }

        $(function() {
            $("#menu_pc_manage").addClass("active");
            $("#pc_request").addClass("active");
            $("#pc_request").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>