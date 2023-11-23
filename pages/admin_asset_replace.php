<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
/** tartget directory */
/* file upload */
$targetDir = "../img/upload/asset_replacement/file/";
/* img directory upload */
$targetDir_img = "../img/upload/asset_replacement/image/";
/**
 * Add New Records
 */
if (isset($_POST['btnadd_new'])) {
   $v_code = $_POST['asset_code'];
   $v_pano_ref = $_POST['asset_pano_ref'];
   $v_category = $_POST['asset_category'];
   $v_asset_type = $_POST['asset_type'];
   $v_asset_name = $_POST['asset_name'];
   $v_asset_mou = $_POST['asset_mou'];
   $v_asset_unit_price = $_POST['asset_unit_price'];
   $v_asset_total = $_POST['asset_total'];
   $v_asset_location = $_POST['asset_location'];
   $v_asset_replace_code = $_POST['asset_replace_code'];
   $v_asset_start_date = $_POST['asset_start_date'];
   $v_asset_status = $_POST['asset_status'];
   $v_asset_supplier_name = $_POST['asset_supplier_name'];
   $v_asset_contact = $_POST['asset_contact'];
   $v_asset_inv_ref = $_POST['asset_inv_ref'];
   $v_replace_date = $_POST['asset_replace_date'];
   /** upload file */
   $v_asset_file = $_FILES['asset_file']['name'];
   if (!empty($v_asset_file)) {
      $v_file = $_FILES['asset_file'];
      $targetDir .= basename($_FILES['asset_file']['name']);
      $file_type = strtolower(pathinfo($targetDir, PATHINFO_EXTENSION));
      if ($file_type === "pdf") {
         $new_name = date("Ymd") . "-" . rand(111, 999) . ".pdf";
         move_uploaded_file($v_file['tmp_name'], "../img/upload/asset_replacement/file/" . $new_name);
      }
   }
   /** image uploads */
   $v_image = $_FILES['asset_image']['name'];
   $v_img_name = '';
   if (!empty($v_image)) {
      $v_img_name = date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      $v_img_fullname = $targetDir_img . date("Ymd") . "_" . basename($_FILES['asset_image']['name']);
      move_uploaded_file($_FILES['asset_image']['tmp_name'], $v_img_fullname);
   }
   $v_asset_warry_period = $_POST['asset_warry_period'];
   $v_asset_condition = $_POST['asset_condition'];
   $v_asset_inspection = $_POST['asset_inspection'];
   $v_replace_no = $_POST['asset_material_id'];
   $v_material_id = $_POST['asset_material_id'];
   /** Insert to database */

   $sql = "INSERT INTO admin_asset_replacement(
                                          adassr_code
                                          ,adassr_ref
                                          ,adassr_category
                                          ,adassr_type
                                          ,adassr_asset_name
                                          ,adassr_mou
                                          ,adassr_unit_price
                                          ,adassr_total
                                          ,adassr_location
                                          ,adassr_replace_code
                                          ,adassr_date
                                          ,adassr_status
                                          ,adassr_supplier_name
                                          ,adassr_contact
                                          ,adassr_inv_ref
                                          ,ada_ssr_replace_date
                                          ,adassr_file
                                          ,adassr_img
                                          ,adassr_war_peri
                                          ,adassr_war_con
                                          ,adassr_insepection
                                          ,adassr_replace_no
                                          ,adssr_material_id
                                          ,adassr_userid
                                          ,adassr_created_date
                                          )
                                          VALUES(
                                             '$v_code'
                                             ,'$v_pano_ref'
                                             ,'$v_category'
                                             ,'$v_asset_type'
                                             ,'$v_asset_name'
                                             ,'$v_asset_mou'
                                             ,'$v_asset_unit_price'
                                             ,'$v_asset_total'
                                             ,'$v_asset_location'
                                             ,'$v_asset_replace_code'
                                             ,'$v_asset_start_date'
                                             ,'$v_asset_status'
                                             ,'$v_asset_supplier_name'
                                             ,'$v_asset_contact'
                                             ,'$v_asset_inv_ref'
                                             ,'$v_replace_date'
                                             ,'$new_name'
                                             ,'$v_img_name'
                                             ,'$v_asset_warry_period'
                                             ,'$v_asset_condition'
                                             ,'$v_asset_inspection'
                                             ,'$v_replace_no'
                                             ,'$v_material_id'
                                             ,'$user_id'
                                             ,NOW()
                                          );";
   /** query to database */
   $result = mysqli_query($connect, $sql);
   /** Add to material form */
   if (!empty($_POST['asset_material']) || !empty($_POST['asset_remark'])) {
      for ($a = 0; $a < count($_POST['asset_material']); $a++) {
         $sql_m = "INSERT INTO admin_replacement_material(
                                                   adrm_material_name,
                                                   adrm_qty,
                                                   adrm_mou_id,
                                                   adrm_remark,
                                                   adrm_material_id
                                                      )
                                                      VALUES(
                                                         '" . $_POST['asset_material'][$a] . "'
                                                         ,'" . $_POST['asset_qty_insert'][$a] . "'
                                                         ,'" . $_POST['asset_in_mou'][$a] . "'
                                                         ,'" . $_POST['asset_remark'][$a] . "'
                                                         ,'" . $v_material_id . "'
                                                      )";
         /** query to database  */
         mysqli_query($connect, $sql_m);
      }
   }
   header('location:admin_asset_replace.php?message=success');
   exit();
}
/** Delete Record */
if (isset($_GET['del_id'])) {
   $id = $_GET['del_id'];
   $sql = "DELETE FROM admin_asset_replacement WHERE adassr_id = '$id'";
   mysqli_query($connect, $sql);
   header('location:admin_asset_replace.php?message=delete');
   exit();
}
/** update record */
if (isset($_POST['btn_update'])) {
   $v_id = $_POST['asset_id_edit'];
   $v_replace_no = $_POST['edit_replace_no'];
   $v_start_date = $_POST['edit_start_date'];
   $v_code = $_POST['edit_code'];
   $v_pano_ref = $_POST['edit_pano_ref'];
   $v_edit_replace_code = $_POST['edit_replace_code'];
   $v_edit_mou = $_POST['edit_mou'];
   $v_edit_qty = $_POST['edit_qty'];
   $v_edit_replace_date = $_POST['edit_replace_date'];
   $v_edit_asset_name = $_POST['edit_asset_name'];
   $v_edit_type = $_POST['edit_type'];
   $v_edit_category = $_POST['edit_category'];
   $v_edit_status = $_POST['edit_status'];
   $v_edit_inspection = $_POST['edit_inspection'];
   $v_edit_warry_condition = $_POST['edit_warry_condition'];
   $v_edit_warry_period = $_POST['edit_warry_period'];
   $v_edit_inv_ref_no = $_POST['edit_inv_ref_no'];
   $v_edit_asset_location = $_POST['edit_asset_location'];
   $v_edit_asset_contact = $_POST['edit_asset_contact'];
   $v_edit_supplier_name = $_POST['edit_supplier_name'];
   $v_edit_total_amount = $_POST['edit_total_amount'];
   $v_edit_unit_price = $_POST['edit_unit_price'];

   $sql = "UPDATE admin_asset_replacement SET adassr_replace_no = '$v_replace_no',
                                             adassr_date = '$v_start_date',
                                             adassr_code = '$v_code',
                                             adassr_type = '$v_edit_type',
                                             adassr_ref = '$v_pano_ref',
                                             adassr_replace_code = '$v_edit_replace_code',
                                             adassr_mou = '$v_edit_mou',
                                             adassr_qty = '$v_edit_qty',
                                             ada_ssr_replace_date = '$v_edit_replace_date',
                                             adassr_asset_name = '$v_edit_asset_name',
                                             adassr_category = '$v_edit_category',
                                             adassr_status = '$v_edit_status',
                                             adassr_insepection = '$v_edit_inspection',
                                             adassr_war_con = '$v_edit_warry_condition',
                                             adassr_war_peri = '$v_edit_warry_period',
                                             adassr_inv_ref = '$v_edit_inv_ref_no',
                                             adassr_location = '$v_edit_asset_location',
                                             adassr_contact = '$v_edit_asset_contact',
                                             adassr_supplier_name ='$v_edit_supplier_name',
                                             adassr_total = '$v_edit_total_amount',
                                             adassr_unit_price = '$v_edit_unit_price'
                                             where adassr_id = '$v_id'
                                             ";
   $result = mysqli_query($connect, $sql);
   header("location:admin_asset_replace.php?message=update");
   exit();
}
/** update_images */
if (isset($_POST['btnimage'])) {
   $img_id = $_POST['asset_photo'];
   $img = $_FILES['edit_photo']['name'];
   $v_img = '';
   if (!empty($img)) {
      $v_img = date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      $v_image_fullname = $targetDir_img . date("Ymd") . "_" . basename($_FILES['edit_photo']['name']);
      move_uploaded_file($_FILES['edit_photo']['tmp_name'], $v_image_fullname);
      $sql = "UPDATE admin_asset_replacement SET adassr_img = '$v_img' where adassr_id = $img_id";
      mysqli_query($connect, $sql);
      header("location:admin_asset_replace.php?message=update");
      exit();
   }
}
/** update_files */
if(isset($_POST['btnUpdate_file'])){
   $v_file_id = $_POST['edit_file'];
   $v_file = @$_FILES['file_update'];
   $dir = '../img/upload/asset_replacement/file' . basename($_FILES['file_update']['name']);
   $file_type = strtolower(pathinfo($dir, PATHINFO_EXTENSION));
   if($file_type == 'pdf'){
      if($v_file['name']!=""){
         $new_name = date("Ymd") . "-" . rand(1111,9999) . ".pdf";
         move_uploaded_file($v_file['tmp_name'],'../img/upload/asset_replacement/file/'. $new_name);
         $sql = "UPDATE admin_asset_replacement SET adassr_file = '$new_name' where adassr_id ='$v_file_id'";
         mysqli_query($connect,$sql);
         header("location:admin_asset_replace.php?message=update");
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
   <style>
      @media only screen and (max-width:500px) {
         .modal-dialog {
            max-width: 450px;
         }

      }
   </style>
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
            <h1>Admin Asset Replacement</h1>
         </section>
         <section class="content">
            <div class="row">
               <!-- modal_add_new -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:750px">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h3 class="modal-title text-primary " id="exampleModalLabel"><i class="fa fa-plus-square-o"></i>Add New</h3>
                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                           <div class="modal-body">
                              <div class="row">
                                 <div class="content-row col-md-12">
                                    <div class="col-xs-4">
                                       <div class="col-md-12">
                                          <h4 class="form-label" style=" font-weight: bold; ">Asset Photo:</h4>
                                          <figure class="figure">
                                             <img src="../img/no_image.jpg" id="show_photo" class="rounded img-thumbnail img-fuild" height="900px;" alt="..." />
                                          </figure>
                                          <input class="form-control" type="file" name="asset_image" id="asset_image" accept="image/*" onchange="show_photo_pre_add(event);">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="">Replace No:</label>
                                          <input type="text" name="asset_replace_no" id="asset_replace_no" class="form-control">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="">Material_ID:</label>
                                          <input type="number" name="asset_material_id" id="asset_material_id" required class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-xs-4">
                                       <div class="form-group col-md-12">
                                          <label style="font-size: 20px; text-align: center; " for="">Asset Information:</label>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_code">Asset Code:</label>
                                          <select type="text" name="asset_code" id="asset_code" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM assest_code_creation";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['ac_id'] . '>' . $row['ac_asset_code'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_pano_ref">PA No ref:</label>
                                          <select type="text" name="asset_pano_ref" id="asset_pano_ref" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM asset_requisiton";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['as_id'] . '>' . $row['as_pa_no'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_category">Asset Category:</label>
                                          <select type="text" name="asset_category" id="asset_category" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM assest_code_creation";
                                             $i = 1;
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['ac_id'] . '>' . $row['as_asset_category'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_type">Asset Type:</label>
                                          <select type="text" name="asset_type" id="asset_type" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM text_asset_code_creation_type";
                                             $i = 1;
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['acct_id'] . '>' . $row['acct_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <lable style="font-weight: bold;" class="">Asset Name:</lable>
                                          <input type="text" name="asset_name" id="asset_name" class="form-control">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <lable style="font-weight: bold;" class="">QTY:</lable>
                                          <input type="number" name="asset_qty" id="asset_qty" class="form-control">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label for="asset_mou" class="">Mou:</label>
                                          <select name="asset_mou" id="asset_mou" class="form-control" data-live-search="true">
                                             <option selected value=""></option>
                                             <?php
                                             $sql = "SELECT * FROM text_asset_in_mou";
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['aim_id'] . '">' . $row['aim_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <lable style="font-weight: bold;" class="">Unit Price:</lable>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input type="number" name="asset_unit_price" id="asset_unit_price" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <lable style="font-weight: bold;" class="">Total Amount:</lable>
                                          <div class="input-group">
                                             <div class="input-group-addon">$</div>
                                             <input type="number" name="asset_total" id="asset_total" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="">Location:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                             <input type="text" name="asset_location" class="form-control" id="asset_location">
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_replace_code">Replace To Code:</label>
                                          <select type="text" name="asset_replace_code" id="asset_replace_code" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM asset_requisiton";
                                             $i = 1;
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['as_id'] . '>' . $row['as_pa_no'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-xs-4">
                                       <div class="form-group col-md-12">
                                          <label style="font-size: 20px; text-align: center; " for="">Calendar Selection:</label>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_start_date">Start Date:</label>
                                          <input class="form-control" type="date" name="asset_start_date" id="asset_start_date">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_status">Status:</label>
                                          <select type="text" name="asset_status" id="asset_status" class="form-control" data-live-search='true'>
                                             <option value="" selected></option>
                                             <?php
                                             $sql = "SELECT * FROM text_asset_broken_status";
                                             $i = 1;
                                             $result = mysqli_query($connect, $sql);
                                             while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value=' . $row['tasb_id'] . '>' . $row['tasb_name'] . '</option>';
                                             }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_supplier_name">Supplier Name:</label>
                                          <input class="form-control" type="text" name="asset_supplier_name" id="asset_supplier_name">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_contact">Contact:</label>
                                          <div class="input-group">
                                             <div class="input-group-addon"><i class='fa fa-phone'></i></div>
                                             <input class="form-control" type="text" name="asset_contact" id="asset_contact">
                                          </div>
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_inv_ref">Inv Ref No:</label>
                                          <input class="form-control" type="text" name="asset_inv_ref" id="asset_inv_ref">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_file">Attach File Inv No:</label>
                                          <input class="form-control" type="file" name="asset_file" id="asset_file">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_warry_period">Warranty Period:</label>
                                          <input class="form-control" type="text" name="asset_warry_period" id="asset_inv_ref">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_condition">Warranty Condition:</label>
                                          <input class="form-control" type="text" name="asset_condition" id="asset_condition">
                                       </div>
                                       <div class=" col-md-12">
                                          <label for="asset_inspection">Inspection:</label>
                                          <input class="form-control" type="text" name="asset_inspection" id="asset_inspection">
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label for="asset_replace_date">Replace Date:</label>
                                          <input class="form-control" type="date" name="asset_replace_date" id="asset_replace_date">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 row">
                                    <table id="asset_table" class="table table-striped">
                                       <tr>
                                          <th class="text-center">No</th>
                                          <th class="text-center">Material_Name</th>
                                          <th class="text-center">QTY</th>
                                          <th class="text-center">Mou</th>
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
                              <button type="submit" name="btnadd_new" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_add_new -->
               <!-- modal_update  -->
               <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>Update Asset Replacement</h4>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="asset_id_edit" id="asset_id_edit">
                              <div class="col-xs-12">
                                 <div class="form-group col-xs-6">
                                    <label for="">Replace_No:</label>
                                    <input type="text" name="edit_replace_no" id="edit_replace_no" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Start_Date:</label>
                                    <input type="date" name="edit_start_date" id="edit_start_date" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Asset_Code:</label>
                                    <select name="edit_code" id="edit_code" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM assest_code_creation";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['ac_id'] ?>"><?= $row['ac_asset_code'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">PA_No_Ref:</label>
                                    <select name="edit_pano_ref" id="edit_pano_ref" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM asset_requisiton";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['as_id'] ?>"><?= $row['as_pa_no'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Replace_to_code:</label>
                                    <select name="edit_replace_code" id="edit_replace_code" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM asset_requisiton";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['as_id'] ?>"><?= $row['as_pa_no'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Status:</label>
                                    <select name="edit_status" id="edit_status" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_broken_status";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['tasb_id'] ?>"><?= $row['tasb_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Category:</label>
                                    <select name="edit_category" id="edit_category" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM assest_code_creation";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['ac_id'] ?>"><?= $row['as_asset_category'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Asset_Type:</label>
                                    <select name="edit_type" id="edit_type" class="form-control" data-live-search="true">
                                       <option selected value=""></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_code_creation_type";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['acct_id'] ?>"><?= $row['acct_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Asset_Name:</label>
                                    <input type="text" name="edit_asset_name" class="form-control" id="edit_asset_name">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Replace_Date:</label>
                                    <input type="date" name="edit_replace_date" id="edit_replace_date" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-3">
                                    <label for="">QTY:</label>
                                    <input type="number" name="edit_qty" id="edit_qty" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-3">
                                    <label for="">Mou:</label>
                                    <select type="number" name="edit_mou" id="edit_mou" class="form-control">
                                       <option value="" selected></option>
                                       <?php
                                       $sql = "SELECT * FROM text_asset_in_mou";
                                       $result = mysqli_query($connect, $sql);
                                       while ($row = mysqli_fetch_assoc($result)) {
                                       ?>
                                          <option value="<?= $row['aim_id']; ?>"><?= $row['aim_name'] ?></option>
                                       <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="edit_unit_price" class="form-label">Unit_Price:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" name="edit_unit_price" id="edit_unit_price" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="col-xs-6 form-group">
                                    <label for="edit_total_amount" class="form-label">Total_Amount:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">$</div>
                                       <input type="number" name="edit_total_amount" id="edit_total_amount" class="form-control" />
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="edit_supplier_name">Supplier Name:</label>
                                    <input type="text" name="edit_supplier_name" class="form-control" id="edit_supplier_name">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="edit_asset_contact">Contact:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class='fa fa-phone'></i></div>
                                       <input class="form-control" type="text" name="edit_asset_contact" id="edit_asset_contact">
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Location:</label>
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                       <input type="text" name="edit_asset_location" class="form-control" id="edit_asset_location">
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Inv Ref No:</label>
                                    <input type="text" name="edit_inv_ref_no" id="edit_inv_ref_no" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Warranty Period:</label>
                                    <input type="text" name="edit_warry_period" id="edit_warry_period" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Warranty Condition:</label>
                                    <input type="text" name="edit_warry_condition" id="edit_warry_condition" class="form-control">
                                 </div>
                                 <div class="form-group col-xs-6">
                                    <label for="">Inspection:</label>
                                    <input type="text" name="edit_inspection" id="edit_inspection" class="form-control">
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="btn_update" class="btn btn-sm btn-primary"><i class="fa fa-save">&nbsp;</i>Save</button>
                                 <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                              </div>
                           </form>
                        </div>

                     </div>
                  </div>
               </div>
               <!-- end_modal_update -->
               <!-- image_modal -->
               <div class="modal fade" id="exampleModal_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;Update Photo</h4>
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
               <!-- end_image_modal -->
               <!-- modal_file  -->
               <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title text-primary" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;Update File*</h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <form action="" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="edit_file" id="edit_file">
                              <input type="hidden" name="old_file" id="old_file">
                              <div class="col-xs-12 form-group">
                                 <label for="">File:</label>
                                 <input type="file" name="file_update" class="form-control" accept=".pdf" id="file_update"onchange ="loadFile(event);">
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="btnUpdate_file" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                           <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- end_modal_file -->
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
                                    <th class="text-center">No</th>
                                    <th class="text-center">Asset Code</th>
                                    <th class="text-center">Asset Type</th>
                                    <th class="text-center">Asset Name</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">Current Price</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">AR No</th>
                                    <th class="text-center">Replace Date</th>
                                    <th class="text-center">Replace to Code</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">File</th>
                                    <th style="width: 130px;" class="text-center"><i class="fa fa-cog"></i></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql = "SELECT * FROM admin_asset_replacement A
                                          LEFT JOIN assest_code_creation B ON B.ac_id = A.adassr_code
                                          LEFT JOIN asset_requisiton C ON C.as_id = A.adassr_replace_code
                                          LEFT JOIN text_asset_broken_status D ON D.tasb_id = A.adassr_status
                                          LEFT JOIN text_asset_code_creation_type E ON E.acct_id = A.adassr_type";
                                 $result = mysqli_query($connect, $sql);
                                 $i = 1;
                                 while ($row = mysqli_fetch_assoc($result)) {
                                    $v_i = $i++;
                                    $v_code = $row['ac_asset_code'];
                                    $v_name = $row['adassr_asset_name'];
                                    $v_start_date = $row['adassr_date'];
                                    $v_qty = $row['adassr_qty'];
                                    $v_c_price = $row['adassr_unit_price'];
                                    $v_total = $row['adassr_total'];
                                    $v_replace_no = $row['adassr_replace_no'];
                                    $v_replace_date = $row['ada_ssr_replace_date'];
                                    $v_replace_code = $row['as_pa_no'];
                                    $v_status = $row['tasb_name'];
                                    $v_photo = $row['adassr_img'];
                                    $v_file = $row['adassr_file'];
                                    $v_type = $row['acct_name']
                                 ?>
                                    <tr>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_i; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_code; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_type; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_name; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_start_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_qty; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_c_price) . '$'; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= number_format($v_total) . '$' ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_replace_no; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_replace_date; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_replace_code; ?></td>
                                       <td class="text-center" style="vertical-align: middle;"><?= $v_status; ?></td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <img src="../img/<?php if ($v_photo != '') {
                                                               echo 'upload/asset_replacement/image/' . $v_photo;
                                                            } else {
                                                               echo 'no_image.jpg';
                                                            } ?>" width="70px" height="70px" alt="">
                                          <a style="float:right; cursor:pointer;" onclick="doImage('<?php echo $row['adassr_id']; ?>','<?php echo $v_photo; ?>');" href="" data-toggle="modal" data-target="#exampleModal_img"><i style="color:#3c8dbc;" class="fa fa-pencil"></i></a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <?php
                                          if ($v_file == '') {
                                          ?>
                                             <a target="_blank" href="../img/file/image_no_file.png">
                                                <img src="../img/file/image_no_file.png" width="70px" height="70px" alt="">
                                             </a>
                                          <?php
                                          } else {
                                          ?>
                                             <a href="../img/upload/asset_replacement/file/<?php echo $v_file; ?>" target="_blank">
                                                <img src="../img/file/pdf_image.png" alt="" height="70px" width="70px">
                                             </a>
                                          <?php
                                          }
                                          ?>
                                          <a style="float:right; cursor:pointer;" onclick="doFile('<?php echo $row['adassr_id'];?>','<?php echo $v_file;?>');" href=""data-toggle="modal" data-target="#modal_file"><i class="fa fa-pencil" ></i></a>
                                       </td>
                                       <td class="text-center" style="vertical-align: middle;">
                                          <a onclick="doUpdate(
                                             '<?php echo $row['adassr_id']; ?>',
                                             '<?php echo $row['adassr_replace_no']; ?>',
                                             '<?php echo $row['adassr_date']; ?>',
                                             '<?php echo $row['adassr_code']; ?>',
                                             '<?php echo $row['adassr_ref']; ?>',
                                             '<?php echo $row['adassr_replace_code']; ?>',
                                             '<?php echo $row['adassr_status']; ?>',
                                             '<?php echo $row['adassr_category']; ?>',
                                             '<?php echo $row['adassr_type']; ?>',
                                             '<?php echo $row['adassr_asset_name']; ?>',
                                             '<?php echo $row['ada_ssr_replace_date']; ?>',
                                             '<?php echo $row['adassr_qty']; ?>',
                                             '<?php echo $row['adassr_mou']; ?>',
                                             '<?php echo $row['adassr_unit_price']; ?>',
                                             '<?php echo $row['adassr_total']; ?>',
                                             '<?php echo $row['adassr_supplier_name']; ?>',
                                             '<?php echo $row['adassr_contact']; ?>',
                                             '<?php echo $row['adassr_location']; ?>',
                                             '<?php echo $row['adassr_inv_ref']; ?>',
                                             '<?php echo $row['adassr_war_peri']; ?>',
                                             '<?php echo $row['adassr_war_con']; ?>',
                                             '<?php echo $row['adassr_insepection']; ?>',
                                          );" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#modal_update"><i class="fa fa-edit"></i>
                                          </a>
                                          <a class="btn btn-sm btn-info" href="admin_asset_replace_view.php?id=<?=$row['adassr_id'];?>&&material_id=<?=$row['adssr_material_id'];?>"><i class="fa fa-eye"></i></a>
                                          <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="admin_asset_replace.php?del_id=<?= $row['adassr_id']; ?>"><i class="fa fa-trash"></i></a>
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
         function doUpdate(id, replace_no, start_date, asset_code, pano_ref, repace_code, status, category, type, asset_name, replace_date, qty, mou, price, total, supplier, contact, location, inv_ref, perid, condition, inspection) {
            $("#asset_id_edit").val(id);
            $("#edit_replace_no").val(replace_no);
            $("#edit_start_date").val(start_date);
            $("#edit_code").val(asset_code).change();
            $("#edit_pano_ref").val(pano_ref).change();
            $("#edit_replace_code").val(repace_code).change();
            $("#edit_status").val(status).change();
            $("#edit_category").val(category).change();
            $("#edit_type").val(type).change();
            $("#edit_asset_name").val(asset_name);
            $("#edit_replace_date").val(replace_date);
            $("#edit_qty").val(qty);
            $("#edit_mou").val(mou).change();
            $("#edit_unit_price").val(price);
            $("#edit_total_amount").val(total);
            $("#edit_supplier_name").val(supplier);
            $("#edit_asset_contact").val(contact);
            $("#edit_asset_location").val(location);
            $("#edit_inv_ref_no").val(inv_ref);
            $("#edit_warry_period").val(perid);
            $("#edit_warry_condition").val(condition);
            $("#edit_inspection").val(inspection);
         }
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

         function doImage(id, photo) {
            $('#asset_photo').val(id);
            $("#txt_old_img").val(photo);
            if (photo == '' || photo == "NULL") {
               document.getElementById('v_show_photo').setAttribute('src', '../img/no_image.jpg');
            } else {
               document.getElementById('v_show_photo').setAttribute('src', '../img/upload/asset_replacement/image/' + photo);
            }
         }

         function show_photo_pre(event) {
            if (event.target.files.length > 0) {
               var src = URL.createObjectURL(event.target.files[0]);
               document.getElementById('v_show_photo').src = src;
            }
         }

         function show_photo_pre_add(event) {
            if (event.target.files.length > 0) {
               var src = URL.createObjectURL(event.target.files[0]);
               document.getElementById("show_photo").src = src;
            }
         }
         function loadFile(e){
            var output =document.getElementById("file_update");
            output.width = 50;
            output.scr =URL.createObjectURL(e.target.files[0]);
         }
         function doFile(id,file){
            $("#edit_file").val(id);
            $("#old_file").val(file);
         }
         $(function() {
            $("select").selectpicker();
            $("#menu_admin_manage").addClass("active");
            $("#asset_replace").addClass("active");
            $("#asset_replace").css("background-color", "##367fa9");
            $('#info_data').dataTable();
         });
      </script>
   </div>
</body>

</html>