<?php
require './function.php';
$targetDir = '../img/upload/asset_transfer/';

if (request('btnadd')) {
   ///////////////// IMAGE////////////////
   if (!empty($_FILES['asset_image']['name'])) {
      $adasst_img = date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      $v_filefullname = $targetDir . date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      move_uploaded_file($_FILES['asset_image']['tmp_name'], $v_filefullname);
   }
   $data = [
      'adasst_img' => $adasst_img ?? null,
      'adasst_type' => $_POST['asset_type'],
      'adasst_date' => $_POST['start_date'],
      'adasst_code' => $_POST['asset_code'],
      'adasst_transfer_no' => $_POST['asset_transfer_no'],
      'adasst_asset_name' => $_POST['asset_name'],
      'adasst_company_transfer_to' => $_POST['asset_transfer_to'],
      'adasst_category' => $_POST['asset_category'],
      'adasst_transfer_date' => $_POST['transfer_date'],
      'adasst_qty' => $_POST['asset_qty'],
      'adasst_mou' => $_POST['asset_in_mou'],
      'adasst_unit_price' => $_POST['asset_unit_price'],
      'adasst_reason' => $_POST['asset_reason'],
      'adasst_total' => $_POST['asset_unit_amount'],
      'adasst_status' => $_POST['asset_status'],
      'adasst_created_date' => $datetime,
      'adasst_company_transfer_from' => $_POST['asset_transfer_from'],
      'adasst_branch_tf_to' => $_POST['branch_transfer_to'],
      'adasst_branch_tf_from' => $_POST['branch_transfer_from']
   ];
   $insert = insert($data, 'admin_asset_transfer', $connect);
   if ($insert) {
      ///////////// get id from last update ////////////////// 
      $last_index_query = "SELECT max(adasst_id) as max_id FROM admin_asset_transfer";
      $last_index_result = mysqli_query($connect, $last_index_query);
      $last_index_row = mysqli_fetch_assoc($last_index_result);

      if ($last_index_row) {
         $get_last_index = $last_index_row['max_id'];
         if (!empty($_POST['asset_material']) || !empty($_POST['asset_qty_insert'])) {
            for ($a = 0; $a < count($_POST['asset_material']); $a++) {
               $sql_m = "INSERT INTO admin_asset_transfer_material(
                                                                              adasstm_name
                                                                              ,adasstm_qty
                                                                              ,adasstm_mou
                                                                              ,adasstm_materail_id
                                                                              ,adasstm_remark
                                                                              ,adasstm_create_at
                                                                           )VALUES(
                                                                              '" . $_POST['asset_material'][$a] . "'
                                                                              ,'" . $_POST['asset_qty_insert'][$a] . "'
                                                                              ,'" . $_POST['asset_in_mou'][$a] . "'
                                                                              ,'$get_last_index'
                                                                              ,'" . $_POST['asset_remark'][$a] . "'
                                                                              ,'$datetime'
                                                                           )";
               mysqli_query($connect, $sql_m);
            }
         }
      }
   }
   $insert ? redirect('success', 'admin_asset_transfer') : redirect('notsuccess', 'admin_asset_transfer');
}

////////////////// update ////////////////// 

if (request('btnUpdate')) {

   $data = [
      'adasst_id'=> $_POST['edit_asset_id'],
      'adasst_type' => $_POST['edit_asset_type'],
      'adasst_date' => $_POST['edit_start_date'],
      'adasst_code' => $_POST['edit_asset_code'],
      'adasst_transfer_no' => $_POST['edit_transfer_no'],
      'adasst_asset_name' => $_POST['edit_asset_name'],
      'adasst_company_transfer_to' => $_POST['edit_transfer_to'],
      'adasst_company_transfer_from' => $_POST['edit_transfer_from'],
      'adasst_category' => $_POST['edit_asset_category'],
      'adasst_transfer_date' => $_POST['edit_transfer_date'],
      'adasst_qty' => $_POST['edit_qty'],
      'adasst_mou' => $_POST['edit_mou'],
      'adasst_unit_price' => $_POST['edit_unit_price'],
      'adasst_reason' => $_POST['edit_reason'],
      'adasst_total' => $_POST['edit_total_amount'],
      'adasst_status' => $_POST['edit_asset_status'],
      'adasst_updated_date' => $datetime,
      'adasst_branch_tf_to'=>$_POST['edit_branch_transfer_to'],
      'adasst_branch_tf_from'=>$_POST['edit_branch_transfer_from'],
   ];
   $updates = $update('admin_asset_transfer',$data,'adasst_id',$data['adasst_id'],$connect);
   $updates ? 
      redirect('update','admin_asset_transfer')
      :
      "";
}

///////////// DELETE////////////// 

if (get_req('id')) {
   $deletes = $delete('id', 'admin_asset_transfer', 'adasst_id', $connect);
   $deletes ? redirect('delete', 'admin_asset_transfer') : '';
}


//////////////// IMG UPDATE ////////////// 


if (isset($_POST['btnimage'])) {
   $id = $_POST['asset_photo'];
   if (!empty($_FILES['edit_photo']['name'])) {
      $v_filename = date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      $v_filefullname = $targetDir . date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_filefullname);
      $sql = "UPDATE admin_asset_transfer SET adasst_img = '$v_filename' where adasst_id = $id";
      $result = mysqli_query($connect, $sql);
      header('location:admin_asset_transfer.php?message=success');
      exit();
   }
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

<body class="skin-black">
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
            if (!empty($_GET['message']) && $_GET['message'] == 'validate') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>All field are require!</h4>';
               echo '</div>';
            }
            if (!empty($_GET['message']) && $_GET['message'] == 'validate_img') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>Please select the images before submited!</h4>';
               echo '</div>';
            }
            if (!empty($_GET['message']) && $_GET['message'] == 'notsuccess') {
               echo '<div class="alert alert-danger">';
               echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
               echo '<h4>Fall updated!</h4>';
               echo '</div>';
            }
            ?>
         </div>
         <section class="content-header">
            <h1>Admin Asset Transfer</h1>
         </section>
         <section class="content">
            <div class="row">
               <!-- modal_add_new   -->
               <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" style="width: 750px;" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus-square-o"></i>Add New</h4>
                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                           <div class="modal-body">
                              <div class="col-md-12">
                                 <div class="form-group col-md-4">
                                    <label style="font-size: 20px;" for="">Asset Photo</label>
                                    <figure class="figure">
                                       <img src="../img/no_image.jpg" required id="show_photo" class="rounded img-thumbnail img-fuild" height="900px;" alt="..." />
                                    </figure>
                                    <input class="form-control" type="file" name="asset_image" id="asset_image" accept="image/*" onchange="show_photo_pre(event);">

                                 </div>
                                 <div class="form-group col-md-8">
                                    <div class="form-group-col-md-12">
                                       <label style="font-size: 20px;" for="">Asset Information</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_code" class="form-label">Asset Code:</label>
                                       <select required type="text" name="asset_code" id="asset_code" class="form-control" data-live-search="true">
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
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_no" required class="form-label">Transfer No:</label>
                                       <input type="text" name="asset_transfer_no" id="asset_transfer_no" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_from" required class="form-label">Company Transfer From:</label>
                                       <select type="text" name="asset_transfer_from" id="asset_transfer_from" class="form-control">
                                          <?php
                                          $sql = "select * from company";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['c_id'] . '>' . $row['c_name_kh'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_to" class="form-label">Company Transfer To:</label>
                                       <select type="text" name="asset_transfer_to" id="asset_transfer_to" class="form-control">
                                          <?php
                                          $sql = "select * from company";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['c_id'] . '>' . $row['c_name_kh'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_from" required class="form-label">Branch Transfer From:</label>
                                       <select type="text" name="branch_transfer_from" id="branch_transfer_from" class="form-control">
                                          <?php
                                          $sql = "select * from user_branch";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ub_id'] . '>' . $row['ub_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="branch_transfer_to" class="form-label">Branch Transfer To:</label>
                                       <select type="text" name="branch_transfer_to" id="branch_transfer_to" class="form-control">
                                          <?php
                                          $sql = "select * from user_branch";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ub_id'] . '>' . $row['ub_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="start_date" class="form-label">Start Date:</label>
                                       <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_name" class="form-label">Asset Name:</label>
                                       <input type="text" name="asset_name" id="asset_name" class="form-control">
                                    </div>

                                    <div class="col-md-6 form-group">
                                       <label for="asset_category" class="form-label">Asset Category:</label>
                                       <select name="asset_category" id="asset_category" class="form-control" data-live-search="true">
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
                                    <div class="col-md-6 form-group">
                                       <label for="asset_status" class="form-label">Asset Status:</label>
                                       <select name="asset_status" id="asset_status" class="form-control" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_status";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ais_id'] . '>' . $row['ais_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_type" class="form-label">Asset Type:</label>
                                       <select name="asset_type" id="asset_type" class="form-control" data-live-search="true">
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
                                    <div class="form-group col-md-6">
                                       <label for="transfer_date" class="form-label">Asset Transfer Date</label>
                                       <input type="date" name="transfer_date" id="transfer_date" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                       <label for="asset_qty" class="form-label">QTY:</label>
                                       <input type="number" name="asset_qty" id="asset_qty" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                       <label for="asset_in_mou" class="form-label">Mou:</label>
                                       <select name="asset_in_mou" id="asset_in_mou" class="form-control" data-live-search="true">
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

                                    <div class="form-group col-md-6">
                                       <label for="">Current Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input name="asset_unit_price" id="asset_unit_price" type="number" class="form-control" step="0.01">
                                       </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input name="asset_unit_amount" id="asset_unit_amount" type="number" class="form-control" step="0.01">
                                       </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                       <label for="asset_reason" class="form-label">Reason:</label>
                                       <textarea class="form-control" name="asset_reason" id="asset_reason" rows="2"></textarea>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <table id="asset_table" class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Material Name</th>
                                             <th class="text-center">Qty</th>
                                             <th style="width: 200px;" class="text-center">Mou</th>
                                             <th class="text-center">Remark</th>
                                             <th class="text-center"><i class="fa fa-cog"></i></th>
                                          </tr>
                                       </thead>
                                    </table>
                                    <div class="box-body">
                                       <div class="button-group">
                                          <a href="javascript:void(0)" class="add-row btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add Item</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-save">&nbsp;</i>Save</button>
                              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo">&nbsp;</i>Close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_add_new -->
               <!-- modal_update -->
               <!-- Button trigger modal -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLongTitle"><i class="fa fa-edit"></i>Update Asset Transfer</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="edit_asset_id" id="edit_asset_id">
                              <div class="row">
                                 <div class="col-md-12">
                                    <h2 style="text-align: center;">Asset Information</h2>
                                    <div class="form-group col-md-6">
                                       <label for="">Asset Code:</label>
                                       <select class="form-control" name="edit_asset_code" id="edit_asset_code" data-live-search="true">
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
                                    <div class="form-group col-md-6">
                                       <label for="">Asset Type:</label>
                                       <select class="form-control" name="edit_asset_type" id="edit_asset_type" data-live-search="true">
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
                                    <div class="form-group col-md-6">
                                       <label for="">Transfer No:</label>
                                       <input type="text" name="edit_transfer_no" id="edit_transfer_no" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_from" required class="form-label">Company Transfer From:</label>
                                       <select type="text" name="edit_transfer_from" id="edit_transfer_from" class="form-control">
                                          <?php
                                          $sql = "select * from company";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['c_id'] . '>' . $row['c_name_kh'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_to" class="form-label">Company Transfer To:</label>
                                       <select type="text" name="edit_transfer_to" id="edit_transfer_to" class="form-control">
                                          <?php
                                          $sql = "select * from company";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['c_id'] . '>' . $row['c_name_kh'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="asset_transfer_from" required class="form-label">Branch Transfer From:</label>
                                       <select type="text" name="edit_branch_transfer_from" id="edit_branch_transfer_from" class="form-control">
                                          <?php
                                          $sql = "select * from user_branch";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ub_id'] . '>' . $row['ub_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="branch_transfer_to" class="form-label">Branch Transfer To:</label>
                                       <select type="text" name="edit_branch_transfer_to" id="edit_branch_transfer_to" class="form-control">
                                          <?php
                                          $sql = "select * from user_branch";
                                          $result = $connect->query($sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ub_id'] . '>' . $row['ub_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Asset Category:</label>
                                       <select class="form-control" name="edit_asset_category" id="edit_asset_category" data-live-search="true">
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
                                       <label for="">Asset Status:</label>
                                       <select class="form-control" name="edit_asset_status" id="edit_asset_status" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_status";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['ais_id'] . ' >' . $row['ais_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Asset Name:</label>
                                       <input type="text" name="edit_asset_name" id="edit_asset_name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">QTY:</label>
                                       <input type="text" name="edit_qty" id="edit_qty" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Unit Price:</label>
                                       <input type="text" name="edit_unit_price" id="edit_unit_price" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Strat Date:</label>
                                       <input type="date" name="edit_start_date" id="edit_start_date" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Transfer Date:</label>
                                       <input type="date" name="edit_transfer_date" id="edit_transfer_date" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Total Amount:</label>
                                       <input type="text" name="edit_total_amount" id="edit_total_amount" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Mou:</label>
                                       <select class="form-control" name="edit_mou" id="edit_mou" data-live-search="true">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM text_asset_in_mou";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['aim_id'] . ' >' . $row['aim_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="">Reason:</label>
                                       <textarea class="form-control" name="edit_reason" id="edit_reason" rows="2"></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="sumbit" name="btnUpdate" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Save</button>
                                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end_modal_update -->
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
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box header">
                        <button class="btn btn-sm btn-primary" data-target="#exampleModalLong" type="button" data-toggle="modal" style="margin-bottom: 2%;">
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
                                    <th class="text-center">Asset Category</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Current Price</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Transter No</th>
                                    <th class="text-center">Transfer To</th>
                                    <th class="text-center">Transfer Date</th>
                                    <th class="text-center">Asset Status</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_transfer A LEFT JOIN assest_code_creation B ON B.ac_id = A.adasst_code
                                                                           LEFT JOIN text_asset_code_creation_type C ON C.acct_id = A.adasst_type
                                                                           LEFT JOIN text_asset_in_status D ON D.ais_id = A.adasst_status
                                                                        
                                                                           ";
                                 $result = mysqli_query($connect, $sql);
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $v_i = $i++;
                                    $v_aset_code = $row['ac_asset_code'];
                                    $v_asset_type = $row['acct_name'];
                                    $v_asset_name = $row['adasst_asset_name'];
                                    $v_asset_date = $row['adasst_date'];
                                    $v_qty = $row['adasst_qty'];
                                    $v_unit_price = $row['adasst_unit_price'];
                                    $v_total_amount = $row['adasst_total'];
                                    $v_transfer_no = $row['adasst_transfer_no'];
                                    $v_transfer_to = $row['adasst_company_transfer_to'];
                                    $v_transfer_date = $row['adasst_transfer_date'];
                                    $v_asset_status = $row['ais_name'];
                                    $v_asset_img = $row['adasst_img'];
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_aset_code; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_type; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          $v_asset_category_id = @$row['adasst_category'];
                                          $sql_category = "SELECT * FROM assest_code_creation where ac_id = '$v_asset_category_id'";
                                          $result_query = $connect->query($sql_category);
                                          $result_row = $result_query->fetch_assoc();
                                          $result_show = @$result_row['as_asset_category'];
                                          echo $result_show;
                                          ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_qty; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_unit_price) . '$'; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_total_amount) . '$' ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_transfer_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?php
                                                                                                if ($v_transfer_to != 0) {
                                                                                                   $sql = "select * from company where c_id = $v_transfer_to";
                                                                                                   $stmt = $connect->query($sql);
                                                                                                   $stms_row = $stmt->fetch_assoc();
                                                                                                   echo $stms_row['c_name_kh'];
                                                                                                }
                                                                                                ?>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_transfer_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_asset_status; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a target="_blank" href="../../hr_system_v1/img/upload/asset_transfer/<?php echo $row['adasst_img'] ?>">
                                             <img class="rounded img-fuild" src="../img<?php if ($v_asset_img != '') {
                                                                                          echo '/upload/asset_transfer/' . $v_asset_img;
                                                                                       } else {
                                                                                          echo '/no_image.jpg';
                                                                                       } ?>" ismap style="width:60px; height:60px;" />
                                          </a>
                                          <a style="float:right; cursor:pointer;" onclick="doImage('<?php echo $row['adasst_id']; ?>',
                                                      '<?php echo $v_asset_img; ?>')" data-toggle="modal" data-target="#modal_image">
                                             <i style="color:#3c8dbc;" class="fa fa-pencil"></i>
                                          </a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;width:150px;">
                                          <a onclick="doUpdate(
                                             '<?php echo $row['adasst_id'] ?>',
                                             '<?php echo $row['adasst_code'] ?>',
                                             '<?php echo $row['adasst_type'] ?>',
                                             '<?php echo $row['adasst_transfer_no'] ?>',
                                             '<?php echo $row['adasst_company_transfer_to'] ?>',
                                             '<?php echo $row['adasst_category'] ?>',
                                             '<?php echo $row['adasst_status'] ?>',
                                             '<?php echo $row['adasst_qty'] ?>',
                                             '<?php echo $row['adasst_unit_price'] ?>',
                                             '<?php echo $row['adasst_total'] ?>',
                                             '<?php echo $row['adasst_date'] ?>',
                                             '<?php echo $row['adasst_transfer_date'] ?>',
                                             '<?php echo $row['adasst_asset_name'] ?>',
                                             '<?php echo $row['adasst_reason'] ?>',
                                             '<?php echo $row['adasst_mou'] ?>',
                                             '<?php echo $row['adasst_company_transfer_from'] ?>',
                                             '<?php echo $row['adasst_branch_tf_from'] ?>',
                                             '<?php echo $row['adasst_branch_tf_to'] ?>',
                                             );" style="color: #fff;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_update" href="#"><i class="fa fa-edit"></i></a>
                                          <a style="color: #fff;" class="btn btn-sm btn-info" href="admin_asset_transfer_view.php?id=<?= $row['adasst_id'] ?>"><i class="fa fa-eye"></i></a>
                                          <a style="color: white;" class="btn-sm btn-danger btn" onclick="return confirm('Are you sure to delete?');" href="admin_asset_transfer.php?id=<?= $row['adasst_id'] ?>"><i class="fa fa-trash"></i></a>
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
               var material = "<td><input class='form-control'required name='asset_material[]' id='asset_material' type='text'></td>";
               var qty = "<td><input class='form-control'required name='asset_qty_insert[]' id='asset_qty_insert' type='number'></td>";
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
               var Remark = "<td><input class='form-control'required name='asset_remark[]' id='asset_remark' type='text'></td>";
               var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
               //    var action = "<th class='text-center'><i class='fa fa-cog' ></i></th>";
               var markup = "<tr>" + "<td><input disable type='text' class='form-control' value='" + no + "' name='auto_count_id[]' id='auto_count_id'/></td>" + material + qty + mou + Remark + remove_button + "</tr>";
               $("#asset_table").append(markup); //    $("thead tr")[i].append(action);
               no++;
               $("#asset_table").on('click', '.remove-row', function() {
                  $(this).closest("tr").remove();
                  if (("#asset_table")) {
                     no = 1;
                  }
               });
            });
         });
      });

      function doUpdate(id, asset_code, asset_type, transfer_no, transfer_to, category, status, qty, unit_price, total_amount, start_date, transfer_date, asset_name, reason, mou, t_from,branch_tf_from,branch_tf_to) {
         $("#edit_asset_id").val(id);
         $("#edit_asset_code").val(asset_code).change();
         $("#edit_asset_type").val(asset_type).change();
         $("#edit_transfer_no").val(transfer_no);
         $("#edit_transfer_to").val(transfer_to).change();
         $("#edit_asset_category").val(category).change();
         $("#edit_asset_status").val(status).change();
         $("#edit_qty").val(qty);
         $("#edit_unit_price").val(unit_price);
         $("#edit_total_amount").val(total_amount);
         $("#edit_start_date").val(start_date);
         $("#edit_transfer_date").val(transfer_date);
         $("#edit_asset_name").val(asset_name);
         $("#edit_reason").val(reason);
         $("#edit_mou").val(mou).change();
         $("#edit_transfer_from").val(t_from).change();
         $("#edit_branch_transfer_from").val(branch_tf_from).change();
         $("#edit_branch_transfer_to").val(branch_tf_to).change();
      }

      function doImage(id, photo) {
         $('#asset_photo').val(id);
         $("#txt_old_img").val(photo);
         if (photo == '' || photo == "NULL") {
            document.getElementById('v_show_photo').setAttribute('src', '../img/no_image.jpg');
         } else {
            document.getElementById('v_show_photo').setAttribute('src', '../img/upload/asset_transfer/' + photo);
         }
      }

      function show_photo_pre(event) {
         if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('show_photo').src = src;
         }
      }
      $(function() {
         $("select").selectpicker();
         $("#menu_admin_manage").addClass("active");
         $("#asset_transfer").addClass("active");
         $("#asset_transfer").css("background-color", "##367fa9");
         $('#info_data').dataTable();
      });
   </script>
</body>

</html>