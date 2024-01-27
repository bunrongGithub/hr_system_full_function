<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$file_dir = '../img/upload/asset_broken/';
$v_image = '';
if (isset($_POST['btnadd'])) {
   $v_image = $_FILES['asset_image']['name'];
   $v_code = $_POST['asset_code'];
   $v_broken_no = $_POST['broken_no'];
   $v_asset_type = $_POST['asset_type'];
   $v_broken_date = $_POST['broken_date'];
   $v_asset_name = $_POST['asset_name'];
   $v_broken_by = $_POST['broken_by'];
   $v_asset_category = $_POST['asset_category'];
   $v_start_date = $_POST['start_date'];
   $v_asset_mou = $_POST['asset_mou'];
   $v_unit_price = $_POST['unit_price'];
   $v_total_amount = $_POST['total_amount'];
   $v_asset_status = $_POST['asset_status'];
   $v_asset_reason = $_POST['asset_reason'];
   $v_qty = $_POST['qty'];
   $v_img_name = '';
   if (!empty($v_image)) {
      $v_img_name = date("Ymd") . '_' . basename($_FILES['asset_image']['name']);
      $v_img_fullname = $file_dir . date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      move_uploaded_file($_FILES['asset_image']['tmp_name'], $v_img_fullname);
   }
   $sql = "INSERT INTO admin_asset_broken(adassb_img
                                          ,adassb_code
                                          ,adassb_broken_no
                                          ,adassb_type
                                          ,adassb_broken_date
                                          ,adassb_asset_name
                                          ,adassb_broken_by
                                          ,adassb_category
                                          ,adassb_date
                                          ,adassb_mou
                                          ,adassb_unit_price
                                          ,adassb_total
                                          ,adassb_status
                                          ,adassb_reason
                                          ,adassb_created_date
                                          ,adassb_qty
                                          ) VALUES (
                                             '$v_img_name'
                                             ,'$v_code'
                                             ,'$v_broken_no'
                                             ,'$v_asset_type'
                                             ,'$v_broken_date'
                                             ,'$v_asset_name'
                                             ,'$v_broken_by'
                                             ,'$v_asset_category'
                                             ,'$v_start_date'
                                             ,'$v_asset_mou'
                                             ,'$v_unit_price'
                                             ,'$v_total_amount'
                                             ,'$v_asset_status'
                                             ,'$v_asset_reason'
                                             ,NOW()
                                             ,'$v_qty'
                                             )";
   mysqli_query($connect, $sql);
   $last_index_query = "SELECT max(adassb_id) FROM admin_asset_broken";
   $last_index_result = mysqli_query($connect, $last_index_query);
   $last_index_row = mysqli_fetch_assoc($last_index_result);
   if ($last_index_row) {
      $get_last_index = $last_index_row['max(adassb_id)'];
      if (!empty($_POST['asset_material']) || !empty($_POST['asset_in_mou'])) {
         for ($a = 0; $a < count($_POST['asset_material']); $a++) {
            $sql_m = "INSERT INTO admin_asset_broken_material(
                                                         adsbm_material_name
                                                         ,adsbm_qty
                                                         ,adsbm_mou
                                                         ,adssbm_material_id
                                                         ,adssbm_remark
                                                      )VALUES(
                                                         '" . $_POST['asset_material'][$a] . "'
                                                         ,'" . $_POST['asset_qty_insert'][$a] . "'
                                                         ,'" . $_POST['asset_in_mou'][$a] . "'
                                                         ,'$get_last_index'
                                                         ,'".$_POST['asset_remark'][$a]."'
                                                      )";
            mysqli_query($connect, $sql_m);
         }
      }
      header('location:admin_asset_broken.php?message=success');
      exit();
   }
}
if (isset($_POST['btnimage'])) {
   $id = $_POST['asset_photo'];
   $old_img = @$_POST['txt_old_img'];
   $v_image = $_FILES['edit_photo']['name'];
   if (!empty($v_image)) {
      $v_img_name = date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      $v_img_fullname = $file_dir . date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_img_fullname);
      $sql = "UPDATE admin_asset_broken SET adassb_img = '$v_img_name' WHERE adassb_id = '$id'";
      $result = mysqli_query($connect, $sql);
      header('location:admin_asset_broken.php?message=success');
      exit();
   }
}

if (isset($_POST['btn_update'])) {
   $v_id = $_POST['edit_id'];
   $v_asset_code = $_POST['edit_asset_code'];
   $v_asset_type = $_POST['edit_asset_type'];
   $v_asset_name = $_POST['edit_asset_name'];
   $v_asset_category = $_POST['edit_asset_category'];
   $v_asset_QTY = $_POST['edit_asset_QTY'];
   $v_asset_mou = $_POST['edit_asset_mou'];
   $v_total_amount = $_POST['edit_total_amount'];
   $v_broken_no = $_POST['edit_broken_no'];
   $v_broken_date = $_POST['edit_broken_date'];
   $v_broken_by_whom = $_POST['edit_broken_by_whom'];
   $v_start_date = $_POST['edit_start_date'];
   $v_current_unit_price = $_POST['edit_current_unit_price'];
   $v_asset_status = $_POST['edit_asset_status'];
   $v_reason = $_POST['edit_reason'];

   $sql = "UPDATE admin_asset_broken SET adassb_code = '$v_asset_code',
                                       adassb_type = '$v_asset_type',
                                       adassb_asset_name = '$v_asset_name',
                                       adassb_category = '$v_asset_category',
                                       adassb_qty = '$v_asset_QTY',
                                       adassb_mou = '$v_asset_mou',
                                       adassb_total = '$v_total_amount',
                                       adassb_broken_no = '$v_broken_no',
                                       adassb_date = '$v_start_date',
                                       adassb_broken_by = '$v_broken_by_whom',
                                       adassb_broken_date = '$v_broken_date',
                                       adassb_unit_price = '$v_current_unit_price',
                                       adassb_status = '$v_asset_status',
                                       adassb_reason = '$v_reason' WHERE adassb_id = '$v_id'
                                       ";
   $result = mysqli_query($connect, $sql);
   header('location:admin_asset_broken.php?message=update');
   exit();
}

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "DELETE FROM admin_asset_broken WHERE adassb_id = $id";
   $result = mysqli_query($connect, $sql);
   header('location:admin_asset_broken.php?message=delete');
   exit();
}

?>
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

<body class='skin-black'>
   <?php include('header.php') ?>
   <div class="wrapper row-offcanvas row-offcanvas-left">
      <?php include "left_menu.php" ?>
      <aside class="right-side">
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
            <h1>Admin Asset Broken</h1>
         </section>
         <section class="content">
            <div class="row">
               <!-- modal_add_new -->
               <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" style="width: 750px;" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus-square-o"></i>Add New</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <div class="form-group col-md-4">
                                 <label style="font-size: 20px;" for="">Asset Photo</label>
                                 <figure class="figure">
                                    <img src="../img/no_image.jpg" id="show_photo" class="rounded img-thumbnail img-fuild" height="900px;" alt="..." />
                                 </figure>
                                 <input class="form-control" type="file" name="asset_image" id="asset_image" accept="image/*" onchange="show_photo_pre_add(event);">
                              </div>
                              <div class="form-group col-md-8">
                                 <div class="col-md-12">
                                    <label style="font-size: 20px; text-align: center; " for="">Asset Information</label>
                                 </div>
                                 <div class="col-md-6 form-group">
                                    <label for="asset_code" class="form-label">Asset Code:</label>
                                    <select type="text" name="asset_code" id="asset_code" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM assest_code_creation";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value=' . $row['ac_id'] . '>' . $row['ac_asset_code'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="broken_no">Broken No:</label>
                                    <input type="text" name="broken_no" id="broken_no" class="form-control">
                                 </div>
                                 <div class="col-md-6 form-group">
                                    <label for="asset_type" class="form-label">Asset Type:</label>
                                    <select type="text" name="asset_type" id="asset_type" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_code_creation_type";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value=' . $row['acct_id'] . '>' . $row['acct_name'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="broken_date">Broken Date:</label>
                                    <input type="date" name="broken_date" id="broken_date" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="asset_name">Asset Name:</label>
                                    <input type="text" name="asset_name" id="asset_name" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="broken_by">Broken By Whom:</label>
                                    <input type="text" name="broken_by" id="broken_by" class="form-control">
                                 </div>
                                 <div class="col-md-6 form-group">
                                    <label for="asset_category" class="form-label">Asset Category:</label>
                                    <select type="text" name="asset_category" id="asset_category" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM assest_code_creation";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value=' . $row['ac_id'] . '>' . $row['as_asset_category'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-3">
                                    <label for="qty">QTY:</label>
                                    <input type="text" name="qty" id="qty" class="form-control">
                                 </div>
                                 <div class="col-md-3 form-group">
                                    <label for="asset_mou" class="form-label">Mou:</label>
                                    <select type="text" name="asset_mou" id="asset_mou" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_in_mou";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value=' . $row['aim_id'] . '>' . $row['aim_name'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="unit_price">Current Unit Price:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" name="unit_price" id="unit_price" class="form-control">
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="total_amount">Total Amount:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="text" name="total_amount" id="total_amount" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-6 form-group">
                                    <label for="asset_status" class="form-label">Status:</label>
                                    <select type="text" name="asset_status" id="asset_status" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_broken_status";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<option value=' . $row['tasb_id'] . '>' . $row['tasb_name'] . '</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-md-12">
                                    <label for="asset_reason">Reason:</label>
                                    <textarea class="form-control" name="asset_reason" id="asset_reason" rows="2"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12 row">
                                 <table id="asset_table" class="table table-striped">
                                    <tr>
                                       <th class="text-center">No</th>
                                       <!-- <th class="text-center">Material No</th> -->
                                       <th class="text-center">Material Name</th>
                                       <th class="text-center">QTY</th>
                                       <th style="width: 150px;" class="text-center">Mou</th>
                                       <th class="text-center">Remark</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </table>
                              </div>
                              <div class="box-body">
                                 <div class="button-group">
                                    <a href="javascript:void(0)" class="add-row btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add Item</a>
                                 </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btnadd" class="btn btn-sm btn-primary"><i class="fa fa-save">&nbsp;</i>Save</button>
                           <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_add_new -->
               <!-- modal_update_image -->
               <div class="modal fade" id="modal_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLongTitle">Update Image</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" id="asset_photo" name="asset_photo" />
                              <input type="hidden" name="txt_old_img" id="txt_old_img">
                              <div class="row">
                                 <div class="col xs-12">
                                    <div class="form-group col-lg-12">
                                       <img id="v_show_photo" class="rounded img-thumbnail img-fuild" accept="image/*" alt="...">
                                       <br />
                                       <label>Upload Photo Here:</label>
                                       <input type="file" id="edit_photo" name="edit_photo" values="upload" class="form-control" accept="image/*" onchange="show_photo_pre(event);"></input>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="btnimage" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Update</button>
                                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end modal update image  -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Update Asset Broken</h4>
                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                           <div class="modal-body">
                              <input type="hidden" name="edit_id" id="edit_id">
                              <div class="row col-md-12">
                                 <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                       <label for="edit_asset_code">Asset Code:</label>
                                       <select name="edit_asset_code" id="edit_asset_code" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ac_id'] . ' >' . $row['ac_asset_code'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_asset_code">Asset Type:</label>
                                       <select name="edit_asset_type" id="edit_asset_type" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_code_creation_type";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['acct_id'] . ' >' . $row['acct_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_asset_name">Asset Name:</label>
                                       <input class="form-control" type="text" name="edit_asset_name" id="edit_asset_name">
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_asset_category">Asset Category:</label>
                                       <select name="edit_asset_category" id="edit_asset_category" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ac_id'] . ' >' . $row['as_asset_category'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="edit_asset_QTY">QTY:</label>
                                       <input class="form-control" type="text" name="edit_asset_QTY" id="edit_asset_QTY">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="edit_asset_mou">Mou:</label>
                                       <select class="form-control" type="text" name="edit_asset_mou" id="edit_asset_mou" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_mou";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['aim_id'] . '>' . $row['aim_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_total_amount">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input class="form-control" type="number" name="edit_total_amount" id="edit_total_amount">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                       <label for="edit_broken_no">Broken No:</label>
                                       <input class="form-control" type="text" name="edit_broken_no" id="edit_broken_no">
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_broken_date">Broken Date:</label>
                                       <input class="form-control" type="date" name="edit_broken_date" id="edit_broken_date">
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_broken_by_whom">Broken By Whom:</label>
                                       <input class="form-control" type="text" name="edit_broken_by_whom" id="edit_broken_by_whom">
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_start_date">Start Date:</label>
                                       <input class="form-control" type="date" name="edit_start_date" id="edit_start_date">
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_current_unit_price">Current Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input class="form-control" type="number" name="edit_current_unit_price" id="edit_current_unit_price">
                                       </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                       <label for="edit_asset_status">Status:</label>
                                       <select class="form-control" type="text" name="edit_asset_status" id="edit_asset_status" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_broken_status";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['tasb_id'] . '>' . $row['tasb_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="">Reason:</label>
                                    <textarea name="edit_reason" id="edit_reason" rows="2" class="form-control"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="btn_update" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                                 <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box header">
                        <button class="btn btn-sm btn-primary" type="button" style="margin-bottom: 2%;" data-toggle="modal" data-target="#exampleModalLong">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                        </button>
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-hover table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Asset Code</th>
                                    <th class="text-center">Asset Type</th>
                                    <th class="text-center">Asset Name</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Current Price</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Broken No</th>
                                    <th class="text-center">Broken Date</th>
                                    <th class="text-center">Broken By</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Photo</th>
                                    <th style="width: 130px;" class="text-center"><i class="fa fa-cog"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_broken A LEFT JOIN assest_code_creation B ON B.ac_id = A.adassb_code
                                 LEFT JOIN text_asset_code_creation_type C ON C.acct_id = A.adassb_type
                                 LEFT JOIN text_asset_broken_status D on D.tasb_id = A.adassb_status
                                 LEFT JOIN admin_asset_broken_material E ON E.adsbm_id = A.adssb_material_id";
                                 $result = mysqli_query($connect, $sql);
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $v_i = $i++;
                                    $v_asset_code = $row['ac_asset_code'];
                                    $v_asset_type = $row['acct_name'];
                                    $v_asset_name = $row['adassb_asset_name'];
                                    $v_asset_start_date = $row['adassb_date'];
                                    $v_asset_qty = $row['adassb_qty'];
                                    $v_current_price = $row['adassb_unit_price'];
                                    $v_total_amount = $row['adassb_total'];
                                    $v_broken_no = $row['adassb_broken_no'];
                                    $v_broken_date = $row['adassb_broken_date'];
                                    $v_broken_by = $row['adassb_broken_by'];
                                    $v_asset_status = $row['tasb_name'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_i ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_code; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_type; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_start_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_qty; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_current_price) . '$'; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_total_amount) . '$' ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_broken_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_broken_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_broken_by ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_status; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a href="http://" target="_blank" rel="noopener noreferrer">
                                             <img src="../img<?php if ($row['adassb_img'] != '') {
                                                                  echo '/upload/asset_broken/' . $row['adassb_img'];
                                                               } else {
                                                                  echo '/no_image.jpg';
                                                               } ?>" ismap style="width:80px; height:80px;" alt="">
                                          </a>
                                          <a style="float:right; cursor:pointer;" onclick="doImage('<?php echo $row['adassb_id']; ?>'
                                                                  ,'<?php echo $row['adassb_img']; ?>'
                                                            );" data-toggle="modal" data-target="#modal_image" href="#"><i style="color:#3c8dbc;" class="fa fa-pencil"></i>
                                          </a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle; width:150px">
                                          <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#modal_update" onclick="doUpdate(
                                                '<?php echo $row['adassb_id']; ?>',
                                                '<?php echo $row['adassb_code']; ?>',
                                                '<?php echo $row['adassb_broken_no']; ?>',
                                                '<?php echo $row['adassb_type']; ?>',
                                                '<?php echo $row['adassb_broken_date']; ?>',
                                                '<?php echo $row['adassb_asset_name']; ?>',
                                                '<?php echo $row['adassb_broken_by']; ?>',
                                                '<?php echo $row['adassb_category']; ?>',
                                                '<?php echo $row['adassb_date']; ?>',
                                                '<?php echo $row['adassb_qty']; ?>',
                                                '<?php echo $row['adassb_mou']; ?>',
                                                '<?php echo $row['adassb_unit_price']; ?>',
                                                '<?php echo $row['adassb_total']; ?>',
                                                '<?php echo $row['adassb_status']; ?>',
                                                '<?php echo $row['adassb_reason']; ?>',
                                             );">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <a class="btn btn-sm btn-info" href="admin_asset_broken_view.php?view_id=<?= $row['adassb_id']; ?>"><i class="fa fa-eye"></i></a>
                                          <a style="color: white;" class="btn-sm btn-danger btn" onclick="return confirm('Are you sure to delete?');" href="admin_asset_broken.php?id=<?= $row['adassb_id'] ?>"><i class="fa fa-trash"></i></a>
                                       </td>

                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </aside>
   </div>
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
   <script type='text/javascript'>
      window.addEventListener('DOMContentLoaded', function() {
         $(document).ready(function() {
            var no = 1;
            $(".add-row").on('click', function() {
               // var material_no = "<td><input class='form-control' type='text' name='asset_material_no[]' id='asset_material_no'/></td>";
               var material = "<td><input class='form-control' name='asset_material[]' id='asset_material' type='text'></td>";
               var qty = "<td><input class='form-control' name='asset_qty_insert[]' id='asset_qty_insert' type='number'></td>";
               var mou = `<td>
                                 <select class='form-control' name='asset_in_mou[]' id='asset_in_mou'data-live-search="true">
                                    <option selected></option>
                                    <?php
                                    $sql = "SELECT * FROM text_asset_in_mou";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                       echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                    }
                                    ?>
                                 </select>
                              </td>`;
               var Remark = "<td><input class='form-control' name='asset_remark[]' id='asset_remark' type='text'></td>";
               var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
               //    var action = "<th class='text-center'><i class='fa fa-cog' ></i></th>";
               var markup = "<tr>" + "<td><input disable type='text' class='form-control' value='" + no + "' name='auto_count_id[]' id='auto_count_id'/></td>" + material + qty + mou + Remark + remove_button + "</tr>";
               $("#asset_table").append(markup); //    $("thead tr")[i].append(action);
               no++;
               $("#asset_table").on('click', '.remove-row', function() {
                  $(this).closest("tr").remove();
                  if ($('#asset_table')) {
                     no = 1;
                  }
               });
            });
         });
      });

      function doImage(id, photo) {
         $('#asset_photo').val(id);
         var empty_dir = '../img/no_image.jpg';
         if (photo == '' || photo == "NULL") {
            document.getElementById('v_show_photo').setAttribute('src', empty_dir);
         } else {
            document.getElementById('v_show_photo').setAttribute('src', '../img/upload/asset_broken/' + photo);
         }
         $("#txt_old_img").val(photo);
      }

      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("v_show_photo").src = src;
         }
      }

      function show_photo_pre_add(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById("show_photo").src = src;
         }
      }

      function doUpdate(id, e_asset_code, e_broken_no, e_asset_type, e_broken_date, e_asset_name, broken_by_whom, e_asset_categroy, e_start_date, QTY, MOU, e_unit_price, e_total, e_status, e_resaon) {
         $("#edit_id").val(id);
         $("#edit_asset_code").val(e_asset_code).change();
         $("#edit_broken_no").val(e_broken_no);
         $("#edit_asset_type").val(e_asset_type).change();
         $("#edit_broken_date").val(e_broken_date);
         $("#edit_asset_name").val(e_asset_name);
         $("#edit_broken_by_whom").val(broken_by_whom);
         $("#edit_asset_category").val(e_asset_categroy).change();
         $("#edit_start_date").val(e_start_date);
         $("#edit_asset_QTY").val(QTY);
         $("#edit_asset_mou").val(MOU).change();
         $("#edit_current_unit_price").val(e_unit_price);
         $("#edit_total_amount").val(e_total);
         $("#edit_asset_status").val(e_status).change();
         $("#edit_reason").val(e_resaon);
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_broke").addClass("active");
         $("#asset_broken").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>