<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$targetDir = "../img/upload/asset_transfer/";

if (isset($_POST["btnadd"])) {
    $v_imagename = '';
    $v_category = $_POST["txt_category"];
    $v_code = $_POST["txt_code"];
    $v_type = $_POST["txt_asset_type"];
    $v_name = $_POST["txt_name"];
    $v_qty = $_POST["txt_qty"];
    $v_mou = $_POST["txt_mou"];
    $v_price = $_POST["txt_price"];
    $v_tprice = $_POST["txt_tprice"];
    $v_date = $_POST["txt_date"];
    $v_status = $_POST["txt_status"];
    $v_transfer_no = $_POST["txt_tran_no"];
    $v_transfer_to = $_POST["txt_tran_to"];
    $v_transfer_date = $_POST["txt_tran_date"];
    $v_current_price = $_POST["txt_current_price"];
    $v_reason = $_POST["txt_reason"];

    if (!empty($_FILES['txt_photo']['name'])) {
        /////////////////upload image//////////////////////
        $v_imagename = date("Ymd") . "_code" . $v_code . "_" . basename($_FILES['txt_photo']['name']);
        $v_imagefullname = $targetDir . date("Ymd") . "_code" . $v_code . "_" . basename($_FILES['txt_photo']['name']);
        move_uploaded_file($_FILES['txt_photo']['tmp_name'], $v_imagefullname);
        ////////////////////////////////////////////////////
    }

    $sql = "INSERT INTO admin_asset_transfer  
                        ( 
                        adstrt_category,
                        adstrt_code,
                        adstrt_type,
                        adstrt_asset_name,
                        adstrt_qty,
                        adstrt_mou,
                        adstrt_unit_price,
                        adstrt_total,
                        adstrt_date,
                        adstrt_status,
                        adstrt_transfer_no,
                        adstrt_transfer_to,
                        adstrt_transfer_date,
                        adstrt_c_price,
                        adstrt_img,
                        adstrt_reason,
                        adstrt_userid,
                        adstrt_created_date )
                  VALUES 
                    ('$v_category','$v_code','$v_type','$v_name',
                    '$v_qty','$v_mou','$v_price','$v_tprice',
                    '$v_date','$v_status','$v_transfer_no', '$v_transfer_to',
                    '$v_transfer_date','$v_current_price','$v_imagename',
                    '$v_reason','$user_id','$yeardate')";
    $result = mysqli_query($connect, $sql);
    header('location:admin_stationary_receive.php?message=success');
}

if (isset($_POST["btnupdate"])) {
    $v_imagename = '';
    $id = $_POST["stationary_rece_id"];
    $v_category = $_POST["edit_category"];
    $v_code = $_POST["edit_code"];
    $v_type = $_POST["edit_asset_type"];
    $v_name = $_POST["edit_name"];
    $v_qty = $_POST["edit_qty"];
    $v_mou = $_POST["edit_mou"];
    $v_price = $_POST["edit_price"];
    $v_tprice = $_POST["edit_tprice"];
    $v_date = $_POST["edit_date"];
    $v_status = $_POST["edit_status"];
    $v_transfer_no = $_POST["edit_tran_no"];
    $v_transfer_to = $_POST["edit_tran_to"];
    $v_transfer_date = $_POST["edit_tran_date"];
    $v_current_price = $_POST["edit_current_price"];
    $v_reason = $_POST["edit_reason"];

    $sql = "UPDATE admin_asset_transfer SET 
                        adstrt_category ='$v_category',
                        adstrt_code ='$v_code',
                        adstrt_type ='$v_type',
                        adstrt_asset_name ='$v_name',
                        adstrt_qty ='$v_qty',
                        adstrt_mou ='$v_mou',
                        adstrt_unit_price ='$v_price',
                        adstrt_total ='$v_tprice',
                        adstrt_date ='$v_date',
                        adstrt_status ='$v_status',
                        adstrt_transfer_no ='$v_transfer_no',
                        adstrt_transfer_to ='$v_transfer_to',
                        adstrt_transfer_date ='$v_transfer_date',
                        adstrt_c_price ='$v_current_price', ";

    if (!empty($_FILES['edit_photo']['name']) || $_FILES['edit_photo']['name'] = '' || $_FILES['edit_photo']['name'] = 'NULL') {
        /////////////////upload image//////////////////////
        $v_imagename = date("Ymd") . "_code" . $v_code . "_" . basename($_FILES['edit_photo']['name']);
        $v_imagefullname = $targetDir . date("Ymd") . "_code" . $v_code . "_" . basename($_FILES['edit_photo']['name']);
        move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_imagefullname);
        ////////////////////////////////////////////////////
        $sql .= "adstrt_img ='$v_imagename', ";
    }

    $sql .= "adstrt_reason ='$v_reason' WHERE adstrt_id = $id";

    $result = mysqli_query($connect, $sql);
    header('location:admin_stationary_receive.php?message=update');
}

if (isset($_GET["del_id"])) {
    $id = $_GET["del_id"];

    $sql = "DELETE FROM admin_asset_transfer WHERE adstrt_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location: admin_stationary_receive.php?message=delete");
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
                    Stationary Receive Transfer
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
                                                            <div class="form-group col-xs-12">
                                                                <label>Transfer Nº :</label>
                                                                <select class="form-control" id="txt_tran_ref" name="txt_tran_ref" data-live-search="true">
                                                                    <option disabled selected>Please Select Transfer No</option>
                                                                    <?php
                                                                    $sql = 'SELECT * FROM admin_stationary_transfer';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['adstt_id '] . '" title="' . $row['adstt_transfer_no'] . '"> Code: ' . $row['adstt_code'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adstt_transfer_no'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Transfer From:</label>
                                                                <input class="form-control" id="txt_tran_from" name="txt_tran_from" type="number">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Receive Date:</label>
                                                                <input class="form-control" id="txt_date" name="txt_date" type="date">
                                                            </div>
                                                            <!-- <p id='amount_data'></p> -->
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Code:</label>
                                                                <input class="form-control" id="txt_code" name="txt_code" type="text">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Name:</label>
                                                                <input class="form-control" id="txt_name" name="txt_name" type="text">
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>ST. Type:</label>
                                                                <select class="form-control" id="txt_type" name="txt_type">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_type';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['st_id'] . '">' . $row['st_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
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
                                                                    <input class="form-control" id="txt_tprice" name="txt_tprice" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Status:</label>
                                                                <select class="form-control" id="txt_status" name="txt_status">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_status';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['ais_id'] . '">' . $row['ais_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                                <label>Reason:</label>
                                                                <input class="form-control" id="txt_reason" name="txt_reason" type="text">
                                                            </div>
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
                                                        <input type="hidden" id="stationary_rece_id" name="stationary_rece_id" />
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>Photo:</label><br />
                                                                <img id="show_edit_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="650px;">
                                                            </div>
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>Transfer Nº :</label>
                                                                <select class="form-control" id="edit_tran_ref" name="edit_tran_ref" data-live-search="true">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM admin_stationary_transfer';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['adstt_id '] . '" title="' . $row['adstt_transfer_no'] . '"> Code: ' . $row['adstt_code'] . ' &nbsp &nbsp &nbsp &nbsp Nº: ' . $row['adstt_transfer_no'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Transfer From:</label>
                                                                <input class="form-control" id="edit_tran_from" name="edit_tran_from" type="number">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Receive Date:</label>
                                                                <input class="form-control" id="edit_date" name="edit_date" type="date">
                                                            </div>
                                                            <!-- <p id='amount_data'></p> -->
                                                        </div>
                                                        <div class="row col-xs-4">
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Code:</label>
                                                                <input class="form-control" id="edit_code" name="edit_code" type="text">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Name:</label>
                                                                <input class="form-control" id="edit_name" name="edit_name" type="text">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>ST. Type:</label>
                                                                <select class="form-control" id="edit_type" name="edit_type">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_type';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['st_id'] . '">' . $row['st_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
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
                                                                    <input class="form-control" id="edit_tprice" name="edit_tprice" type="number" step="0.01">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Asset Status:</label>
                                                                <select class="form-control" id="edit_status" name="edit_status">
                                                                    <?php
                                                                    $sql = 'SELECT * FROM text_asset_in_status';
                                                                    $result = mysqli_query($connect, $sql);
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo '<option value="' . $row['ais_id'] . '">' . $row['ais_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label>Reason:</label>
                                                                <input class="form-control" id="edit_reason" name="edit_reason" type="text">
                                                            </div>
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
                                                <th>Unit Price</th>
                                                <th>Total Amount</th>
                                                <th>Transfer No</th>
                                                <th>Transfer From</th>
                                                <th>Receive Date</th>
                                                <th>Status</th>
                                                <th style="width: 110px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM admin_stationary_receive   
                                                                LEFT JOIN admin_asset_transfer on admin_asset_transfer.adasst_id = admin_stationary_receive.adstrt_transfer_no  
                                                                LEFT JOIN user_branch ON user_branch.ub_id = admin_stationary_receive.adstrt_transfer_location  
                                                                LEFT JOIN text_asset_in_status ON text_asset_in_status.ais_id = admin_stationary_receive.adstrt_status";
                                            $result = $connect->query($sql);

                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                $v_i = $i++;
                                                $v_code = $row["adstrt_code"];
                                                $v_type = $row["adstrt_type"];
                                                $v_name = $row["adstrt_name"];
                                                $v_qty = $row["adstrt_qty"];
                                                $v_uprice = $row["adstrt_unit_price"];
                                                $v_total_amount = $row["adstrt_total"];
                                                $v_transfer_no = $row["adasst_transfer_no"];
                                                $v_transfer_from = $row["ub_name"];
                                                $v_receive_date = $row["adstrt_date"];
                                                $v_current_price = $row["adstrt_c_price"];
                                                $v_reason = $row["adstrt_reason"];
                                                $v_status_id = $row["ais_name"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $v_i; ?></td>
                                                    <td><?php echo $v_code; ?></td>
                                                    <td><?php echo $v_type; ?></td>
                                                    <td><?php echo $v_name; ?></td>
                                                    <td><?php echo $v_qty; ?></td>
                                                    <td><?php echo $v_uprice; ?></td>
                                                    <td><?php echo $v_total_amount; ?></td>
                                                    <td><?php echo $v_transfer_no; ?></td>
                                                    <td><?php echo $v_transfer_from; ?></td>
                                                    <td><?php echo $v_receive_date; ?></td>
                                                    <td><?php echo $v_status_id; ?></td>
                                                    <td>
                                                        <!-- <a href="edit_admin_stationary_receive.php?id=<?php echo $row['adstrt_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                                        <a onclick="doUpdate(
                                                        '<?php echo $row['adstrt_id']; ?>',
                                                        '<?php echo $v_type; ?>',
                                                        '<?php echo $row['adstrt_code']; ?>',
                                                        '<?php echo $row['adstrt_name']; ?>',
                                                        '<?php echo $row['adstrt_qty']; ?>',
                                                        '<?php echo $row['adstrt_mou']; ?>',
                                                        '<?php echo $row['adstrt_unit_price']; ?>',
                                                        '<?php echo $row['adstrt_total']; ?>',
                                                        '<?php echo $row['adstrt_transfer_no']; ?>',
                                                        '<?php echo $row['adstrt_transfer_location']; ?>',
                                                        '<?php echo $row['adstrt_date']; ?>',
                                                        '<?php echo $row['adstrt_status']; ?>',
                                                        '<?php echo $row['adstrt_note']; ?>',
                                                        '<?php echo ''; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete ?');" href="admin_stationary_receive.php?del_id=<?php echo $row['adstrt_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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

        function doUpdate(id, type, code, name, qty, mou, uprice, total, tran_no, 
        tran_to, date, status, note, photo) {

            $('#stationary_rece_id').val(id);
            $('#edit_type').val(type).change();
            $('#edit_code').val(code);
            $('#edit_name').val(name);
            $('#edit_qty').val(qty);
            $('#edit_mou').val(mou).change();
            $('#edit_price').val(uprice);
            $('#edit_tprice').val(total);
            $('#edit_tran_ref').val(tran_no).change();
            $('#edit_tran_from').val(tran_to).change();
            $('#edit_date').val(date);
            $('#edit_status').val(status).change();
            $('#edit_reason').val(note);

            if (photo == '' || photo == 'NULL') {
                document.getElementById('show_edit_photo').setAttribute('src', '../img/no_image.jpg');
            } else {
                document.getElementById('show_edit_photo').setAttribute('src', '../img/upload/asset_transfer/' + photo);
            }
        }


        $('#edit_tran_ref').change(function() {
            $('.show_hid').css("visibility", "visible");
            /*var job_id = $("#edit_tran_ref").val();
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
            $("#station_receive").addClass("active");
            $("#station_receive").css("background-color", "##367fa9");

            $('#info_data').dataTable();
        });
    </script>
</body>

</html>