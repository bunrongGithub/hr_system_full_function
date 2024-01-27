<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
/** Add New Record */
if (isset($_POST['add_new'])) {
   /** POST DATA */
   $_as_code      = $_POST['txt_code'];
   $_dep_no       = $_POST['txt_depre_no'];
   $_as_category  = $_POST['txt_category'];
   $_dep_age      = $_POST['txt_category'];
   $_as_name      = $_POST['txt_as_name'];
   $_dep_st_date  = $_POST['txt_depre_start_date'];
   $_qty          = $_POST['txt_QTY'];
   $_mou          = $_POST['txt_mou'];
   $_dep_a_p_mon  = $_POST['txt_de_amount_per_month'];
   $_total_amount = $_POST['txt_total_amount'];
   $_dep_a_p_day  = $_POST['txt_de_amount_per_day'];
   $_unit_price   = $_POST['txt_unit_price'];
   $_dep_total_amount = $_POST['txt_depre_total_amount'];
   $_note         = $_POST['txt_note'];

   /** let insert data to our database */
   $sql = "INSERT INTO `admin_asset_depreciation`
                  (
                     adassd_code
                     , adassd_depre_no
                     , adassd_category
                     , adassd_depre_age
                     , adassd_asset_name
                     , adassd_depre_date
                     , adassd_qty
                     , adassd_mou
                     , adassd_depre_amount_per_month 
                     , adassd_amount
                     , adassd_depre_payday
                     , adassd_price
                     , adassd_created_date
                     , adassd_userid
                     , adassd_depre_total_amount
                     , adassd_note
                  )   
                  VALUES
                  (
                     '$_as_code'
                     ,'$_dep_no'
                     ,'$_as_category'
                     ,'$_dep_age'
                     ,'$_as_name'
                     ,'$_dep_st_date'
                     ,'$_qty'
                     ,'$_mou'
                     ,'$_dep_a_p_mon'
                     ,'$_total_amount'
                     ,'$_dep_a_p_day'
                     ,'$_unit_price'
                     ,now()
                     ,'$user_id'
                     ,'$_dep_total_amount'
                     ,'$_note'
                  )";
   /** query to database */
   mysqli_query($connect, $sql);
   /**    Material form */
   $last_index_query = "SELECT max(adassd_id) FROM admin_asset_depreciation";
   $last_index_result = mysqli_query($connect, $last_index_query);
   $last_index_row = mysqli_fetch_assoc($last_index_result);
   if ($last_index_row) {
      $get_last_index = $last_index_row['max(adassd_id)'];
      if (!empty($_POST['asset_material']) || !empty($_POST['asset_remark']) || !empty($_POST['asset_qty_insert'])) {
         for ($a = 0; $a < count($_POST['asset_material']); $a++) {
            $sql_m = "INSERT INTO `admin_asset_depreciation_material`(
                                                         adassd_m_name
                                                         ,adassd_m_qty
                                                         ,asdassd_m_mou
                                                         ,adassd_m_material_id
                                                         ,adassd_m_note
                                                         ,adassd_m_created_at
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
      header("location:admin_asset_depreciation.php?message=success");
      exit();
   }
}

/** let update record */
if (isset($_POST['update_data'])) {
   $_edit_id = $_POST['edit_id'];
   $_as_code = $_POST['edit_code'];
   $_dep_no  = $_POST['edit_depre_no'];
   $_category = $_POST['edit_category'];
   $_dep_age = $_POST['edit_depre_age'];
   $_as_type = $_POST['edit_as_type'];
   $_as_name = $_POST['edit_as_name'];
   $_dep_date = $_POST['edit_depre_start_date'];
   $_qty     = $_POST['edit_QTY'];
   $_mou     = $_POST['edit_mou'];
   $_dep_pay_day = $_POST['edit_de_amount_per_day'];
   $_u_price = $_POST['edit_unit_price'];
   $_dep_pay_month = $_POST['edit_de_amount_per_month'];
   $_total_amount  = $_POST['edit_total_amount'];
   $_note    = $_POST['edit_note'];
   $_date    = $_POST['edit_date'];
   $_dep_total_amount = $_POST['edit_depre_total_amount'];
   $sql = "UPDATE `admin_asset_depreciation` SET 
                  adassd_code = '$_as_code',
                  adassd_category = '$_category',
                  adassd_type = '$_as_type',
                  adassd_asset_name = '$_as_name',
                  adassd_date = '$_date',
                  adassd_qty = '$_qty',
                  adassd_price = '$_u_price',
                  adassd_mou = '$_mou',
                  adassd_amount = '$_total_amount',
                  adassd_depre_no = '$_dep_no',
                  adassd_depre_age = '$_dep_age',
                  adassd_depre_date = '$_dep_date',
                  adassd_depre_amount_per_month = '$_dep_pay_month',
                  adassd_depre_total_amount = '$_dep_total_amount',
                  adassd_depre_payday = '$_dep_pay_day',
                  adassd_updated_date = now()   where adassd_id = '$_edit_id'
   ";
   mysqli_query($connect, $sql);
   header("location:admin_asset_depreciation.php?message=update");
   exit();
}
/** Delete record */
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sql = "DELETE FROM `admin_asset_depreciation` WHERE adassd_id = '$id'";
   mysqli_query($connect, $sql);
   header("location:admin_asset_depreciation.php?message=delete");
   exit();
}


/** Update IMAGE */
$Directory = "../img/upload/asset_depreciation/";
if (isset($_POST['btnimage'])) {
   $_img_id = $_POST['asset_photo'];
   $_image = $_FILES['edit_photo']['name'];
   if (!empty($_image)) {
      $v_img_name = date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      $v_img_full_name = $Directory . $v_img_name;
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_img_full_name);
      $sql = "UPDATE `admin_asset_depreciation` SET adassd_img = '$v_img_name' WHERE adassd_id = '$_img_id'";
      $result = mysqli_query($connect, $sql);
      if ($result) {
         header("location:admin_asset_depreciation.php?message=update");
         exit();
      }
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
            ?>
         </div>
         <section class="content-header">
            <h1>Admin Asset Depreciation</h1>
         </section>
         <section class="content">
            <div class="row">
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel">New Depreciation</h4>
                        </div>
                        <form action="admin_asset_depreciation.php" enctype="multipart/form-data" method="post">
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Code:</label>
                                       <select name="txt_code" data-live-search="true" required class="form-control" id="txt_code">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value =" . $row['ac_id'] . ">" . $row['ac_asset_code'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation No:</label>
                                       <input type="text" name="txt_depre_no" required id="txt_depre_no" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Category:</label>
                                       <select name="txt_category" data-live-search="true" required class="form-control" id="txt_category">
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
                                       <label for="">Deprecation Age:</label>
                                       <input type="text" name="txt_depre_age" placeholder="month.." required id="txt_depre_age" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Name:</label>
                                       <input type="text" name="txt_as_name" required id="txt_as_name" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Start Date:</label>
                                       <input type="date" name="txt_depre_start_date" required id="txt_depre_start_date" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-3">
                                       <label for="">QTY:</label>
                                       <input type="text" name="txt_QTY" required id="txt_QTY" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-3">
                                       <label for="">Mou:</label>
                                       <select class=" form-control" data-live-search="true" required name="txt_mou" id="txt_mou">
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
                                       <label for="">Deprecation Pay Day:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="txt_de_amount_per_day" required id="txt_de_amount_per_day" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="txt_unit_price" id="txt_unit_price" class="form-control">
                                       </div>
                                    </div>

                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Amount Per Month:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="txt_de_amount_per_month" required id="txt_de_amount_per_month" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="txt_total_amount" required id="txt_total_amount" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="txt_depre_total_amount" required id="txt_depre_total_amount" class="form-control">
                                       </div>
                                    </div>

                                    <div class="form-group col-xs-6">
                                       <label for="">Note</label>
                                       <textarea name="txt_note" required id="txt_note" rows="1" class="form-control"></textarea>
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
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="add_new" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- start_edit_modal  -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary " id="exampleModalLabel">Update Deprecation</h4>

                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                           <input type="hidden" name="edit_id" id="edit_id">
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Code:</label>
                                       <select name="edit_code" data-live-search="true" required class="form-control" id="edit_code">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM assest_code_creation";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo "<option value =" . $row['ac_id'] . ">" . $row['ac_asset_code'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Start Date:</label>
                                       <input type="date" name="edit_date" required id="edit_date" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation No:</label>
                                       <input type="text" name="edit_depre_no" required id="edit_depre_no" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Category:</label>
                                       <select name="edit_category" data-live-search="true" required class="form-control" id="edit_category">
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
                                       <label for="">Deprecation Age:</label>
                                       <input type="text" name="edit_depre_age" placeholder="month.." required id="edit_depre_age" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Type:</label>
                                       <select name="edit_as_type" data-live-search="true" required class="form-control" id="edit_as_type">
                                          <option selected value=""></option>
                                          <?php
                                          $sql = "SELECT * FROM `text_asset_code_creation_type`";
                                          $result = mysqli_query($connect, $sql);
                                          while ($row = mysqli_fetch_assoc($result)) {
                                             echo '<option value=' . $row['acct_id'] . '>' . $row['acct_name'] . '</option>';
                                          }
                                          ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Asset Name:</label>
                                       <input type="text" name="edit_as_name" required id="edit_as_name" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Start Date:</label>
                                       <input type="date" name="edit_depre_start_date" required id="edit_depre_start_date" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-3">
                                       <label for="">QTY:</label>
                                       <input type="text" name="edit_QTY" required id="edit_QTY" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-3">
                                       <label for="">Mou:</label>
                                       <select class=" form-control" data-live-search="true" required name="edit_mou" id="edit_mou">
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
                                       <label for="">Deprecation Pay Day:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_de_amount_per_day" required id="edit_de_amount_per_day" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Unit Price:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_unit_price" id="edit_unit_price" class="form-control">
                                       </div>
                                    </div>

                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Amount Per Month:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_de_amount_per_month" required id="edit_de_amount_per_month" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_total_amount" required id="edit_total_amount" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-6">
                                       <label for="">Deprecation Total Amount:</label>
                                       <div class="input-group">
                                          <div class="input-group-addon">$</div>
                                          <input type="text" name="edit_depre_total_amount" required id="edit_depre_total_amount" class="form-control">
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                       <label for="">Note</label>
                                       <textarea name="edit_note" required id="edit_note" rows="1" class="form-control"></textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="submit" name="update_data" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_edit_modal  -->
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
                                       <img id="show_photo" class="rounded img-thumbnail img-fuild" style="width: 500px; height: 500px; " accept="image/*" alt="...">
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
               <!-- end image  -->
               <div class="col-xs-12 connectedSortable">
                  <div class="box">
                     <div class="box header">
                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 2%;">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New
                        </button>
                        <div class="box-body table-responsive">
                           <table id="info_data" class="table table-hover table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Asset_Code</th>
                                    <th>Asset_Type</th>
                                    <th>Asset_Name</th>
                                    <th>Start Date</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>Total_Amount</th>
                                    <th>Depre.No</th>
                                    <th>Depre.Date</th>
                                    <th>Deprecation Pay Day</th>
                                    <th>Deprecation Amount Pay Month</th>
                                    <th>Deprecation Total Amount</th>
                                    <th>Photo</th>
                                    <th style="width: 180px;">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM `admin_asset_depreciation` A 
                                          LEFT JOIN `assest_code_creation` B ON A.adassd_code = B.ac_id
                                          LEFT JOIN `text_asset_code_creation_type` C ON C.acct_id = A.adassd_type
                                          ";
                                 $result = $connect->query($sql);
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $v_i = $i++;
                                    $v_as_code = $row['ac_asset_code'];
                                    $v_as_type = $row['acct_name'];
                                    $v_as_name = $row['adassd_asset_name'];
                                    $v_start_date = $row['adassd_date'];
                                    $v_as_qty = $row['adassd_qty'];
                                    $v_price = $row['adassd_price'];
                                    $v_total = $row['adassd_amount'];
                                    $v_depre_no = $row['adassd_depre_no'];
                                    $v_depre_date = $row['adassd_depre_date'];
                                    $v_depre_pay_day = $row['adassd_depre_payday'];
                                    $v_depre_pay_month = $row['adassd_depre_amount_per_month'];
                                    $v_depre_total_amount = $row['adassd_depre_total_amount'];
                                    $v_img = $row['adassd_img'];
                                 ?>
                                    <tr>
                                       <td class="text-center"><?= $v_i; ?></td>
                                       <td class="text-center"><?= $v_as_code; ?></td>
                                       <td class="text-center"><?= $v_as_type; ?></td>
                                       <td class="text-center"><?= $v_as_name; ?></td>
                                       <td class="text-center"><?= $v_start_date; ?></td>
                                       <td class="text-center"><?= $v_as_qty; ?></td>
                                       <td class="text-center"><?= $v_price . '$'; ?></td>
                                       <td class="text-center"><?= $v_total . '$'; ?></td>
                                       <td class="text-center"><?= $v_depre_no; ?></td>
                                       <td class="text-center"><?= $v_depre_date; ?></td>
                                       <td class="text-center"><?= $v_depre_pay_day . '$'; ?></td>
                                       <td class="text-center"><?= $v_depre_pay_month . '$'; ?></td>
                                       <td class="text-center"><?= $v_depre_total_amount . '$'; ?></td>
                                       <td class="text-center">
                                          <img class="rounded img-fuild" src="../img<?php if ($v_img != '') {
                                                                                       echo '/upload/asset_depreciation/' . $v_img;
                                                                                    } else {
                                                                                       echo '/no_image.jpg';
                                                                                    } ?>" ismap style="width:50px; height:50px;" />
                                          <a style="float:right; cursor:pointer;" onclick="doImage(
                                                               '<?= $row['adassd_id']; ?>',
                                                               '<?= $row['adassd_img']; ?>',
                                                            );" data-toggle="modal" data-target="#modal_image" href="#"><i style="color:#3c8dbc;" class="fa fa-pencil"></i>
                                          </a>
                                       </td>
                                       <td style="vertical-align: middle;" class="text-center">
                                          <a class="btn btn-sm btn-primary" href="admin_asset_depreciation_view.php?id=<?php echo $row['adassd_id']; ?>"><i class="fa fa-eye"></i>
                                          </a>

                                          <a target="_blank" class="btn btn-sm btn-success" href="print_depreciation.php?id=<?php echo $row['adassd_id']; ?>"><i class="fa fa-print"></i>
                                          </a>

                                          <a onclick="doupdate(
                                                '<?php echo $row['adassd_id']; ?>',
                                                '<?php echo $row['adassd_code']; ?>',
                                                '<?php echo $row['adassd_depre_no']; ?>',
                                                '<?php echo $row['adassd_category']; ?>',
                                                '<?php echo $row['adassd_depre_age']; ?>',
                                                '<?php echo $row['adassd_type']; ?>',
                                                '<?php echo $row['adassd_asset_name']; ?>',
                                                '<?php echo $row['adassd_depre_date']; ?>',
                                                '<?php echo $row['adassd_qty']; ?>',
                                                '<?php echo $row['adassd_mou']; ?>',
                                                '<?php echo $row['adassd_depre_payday']; ?>',
                                                '<?php echo $row['adassd_price']; ?>',
                                                '<?php echo $row['adassd_depre_amount_per_month']; ?>',
                                                '<?php echo $row['adassd_amount']; ?>',
                                                '<?php echo $row['adassd_depre_total_amount']; ?>',
                                                '<?php echo $row['adassd_note']; ?>',
                                                '<?php echo $row['adassd_mater_id']; ?>',
                                                '<?php echo $row['adassd_date']; ?>',
                                             );" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_update" href="">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure deleted this row??'); " href="admin_asset_depreciation.php?id=<?= $row['adassd_id']; ?>"><i class="fa fa-trash"></i></a>
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
         window.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
               var no = 1;
               $(".add-row").on('click', function() {
                  // var material_no = "<td><input class='form-control' type='text' name='asset_material_no[]' id='asset_material_no'/></td>";
                  var material = "<td><input class='form-control' required name='asset_material[]' id='asset_material' type='text'></td>";
                  var qty = "<td><input class='form-control' required name='asset_qty_insert[]' id='asset_qty_insert' type='number'></td>";
                  var mou = `<td>
                                 <select class='form-control' required name='asset_in_mou[]' id='asset_in_mou'data-live-search="true">
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
                  var Remark = "<td><input class='form-control' required name='asset_remark[]' id='asset_remark' type='text'></td>";
                  var remove_button = "<td><button type='button' class='remove-row btn btn-sm btn-danger'><i class='fa fa-trash'></i></button></td>";
                  //    var action = "<th class='text-center'><i class='fa fa-cog' ></i></th>";
                  var markup = "<tr>" + "<td>" + no + "</td>" + material + qty + mou + Remark + remove_button + "</tr>";
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

         function doupdate(id, as_code, dep_no, category, dep_age, as_type, as_name, dep_start_date, qty, mou, dep_day, price, edit_de_amount_per_month, edit_total_amount, edit_depre_total_amount, edit_note, edit_material, date) {
            $("#edit_id").val(id);
            $("#edit_code").val(as_code).change();
            $("#edit_depre_no").val(dep_no);
            $("#edit_category").val(category).change();
            $("#edit_depre_age").val(dep_age);
            $("#edit_as_type").val(as_type).change();
            $("#edit_as_name").val(as_name);
            $("#edit_depre_start_date").val(dep_start_date);
            $("#edit_QTY").val(qty);
            $("#edit_mou").val(mou).change();
            $("#edit_de_amount_per_day").val(dep_day);
            $("#edit_unit_price").val(price);
            $("#edit_de_amount_per_month").val(edit_de_amount_per_month);
            $("#edit_total_amount").val(edit_total_amount);
            $("#edit_depre_total_amount").val(edit_depre_total_amount);
            $("#edit_material").val(edit_material);
            $("#edit_note").val(edit_note);
            $("#edit_date").val(date);
         }

         function doImage(id, photo) {
            $('#asset_photo').val(id);
            $("#txt_old_img").val(photo);
            if (photo == '' || photo == "NULL") {
               document.getElementById('show_photo').setAttribute('src', '../img/no_image.jpg');
            } else {
               document.getElementById('show_photo').setAttribute('src', '../img/upload/asset_depreciation/' + photo);
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
            $("#asset_depre").addClass("active");
            $("#asset_depre").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>
   </div>
</body>

</html>