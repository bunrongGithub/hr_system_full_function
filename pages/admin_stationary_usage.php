<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (isset($_POST["btnadd"])) {
    $v_category = $_POST["txt_category"];
    $v_code = $_POST["txt_code"];
    $v_type = $_POST["txt_asset_type"];
    $v_name = $_POST["txt_name"];
    $v_qty = $_POST["txt_qty"];
    $v_mou = $_POST["txt_mou"];
    $v_price = $_POST["txt_price"];
    $v_amount = $_POST["txt_amount"];
    $v_er_id = $_POST["txt_er_id"];
    $v_emp_name = $_POST["txt_emp_name"];
    $v_position = $_POST["txt_position"];
    $v_useday = $_POST["txt_use_date"];
    $v_note = $_POST["txt_note"];

    $sql = "INSERT INTO admin_stationary_usage  
                        ( 
                        adstu_code,
                        adstu_type,
                        adstu_name,
                        adstu_category,
                        adstu_qty,
                        adstu_mou,
                        adstu_unit_price,
                        adstu_total,
                        adstu_er_id,
                        adstu_emp_name,
                        adstu_position,
                        adstu_using_date,
                        adstu_note,
                        adstu_userid,
                        adstu_created_date )
                  VALUES 
                    ('$v_code','$v_type','$v_name','$v_category',
                    '$v_qty','$v_mou','$v_price','$v_amount',
                    '$v_er_id','$v_emp_name','$v_position','$v_useday',
                    '$v_note','$user_id','$yeardate')";
    $result = mysqli_query($connect, $sql);
    header('location:admin_stationary_usage.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $id = $_POST["asset_usage_id"];
    $v_category = $_POST["edit_category"];
    $v_code = $_POST["edit_code"];
    $v_type = $_POST["edit_asset_type"];
    $v_name = $_POST["edit_name"];
    $v_qty = $_POST["edit_qty"];
    $v_mou = $_POST["edit_mou"];
    $v_price = $_POST["edit_price"];
    $v_amount = $_POST["edit_amount"];
    $v_er_id = $_POST["edit_er_id"];
    $v_emp_name = $_POST["edit_emp_name"];
    $v_position = $_POST["edit_position"];
    $v_useday = $_POST["edit_use_date"];
    $v_note = $_POST["edit_note"];

    $sql = "UPDATE admin_stationary_usage SET 
                        adstu_code ='$v_code',
                        adstu_type ='$v_type',
                        adstu_name ='$v_name',
                        adstu_category ='$v_category',
                        adstu_qty ='$v_qty',
                        adstu_mou ='$v_mou',
                        adstu_unit_price ='$v_price',
                        adstu_total ='$v_amount',
                        adstu_er_id ='$v_er_id',
                        adstu_emp_name ='$v_emp_name',
                        adstu_position ='$v_position',
                        adstu_using_date ='$v_useday',
                        adstu_note ='$v_note' WHERE adstu_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:admin_stationary_usage.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM admin_stationary_usage WHERE adstu_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: admin_stationary_usage.php?message=delete");
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
                    Asset Usage
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
                                    <div class="modal-dialog" style="width: 60%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>Photo:</label><br />
                                                                <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="650px;">
                                                            </div>
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Code:</label>
                                                                <select class="form-control" id="txt_code" name="txt_code" data-live-search="true">
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
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Name:</label>
                                                                <input class="form-control" id="txt_name" name="txt_name" type="text">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Category:</label>
                                                                <input class="form-control" id="txt_category" name="txt_category" type="text">
                                                            </div>
                                                            <!-- <p id='amount_data'></p> -->
                                                            <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                                <label>QTY:</label>
                                                                <input class="form-control" id="txt_qty" name="txt_qty" type="number">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-6" style="visibility: hidden;">
                                                                <label>MOU:</label>
                                                                <select class="form-control" id="txt_mou" name="txt_mou">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_mou';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Unit Price:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-addon">$</div>
                                                                    <input class="form-control" id="txt_price" name="txt_price" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Total Amount:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-addon">$</div>
                                                                    <input class="form-control" id="txt_amount" name="txt_amount" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Job ID:</label>
                                                                <select class="form-control" id="txt_er_id" name="txt_er_id" data-live-search="true">
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
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Employee Name:</label>
                                                                <input class="form-control" id="txt_emp_name" name="txt_emp_name" type="text">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Position:</label>
                                                                <select class="form-control" id="txt_position" name="txt_position">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM position';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['position_id'] . '">' . $row['position'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Using Date:</label>
                                                                <input class="form-control" id="txt_use_date" name="txt_use_date" type="date">
                                                            </div>
                                                        </div>
                                                        <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="txt_reason" name="txt_reason" type="text">
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
                                    <div class="modal-dialog" style="width: 60%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form method="post" enctype="multipart/form-data" action="">
                                                        <input type="hidden" id="asset_usage_id" name="asset_usage_id" />
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>Photo:</label><br />
                                                                <img id="show_edit_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="650px;">
                                                            </div>
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Code:</label>
                                                                <select class="form-control" id="edit_code" name="edit_code" data-live-search="true">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM employee_registration';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['er_job_id'] . '" title="' . $row['er_job_id'] . '"> ID: ' . $row['er_job_id'] . ' &nbsp &nbsp &nbsp &nbsp Name: ' . $row['er_name_kh'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Name:</label>
                                                                <input class="form-control" id="edit_name" name="edit_name" type="text">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Category:</label>
                                                                <input class="form-control" id="edit_category" name="edit_category" type="text">
                                                            </div>
                                                            <!-- <p id='amount_data'></p> -->
                                                            <div class="form-group col-xs-6">
                                                                <label>QTY:</label>
                                                                <input class="form-control" id="edit_qty" name="edit_qty" type="number">
                                                            </div>
                                                            <div class="form-group col-xs-6">
                                                                <label>MOU:</label>
                                                                <select class="form-control" id="edit_mou" name="edit_mou">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_mou';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Unit Price:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-addon">$</div>
                                                                    <input class="form-control" id="edit_price" name="edit_price" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Total Amount:</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-addon">$</div>
                                                                    <input class="form-control" id="edit_amount" name="edit_amount" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>Job ID:</label>
                                                                <select class="form-control" id="edit_er_id" name="edit_er_id" data-live-search="true">
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
                                                            <div class="form-group col-xs-12">
                                                                <label>Employee Name:</label>
                                                                <input class="form-control" id="edit_emp_name" name="edit_emp_name" type="text">
                                                            </div>
                                                            <div class="form-group col-xs-12">
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
                                                            <div class="form-group col-xs-12">
                                                                <label>Using Date:</label>
                                                                <input class="form-control" id="edit_use_date" name="edit_use_date" type="date">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-xs-12">
                                                            <label>Reason:</label>
                                                            <input class="form-control" id="edit_reason" name="edit_reason" type="text">
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
                                                <th>ST. Code</th>
                                                <th>ST. Type</th>
                                                <th>ST. Name</th>
                                                <th>QTY</th>
                                                <th>Current Price</th>
                                                <th>Total Amount</th>
                                                <th>Job ID</th>
                                                <th>Employee Name</th>
                                                <th>Position</th>
                                                <th>Using Date</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM admin_stationary_usage 
                                                                LEFT JOIN employee_registration ON employee_registration.er_id = admin_stationary_usage.adstu_er_id  
                                                                LEFT JOIN position ON position.position_id = employee_registration.er_position_id ";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_code = $row["adstu_code"];
                                                $v_type = $row["adstu_type"];
                                                $v_name = $row["adstu_name"];
                                                $v_qty = $row["adstu_qty"];
                                                $v_cprice = $row["adstu_c_price"];
                                                $v_tprice = $row["adstu_amount"];
                                                $v_job_id = $row["adstu_er_id"];
                                                $v_emp_name = $row["adstu_emp_name"];
                                                $v_position = $row["position"];
                                                $v_using_date = $row["adstu_using_date"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_code; ?></td>
                                                    <td><?php echo $v_type; ?></td>
                                                    <td><?php echo $v_name; ?></td>
                                                    <td><?php echo $v_qty; ?></td>
                                                    <td><?php echo $v_cprice; ?></td>
                                                    <td><?php echo $v_tprice; ?></td>
                                                    <td><?php echo $v_job_id; ?></td>
                                                    <td><?php echo $v_emp_name; ?></td>
                                                    <td><?php echo $v_position; ?></td>
                                                    <td><?php echo $v_using_date; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_admin_stationary_usage.php?id=<?php echo $row['adstu_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(
                                                        '<?php echo $row['adstu_id']; ?>',
                                                        '<?php echo $row['adstu_category']; ?>',
                                                        '<?php echo $row['adstu_code']; ?>',
                                                        '<?php echo $row['adstu_name']; ?>',
                                                        '<?php echo $row['adstu_qty']; ?>',
                                                        '<?php echo $row['adstu_mou']; ?>',
                                                        '<?php echo $row['adstu_c_price']; ?>',
                                                        '<?php echo $row['adstu_amount']; ?>',
                                                        '<?php echo $row['adstu_er_id']; ?>',
                                                        '<?php echo $row['adstu_emp_name']; ?>',
                                                        '<?php echo $row['adstu_position']; ?>',
                                                        '<?php echo $row['adstu_using_date']; ?>',
                                                        '<?php echo $row['adstu_note']; ?>',
                                                        '<?php echo ''; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="admin_stationary_usage.php?del_id=<?php echo $row['adstu_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
        function show_photo_pre(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("show_photo").src = src;
            }
        }

        function show_edit_photo_pre(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("show_edit_photo").src = src;
            }
        }

        function doUpdate(id, category, code, name, qty, mou, c_price, amount,
            emp_id, emp_name, emp_position, using_date, note, photo) {

            $('#asset_usage_id').val(id);
            $('#edit_category').val(category);
            $('#edit_code').val(code).change();
            $('#edit_name').val(name);
            $('#edit_qty').val(qty);
            $('#edit_mou').val(mou).change();
            $('#edit_c_price').val(amount);
            $('#edit_amount').val(amount);
            $('#edit_er_id').val(emp_id).change();
            $('#edit_emp_name').val(emp_name);
            $('#edit_position').val(emp_position);
            $('#edit_use_date').val(using_date);
            $('#edit_note').val(note);

            if (photo == '' || photo == 'NULL') {
                document.getElementById('show_edit_photo').setAttribute('src', '../img/no_image.jpg');
            } else {
                document.getElementById('show_edit_photo').setAttribute('src', '../img/upload/asset_broken/' + photo);
            }
        }


        $('#txt_code').change(function() {
            $('.show_hid').css("visibility", "visible");
            /*var job_id = $("#txt_asset_id").val();
            if (job_id) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_admin_asset.php',
                    data: {
                        txt_asset_in_id: job_id
                    },
                    success: function(html) {
                        $('#amount_data').html(html);
                    }
                });
            }*/
        })

        $('#txt_er_id').change(function() {
            $('.show_hid').css("visibility", "visible");
            /*var job_id = $("#txt_er_id").val();
            if (job_id) {
                $.ajax({
                    type: 'POST',
                    url: 'fetch_admin_asset.php',
                    data: {
                        txt_asset_in_id: job_id
                    },
                    success: function(html) {
                        $('#amount_data').html(html);
                    }
                });
            }*/
        })

        $(function() {
            $("select").selectpicker();
            $("#menu_admin_manage").addClass("active");
            $("#asset_depre").addClass("active");
            $("#asset_depre").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>