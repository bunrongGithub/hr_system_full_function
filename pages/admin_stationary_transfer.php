<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$_Dir = "../img/upload/admin_stationary_transfer/";
if (isset($_POST["btnadd"])) {
   $v_code = $_POST["txt_code"];
   $v_type = $_POST["txt_asset_type"];
   $v_name = $_POST["txt_name"];
   $v_qty = $_POST["txt_qty"];
   $v_mou = $_POST["txt_mou"];
   $v_price = $_POST["txt_price"];
   $v_tprice = $_POST["txt_tprice"];
   $v_status = $_POST["txt_status"];
   $v_transfer_no = $_POST["txt_tran_no"];
   $v_transfer_to = $_POST["txt_tran_to"];
   $v_transfer_date = $_POST["txt_tran_date"];
   $v_reason = $_POST["txt_reason"];
   $v_img = $_FILES['txt_img'];
   if(!empty($v_img)){
      $v_img_name = date("Ymd") . "_" . basename($v_img['name']);
      $v_img_fullname = $_Dir . $v_img_name;
      move_uploaded_file($v_img['tmp_name'], $v_img_fullname);
   }

   $sql = "INSERT INTO admin_stationary_transfer 
                        ( 
                        adstt_code,
                        adstt_type,
                        adstt_name,
                        adstt_qty,
                        adstt_mou,
                        adstt_unit_price,
                        adstt_total,
                        adstt_status,
                        adstt_transfer_no,
                        adstt_transfer_to,
                        adstt_transfer_date,
                        adstt_note,
                        adstt_userid,
                        adstt_created_date,adstt_photo )
                  VALUES 
                    ('$v_code','$v_type','$v_name','$v_qty',
                    '$v_mou','$v_price','$v_tprice','$v_status',
                    '$v_transfer_no','$v_transfer_to','$v_transfer_date',
                    '$v_reason','$user_id','$yeardate','$v_img_name')";
   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_transfer.php?message=success');
}

if (isset($_POST["btnupdate"])) {
   $id = $_POST["station_tran_id"];;
   $v_code = $_POST["edit_code"];
   $v_type = $_POST["edit_asset_type"];
   $v_name = $_POST["edit_name"];
   $v_qty = $_POST["edit_qty"];
   $v_mou = $_POST["edit_mou"];
   $v_price = $_POST["edit_price"];
   $v_tprice = $_POST["edit_tprice"];
   $v_status = $_POST["edit_status"];
   $v_transfer_no = $_POST["edit_tran_no"];
   $v_transfer_to = $_POST["edit_tran_to"];
   $v_transfer_date = $_POST["edit_tran_date"];
   $v_reason = $_POST["edit_reason"];

   $sql = "UPDATE admin_stationary_transfer SET 
                        adstt_code ='$v_code',
                        adstt_type ='$v_type',
                        adstt_name ='$v_name',
                        adstt_qty ='$v_qty',
                        adstt_mou ='$v_mou',
                        adstt_unit_price ='$v_price',
                        adstt_total ='$v_tprice',
                        adstt_status ='$v_status',
                        adstt_transfer_no ='$v_transfer_no',
                        adstt_transfer_to ='$v_transfer_to',
                        adstt_transfer_date ='$v_transfer_date',
                        adstt_note ='$v_reason' WHERE adstt_id = $id";

   $result = mysqli_query($connect, $sql);
   header('location:admin_stationary_transfer.php?message=update');
   exit();
}

if (isset($_GET["del_id"])) {
   $id = $_GET["del_id"];

   $sql = "DELETE FROM admin_stationary_transfer WHERE adstt_id = '$id'";
   $result = mysqli_query($connect, $sql);
   header("location: admin_stationary_transfer.php?message=delete");
   exit();
}
if(isset($_POST['update_image'])){
   $_stf_id = $_POST['text_old_id'];
   $v_img = $_FILES['txt_img'];
   if(!empty($v_img)){
      $v_img_name = date("Ymd") . "_" . basename($v_img['name']);
      $v_img_fullname = $_Dir . $v_img_name;
      move_uploaded_file($v_img['tmp_name'], $v_img_fullname);
      $sql = "UPDATE admin_stationary_transfer SET adstt_photo = '$v_img_name' WHERE adstt_id = '$_stf_id'";
      $result = mysqli_query($connect, $sql);
      header("location: admin_stationary_transfer.php?message=update");
      exit();
   }
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
               Stationary Transfer
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
                                             <div style="visibility: hidden;" class="show_hid form-group col-xs-12">
                                                <label>Photo:</label><br />
                                                <img id="v_show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="..." src="../img/no_image.jpg" height="650px;">
                                                <input type="file" name="txt_img" id="txt_img"  accept="image/*" class="form-control" onchange="show_image(event)" >
                                             </div>
                                          </div>
                                          <div class="row col-xs-4">
                                             <div class="form-group col-xs-12">
                                                <label>ST. Code:</label>
                                                <select class="form-control" id="txt_code" name="txt_code" data-live-search="true" required="required">
                                                   <option disabled selected>Please Select Code</option>
                                                   <?php
                                                   $sql = "SELECT sc_id,
                                                                  sc_description_kh,
                                                                  sc_stationary_code
                                                               FROM stationary_code";
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['sc_id'] . '">Code:&nbsp;&nbsp;&nbsp;&nbsp;' . $row['sc_stationary_code'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desc:&nbsp;&nbsp;&nbsp;&nbsp;' . $row['sc_description_kh'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>ST. Name:</label>
                                                <input class="form-control" id="txt_name" name="txt_name" type="text">
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>ST. Type:</label>
                                                <select class="form-control" id="txt_asset_type" name="txt_asset_type">
                                                   <option selected value=""></option>
                                                   <?php
                                                   $sql = 'SELECT * FROM `text_asset_code_creation_type`';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['acct_id'] . '">' . $row['acct_name'] . '</option>';
                                                   }
                                                   ?>
                                                </select>
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
                                                   $sql = 'SELECT tasim_id,tasim_name FROM txt_admin_stationary_in_mou';
                                                   $result = mysqli_query($connect, $sql);
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                      echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
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
                                                <label>Total amount:</label>
                                                <div class="input-group ">
                                                   <div class="input-group-addon">$</div>
                                                   <input class="form-control" id="txt_tprice" name="txt_tprice" type="number" step="0.01">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row col-xs-4">
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>Transfer No:</label>
                                                <input class="form-control" id="txt_tran_no" name="txt_tran_no" type="text">
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>Transfer To:</label>
                                                <input class="form-control" id="txt_tran_to" name="txt_tran_to" type="text">
                                             </div>
                                             <div class="show_hid form-group col-xs-12" style="visibility: hidden;">
                                                <label>Transfer Date:</label>
                                                <input class="form-control" id="txt_tran_date" name="txt_tran_date" type="date">
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
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Information</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-12">
                                       <form method="post" enctype="multipart/form-data" action="">
                                          <input type="hidden" id="station_tran_id" name="station_tran_id" />
                                          <div class="form-group col-xs-6">
                                             <label>ST. Code:</label>
                                             <select class="form-control" id="edit_code" name="edit_code" data-live-search="true" required="required">
                                                <option disabled selected>Please Select Code</option>
                                                <?php
                                                $sql = "SELECT sc_id,
                                                                  sc_description_kh,
                                                                  sc_stationary_code
                                                               FROM stationary_code";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['sc_id'] . '">Code:&nbsp;&nbsp;&nbsp;&nbsp;' . $row['sc_stationary_code'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desc:&nbsp;&nbsp;&nbsp;&nbsp;' . $row['sc_description_kh'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>ST. Name:</label>
                                             <input class="form-control" id="edit_name" name="edit_name" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>ST. Type:</label>
                                             <select class="form-control" id="edit_asset_type" name="edit_asset_type">
                                                <option selected value=""></option>
                                                <?php
                                                $sql = 'SELECT * FROM `text_asset_code_creation_type`';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['acct_id'] . '">' . $row['acct_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
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
                                                $sql = 'SELECT tasim_id,tasim_name FROM txt_admin_stationary_in_mou';
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                   echo '<option value="' . $row['tasim_id'] . '">' . $row['tasim_name'] . '</option>';
                                                }
                                                ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Unit Price:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_price" name="edit_price" type="number" step="0.01">
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Total amount:</label>
                                             <div class="input-group ">
                                                <div class="input-group-addon">$</div>
                                                <input class="form-control" id="edit_tprice" name="edit_tprice" type="number" step="0.01" />
                                             </div>
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Transfer No:</label>
                                             <input class="form-control" id="edit_tran_no" name="edit_tran_no" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Transfer To:</label>
                                             <input class="form-control" id="edit_tran_to" name="edit_tran_to" type="text">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Transfer Date:</label>
                                             <input class="form-control" id="edit_tran_date" name="edit_tran_date" type="date">
                                          </div>
                                          <div class="form-group col-xs-6">
                                             <label>Status:</label>
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
                                          <div class="form-group col-xs-6">
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
                        <div class="modal fade" id="photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="exampleModalLabel">Uload Photo</h4>
                                 </div>
                                 <div class="modal-body">
                                    <form action="" enctype="multipart/form-data" method="post">
                                       <div class="form-group col-xs-12">
                                       <input type="hidden" name="text_old_id" id="text_old_id">
                                          <label>Photo:</label><br />
                                          <img id="show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" src="" alt="..."height="650px;">
                                          <input type="file" name="txt_img" id="txt_img" class="form-control" onchange="show_image_update(event)" >
                                       </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="submit" name="update_image" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                                    <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
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
                                    <th>Transfer to</th>
                                    <th>Transfer Date</th>
                                    <th>Status</th>
                                    <th>Photo</th>
                                    <th style="width: 110px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_stationary_transfer    
                                                               LEFT JOIN text_asset_code_creation_type ON text_asset_code_creation_type.acct_id = admin_stationary_transfer.adstt_type 
                                                               LEFT JOIN text_asset_in_status ON text_asset_in_status.ais_id = admin_stationary_transfer.adstt_status
                                                               LEFT JOIN stationary_code ON stationary_code.sc_id = admin_stationary_transfer.adstt_code
                                                               ";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = $result->fetch_assoc()) {
                                    $v_i = $i++;
                                    $v_code = $row["sc_stationary_code"];
                                    $v_type = $row["acct_name"];
                                    $v_name = $row["adstt_name"];
                                    $v_qty = $row["adstt_qty"];
                                    $v_uprice = $row["adstt_unit_price"];
                                    $v_total_amount = $row["adstt_total"];
                                    $v_transfer_no = $row["adstt_transfer_no"];
                                    $v_transfer_to = $row["adstt_transfer_to"];
                                    $v_transfer_date = $row["adstt_transfer_date"];
                                    $v_status_id = $row["ais_name"];
                                    $v_photo = $row['adstt_photo'];
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
                                       <td><?php echo $v_transfer_to; ?></td>
                                       <td><?php echo $v_transfer_date; ?></td>
                                       <td><?php echo $v_status_id; ?></td>
                                       <td>
                                          <img src="../img/<?php
                                                            if ($v_photo == '') {
                                                               echo "no_image.jpg";
                                                            } else {
                                                               echo "upload/admin_stationary_transfer/" . $v_photo;
                                                            }
                                                            ?>" width="60" height="60" alt="">
                                          <a onclick="doIMG('<?php echo $row['adstt_id']; ?>','<?php echo $row['adstt_photo']; ?>');" data-toggle="modal" data-target="#photo_modal" style="float:right;">
                                             <i class="fa fa-pencil"></i>
                                          </a>
                                       </td>
                                       <td>
                                          <!-- <a href="edit_admin_stationary_transfer.php?id=<?php echo $row['adstt_id']; ?>" class="btn btn-info btn-sm"><i style="color:white;" class="fa fa-eye"></i></a> -->
                                          <a onclick="doUpdate(
                                                         '<?php echo $row['adstt_id']; ?>',
                                                         '<?php echo $row['adstt_code']; ?>',
                                                         '<?php echo $row['adstt_type']; ?>',
                                                         '<?php echo $row['adstt_name']; ?>',
                                                         '<?php echo $row['adstt_qty']; ?>',
                                                         '<?php echo $row['adstt_mou']; ?>',
                                                         '<?php echo $row['adstt_unit_price']; ?>',
                                                         '<?php echo $row['adstt_total']; ?>',
                                                         '<?php echo $row['adstt_status']; ?>',
                                                         '<?php echo $row['adstt_transfer_no']; ?>',
                                                         '<?php echo $row['adstt_transfer_to']; ?>',
                                                         '<?php echo $row['adstt_transfer_date']; ?>',
                                                         '<?php echo $row['adstt_note']; ?>',
                                                         '<?php echo ''; ?>')" data-toggle="modal" data-target="#myModal_update" class="btn btn-primary btn-sm"><i style="color:white;" class="fa fa-edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?');" href="admin_stationary_transfer.php?del_id=<?php echo $row['adstt_id']; ?>" class="btn btn-danger btn-sm"><i style="color:white;" class="fa fa-trash "></i></a>
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
      function doUpdate(id, code, type, name, qty, mou, uprice, total,
         status, tran_no, tran_to, tran_date, reason, photo) {
         $('#station_tran_id').val(id);
         $('#edit_code').val(code).change();
         $('#edit_asset_type').val(type).change();
         $('#edit_name').val(name);
         $('#edit_qty').val(qty);
         $('#edit_mou').val(mou).change();
         $('#edit_price').val(uprice);
         $('#edit_tprice').val(total);
         $('#edit_status').val(status).change();
         $('#edit_tran_no').val(tran_no);
         $('#edit_tran_to').val(tran_to);
         $('#edit_tran_date').val(tran_date);
         $('#edit_reason').val(reason);
      }

      function doIMG(id, photo) {
         $("#text_old_id").val(id);
         console.log(id);
         console.log(photo);
         if(photo == '' || photo == "NULL"){
            document.getElementById('show_photo').setAttribute('src', '../img/no_image.jpg');
         }else{
            document.getElementById('show_photo').setAttribute('src', '../img/upload/admin_stationary_transfer/' + photo);
         }
      }
      function show_image(e){
         if(e.target.files.length > 0){
            var src =URL.createObjectURL(e.target.files[0]);
            document.getElementById("v_show_photo").src =src;
         }
      }
      function show_image_update(e){
         if(e.target.files.length > 0){
            var src =URL.createObjectURL(e.target.files[0]);
            document.getElementById("show_photo").src =src;
         }
      }
      $('#txt_code').change(function() {
         $('.show_hid').css("visibility", "visible");
      })

      $(function() {
         $("select").selectpicker();
         $("#menu_stationary_manage").addClass("active");
         $("#station_transfer").addClass("active");
         $("#station_transfer").css("background-color", "##367fa9");

         $('#info_data').dataTable();
      });
   </script>
</body>

</html>